<?php
	$conn = new mysqli("localhost","eco33771_ecomex","Ecomex@123","eco33771_ecomex");

	// Check connection
	if ($conn->connect_errno) {
	  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
	  exit();
	}

$tendangnhap = $_POST['username'];
$tennhanvien = $_POST['name'];
$matkhau = md5($_POST['password']);
$sdt = $_POST['phone'];
$email = $_POST['email'];
$quyen = $_POST['quyen'];
if(isset($_POST['themtaikhoannv'])){
	//them
	$sql_them = "
	SELECT COUNT(*) as count FROM user WHERE username = '$tendangnhap' OR name = '$tennhanvien' AND quyen = '$quyen'
	";
	$result = $conn->query($sql_them);
	$count = $result->fetch_assoc()['count'];

	if ($count > 0) {
		echo
		"<script>alert('Tên đăng nhập hoặc tên nhân viên đã tồn tại! Vui lòng chọn tên khác');
			window.location.href = 'register-staff.php';
			</script>";
	} else {
		$sql = "
		INSERT INTO user(username, name, password, phone, email, quyen, avatar) 
		VALUES('$tendangnhap','$tennhanvien','$matkhau','$sdt','$email','$quyen','../../uploads/0.jpg')
		";
		if ($conn->query($sql) === TRUE) {
			$message = "Tạo tài khoản thành công!";
			echo "<script>alert('$message');
			window.location.href = 'register-staff.php';
			</script>";
		} else {
			$message = "Tạo tài khoản thất bại!";
			echo "Lỗi: " . $conn->error."
			<script>alert('$message');
			window.location.href = 'register-staff.php';
			</script>
			";
		}
	}
}
// elseif(isset($_POST['suataikhoan'])){
// 	//sua
// 	$idnv=$_GET['id_nv'];
// 	$sql_update = "UPDATE user SET username='".$tendangnhap."',name='".$tennhanvien."',password='".$matkhau."',phone='".$sdt."',
// 	email='".$email."',quyen='".$quyen."' WHERE id='".$idnv."'";
// 	mysqli_query($conn,$sql_update);
// 	$message = "Sửa thành công!";
// 	echo "<script>alert('$message');window.location.href = 'http://localhost/EcomexMVC/View/vAdmin/account-staff.php';</script>";
// }
// else{

// 	$idnv=$_GET['id_nv'];
// 	$sql_xoa = "DELETE FROM user WHERE id='".$idnv."'";
// 	mysqli_query($conn,$sql_xoa);
// 	$message = "Xóa thành công!";
// 	echo "<script>alert('$message');window.location.href = '../view/vAdmin/account-staff.php';</script>";
// }
// else if{
// 		// Xóa dữ liệu từ bảng "users"
// 		$idnv=$_GET['id'];
// 		$sql = "DELETE FROM user WHERE id = '".$idnv.'";
	
// 		if (mysqli_query($conn, $sql)) {
// 			echo "Dữ liệu đã được xóa thành công";
// 		} else {
// 			echo "Lỗi xóa dữ liệu: " . mysqli_error($conn);
// 		}
// }
?>