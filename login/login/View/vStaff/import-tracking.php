<?php
require '../../vendor/autoload.php';
require '../../Model/connect.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
// Hàm kiểm tra kiểu dữ liệu
function isDataTypeValid($col, $value) {
    switch ($col) {
        case 1: 
            return is_numeric($value);
        case 2: 
            return is_string($value);
        default:
            return false; // Các cột khác không hợp lệ
    }
}
?>
<?php 
  include "taskbar.php";
  include "navigation.php";
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card">
            <div class="card-header text-center">
                <h3>UPLOAD TỆP VÀ TẢI TRACKING LÊN HỆ THỐNG</h3><a href="../../Dungchung/Excel/export-tracking.php" class="btn btn-primary">Tải xuống form Excel mẫu</a><br>
            </div>
                <div class="card-body ">  
                <?php 
                if (isset($_POST['submit'])) {
                    // Kiểm tra xem có tệp Excel được tải lên không
                    if ($_FILES['excel']['name']) {
                        $excelFile = $_FILES['excel']['tmp_name'];
                        $inputFileType = 'Xlsx'; // Định dạng file Excel (ví dụ: Xlsx, Xls)
                        $reader = IOFactory::createReader($inputFileType);
                        $allDataValid = true; // Kiểm tra tất cả dữ liệu có hợp lệ không
                        try {
                            // Load dữ liệu từ file Excel
                            $spreadsheet = $reader->load($excelFile);
                            $worksheet = $spreadsheet->getActiveSheet();
                            $highestRow = $worksheet->getHighestRow();
                            $highestColumn = $worksheet->getHighestColumn();
                            $rowValid = true; // Kiểm tra dữ liệu của dòng hiện tại có hợp lệ không
                
                            // Lặp qua từng dòng để đọc dữ liệu
                            for ($row = 2; $row <= $highestRow; $row++) {
                                $rowData = array();
                                for ($col = 1; $col <= 2; $col++) {
                                    $columnLetter = Coordinate::stringFromColumnIndex($col);
                                    $cellCoordinate = $columnLetter . $row;
                                    $cell = $worksheet->getCell($cellCoordinate);
                                    $value = $cell->getValue();
                                    $rowData[] = $conn->real_escape_string($value);
                                    // Kiểm tra kiểu dữ liệu và loại bỏ dòng nếu kiểu không phù hợp
                                    if (!isDataTypeValid($col, $value)) {
                                        $rowValid = false;
                                        break; // Thoát vòng lặp nếu dữ liệu không hợp lệ
                                    }
                                }
                            }   
                                // Nếu dữ liệu của dòng hiện tại hợp lệ, tiến hành import
                                if ($rowValid) {
                                    $count = 0;
                                    for ($row = 2; $row <= $highestRow; $row++) {
                                        $rowData = array();
                                        for ($col = 1; $col <= 2; $col++) {
                                            $columnLetter = Coordinate::stringFromColumnIndex($col);
                                            $cellCoordinate = $columnLetter . $row;
                                            $cell = $worksheet->getCell($cellCoordinate);
                                            $value = $cell->getValue();
                                            $rowData[] = $conn->real_escape_string($value);
                                        }
                                        $sql = "UPDATE `oder` SET `tracking_number` = '$rowData[1]' WHERE `idOrder` = '$rowData[0]'";
                                        if ($conn->query($sql) !== TRUE) {
                                            throw new Exception('Lỗi khi thực hiện truy vấn SQL.');
                                        }
                                        $count++;
                                }
                            }
                            // Kiểm tra nếu có ít nhất một dòng không hợp lệ, không thêm bất kỳ bản ghi nào vào cơ sở dữ liệu
                            if (!$rowValid) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Đã xảy ra lỗi khi tải tracking đơn hàng. Vui lòng kiểm tra dữ liệu tệp.
                                <span id="countdown" class="float-end"></span>
                                </div>
                                <script>
                                setTimeout(function(){
                                    history.go(-1);
                                }, 5000);
                                </script>';
                            } else {
                            // Hiển thị thông báo thành công với số lượng bản ghi đã cập nhật
                            echo '<div class="alert  alert-dismissible fade show" role="alert">
                                    Tải lên tracking thành công! Đã cập nhật ' . $count . ' tracking number.';
                            }
                        } catch (Exception $e) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Đã xảy ra lỗi khi cập nhật tracking.
                            <span id="countdown" class="float-end"></span>
                            </div>
                            <script>
                            setTimeout(function(){
                                history.go(-1);
                            }, 5000);
                            </script>' . $e->getMessage();
                        }
                    }
                }
                ?>
                    <form method="post" action="import-tracking.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fileUpload">Chọn tệp Excel:</label><br>
                            <input type="file" id="fileUpload" name="excel" class="form-control-file" accept=".xls, .xlsx" required/>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" name="submit">Import</button>
                        </div>
                    </form>
                    <br>
                    <p style="font-style: italic; color: red;font-size: 18px;">
                    Lưu ý:
                    <br>
                    *Nhân viên tải xuống form excel mẫu để thực hiện điền thông tin vào trong form theo đúng định dạng.
                    <br>
                    *Nếu sử dụng form Excel khác, đảm bảo các cột được sắp xếp theo mẫu trên.
                    <br>
                    *Vui lòng không nhập thừa hay thiếu thông tin của đơn hàng.
                    <br>
                    *Nếu xảy ra lỗi sẽ không có tracking nào được upload, vui lòng kiểm tra lại file và chỉnh sửa dữ liệu đúng định dạng.
                    </p>
                </div>  
            </div> 
        </div>
    </div>
</div>
<?php 
  include "../../Dungchung/js.php";
?>