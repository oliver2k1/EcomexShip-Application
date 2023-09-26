<?PHP 
  include "taskbar.php";
  include "navigation.php";
?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
  if(!isset($_GET['idOrder'])||$_GET['idOrder']==NULL){
    echo "<script>alert('Lỗi không tồn tại id')</script>";
  }else{
    $idOrder = $_GET['idOrder'];
  }
?>
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <?php 
              $get_order_by_id = $order->detail_order($idOrder);
                if ($get_order_by_id){
                  while ($result_order = $get_order_by_id->fetch_assoc()){
            ?>
            <form action="barcode.php" target="_blank" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Thông tin người nhận</h5>
                    <div class="card-body">
                    <div class="mb-3">
                      <label for="defaultFormControlInput" class="form-label ">Trạng thái đơn hàng</label>
                      <input type = "text" readonly class="form-control" value="<?php if($result_order['trangthai'] == 0){
                         echo "Chưa xử lý";
                       }elseif ($result_order['trangthai'] == 1) {
                         echo "Đang vận chuyển";
                       }elseif ($result_order['trangthai']==2){
                        echo "Đã hoàn thành";
                       }elseif($result_order['trangthai']==3){
                        echo "Đơn rủi ro";
                       }elseif($result_order['trangthai']==4){
                        echo "Đơn đã hủy";
                       }elseif($result_order['trangthai']==5){
                        echo "Đang giao phát";
                       }elseif($result_order['trangthai']==6){
                        echo "Tạo nhãn label";
                       }else{
                        echo "Chưa xử lý";
                       } ?>" />
                    </select>
                    </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Tên khách hàng</label>
                        <input type = "text" value="<?php echo $result_order['name_user'] ?>"readonly class="form-control"></input>
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Tên người nhận</label>
                        <input type = "text" value="<?php echo $result_order['name_consignee'] ?>"readonly class="form-control"></input>
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Địa chỉ</label>
                        <input type = "text" value="<?php echo $result_order['address_consignee'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Số điện thoại</label>
                        <input type = "text" value="<?php echo $result_order['phone_consignee'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Quốc Gia</label>
                        <input type = "text" value="<?php echo $result_order['country'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Bang</label>
                        <input type = "text" value="<?php echo $result_order['state'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Thành phố</label>
                        <input type = "text" value="<?php echo $result_order['city'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Zipcode</label>
                        <input type = "text" value="<?php echo $result_order['zipcode'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Thời gian tạo</label>
                        <input type = "text" value="<?php echo $result_order['time'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Thời gian nhận hàng</label>
                        <input type = "text" value="<?php echo $result_order['delivery_time'] ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Tình trạng đơn hàng</label>
                        <input type ="text" value="<?php if(empty($result_order['delivery_time'])||$result_order['delivery_time']==""){
                          echo "Chưa có hàng";
                        }else{
                          echo "Đã có hàng";
                        } ?>" readonly class="form-control"></input>
                      </div>
                      <div class="mb-3">
                          <label for="defaultFormControlInput" class="form-label">Người tạo đơn</label>
                          <input type = "text" value="<?php echo $result_order['name_creater'] ?>" readonly class="form-control"></input>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Thông tin đơn hàng</h5>
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Mã đơn hàng (ID)</label>
                        <input type = "text" value="<?php echo $result_order['idOrder'] ?>" readonly class="form-control"></input>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Tên sản phẩm</label>
                        <input type = "text" readonly value="<?php echo $result_order['name_product'] ?>" class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Số lượng gói hàng</label>
                        <input type = "text" readonly value="<?php echo $result_order['quantity'] ?>" class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Loại dịch vụ</label>
                        <input type = "text" readonly value="<?php echo $result_order['service'] ?>" class="form-control"></input>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Thời gian giao hàng</label>
                        <input type = "text" readonly value="<?php if($result_order['trangthai']!=0 && $result_order['trangthai']!=6)
                        { echo date('Y/m/d H:i:s', $result_order['ship_time']);
                        } ?>" class="form-control" ></input>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Thời gian dự kiến</label>
                        <input type = "text" readonly value="<?php if($result_order['time_dukien']==2629746){
                          echo "30 ngày";
                        }elseif($result_order['time_dukien']==432000){
                          echo "5 ngày";
                        }elseif($result_order['time_dukien']==518400){
                          echo "6 ngày";
                        }elseif($result_order['time_dukien']==777600){
                          echo "9 ngày";
                        }elseif($result_order['time_dukien']==864000){
                          echo '10 ngày';
                        }elseif($result_order['time_dukien']==1296000){
                          echo '15 ngày';
                        }elseif($result_order['time_dukien']==1555200){
                          echo '18 ngày';
                        }elseif($result_order['time_dukien']==1728000){
                          echo '20 ngày';
                        } ?>" class="form-control"></input>
                      </div>
                      <label for="x" class="form-label">Kích thước (cm) Dim (gam)</label>
                      <div class="input-group">
                      <label class="form-control" >Kích thước</label>
                      <input type = "text" readonly name="length" type="text" aria-label="First name" class="form-control" value="<?php echo $result_order['length'].' cm' ?>" readonly />
                      <input type = "text" readonly name="width" type="text" aria-label="Last name" class="form-control" value="<?php echo $result_order['width'].' cm' ?>" readonly />
                      <input type = "text" readonly name="height" type="text" aria-label="Last name" class="form-control" value="<?php echo $result_order['height'].' cm' ?>" readonly />
                      <input type = "text" readonly name="dim" type="text" aria-label="Last name" class="form-control" value="<?php echo $result_order['dim'] ?>" readonly />
                      </div>
                    <label class="form-label">Cân nặng (gam)</label>
                    <div class="input-group">
                      <label  class="form-control" >Cân nặng</label>
                      <input type = "text" readonly name="weight" type="text" aria-label="First name" class="form-control" value="<?php echo $result_order['weight'].' gam' ?>" readonly />
                    </div>
                    <label for="price" class="form-label">Phụ phí (VNĐ)</label>
                    <div class="input-group mb-3">
                      <label for="price" class="form-control" >Phụ phí</label>
                      <input type = "text" readonly type="text" aria-label="First name" class="form-control" value="" readonly />
                    </div>
                    <label for="price" class="form-label">Chiết khấu (%)</label>
                    <div class="input-group mb-3">
                      <label for="price" class="form-control" >Chiết khấu</label>
                      <input type = "text" readonly type="text" class="form-control" value="" readonly />
                    </div>
                    <label for="price" class="form-label">Thành tiền (VNĐ)</label>
                    <div class="input-group mb-3">
                      <label for="price" class="form-control" >Thành tiền</label>
                      <input type = "text" readonly type="text" aria-label="First name" class="form-control" value="" readonly />
                    </div>
                    <label for="price" class="form-label">Tracking number</label>
                    <div class="input-group mb-3">
                      <label for="price" class="form-control" >Tracking number</label>
                      <input  type="text" aria-label="First name" class="form-control" value="<?php echo $result_order['tracking_number'] ?>" readonly/>
                    </div>
                    <div >
                        <label for="exampleFormControlSelect1" class="form-label">Trạng thái thanh toán</label>
                        <input type = "text" readonly value="<?php if($result_order['payment']==1){
                          echo "Đã thanh toán";
                        }else{
                          echo "Chưa thanh toán";
                        }  ?>" class="form-control"></input>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                  <div class="col text-center"> 
                    <button type="button" class="btn btn-outline-secondary" onclick="goBack()">Quay lại</button>
                  </div>
                </div> 
          </form>
          <?php
                  }
                }
            ?>
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>

