<?php
// Kết nối đến cơ sở dữ liệu
require_once './dbcon.php';

if (isset($_GET['currentUsername'])) {
    // Lấy tên người nhắn tin hiện tại từ tham số truyền vào
    $currentUsername = $_GET['currentUsername'];
    // Thực hiện truy vấn để kiểm tra tin nhắn mới
    $query = "SELECT COUNT(*) AS new_messages
              FROM messages
              WHERE recipient = '$currentUsername' AND is_read = 0";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $newMessages = $row['new_messages'];
        if ($newMessages > 0) {
            // Có tin nhắn mới
            echo 'true';
        } else {
            // Không có tin nhắn mới
            echo 'false';
        }
    } else {
        // Xử lý lỗi
        echo 'error';
    }
}
// Đóng kết nối cơ sở dữ liệu
mysqli_close($con);
?>