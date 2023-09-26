<?php
require_once("../../Model/tblKienhang.php");//lấy dữ liệu từ request
if(isset($_REQUEST["id"])==false)
	die("<p>chưa có id kiện hàng</p>");
$id = $_REQUEST["id"];//lấy id dịch vụ
if($id=="" || is_numeric($id)==false)
	die("<p>id không được rỗng và phải là số</p>");
$ketqua = deleteKienhang($id);
if($ketqua==TRUE)
	echo "<H3> THÀNH CÔNG </H3>";
else
	echo "<h3> LỖI Xóa DỮ LIỆU</h3>";

header('location:../../View/vAdmin/kienhang.php');   
?>
