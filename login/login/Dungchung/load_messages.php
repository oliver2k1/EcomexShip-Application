<?php
// Kết nối đến CSDL
$conn = new mysqli("localhost", "eco33771_ecomex", "Ecomex@123", "eco33771_ecomex");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Lỗi kết nối đến CSDL: " . $conn->connect_error);
}

if (isset($_POST["currentAccount"]) && isset($_POST["receiverAccount"])) {
    // Lấy tài khoản hiện tại và tài khoản người nhận từ dữ liệu gửi đi
$currentAccount = $_POST["currentAccount"];
$receiverAccount = $_POST["receiverAccount"];

// Truy vấn tin nhắn từ CSDL
$sql = "SELECT * FROM `messages` WHERE (`sender` = '$currentAccount' AND `recipient` = '$receiverAccount') OR (sender = '$receiverAccount' AND recipient = '$currentAccount') ORDER BY created_at ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tạo chuỗi HTML để hiển thị tin nhắn
    $html = "";
    while ($row = $result->fetch_assoc()) {
        $message = $row["message"];
        $time = $row["created_at"];
        $time = substr($time, 11, 5);
        // Hiển thị tin nhắn tùy thuộc vào người gửi
        if ($row["sender"] == $currentAccount) {
            $html .= '<div class="message-container me">';
        } else {
            $html .= '<div class="message-container">';
        }
        $html .= '<div class="message">'. $message .'</div>';
        $html .= '</div>';
    }
    echo $html;
} else {
    echo $receiverAccount;
}
}else {
    // Dữ liệu POST không được gửi đi hoặc không nhận được
    echo "";
}

$conn->close();
?>