<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body onload="window.print();">
	<div style="margin-left: 5%">
		<?php
		include 'barcode128.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['idOrder'])) {
    $selectedValues = $_POST['idOrder'];
    // Xử lý các giá trị đã chọn trong mảng $selectedValues
    foreach ($selectedValues as $value) {
      // Thực hiện xử lý cho mỗi giá trị đã chọn
        $valueArray = explode(',',$value);
        $product_id = $valueArray[0]; // Giá trị thứ nhất
        $print_qty = $valueArray[1];
        $service = $valueArray[2];// Giá trị thứ hai
  		for($i=1;$i<=$print_qty;$i++){
		echo "<p class='inline'><span><b>  $i of $print_qty $service</b></span>".bar128(stripcslashes($product_id))."<span><b>"."</b><span></p>&nbsp&nbsp&nbsp&nbsp";
	    }
    }
  }
}
		?>
	</div>
</body>
</html>