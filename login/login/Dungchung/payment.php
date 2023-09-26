<?php
  require_once("../vnpay_php/config.php");
  require_once '../Model/connect.php'; 
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Ecomex </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo2.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/css/navi.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    <style></style>
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>
  <body">
  <div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
        <div class="table-responsive text-nowrap">
            <div class="card">  
            <!--<form action="../vnpay_php/vnpay_create_payment.php" id="frmCreateOrder" method="post" >-->
            <form action="" id="frmCreateOrder" method="post" >
            <h3 class="card-header">Thông tin thanh toán</h3>
            <div class="table-responsive text-nowrap">
                <table class="table" style="color: #000;">
                <thead>
                    <tr class="text-nowrap">
                    <th class="text-uppercase">Mã đơn hàng</th>
                    <th class="text-uppercase">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                <tr>

            <?php 
                if (isset($_POST['idOrder']) && is_array($_POST['idOrder'])) {
                    $order_ids = $_POST['idOrder'];
                    $price = 0; // Khởi tạo biến để tính tổng giá tiền của các đơn hàng đã chọn
                    foreach ($order_ids as $order_id) {
                    $query = "SELECT * FROM oder WHERE `idOrder` = '$order_id'";
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $price += $row['price'];
                ?>
                    <tr>
                        <td><input class="form-control" name="idOrder[]" type="text" readonly value="<?php echo $order_id ?>"></td>
                        <td><input class="form-control" type="number" readonly value="<?php echo $row['price']?>" /></td>
                        <input type='hidden' name='name_user' value='<?php echo $row['name_user'] ?>'></input>
                    </tr>
                    <?php 
                        } else {
                            echo "<td><h5>Không tìm thấy đơn hàng có ID là $order_id</h5></td>";
                        }
                    }
                        echo "<td><h4>Tổng tiền:</h4></td>
                        <td><h4><span class='text-danger'>".number_format($price)."</span><input type='hidden' name='amount' value='$price'></input> VNĐ</h4></td>
                        ";
                        } else {
                            echo "<td><h5>Bạn chưa chọn đơn hàng nào để thanh toán!</h5></td>";
                        }
                    ?>
                </tbody>
                </table>
            </div>
            <div class="card-body">
                <h4 class="card-header">Phương thức thanh toán</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="vnpay"  checked>
                    <label class="form-check-label" for="exampleRadio1">
                    <img src="../assets/img/vnpay.jpg" alt="VNPAY" height="30">Cổng thanh toán VNPAY
                    </label>
                </div>
                <h4 class="card-header">Chọn ngôn ngữ giao diện thanh toán:</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="language" id="language"  value="vn" checked>
                    <label class="form-check-label" for="exampleRadio1">
                        Tiếng Việt
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="language" id="language"  value="en" >
                    <label class="form-check-label" for="exampleRadio1">
                        Tiếng Anh
                    </label>
                </div>
                <br>
                <!--<button class="btn btn-primary" name="redirect" type="submit">Thanh toán</button>-->
                <button class="btn btn-primary" onclick="alert('Chức năng đang được phát triển')">Thanh toán</button>
                <button onclick="closeTab()" class="btn btn-secondary">Quay lại</button>  
             </div>
            </div>
                </form>
            </div>
        </div>
     </div>
  </div> 
 </body>
</html>
<script>
function closeTab() {
  window.close();
}
</script>