<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
            <?php
        require_once("./config.php");
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        ?>
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form>
                    <div class="form-group">
                        <label for="order-id">Mã đơn hàng:</label>
                        <input type="text" class="form-control" id="order-id" value="<?php echo $_GET['vnp_TxnRef'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="amount">Số tiền:</label>
                        <input type="text" class="form-control" id="amount" value="<?php echo $_GET['vnp_Amount'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="order-info">Nội dung thanh toán:</label>
                        <input type="text" class="form-control" id="order-info" value="<?php echo $_GET['vnp_OrderInfo'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="response-code">Mã phản hồi (vnp_ResponseCode):</label>
                        <input type="text" class="form-control" id="response-code" value="<?php echo $_GET['vnp_ResponseCode'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="transaction-no">Mã GD Tại VNPAY:</label>
                        <input type="text" class="form-control" id="transaction-no" value="<?php echo $_GET['vnp_TransactionNo'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bank-code">Mã Ngân hàng:</label>
                        <input type="text" class="form-control" id="bank-code" value="<?php echo $_GET['vnp_BankCode'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pay-date">Thời gian thanh toán:</label>
                        <input type="text" class="form-control" id="pay-date" value="<?php echo $_GET['vnp_PayDate'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="result">Kết quả:</label>
                        <input type="text" class="form-control" id="result" value="<?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "GD Thanh cong";
                            } else {
                                echo "GD Khong thanh cong";
                            }
                        } else {
                            echo "Chu ky khong hop le";
                        }
                        ?>" readonly>
                    </div>
                </form>
            </div>
        </div>
        <footer class="footer">
            <p>&copy; VNPAY <?php echo date('Y')?></p>
        </footer>
    </div>
</body>
</html>