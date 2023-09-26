<?php
  $servername = "localhost";
  $username = "eco33771_ecomex";
  $password = "Ecomex@123";
  $dbname = "eco33771_ecomex";
  // Kết nối đến CSDL
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Kiểm tra kết nối
  if (!$conn) {
    die("Kết nối đến CSDL thất bại: " . mysqli_connect_error());
  }
?>