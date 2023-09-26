<?php
require_once("../../Model/tblService.php");
//lấy dữ liệu từ form
if(isset($_REQUEST["b1"])==FALSE)//nếu chưa submit form
 die("<h3> Chưa nhập form</h3>");
$name = $_REQUEST["tName"];
$start = $_REQUEST["tStart"];
$end = $_REQUEST["tEnd"];
$price = $_REQUEST["tPrice"];
//THỰC HIỆN CÂU LỆNH INSERT,UPDATE, DELETE
$ketqua = addService($name,$start,$end,$price);
if($ketqua==TRUE)
	echo "<H3> THÀNH CÔNG </H3>";
else
	echo "<h3> LỖI THÊM DỮ LIỆU</h3>";

header('location:../../View/vAdmin/delivery-service.php');   
?>
