<?php
// Kết nối đến cơ sở dữ liệu
require_once 'dbcon.php';
// Lấy tên người nhận từ yêu cầu AJAX
$receiver = $_POST['currentAccount'];
$sender = $_POST['receiver'];
// Cập nhật trạng thái của tin nhắn từ "chưa đọc" thành "đã đọc"
$query = "UPDATE messages SET is_read = 1 WHERE `recipient` = '$receiver' AND `sender` = '$sender'";
$result = mysqli_query($con, $query);
if ($result) {
    // Cập nhật thành công
    echo 'success';
} else {
    // Xử lý lỗi
    echo 'error';
}
// Đóng kết nối cơ sở dữ liệu
mysqli_close($con);
?>