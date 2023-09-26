<?php
require '../../vendor/autoload.php';
require '../../Model/connect.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
// Hàm kiểm tra kiểu dữ liệu
function isDataTypeValid($col, $value) {
    $allowEmptyCols = [1, 9, 10, 11, 12, 13, 14, 15]; // Các cột có thể trống

    if (!isset($value) || $value === "" || in_array($col, $allowEmptyCols)) {
        return true;
    }
    switch ($col) {
        case 2: 
        case 3: 
        case 4: 
        case 5:
        case 6: 
        case 7: 
        case 8: 
            return is_string($value) || is_numeric($value);
        case 9: 
            return is_string($value);
        case 10: 
            return is_string($value);
        case 11: 
        case 12: 
        case 13: 
        case 14: 
        case 15: 
            return is_numeric($value);
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
                <h3>UPLOAD TỆP VÀ TẢI LÊN HỆ THỐNG</h3><a href="../../Dungchung/Excel/export-order.php" class="btn btn-primary">Tải xuống form Excel mẫu</a><br>
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
                            $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);
                            $rowValid = true; // Kiểm tra dữ liệu của dòng hiện tại có hợp lệ không
                
                            // Lặp qua từng dòng để đọc dữ liệu
                            for ($row = 5; $row <= $highestRow; $row++) {
                                $rowData = array();
                                for ($col = 1; $col <= $highestColumnIndex; $col++) {
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
                                    for ($row = 5; $row <= $highestRow; $row++) {
                                        $rowData = array();
                                        for ($col = 1; $col <= $highestColumnIndex; $col++) {
                                            $columnLetter = Coordinate::stringFromColumnIndex($col);
                                            $cellCoordinate = $columnLetter . $row;
                                            $cell = $worksheet->getCell($cellCoordinate);
                                            $value = $cell->getValue();
                                            $rowData[] = $conn->real_escape_string($value);
                                        }
                                        $id = $_SESSION['id'].date('dhis').$count;
                                        $name_user = $_SESSION['name'];
                                        $time = date("Y/m/d H:i:s", time());
                                        $sql = "INSERT INTO oder(`idOrder`, `name_user`,`time`,`name_creater`,`name_consignee`,`phone_consignee`,`address_consignee`,`country`,`state`,`city`,`zipcode`,`name_product`,`quantity`,`service`,`length`,`width`,`height`,`weight`,`dim`)
                                         VALUES ('$id','$name_user','$time','$name_user','$rowData[1]','$rowData[8]','$rowData[2]','$rowData[6]','$rowData[4]','$rowData[3]','$rowData[5]','$rowData[0]','$rowData[7]','$rowData[9]','$rowData[10]','$rowData[11]','$rowData[12]','$rowData[13]','$rowData[14]')";
                                        if ($conn->query($sql) !== TRUE) {
                                            throw new Exception('Lỗi khi thực hiện truy vấn SQL.');
                                        }
                                        $count++;
                                }
                            }
                            // Kiểm tra nếu có ít nhất một dòng không hợp lệ, không thêm bất kỳ bản ghi nào vào cơ sở dữ liệu
                            if (!$rowValid) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Đã xảy ra lỗi khi tạo đơn hàng. Vui lòng kiểm tra dữ liệu tệp.
                                <span id="countdown" class="float-end"></span>
                                </div>
                                <script>
                                setTimeout(function(){
                                    history.go(-1);
                                }, 2000);
                                </script>';
                            } else {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Tải lên đơn hàng thành công!.
                                <span id="countdown" class="float-end"></span>
                                <script>
                                setTimeout(function(){
                                    history.go(-1);
                                }, 2000);
                                </script>';
                            }
                        } catch (Exception $e) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Đã xảy ra lỗi khi tạo đơn hàng.
                            <span id="countdown" class="float-end"></span>
                            </div>
                            <script>
                            setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                            </script>' . $e->getMessage();
                        }
                    }
                }
                ?>
                    <form method="post"action="create-orders.php" enctype="multipart/form-data">
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
                    *Khách hàng tải xuống form excel mẫu để thực hiện điền thông tin vào trong form theo đúng định dạng.
                    <br>
                    *Nếu sử dụng form Excel khác, đảm bảo các cột được sắp xếp theo mẫu trên.
                    <br>
                    *Những cột sau đây sẽ nhập cả chữ cả số:Receiver Name, Receiver Phone, Receiver Address, Receiver Country, Receiver State, Receiver City, Zipcode, Tên hàng, Dịch vụ.
                    <br>
                    *Những cột sau đây sẽ chỉ nhập số nguyên (VD 1, 2,...,100): Số lượng, Dài(cm), Rộng(cm), Cao(cm), Cân nặng(gam), Dim(gam),
                    <br>
                    *Vui lòng không nhập thừa hay thiếu thông tin của đơn hàng.
                    <br>
                    *Nếu xảy ra lỗi sẽ không có đơn hàng nào được tạo, vui lòng kiểm tra lại file và chỉnh sửa dữ liệu đúng định dạng.
                    </p>
                </div>  
            </div> 
        </div>
    </div>
</div>
<?php 
  include "../../Dungchung/js.php";
?>