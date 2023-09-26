<?php
require_once('../vendor/setasign/fpdf/fpdf.php');
require_once('../vendor/setasign/fpdi/src/autoload.php');
require_once('../vendor/smalot/pdfparser/src/Smalot/PdfParser/Parser.php');
require_once('../vendor/autoload.php');
use setasign\Fpdi\Fpdi;
use Smalot\PdfParser\Parser;

function compareTextInPdf($pdfFile) {
    try {
    // Đếm số trang trong tệp PDF
    $parser = new Parser();
    $pdfData = $parser->parseFile($pdfFile);
    $totalPages = count($pdfData->getPages());

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
    // Tạo một thư mục để lưu các tệp PDF riêng lẻ
    $outputDir = "./pdf/individual_pages/";
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }
    // Lặp qua từng trang và so sánh văn bản
    for ($page = 1; $page <= $totalPages; $page++) {
            $pdf = new CustomPDF('P', 'mm', array($pdfWidth, $pdfHeight));
            // Khởi tạo một đối tượng FPDI riêng cho mỗi trang
            $pdf->setSourceFile($pdfFile);
            // Thêm trang mới vào tệp PDF mới
            $pdf->AddPage();
            // Nhập trang từ tệp PDF ban đầu
            $importedPage = $pdf->importPage($page);
            $pdf->useTemplate($importedPage);
            // Tạo tên tệp PDF mới dựa trên số trang
            $newPdfFileName = 'Page_'.$page.'.pdf';
            // Lưu tệp PDF mới
            $pdf->Output($outputDir . $newPdfFileName, 'F');
        } 
        $zipFile = "./pdf/individual_pages.zip";
        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($outputDir),
                RecursiveIteratorIterator::LEAVES_ONLY
            );
            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($outputDir) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
            // Xóa các tệp PDF riêng lẻ
            $files = glob($outputDir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
            // Tải xuống tệp tin tức (ZIP)
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($zipFile) . '"');
            header('Content-Length: ' . filesize($zipFile));
            readfile($zipFile);
            // Xóa tệp tin tức (ZIP)
            unlink($zipFile);
      } catch (Exception $e) {
        // Xử lý ngoại lệ và hiển thị cảnh báo
        echo '<script>alert("Đã xảy ra lỗi: ' . $e->getMessage() . '");
        window.close(); 
        </script>';
    }
}

// Sử dụng hàm findOrderId
if (isset($_POST['submit'])) {
    if (isset($_FILES['pdf_file']['name'])) {
        // Nếu trường 'pdf_file' có tệp đính kèm
        $file_name = $_FILES['pdf_file']['name'];
        $file_tmp = $_FILES['pdf_file']['tmp_name'];
        // Di chuyển tệp PDF đã tải lên vào thư mục 'pdf'
        move_uploaded_file($file_tmp, "./pdf/" . $file_name);
        // Đường dẫn đến tệp PDF
        $pdfFilePath = "./pdf/" . $file_name;
        // So sánh văn bản trong tệp PDF và tạo các tệp PDF mới chứra phần của văn bản giữa ký tự bắt đầu và kết thúc
        $inserted = compareTextInPdf($pdfFilePath);
        // Xóa tệp PDF gốc
        unlink("./pdf/" . $file_name);
    }
}
?>