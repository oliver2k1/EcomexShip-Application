<?php
require_once("../../Model/tblKienhang.php");

//lấy dữ liệu từ form
if(isset($_REQUEST["b2"])==FALSE)//nếu chưa submit form
 die("<h3> Chưa nhập form</h3>");
$id = $_REQUEST["idUpdate"];
$name = $_REQUEST["tName"];
$ketqua = updateKienhang($name,$id);
if ($ketqua == TRUE) {
    session_start();
    $_SESSION['success_message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	Sửa kiện hàng thành công!.
	<span id="countdown" class="float-end"></span>
	</div> ';
}else{
    session_start();
    $_SESSION['error_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	Sửa kiện hàng thất bại! Vui lòng thử lại sau.
	<span id="countdown" class="float-end"></span>
  </div>';
}
header('location:../../View/vAdmin/kienhang.php'); 
?>
