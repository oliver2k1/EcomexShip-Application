<?PHP 
  include "taskbar.php";
  include "navigation.php";
?>
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white;"><span>Quản lý đơn hàng /</span> Chỉnh sửa đơn hàng</h4>
            <?php
            if(!isset($_GET['idOrder'])||$_GET['idOrder']==NULL){

            }else{
              $idOrder = $_GET['idOrder'];
            }
          ?>
            <form action="edit-order.php"  method="post">
              <div class="row">
              <?php
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                $order = new order();
                if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
                  $update_order = $order->update_order_admin($_POST);
                }
              ?>
              <?php
                if(isset($update_order)){
                  echo $update_order;
                }
              ?>
                <div class="col-md-6">
                  <div class="card mb-4">
                  <?php 
                    $get_order_by_id = $order->detail_order($idOrder);
                      if ($get_order_by_id){
                        while ($result_order = $get_order_by_id->fetch_assoc()){
                  ?>
                    <h5 class="card-header">Thông tin người nhận</h5>
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label text-danger">Tình trạng đơn hàng</label>
                        <select class="form-select"  aria-label="Default select example" name="delivery_time" >
                          <option <?php if($result_order['delivery_time']==''){
                          echo 'selected'; } ?> value="">Chưa có hàng</option>
                          <option value="<?php
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            echo date("Y/m/d H:i:s", time())?>" <?php if($result_order['delivery_time']!=''){
                          echo 'selected'; } ?>>Đã có hàng</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label text-danger">Trạng thái đơn hàng</label>
                        <select class="form-select" aria-label="Default select example" name="trangthai">
                            <option <?php if($result_order['trangthai']==0){ echo 'selected'; } ?> value="0"> Chưa xử lý</option>
                            <option <?php if($result_order['trangthai']==6){ echo 'selected'; } ?> value="6"> Tạo nhãn label</option>
                            <option <?php if($result_order['trangthai']==1){ echo 'selected'; } ?> value="1"> Đang vận chuyển</option>
                            <option <?php if($result_order['trangthai']==7){ echo 'selected'; } ?> value="7"> Đã nhập kho</option>
                            <option <?php if($result_order['trangthai']==8){ echo 'selected'; } ?> value="8"> Đã xuất kho</option>
                            <option <?php if($result_order['trangthai']==5){ echo 'selected'; } ?> value="5"> Đang giao phát</option>
                            <option <?php if($result_order['trangthai']==2){ echo 'selected'; } ?> value="2"> Đã hoàn thành </option>
                            <option <?php if($result_order['trangthai']==3){ echo 'selected'; } ?> value="3"> Đơn chú ý</option>
                            <option <?php if($result_order['trangthai']==4){ echo 'selected'; } ?> value="4"> Hủy đơn hàng</option>
                      </select>
                    </div>
                    <div class="mb-3" >
                        <label  class="form-label text-danger">Thời gian dự kiến</label>
                        <select name="time_dukien" class="form-select" id="">
                            <option <?php if($result_order['time_dukien']==2629746) { echo 'selected'; }?> value="2629746">Chưa chọn thời gian</option>
                            <option <?php if($result_order['time_dukien']==432000) { echo 'selected'; }?> value="432000">5 ngày</option>
                            <option <?php if($result_order['time_dukien']==518400) { echo 'selected'; }?> value="518400">6 ngày</option>
                            <option <?php if($result_order['time_dukien']==777600) { echo 'selected'; }?> value="777600">9 ngày</option>
                            <option <?php if($result_order['time_dukien']==864000) { echo 'selected'; }?> value="864000">10 ngày</option>
                            <option <?php if($result_order['time_dukien']==1296000) { echo 'selected'; }?> value="1296000">15 ngày</option>
                            <option <?php if($result_order['time_dukien']==1555200) { echo 'selected'; }?> value="1555200">18 ngày</option>
                            <option <?php if($result_order['time_dukien']==1728000) { echo 'selected'; }?> value="1728000">20 ngày</option>
                        </select>
                      </div>
                      <div class="mb-3" >
                        <label class="form-label text-danger">Thanh toán</label>
                        <select name="payment" class="form-select" id="">
                            <option <?php if($result_order['payment']!=1) { echo 'selected'; }?> value="0">Chưa thanh toán</option>
                            <option <?php if($result_order['payment']==1) { echo 'selected'; }?> value="1">Đã thanh toán</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Tên người nhận*</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['name_consignee']) ?>"
                          name="nameReceiver"
                        />
                      </div>
                      <div class="">
                        <label for="defaultFormControlInput" class="form-label">Địa chỉ*</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['address_consignee']) ?>"
                          name="addressReceiver"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Số điện thoại*</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['phone_consignee']) ?>"
                          placeholder="VD: +84 123 456 789"
                          name="phoneReceiver"
                        />
                      </div>
                      <div class="mb-3" >
                        <label for="defaultFormControlInput" class="form-label">Quốc Gia</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['country']) ?>"
                          name="country"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Bang</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['state']) ?>"
                          name="state"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Thành phố</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['city']) ?>"
                          name="city"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Zipcode</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['zipcode']) ?>"
                          name="zipcode"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Thời gian tạo</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['time']) ?>"
                          name=""
                          readonly
                        />
                      </div>
                    </div>
                  </div> 
                </div> 
                  <input
                    type="hidden"
                    class="form-control"
                    value="<?php
                    if($result_order['trangthai']==0||$result_order['trangthai']==6){
                      echo time();
                    }else{
                      echo $result_order['ship_time'];
                    }
                    ?>"
                    name="ship_time"
                  />
                  <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Thông tin đơn hàng</h5>
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-danger">Mã đơn hàng (ID)</label>
                        <input autocomplete="OFF" type="text" class="form-control" id="" name="product_id" value="<?php echo htmlspecialchars($result_order['idOrder']) ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label text-danger">Tên khách hàng*</label>
                        <select class="form-select"  aria-label="Default select example" name="name_user" required>
                      <?php
                      if($result_order['payment']==1||($result_order['trangthai']==1)||($result_order['trangthai']==2)||($result_order['trangthai']==3)||($result_order['trangthai']==4)){
                        echo '<option value="'.$result_order["name_user"].'">'.$result_order["name_user"].'</option>';
                      }elseif($result_order['name_user']==""){
                        $list_user = $order->get_list_user();
                        foreach($list_user as $row)//lặp từng dòng
                          {
                        ?>
                            <option value="<?php echo $row["name"]?>"><?php echo$row["name"]?></option>
                            <?php
                          }
                        }else{
                          echo '<option value="'.$result_order["name_user"].'">'.$result_order["name_user"].'</option>';
                        }
                        ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label text-danger" >Loại dịch vụ</label>
                        <select class="form-select" aria-readonly="true" aria-label="Default select example" id="service" name="service">
                            <option value="">Chưa chọn dịch vụ</option>
                        <?php
                         if($result_order['service']!==''){
                          echo '<option selected value="'.$result_order["service"].'">'.$result_order["service"].'</option>';
                        }else{
                          $rows = getNameService();
                          foreach($rows as $row)//lặp từng dòng
                            {
                          ?>
                            <option value="<?=$row["name"]?>"><?=$row["name"]?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label text-danger" >Tên kiện hàng</label>
                        <select class="form-select" aria-readonly="true" aria-label="Default select example" id="kienhang" name="kienhang">
                            <option value="">Chưa chọn kiện hàng</option>
                        <?php
                         if($result_order['kienhang']!==''){
                          echo '<option selected value="'.$result_order["kienhang"].'">'.$result_order["kienhang"].'</option>';
                        }else{
                          $rows = getNameKienhang();
                          foreach($rows as $row)//lặp từng dòng
                            {
                          ?>
                            <option value="<?=$row["name"]?>"><?=$row["name"]?></option>
                          <?php
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Tên sản phẩm</label>
                        <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" placeholder="Nhập tên sản phẩm" value="<?php echo htmlspecialchars($result_order['name_product']) ?>">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Số lượng gói hàng</label>
                        <input  type="number" class="form-control" id="product" name="quantity" required="" min="1" placeholder="Nhập số kiện hàng" value="<?php echo htmlspecialchars($result_order['quantity']) ?>">
                      </div>
                      <label for="x" class="form-label">Kích thước (cm) - Dim (gam)</label>
                      <div class="input-group" class="mb-3">
                        <input name="length"  required type="number" id="dai"  <?php if( $result_order['trangthai']!= 0){ echo 'min = "1"'; } ?>  class="form-control" placeholder="Chiều dài" value="<?php echo htmlspecialchars($result_order['length']) ?>"/>
                        <input name="width"  required type="number"  id="rong" <?php if( $result_order['trangthai']!= 0){ echo 'min = "1"'; } ?>  class="form-control" placeholder="Chiều rộng" value="<?php echo htmlspecialchars($result_order['width']) ?>"/>
                        <input name="height"  required type="number"  id="cao"  <?php if( $result_order['trangthai']!= 0){ echo 'min = "1"'; } ?>  class="form-control" placeholder="Chiều cao" value="<?php echo htmlspecialchars($result_order['height']) ?>"/>
                        <input name="dim" required type="number" id="ketqua" readonly class="form-control" value="<?php echo htmlspecialchars($result_order['dim']) ?>"/>
                      </div>
                    <div class="mb-3">
                      <label for="x2" class="form-label ">Cân nặng (gam)</label>
                      <input name="weight" id="weight" type="number" step="1" <?php if( $result_order['trangthai']!= 0){ echo 'min = "1"'; } ?>  required aria-label="First name" class="form-control" placeholder="Cân nặng" value="<?php echo htmlspecialchars($result_order['weight']) ?>"/>
                    </div>
                    <div class="mb-3">
                      <label for="x2" class="form-label" >Chiết khấu (%)</label>
                      <input name="disscount" id="disscount" step="1" type="number" min="0" max="100"  
                     <?php if( $result_order['trangthai']!= 0){ echo 'required'; } ?> class="form-control"  placeholder="Nhập chiết khấu" value="<?PHP echo $result_order['disscount'] ?>"/>
                    </div>
                    <div class="mb-3">
                      <label for="x2" class="form-label" >Phụ phí</label>
                      <input name="fee" id="fee" step="1" type="number" min="0"
                      <?php if( $result_order['trangthai']!= 0){ echo 'required'; } ?>  class="form-control"  placeholder="Nhập phụ phí" value="<?PHP if($result_order['trangthai']!= 0&&$result_order['trangthai']!= 6 ){echo $result_order['fee'];} ?>"/>
                    </div>
                    <div class="mb-3">
                      <label for="x2" class="form-label" >Thành tiền (VNĐ)</label>
                      <input id="price" name="price" value="<?php echo $result_order['price'] ?>" type="number" class="form-control" readonly></input>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" >Tracking number</label>
                      <input  type="text" aria-label="First name" class="form-control" <?php if($result_order['trangthai']==2){echo "readonly";} ?> name="tracking_number" value="<?php echo $result_order['tracking_number'] ?>"/>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-center"> 
                  <button type="submit" class="btn btn-primary" onclick="return confirm('Hãy kiểm tra thông tin kỹ đơn hàng! Tiếp tục ?')" name="submit">Lưu thay đổi</button>
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

