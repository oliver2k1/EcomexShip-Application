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
		if(isset($_GET['idOrder'])){
			$product_id = $_GET['idOrder'];
			$print_qty = $_GET['quantity'];
			$service = $_GET['service'];
		}
		for($i=1;$i<=$print_qty;$i++){
			echo "<p class='inline'><span><b>  $i of $print_qty $service</b></span>".bar128(stripcslashes($product_id))."<span><b>"."</b><span></p>&nbsp&nbsp&nbsp&nbsp";
		}
		?>
	</div>
</body>
</html>