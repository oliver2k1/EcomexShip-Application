<?php
$today = date('Ymd'); // Lấy ngày hiện tại dưới định dạng Ymd (VD: 20230927)
$unique_code = substr(str_shuffle($today), 0, 8); // Lấy 6 chữ số ngẫu nhiên từ chuỗi ngày hiện tại

echo $unique_code; // Hiển thị mã 6 chữ số không trùng nhau trong ngày
function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

$number = 8;
$combinations = factorial($number);
echo "Số lượng cách kết hợp: " . $combinations;
?>