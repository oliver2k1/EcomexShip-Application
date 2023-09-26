<?php
require_once '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();

$cell = 'G1';
$worksheet->setCellValue($cell, '');

$sheet = $spreadsheet->getActiveSheet();
$lightBlueColor = '4E80E4';
$greenColor = '899200';
$sheet->getStyle('A1:B1')->getFill()->setFillType(Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setARGB($greenColor);
$sheet->getStyle('B1')->getFill()->getStartColor()->setARGB($lightBlueColor);
// Thiết lập viền đậm cho 15 ô của hàng đầu tiên
for ($col = 1; $col <= 2; $col++) {
    $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . '1';
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
$style = $sheet->getStyle('A1:B1');
$style->getFont()->setName('Arial');
$style->getFont()->setSize(14);
$style->getFont()->setBold(true);
$style->getFont()->getColor()->setRGB(Color::COLOR_WHITE);
$style->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$style->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getColumnDimension('B')->setWidth(40);
$sheet->getRowDimension(1)->setRowHeight(30);
$sheet->setCellValue('A1', 'ID Order');
$sheet->setCellValue('B1', 'Tracking Number');
$filename = 'Ecomex_Tracking.xlsx';
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