<?php
require_once("../../Model/tblService.php");

//lấy dữ liệu từ form
if(isset($_REQUEST["b2"])==FALSE)//nếu chưa submit form
 die("<h3> Chưa nhập form</h3>");
$id = $_REQUEST["idUpdate"];
$name = $_REQUEST["tName"];
$start = $_REQUEST["tStart"];
$end = $_REQUEST["tEnd"];
$price = $_REQUEST["tPrice"];
$ketqua = updateService($name,$start,$end,$price,$id);
if ($ketqua == TRUE) {
    session_start();
    $_SESSION['success_message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	Sửa dịch vụ thành công!.
	<span id="countdown" class="float-end"></span>
	</div> ';
}else{
    session_start();
    $_SESSION['error_message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	Sửa dịch vụ thất bại! Vui lòng thử lại sau.
	<span id="countdown" class="float-end"></span>
  </div>';
}
header('location:../../View/vAdmin/delivery-service.php'); 
?>
