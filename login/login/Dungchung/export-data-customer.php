<?php
require 'dbcon.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Lấy dữ liệu từ form
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$name_user = $_POST['name_user'];
// Chuyển đổi định dạng ngày tháng
$start_date = date('Y/m/d 00:00:00', strtotime($start_date));
$end_date = date('Y/m/d 23:59:59', strtotime($end_date));

// Truy vấn cơ sở dữ liệu để lấy dữ liệu từ bảng "order" trong khoảng thời gian đã chọn
$sql = "SELECT * FROM `oder` WHERE `time` BETWEEN '$start_date' AND '$end_date' AND `status` = 1 AND `name_user` = '$name_user' order by `time` DESC";
$result = $con->query($sql);

if ($result) {
  // Truy vấn thành công, có dữ liệu trả về
  if ($result->num_rows > 0) {
    // Tạo file Excel
    require '../vendor/autoload.php'; // Đường dẫn đến thư mục chứa thư viện PhpSpreadsheet

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Gán dữ liệu từ kết quả truy vấn vào các ô trong file Excel
    $row = 5;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, '\''.$row_data['idOrder']);
        $sheet->setCellValue('B' . $row, $row_data['name_user']);
        $sheet->setCellValue('C' . $row, $row_data['time']);
        $sheet->setCellValue('D' . $row, $row_data['name_consignee']);
        $sheet->setCellValue('E' . $row, $row_data['address_consignee']);
        $sheet->setCellValue('F' . $row, '\''.$row_data['phone_consignee']);
        $sheet->setCellValue('G' . $row, $row_data['country']);
        $sheet->setCellValue('H' . $row, $row_data['state']);
        $sheet->setCellValue('I' . $row, $row_data['city']);
        $sheet->setCellValue('J' . $row, $row_data['zipcode']);
        $sheet->setCellValue('K' . $row, $row_data['name_product']);
        $sheet->setCellValue('L' . $row, $row_data['quantity']);
        $sheet->setCellValue('M' . $row, $row_data['service']);
        $sheet->setCellValue('N' . $row, $row_data['dim']);
        $sheet->setCellValue('O' . $row, $row_data['weight']);
        $sheet->setCellValue('P' . $row, number_format($row_data['price']));
        $sheet->setCellValue('Q' . $row, '\''.$row_data['tracking_number']);
      // Thêm các cột dữ liệu khác tùy theo cấu trúc bảng "order"
      $row++;
    }
    $worksheet = $spreadsheet->getActiveSheet();

        $imagePath = './Excel/logo.jpg';

        $cell = 'G1';
        $worksheet->setCellValue($cell, '');

        $objDrawing = new Drawing();
        $objDrawing->setName('Image');
        $objDrawing->setDescription('Image');
        $objDrawing->setPath($imagePath);
        $objDrawing->setCoordinates($cell);
        $objDrawing->setWidth(200);
        $objDrawing->setHeight(60);

        $objDrawing->setWorksheet($worksheet);

        $sheet = $spreadsheet->getActiveSheet();
        $lightBlueColor = '4E80E4';
        $greenColor = '899200';
        $sheet->getStyle('A4')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A4')->getFill()->getStartColor()->setARGB($lightBlueColor);
        $sheet->getStyle('B4:H4')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('B4:H4')->getFill()->getStartColor()->setRGB($lightBlueColor);
        $sheet->getStyle('I4:Q4')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('I4:Q4')->getFill()->getStartColor()->setARGB($lightBlueColor);
        for ($col = 1; $col <= 4; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(130 / 7); // 150px / 7 cột
        }
        for ($col = 5; $col <= 5; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(200 / 7); // 150px / 7 cột
        }
        for ($col = 6; $col <= 10; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(100 / 7); // 150px / 7 cột
        }
        for ($col = 11; $col <= 11; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(150 / 7); // 150px / 7 cột
        }
        for ($col = 12; $col <= 13; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(100 / 7); // 150px / 7 cột
        }
        for ($col = 14; $col <= 16; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(100 / 7); // 150px / 7 cột
        }
        for ($col = 17; $col <= 17; $col++) {
            $sheet->getColumnDimensionByColumn($col)->setWidth(200 / 7); // 150px / 7 cột
        }
        $sheet->getRowDimension(4)->setRowHeight(40);
        // Thiết lập viền đậm cho 15 ô của hàng đầu tiên
        for ($col = 1; $col <= 17; $col++) {
            $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '4';
            $sheet->setCellValue($cellCoordinate,''); // Đặt giá trị ô nếu cần
            $style = $sheet->getStyle($cellCoordinate);
            $style->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
            $style->getBorders()->getBottom()->getColor()->setARGB(Color::COLOR_BLACK);
            $style->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
            $style->getBorders()->getRight()->getColor()->setARGB(Color::COLOR_BLACK);
            $style->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $style->getBorders()->getTop()->getColor()->setARGB(Color::COLOR_BLACK);
            $style->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
            $style->getBorders()->getLeft()->getColor()->setARGB(Color::COLOR_BLACK);
        }
        // Thiết lập kiểu cho hàng đầu
        $style = $sheet->getStyle('A4:Q4');
        $style->getFont()->setName('Arial');
        $style->getFont()->setSize(12);
        $style->getFont()->setBold(true);
        $style->getFont()->getColor()->setRGB(Color::COLOR_WHITE);
        $style->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $style->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        // Thiết lập giá trị và căn giữa ngang, căn giữa dọc cho 15 ô trong hàng đầu
        for ($col = 1; $col <= 15; $col++) {
            $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '4';
            $sheet->setCellValue($cellCoordinate, '');
            $sheet->getStyle($cellCoordinate)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellCoordinate)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }
        $sheet->setCellValue('A4', 'ID Order');
        $sheet->setCellValue('B4', 'Tên khách hàng');
        $sheet->setCellValue('C4', 'Thời gian tạo');
        $sheet->setCellValue('D4', 'Tên người nhận');
        $sheet->setCellValue('E4', 'Địa chỉ');
        $sheet->setCellValue('F4', 'Số điện thoại');
        $sheet->setCellValue('G4', 'Quốc gia');
        $sheet->setCellValue('H4', 'Bang');
        $sheet->setCellValue('I4', 'Thành phố');
        $sheet->setCellValue('J4', 'Zipcode');
        $sheet->setCellValue('K4', 'Tên sản phẩm');
        $sheet->setCellValue('L4', 'Số lượng');
        $sheet->setCellValue('M4', 'Dịch vụ');
        $sheet->setCellValue('N4', 'Dim');
        $sheet->setCellValue('O4', 'Cân nặng');
        $sheet->setCellValue('P4', 'Thành tiền');
        $sheet->setCellValue('Q4', 'Tracking number');
    // Thiết lập header để tải file Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$name_user.'.xlsx"');
    header('Cache-Control: max-age=0');

    // Ghi dữ liệu vào file Excel và xuất ra output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  } else {
    // Truy vấn thành công, không có dữ liệu trả về
    echo '<script>
                alert("Không có dữ liệu đơn hàng trong khoảng thời gian đã chọn!");
                window.close(); // Đóng trang hiện tại
        </script>';
  }
} else {
  // Truy vấn thất bại
  echo '<script>
                alert("Lỗi cơ sở dữ liệu! Vui lòng thử lại sau");
                window.close(); // Đóng trang hiện tại
        </script>';
}

// Đóng kết nối cơ sở dữ liệu
$con->close();
?>