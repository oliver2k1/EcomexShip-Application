<?php
session_start();
// print_r($_SESSION);
require("KiemTraDangNhap.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
</head>
<body>
<?php
//  session_start();
//  	header('Location:admin/index.php');
            $usertype = isset($_REQUEST["usertype"])?$_REQUEST["usertype"]:"";
            if($usertype==1)
                require("View/vAdmin/index.php");
            else if($usertype==2)
                require("View/vCustomer/index.php");
            else if($usertype==3)
                require("View/vStaff/index.php");
            else
                header('Location:login.php');
// ?>
</body>
</html>