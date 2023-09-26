<?php
session_start();
require_once('../vendor/setasign/fpdf/fpdf.php');
require_once('../vendor/setasign/fpdi/src/autoload.php');
require_once('../vendor/smalot/pdfparser/src/Smalot/PdfParser/Parser.php');
require_once('../vendor/autoload.php');
require_once('./dbcon.php');
use setasign\Fpdi\Fpdi;
use Smalot\PdfParser\Parser;
use setasign\Fpdi\PdfParser\PdfParser;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\FpdiPdfParser\PdfParser\CrossReference\CompressedReader;
use setasign\FpdiPdfParser\PdfParser\CrossReference\CorruptedReader;
if (!$con) {
    ?>
    <script>alert("Connection Unsuccessful!!!");</script>
<?php
}

function compareTextInPdf($pdfFile, $startCharacter, $endCharacter, $con) {
    $success = false;

    try {
    // Đếm số trang trong tệp PDF
    $parser = new Parser();
    $pdfData = $parser->parseFile($pdfFile);
    $totalPages = count($pdfData->getPages());
    
    // Biến để theo dõi trạng thái thành công
    $success = false;
    // Kích thước tệp PDF mới 
    $pdfWidth = 210 ;
    $pdfHeight = 297  ;
        // Tạo một lớp con từ lớp FPDF
    class CustomPDF extends FPDI {
        function Header() {
            // Không có header trong trường hợp này
        }

        function Footer() {
            // Không có footer trong trường hợp này
        }
    }
    // Lặp qua từng trang và so sánh văn bản
    for ($page = 1; $page <= $totalPages; $page++) {
        // Khởi tạo một đối tượng FPDI riêng cho mỗi trang
        $pdf = new CustomPDF('P', 'mm', array($pdfWidth, $pdfHeight));
        $pdf->setSourceFile($pdfFile);
        
        // Thêm trang mới vào tệp PDF mới
        $pdf->AddPage();
        // Vẽ một đường chéo để kiểm tra kích thước
        // $pdf->Line(0, 0, $pdfWidth, $pdfHeight);
        // Nhập trang từ tệp PDF ban đầu
        $importedPage = $pdf->importPage($page);
        $pdf->useTemplate($importedPage);
        
        // Trích xuất văn bản từ trang PDF
        $text = $pdfData->getPages()[$page - 1]->getText();
        
        // Tìm vị trí của ký tự bắt đầu và kết thúc
        $startPos = strpos($text, $startCharacter);
        $endPos = strpos($text, $endCharacter);
        if ($startPos !== false && $endPos !== false && $endPos > $startPos) {
            // Trích xuất phần của văn bản giữa ký tự bắt đầu và kết thúc
            $extractedText = substr($text, $startPos + 3, $endPos - $startPos - 3);
            // Tạo tên tệp PDF mới dựa trên số trang và phần của văn bản được trích xuất
            $newPdfFileName = $extractedText . '.pdf';
            $new_file_name = $newPdfFileName;
            $counter = 1;
            
            while (file_exists("./pdf/" . $new_file_name)) {
                // If file already exists, append a counter to the file name
                $new_file_name = '('.$counter.') '.$newPdfFileName  ;
                $counter++;
            }
            
            // Lưu tệp PDF mới
            $pdf->Output('./pdf/' . $new_file_name, 'F');
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = date('Y-m-d H:i:s');
            $name_user = $_SESSION['name'];
            $insertquery = "INSERT INTO pdf_data(`idOrder`,`filename`,`time`,`name_user`) VALUES('$extractedText','$new_file_name','$time','$name_user')";
            
            // Execute insert query
            $iquery = mysqli_query($con, $insertquery);
            
            // Kiểm tra nếu có ít nhất một bản ghi được thêm thành công
            if ($iquery) {
                $success = true;
            }
        }
    }        } catch (Exception $e) {
        // Xử lý ngoại lệ và hiển thị cảnh báo
        echo '<script>alert("Đã xảy ra lỗi: ' . $e->getMessage() . '");
        window.close(); 
        </script>';
    }

    return $success;
}

// Sử dụng hàm findOrderId
if (isset($_POST['submit'])) {
    if (isset($_FILES['pdf_file']['name'])) {
        // Nếu trường 'pdf_file' có tệp đính kèm
        $file_name = $_FILES['pdf_file']['name'];
        $file_tmp = $_FILES['pdf_file']['tmp_name'];
        // Check if file already exists
        // Di chuyển tệp PDF đã tải lên vào thư mục 'pdf'
        move_uploaded_file($file_tmp, "./pdf/" . $file_name);
        
        // Đường dẫn đến tệp PDF
        $pdfFilePath = "./pdf/" . $file_name;
        
        // Ký tự bắt đầu
        $startCharacter = 'FLO';
        
        // Ký tự kết thúc
        $endCharacter = 'MEX';
        
        // So sánh văn bản trong tệp PDF và tạo các tệp PDF mới chứra phần của văn bản giữa ký tự bắt đầu và kết thúc
        $inserted = compareTextInPdf($pdfFilePath, $startCharacter, $endCharacter, $con);
        
        // Xóa tệp PDF gốc
        unlink("./pdf/" . $file_name);
        
        if ($inserted) {
            ?>
            <script>
                alert("Upload label thành công!");
                window.close(); // Đóng trang hiện tại
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Upload label thất bại! Vui lòng kiếm tra và thử lại");
                window.close(); // Đóng trang hiện tại
            </script>
            <?php
        }
    }
}
?>