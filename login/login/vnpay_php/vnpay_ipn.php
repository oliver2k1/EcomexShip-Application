﻿<?php
/* Payment Notify
 * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
 * Các bước thực hiện:
 * Kiểm tra checksum 
 * Tìm giao dịch trong database
 * Kiểm tra số tiền giữa hai hệ thống
 * Kiểm tra tình trạng của giao dịch trước khi cập nhật
 * Cập nhật kết quả vào Database
 * Trả kết quả ghi nhận lại cho VNPAY
 */

require_once("./config.php");
$inputData = array();
$returnData = array();
foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

$vnp_SecureHash = $inputData['vnp_SecureHash'];
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
$vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
$vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
$vnp_Amount = $inputData['vnp_Amount']/100; // Số tiền thanh toán VNPAY phản hồi
$Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
$orderId = $inputData['vnp_TxnRef'];
$orderIds = $inputData['vnp_OrderInfo'];
$name_user = $inputData['vnp_Inv_Customer'];
$time = $inputData['vnp_CreateDate'];
try {
    //Check Orderid    
    //Kiểm tra checksum của dữ liệu
    if ($secureHash == $vnp_SecureHash) {
        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
        //Giả sử: $order = mysqli_fetch_assoc($result);   
        $orders = NULL;
        $orderIds = $inputData['vnp_OrderInfo'];
        $orders = implode(',', $orderIds);
        $query = "SELECT SUM(price) FROM oder WHERE `idOrder` IN ($orders)";
        $result = mysqli_query($con, $query);
        $Amount = mysqli_fetch_assoc($result);
        if ($orders != NULL) {
            if($Amount == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
            {
                $query = "SELECT * FROM oder WHERE `idOrder` IN ($orders)";
                $result = mysqli_query($con, $query);
                    if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                        $query = "UPDATE `oder` SET `payment` = 1 WHERE `idOrder` IN ('$orders')";
                        $query2 = "INSERT INTO `vnpay` (`name_user`,`idBill`,`time`,`price`,`content`,`status`)
                         VALUES ('$name_user','$orderId','$time','$Amount','Thanh toán đơn hàng: $orders',1)";
                        $updateStatus = mysqli_query($con, $query);
                        $insertHistory = mysqli_query($con, $query2);
                    } else {
                        $query = "INSERT INTO `vnpay` (`name_user`,`idBill`,`time`,`price`,`content`,`status`)
                        VALUES ('$name_user','$orderId','$time','$Amount','Thanh toán đơn hàng: $orders',0)";
                        $insertHistory = mysqli_query($con, $query);
                    }               
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
            }
            else {
                $returnData['RspCode'] = '04';
                $returnData['Message'] = 'invalid amount';
            }
        } else {
            $returnData['RspCode'] = '01';
            $returnData['Message'] = 'Order not found';
        }
    } else {
        $returnData['RspCode'] = '97';
        $returnData['Message'] = 'Invalid signature';
    }
} catch (Exception $e) {
    $returnData['RspCode'] = '99';
    $returnData['Message'] = 'Unknow error';
}
//Trả lại VNPAY theo định dạng JSON
echo json_encode($returnData);
