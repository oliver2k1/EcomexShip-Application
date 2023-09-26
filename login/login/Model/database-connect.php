<?php
function ConnectDB()
{
    $conn = NULL;
    try
    {
    $conn = new PDO("mysql:host=localhost;dbname=eco33771_ecomex","eco33771_ecomex","Ecomex@123");
    $conn->query("SET NAMES UTF8");//thiết lập chế độ unicode
    }
    catch(PDOException $ex)
    {
        echo "<p>" . $ex->getMessage() . "</p>";//thông báo lỗi hệ thống
        die ("<h3> LỖI KẾT NỐI CSDL </h3>");
    }
    return $conn;//trả về đối tượng PDO
}
?>