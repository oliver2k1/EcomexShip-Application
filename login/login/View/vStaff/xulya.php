<?php
	$conn = new mysqli("localhost","eco33771_ecomex","Ecomex@123","eco33771_ecomex");

	// Check connection
	if ($conn->connect_errno) {
	  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
	  exit();
	}

	if(isset($_POST['themtaikhoankh'])){
	$tendangnhap = $_POST['username'];
	$tenkhachhang = $_POST['name'];
	$matkhau = md5($_POST['password']);
	$sdt = $_POST['phone'];
	$email = $_POST['email'];
	$quyen = $_POST['quyen'];
	$name_creater = $_POST['name_creater'];
	//them
	$sql_them = "
	SELECT COUNT(*) as count FROM user WHERE username = '$tendangnhap' AND quyen = '$quyen'
	";
	$result = $conn->query($sql_them);
	$count = $result->fetch_assoc()['count'];

	if ($count > 0) {
		echo
		"<script>alert('Tên đăng nhập đã tồn tại! Vui lòng chọn tên đăng nhập khác');
			window.location.href = 'register-staff.php';
			</script>";
	} else {
		$sql = "
		INSERT INTO user(username, name, password, phone, email, quyen, name_creater,avatar) 
		VALUES('".$tendangnhap."','".$tenkhachhang."','".$matkhau."','".$sdt."','".$email."','".$quyen."','$name_creater','../../uploads/0.jpg')
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
elseif(isset($_GET['suadanhmuc'])){
	//sua
	$sql_update = "UPDATE tbl_danhmuc SET tendanhmuc='".$tenloaisp."',thutu='".$thutu."' WHERE id_danhmuc='$_GET[iddanhmuc]'";
	mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
}

elseif(isset($_GET['id_cnmk'])){
	$cnmk=$_GET['id_cnmk'];
	$sql_updatemk = "UPDATE user SET `password` = '123456' WHERE `id` ='$cnmk'";
	mysqli_query($conn,$sql_updatemk);
	$message = "Đặt lại mật khẩu thành công!";
	echo "<script>alert('$message');
	window.history.back();</script>";
}
else{
	$idkh=$_GET['id_kh'];
	$sql_xoa = "DELETE FROM user WHERE id='".$idkh."'";
	mysqli_query($conn,$sql_xoa);
	$message = "Xóa tài khoản thành công!";
	echo "<script>alert('$message');
	window.history.back();</script>";
}
?>