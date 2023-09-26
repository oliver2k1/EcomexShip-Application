    <title>Thank Pages</title>
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-misc.css" />
  </head>
  <body>
<div class="container-xxl container-p-y">
      <div class="misc-wrapper">
<?php 
    require_once("../Model/connect.php");
?>
<?php 
    session_start(); 
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if(isset($_GET['vnp_Amount']) && isset($_GET['vnp_BankTranNo']) && isset($_GET['vnp_TxnRef'])){
        $price = $_GET['vnp_Amount']/100;
        $idBill = $_GET['vnp_TxnRef'];
        $idOrders = $_GET['vnp_OrderInfo'];
        $creatTime = $_GET['vnp_PayDate'];
        $vnp_BankCode = $_GET['vnp_BankCode']; //Các mã loại hình thức thanh toán VNPAYQR, VNBANK, INTCARD
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];  //Mã giao dịch tại Ngân hàng. Ví dụ: NCB20170829152730
        $vnp_CardType = $_GET['vnp_CardType']; //Loại tài khoản/thẻ khách hàng sử dụng:ATM,QRCODE
        $vnp_TransactionNo = $_GET['vnp_TransactionNo']; // Mã giao dịch ghi nhận tại hệ thống VNPAY.
        $ketqua = $_GET['vnp_ResponseCode'];
        $name_user = $_SESSION['name'];
        $idOrder_array = explode(",", $idOrders);
        $query = "INSERT INTO vnpay(`idBill`,`time`,`price`,`content`,`status`,`vnp_bankcode`,`vnp_banktranno`,`vnp_cardtype`,`vnp_transactionno`,`name_user`) 
        VALUES ('$idBill','$creatTime','$price','Thanh toán đơn hàng: $idOrders',1,'$vnp_BankCode','$vnp_BankTranNo','$vnp_CardType','$vnp_TransactionNo','$name_user')";
        foreach ($idOrder_array as $idOrder){
            $query2 = "UPDATE oder SET `payment` = 1 WHERE `idOrder` = '$idOrder'";
            $result2 = mysqli_query($conn, $query2);
        }
        $result = mysqli_query($conn, $query);
        echo '<h3>Giao dịch bằng vnpay thành công !</h3>';
    }
    else{
        echo '<h3>Giao dịch bằng vnpay thất bại !</h3>';
    }
    ?>
    <a href="../login.php" class="btn btn-primary">Quay lại</a>
      </div>
</div>



