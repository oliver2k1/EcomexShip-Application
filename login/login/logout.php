<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['name'])) {
    // Người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: login.php");
    exit();
}

// Đăng xuất: Huỷ phiên làm việc và xóa tất cả các biến SESSION
session_destroy();

// Chuyển hướng về trang đăng nhập sau khi đăng xuất
header("Location: login.php");
exit();
?>