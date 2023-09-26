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
require '../vendor/autoload.php'; // Đường dẫn đến thư mục chứa thư viện PhpSpreadsheet
if (isset($_POST['submit'])&&isset($_POST['idOrder']) && is_array($_POST['idOrder'])) {
      $selectedIds = $_POST['idOrder'];
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $row = 2;
      // Gán dữ liệu từ kết quả truy vấn vào các ô trong file Excel
      foreach ($selectedIds as $idOrder) {
        // Truy vấn cơ sở dữ liệu để lấy dữ liệu từ bảng "order" dựa trên $idOrder
        $sql = "SELECT * FROM `oder` WHERE `idOrder` = '$idOrder'";
        $result = $con->query($sql);
        while ($row_data = $result->fetch_assoc()) {
          $sheet->setCellValue('A' . $row, '\'' . $row_data['idOrder']);
          $sheet->setCellValue('B' . $row, $row_data['name_consignee'] . ' ' . $row_data['address_consignee'] . ' ' . $row_data['city'] . ' ' . $row_data['state'] . ' ' . $row_data['zipcode']);
          $sheet->setCellValue('C' . $row, $row_data['weight']);
          // Thêm các cột dữ liệu khác tùy theo cấu trúc bảng "order"
          $row++;
        }
      }
      $worksheet = $spreadsheet->getActiveSheet();
      $sheet = $spreadsheet->getActiveSheet();
      $lightBlueColor = '4E80E4';
      $greenColor = '899200';
      $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID);
      $sheet->getStyle('A1')->getFill()->getStartColor()->setARGB($greenColor);
      $sheet->getStyle('B1:C1')->getFill()->setFillType(Fill::FILL_SOLID);
      $sheet->getStyle('B1:C1')->getFill()->getStartColor()->setRGB($lightBlueColor);
      $sheet->getColumnDimensionByColumn(1)->setWidth(150 / 7); // 150px / 7 cột
      $sheet->getColumnDimensionByColumn(2)->setWidth(400 / 7); // 150px / 7 cột
      $sheet->getColumnDimensionByColumn(3)->setWidth(100 / 7); // 150px / 7 cột
      $sheet->getRowDimension(1)->setRowHeight(40);
      // Thiết lập viền đậm cho 15 ô của hàng đầu tiên
      for ($col = 1; $col <= 3; $col++) {
          $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '1';
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
      $style = $sheet->getStyle('A1:C1');
      $style->getFont()->setName('Arial');
      $style->getFont()->setSize(12);
      $style->getFont()->setBold(true);
      $style->getFont()->getColor()->setRGB(Color::COLOR_WHITE);
      $style->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $style->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
      // Thiết lập giá trị và căn giữa ngang, căn giữa dọc cho 15 ô trong hàng đầu
      for ($col = 1; $col <= 3; $col++) {
          $cellCoordinate = Coordinate::stringFromColumnIndex($col) . '1';
          $sheet->setCellValue($cellCoordinate, '');
          $sheet->getStyle($cellCoordinate)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
          $sheet->getStyle($cellCoordinate)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
      }
      $sheet->setCellValue('A1', 'ID Order');
      $sheet->setCellValue('B1', 'Thông tin người nhận');
      $sheet->setCellValue('C1', 'Cân nặng');
      // Thiết lập header để tải file Excel
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="export.xlsx"');
      header('Cache-Control: max-age=0');
      // Ghi dữ liệu vào file Excel và xuất ra output
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
    } else {
      // Truy vấn thành công, không có dữ liệu trả về
      echo "Không có dữ liệu";
    }
// Đóng kết nối cơ sở dữ liệu
$con->close();
?>