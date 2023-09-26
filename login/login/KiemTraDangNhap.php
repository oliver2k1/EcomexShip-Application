<?php
//nếu chưa có biến $_SESSION["logined"] thì cho như chưa đăng nhập
if(isset($_SESSION["dangnhap"])==false || $_SESSION["dangnhap"]=="")
{
header('Location:login.php');

// Chuyển dòng code ALT + CAPS + MŨI LÊN XUỐNG 
?>
	<!-- <h3 style="color:red"> BẠN CHƯA ĐĂNG NHẬP</h3>
    <a href="login.php"> MỜI ĐĂNG NHẬP</a> -->
<?php
	die("<h2>Kết thúc</h2>");
}
?>