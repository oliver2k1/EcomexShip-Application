<?php 
require_once './Model/order.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ECOMEX</title>
</head>

<body>
<?php
session_start();
require("Database.php");
$user = $_REQUEST["username"];
//$pass = $_REQUEST["password"];
$pass = md5($_REQUEST["password"]);
$row = CheckLogin($user,$pass);
if($row!=NULL)//thành công
{
	$_SESSION["dangnhap"] = "OK";
	$_SESSION["user"] = $row["username"];//lấy giá trị cột fullname
	// $_SESSION["fullname"]=$row["fullname"];//lấy giá trị cột fullname
	$_SESSION["quyen"]=$row["quyen"];//lấy giá trị cột fullname
	$_SESSION["name"] = $row["name"];
	$_SESSION["phone"] = $row["phone"];
	$_SESSION["email"] = $row["email"];
	$_SESSION["id"] = $row["id"];
	$_SESSION["avatar"] = $row["avatar"];
	// print_r($_SESSION);
	// echo "<a href=\"admin/index.php?usertype=". $_SESSION["quyen"] . "\"> Vào Trang index</a>";
	if ($_SESSION["quyen"] == 1) {
		header("Location: View/vAdmin/index.php?usertype=" . $_SESSION['quyen']);
		exit();
	  }
		// header('Location:admin/index.php');
	else if ($_SESSION["quyen"] == 2) {
		header("Location: View/vStaff/index.php?usertype=" . $_SESSION['quyen']);
		exit();
	  }
		// header('Location:customer/index.php');
	else if ($_SESSION["quyen"] == 3) {
		header("Location: View/vCustomer/index.php?usertype=" . $_SESSION['quyen']);
		exit();
	  }
	  else if ($_SESSION["quyen"] == 4) {
		header("Location: View/vStaffEpacket/index.php?usertype=" . $_SESSION['quyen']);
		exit();
	  }else if ($_SESSION["quyen"] == 5) {
		header("Location: View/vStaffSupport/index.php?usertype=" . $_SESSION['quyen']);
		exit();
	  }
		// header('Location:staff/index.php');
}
else
{
	$_SESSION["dangnhap"] = "";
	$_SESSION["quyen"] = "";
	echo "<script>alert('Sai tài khoản hoặc mật khẩu, vui lòng thử lại'); window.location.href = 'login.php';</script>";
	exit;
}
?>
</body>
</html>