<?PHP 
  include "taskbar.php";
  include "navigation.php";
?>
<?php
  if(!isset($_GET['idOrder'])||$_GET['idOrder']==NULL){

  }else{
    $idOrder = $_GET['idOrder'];
  }
?>

          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white;"><span>Quản lý đơn hàng /</span> Chỉnh sửa đơn hàng</h4>
            <form action="edit-order.php"  method="post">
              <div class="row">
              <?php
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                $order = new order();
                if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
                  $update_order = $order->update_order($_POST);
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
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Tên người nhận*</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['name_consignee']) ?>"
                          name="nameReceiver"
                        />
                      </div>
                      <div class="mb-3">
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
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Quốc Gia</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['country']) ?>"
                          name="country"
                        />
                      </div>
                      <div >
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
                    </div>
                  </div> 
                </div> 
                  <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Thông tin đơn hàng</h5>
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Mã đơn hàng (ID)</label>
                        <input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id" value="<?php echo htmlspecialchars($result_order['idOrder']) ?>" readonly>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Người tạo đơn</label>
                        <input type="text" class="form-control" name="name_creater" value="<?php echo htmlspecialchars($result_order['name_creater']) ?>" >
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Tên sản phẩm</label>
                        <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" placeholder="Nhập tên sản phẩm" value="<?php echo htmlspecialchars($result_order['name_product']) ?>">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Số kiện hàng</label>
                        <input  type="number" class="form-control" id="product" name="quantity" required="" min="1" placeholder="Nhập số kiện hàng" value="<?php echo htmlspecialchars($result_order['quantity']) ?>">
                      </div>
                      <div class="">
                        <label for="exampleFormControlSelect1" class="form-label" >Loại dịch vụ</label>
                        <select class="form-select"  aria-label="Default select example"  name="service">
                        <?php
                        $rows = getNameService();
                        foreach($rows as $row)//lặp từng dòng
                          {
                        ?>
                          <option value="<?=$row["name"]?>"><?=$row["name"]?></option>
                        <?php
                          }
                        ?>
                        </select>
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Zipcode</label>
                        <input
                          type="text"
                          class="form-control"
                          value="<?php echo htmlspecialchars($result_order['zipcode']) ?>"
                          name="zipcode"
                        />
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-center"> 
                  <button type="submit" class="btn btn-primary" name="submit">Lưu thay đổi</button>
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

