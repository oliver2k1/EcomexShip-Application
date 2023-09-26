<?php 
require_once '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Fill;
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$defaultFont = new \PhpOffice\PhpSpreadsheet\Style\Font();
$defaultFont->setName('Arial');
$defaultFont->setSize(11);

$sheet->getDefaultRowDimension()->setRowHeight(15);
$sheet->getStyle('A1:H999')->applyFromArray([
    'font' => [
        'name' => $defaultFont->getName(),
        'size' => $defaultFont->getSize(),
    ],
]);

$styleArray = [
    'font' => [
        'name' => 'Arial Narrow',
    ],
];
$styleArray2 = [
    'font' => [
        'name' => 'Century Gothic',
    ],
];
$borderStyle = [
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$nameCompany = $_POST['CompanyName'];
$time = $_POST['time'];
$pkgs = $_POST['pkgs'];
$weight = $_POST['weight'];
$contactName = $_POST['contactName'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$zipcode = $_POST['zipcode'];
$address = $_POST['address'];

$sheet->mergeCells('B1:H1')->setCellValue('B1', 'NON COMMERCIAL INVOICE')->getRowDimension(1)->setRowHeight(30);

// Apply alignment to the merged cell
$sheet->getStyle('B1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Apply border style to the merged cell
$sheet->getStyle('B1:H1')->applyFromArray($borderStyle);
$sheet->getStyle('B1')->getFont()->setSize(13);
$sheet->getRowDimension(2)->setRowHeight(6);
$sheet->getRowDimension(3)->setRowHeight(20);
$sheet->getColumnDimension('A')->setWidth(2);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(18);
$sheet->getColumnDimension('H')->setWidth(20);
$sheet->getStyle('B1:H1')->getFont()->setBold(true);
$sheet->setTitle('Invoice');

$sheet->setCellValue('C3', 'Invoice No:')->getStyle('C3')->getFont()->setBold(true)->setItalic(true);
$sheet->setCellValue('G3', 'Date:')->getStyle('G3')->getFont()->setBold(true)->setItalic(true);
$sheet->setCellValue('B5', 'SHIPPER')->getStyle('B5')->getFont()->setBold(true)->setUnderline(true);
$sheet->setCellValue('G5', 'Air waybill No.')->getStyle('G5')->getFont()->setBold(true);
$sheet->getStyle('B6:B19')->applyFromArray($styleArray);
$sheet->setCellValue('B6', 'Company Name');
$sheet->setCellValue('B7', 'Address');
$sheet->setCellValue('B8', 'Town/ Area Code');
$sheet->setCellValue('B9', 'State/ Country');
$sheet->setCellValue('B10', 'Contact Name');
$sheet->setCellValue('B11', 'Phone/Fax No. ');
$sheet->setCellValue('B13', 'CONSIGNEE')->getStyle('B13')->getFont()->setBold(true)->setUnderline(true);
$sheet->setCellValue('B14', 'Company Name');
$sheet->setCellValue('B15', 'Address');
$sheet->setCellValue('B16', 'Postal Code');
$sheet->setCellValue('B17', 'State/ Country');
$sheet->setCellValue('B18', 'Contact Name');
$sheet->setCellValue('B19', 'Phone/Fax No.');
$sheet->setCellValue('H6', 'UPS SAVER')->getStyle('H6')->getFont()->setBold(true);
$sheet->getStyle('H6')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
$sheet->getStyle('C6:F11')->applyFromArray($styleArray2);
$sheet->getStyle('B21:H33')->applyFromArray($styleArray2);
$sheet->mergeCells('C8:F8')->setCellValue('C8', 'Ha Noi');
$sheet->mergeCells('C9:F9')->setCellValue('C9', 'Viet Nam')->getStyle('C9')->getFont()->setBold(true);

$sheet->setCellValue('G8', 'No. of pkgs ')->getStyle('G8')->getFont()->setBold(true);
$sheet->setCellValue('G10', 'Weight ')->getStyle('G10')->getFont()->setBold(true);
$styleArray = [
    'font' => [
        'bold' => true,
    ],
];

$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];

$sheet->setCellValue('G12', 'Dimensions ')->getStyle('G12')->getFont()->setBold(true);
$sheet->mergeCells('B21:D22')->setCellValue('B21', 'Full Description of Goods
(Name of goods, composition of material, marks,...)')->getStyle('B21:D22')->applyFromArray($styleArray);
$sheet->mergeCells('E21:E22')->setCellValue('E21', "Q'Ty")->getStyle('E21:E22')->applyFromArray($styleArray);
$sheet->mergeCells('F21:F22')->setCellValue('F21', 'Unit (pcs/sets)')->getStyle('F21:F22')->applyFromArray($styleArray);
$sheet->mergeCells('G21:G22')->setCellValue('G21', 'Unit Price (in USD)')->getStyle('G21:G22')->applyFromArray($styleArray);
$sheet->mergeCells('H21:H22')->setCellValue('H21', 'Sub Total (in USD)')->getStyle('H21:H22')->applyFromArray($styleArray);
$sheet->mergeCells('E25:G25')->setCellValue('E25', 'Total Value (in USD)')->getStyle('E25:G25')->applyFromArray($styleArray);
$sheet->mergeCells('B27:C27')->setCellValue('B27', 'Reason for Export');
$sheet->mergeCells('D27:H27')->setCellValue('D27', 'gift')->getStyle('D27:H27')->getFont()->setBold(true);
$sheet->mergeCells('B28:H28')->setCellValue('B28', 'I declare that the information is true and correct to the best of my knowledge,');
$sheet->mergeCells('B29:D29')->setCellValue('B29', 'and that the goods are of VIETNAM origin.');
$sheet->setCellValue('B30', 'I (name) ');
$sheet->mergeCells('C30:E30');
$sheet->mergeCells('F30:H30')->setCellValue('F30', 'certify that the particulars and');
$sheet->mergeCells('B31:H31')->setCellValue('B31', 'quantity of goods specified in this document are goods which are submitted for');
$sheet->mergeCells('B32:D32')->setCellValue('B32', 'clearance for export out of Vietnam.');
$sheet->mergeCells('G33:H33')->setCellValue('G33', 'Signature/Title/Stamp');
$sheet->setCellValue('H3', '=TODAY()');
$sheet->mergeCells('C14:F14')->setCellValue('C14', $nameCompany);
$sheet->mergeCells('C15:F15')->setCellValue('C15', $address);
$sheet->mergeCells('C16:F16')->setCellValue('C16', $zipcode);
$sheet->mergeCells('C17:F17')->setCellValue('C17', $country);
$sheet->mergeCells('C18:F18')->setCellValue('C18', $contactName);
$sheet->mergeCells('C19:F19')->setCellValue('C19', "'$phone");
$sheet->setCellValue('H3', $time);
$sheet->setCellValue('H8', $pkgs);
$sheet->setCellValue('H10', $weight);
$sheet->getStyle('G3:H3')->applyFromArray($borderStyle);
$sheet->getStyle("H6")->applyFromArray($borderStyle);
$sheet->getStyle("H4")->applyFromArray($borderStyle);
$sheet->getStyle("H12:H15")->applyFromArray($borderStyle);
$sheet->getStyle("H11")->applyFromArray($borderStyle);
$sheet->getStyle("C7:F7")->applyFromArray($borderStyle);
$sheet->getStyle("C8:F8")->applyFromArray($borderStyle);
$sheet->getStyle("C9:H9")->applyFromArray($borderStyle);
$sheet->getStyle("C10:H10")->applyFromArray($borderStyle);
$sheet->getStyle("C11:F11")->applyFromArray($borderStyle);
$sheet->getStyle("C12:F12")->applyFromArray($borderStyle);
$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('C14:H14')->applyFromArray($borderStyle);
$sheet->getStyle('C15:H15')->applyFromArray($borderStyle);
$sheet->getStyle('C16:H16')->applyFromArray($borderStyle);
$sheet->getStyle('C17:F17')->applyFromArray($borderStyle);
$sheet->getStyle('C18:F18')->applyFromArray($borderStyle);
$sheet->getStyle('C19:F19')->applyFromArray($borderStyle);
$sheet->getStyle('C20:F20')->applyFromArray($borderStyle);
$sheet->getStyle('B21:H24')->applyFromArray($borderStyle);
$sheet->getStyle('E25:H25')->applyFromArray($borderStyle);
// Tạo đối tượng Writer và lưu tệp .xlsx
$writer = new Xlsx($spreadsheet);
$filename = 'Invoice_'.$contactName.'_'.$time.'.xlsx';
$writer->save($filename);

// Thiết lập các tiêu đề và loại tệp tin trong phản hồi HTTP
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Gửi nội dung tệp tin cho người dùng
readfile($filename);
unlink($filename);
?>