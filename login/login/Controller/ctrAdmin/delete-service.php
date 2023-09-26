<?php
require_once("../../Model/tblService.php");//lấy dữ liệu từ request
if(isset($_REQUEST["id"])==false)
	die("<p>chưa có id dịch vụ</p>");
$id = $_REQUEST["id"];//lấy id dịch vụ
if($id=="" || is_numeric($id)==false)
	die("<p>id không được rỗng và phải là số</p>");
    
$ketqua = deleteService($id);
if($ketqua==TRUE)
	echo "<H3> THÀNH CÔNG </H3>";
else
	echo "<h3> LỖI Xóa DỮ LIỆU</h3>";

header('location:../../View/vAdmin/delivery-service.php');   
?>
