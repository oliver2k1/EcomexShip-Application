<?php
require_once '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

$imagePath = 'logo.jpg';

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
$sheet->getStyle('B4:H4')->getFill()->getStartColor()->setRGB($greenColor);
$sheet->getStyle('I4:O4')->getFill()->setFillType(Fill::FILL_SOLID);
$sheet->getStyle('I4:O4')->getFill()->getStartColor()->setARGB($lightBlueColor);
for ($col = 1; $col <= 3; $col++) {
    $sheet->getColumnDimensionByColumn($col)->setWidth(150 / 7); // 150px / 7 cột
}
for ($col = 4; $col <= 6; $col++) {
    $sheet->getColumnDimensionByColumn($col)->setWidth(120 / 7); // 150px / 7 cột
}
for ($col = 7; $col <= 8; $col++) {
    $sheet->getColumnDimensionByColumn($col)->setWidth(150 / 7); // 150px / 7 cột
}
for ($col = 9; $col <= 15; $col++) {
    $sheet->getColumnDimensionByColumn($col)->setWidth(130 / 7); // 150px / 7 cột
}
$sheet->getRowDimension(4)->setRowHeight(40);
// Thiết lập viền đậm cho 15 ô của hàng đầu tiên
for ($col = 1; $col <= 15; $col++) {
    $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . '4';
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
$style = $sheet->getStyle('A4:O4');
$style->getFont()->setName('Arial');
$style->getFont()->setSize(12);
$style->getFont()->setBold(true);
$style->getFont()->getColor()->setRGB(Color::COLOR_WHITE);
$style->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$style->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
// Thiết lập giá trị và căn giữa ngang, căn giữa dọc cho 15 ô trong hàng đầu
for ($col = 1; $col <= 15; $col++) {
    $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . '4';
    $sheet->setCellValue($cellCoordinate, '');
    $sheet->getStyle($cellCoordinate)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($cellCoordinate)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
}
$sheet->setCellValue('A4', 'Tên hàng');
$sheet->setCellValue('B4', 'Receiver Name');
$sheet->setCellValue('C4', 'Receiver Address');
$sheet->setCellValue('D4', 'Receiver City');
$sheet->setCellValue('E4', 'Receiver State');
$sheet->setCellValue('F4', 'ZIP code');
$sheet->setCellValue('G4', 'Receiver Country');
$sheet->setCellValue('H4', 'Số lượng');
$sheet->setCellValue('I4', 'Receiver Phone');
$sheet->setCellValue('J4', 'Dịch vụ');
$sheet->setCellValue('K4', 'Dài(cm)');
$sheet->setCellValue('L4', 'Rộng(cm)');
$sheet->setCellValue('M4', 'Cao(cm)');
$sheet->setCellValue('N4', 'Cân nặng(gam)');
$sheet->setCellValue('O4', 'Dim(gam)');
$filename = 'Ecomex_Order.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filename);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
readfile($filename);
unlink($filename);
exit();
?>