<?php
// Kết nối đến CSDL
$conn = new mysqli("localhost", "eco33771_ecomex", "Ecomex@123", "eco33771_ecomex");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Lỗi kết nối đến CSDL: " . $conn->connect_error);
}

// Lấy tài khoản hiện tại, tài khoản người nhận và tin nhắn từ dữ liệu gửi đi
$currentAccount = $_POST["currentAccount"];
$receiverAccount = $_POST["receiverAccount"];
$message = $_POST["message"];

// Thực hiện truy vấn để lưu tin nhắn vào CSDL
$sql = "INSERT INTO `messages` (`sender`, `recipient`, `message`) VALUES ('$currentAccount', '$receiverAccount', '$message')";
if ($conn->query($sql) === TRUE) {
    // Tin nhắn đã được lưu thành công
    echo "success";
} else {
    // Lỗi khi lưu tin nhắn
    echo "error: " . $conn->error;
}

$conn->close();
?>