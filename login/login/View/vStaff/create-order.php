<?PHP 
include_once "taskbar.php";
include_once "navigation.php";
?>
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white;"><span>Quản lý đơn hàng /</span> Tạo đơn hàng</h4>
            <form  action="create-order.php" method="post">
              <div class="row">
              <?php
              error_reporting(E_ERROR | E_WARNING | E_PARSE);
                if ($_SERVER["REQUEST_METHOD"] =='POST' && isset($_POST['submit'])){
                  $insert_order = $order->insert_order_admin($_POST);
                }
              ?>
              <?php
                if(isset($insert_order)){
                  echo $insert_order;
                }
              ?>
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Thông tin người nhận</h5>
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Quốc Gia*</label>
                        <input  class="form-control" name="country" type="text" value="" required>
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Bang</label>
                        <input  class="form-control" name="state" type="text" value="">
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label" >Thành phố*</label>
                        <input class="form-control" name="city" type="text" required>
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label" >Địa chỉ*</label>
                        <input
                          type="text"
                          class="form-control"
                          name="addressReceiver"
                          placeholder="VD: Lane 195 , Xo Viet Nghe Tinh Street"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Zipcode*</label>
                        <input  class="form-control" name="result" type="text" value="" required>
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Tên người nhận*</label>
                        <input
                          type="text"
                          class="form-control"
                          name="nameReceiver"
                          placeholder="VD: John Doe"
                          required
                        />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Số điện thoại</label>
                        <input
                          type="text"
                          class="form-control"
                          name="phoneReceiver"
                          placeholder="VD: +84 123 456 789"
                        />
                      </div>
                      <div class="mb-3">
                        <input
                          type="hidden"
                          class="form-control"
                          value="<?php
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            echo date("Y/m/d H:i:s", time())?>"
                            readonly
                          name="time"
                        />
                      </div>
                        <input
                          type="hidden"
                          value="<?php echo $_SESSION['name'] ?>"
                          readonly
                          name="nameCreater"
                        />
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Thông tin đơn hàng</h5>
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tên khách hàng*</label>
                        <select class="form-select"  aria-label="Default select example" name="name_user">
                          <option selected value="">Chọn khách hàng</option>
                        <?php
                        $list_user = $order->get_list_user();
                        foreach($list_user as $row)//lặp từng dòng
                          {
                      ?>
                          <option value="<?php echo $row["name"]?>"><?php echo$row["name"]?></option>
                          <?php
                        }
                      ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Mã đơn hàng (ID)</label>
                        <input  type="text" class="form-control" name="idOrder" value="<?php echo $_SESSION['id'].date('dhis') ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Tên sản phẩm</label>
                        <input autocomplete="OFF" type="text" class="form-control" id="product" name="product" placeholder="Nhập tên sản phẩm...">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Số lượng gói hàng</label>
                        <input  type="number" class="form-control" id="product" name="quantity" min="1" placeholder="Nhập số lượng gói hàng..." required>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Loại dịch vụ</label>
                        <select class="form-select"  aria-label="Default select example" name="service">
                          <option selected value="">Chọn dịch vụ</option>
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
                      <label for="x" class="form-label">Kích thước (cm)</label>
                    <div class="input-group">
                      <label class="form-control" >Kích thước</label>
                      <input name="length" id="dai" type="number" required class="form-control" placeholder="Chiều dài" />
                      <input name="width" id="rong" type="number" required class="form-control" placeholder="Chiều rộng"/>
                      <input name="height" id="cao" type="number" required class="form-control" placeholder="Chiều cao"/>
                      <input name="dim" id="ketqua" type="text" required id="ketqua" readonly class="form-control"/>
                    </div>
                    <label class="form-label">Cân nặng (gam)</label>
                    <div class="input-group">
                      <label  class="form-control" >Cân nặng</label>
                      <input name="weight" type="number" required aria-label="First name" class="form-control" placeholder="Cân nặng" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="row ">
              <div class="col text-center"> 
                  <button  type="submit" class="btn btn-primary" name="submit">Tạo đơn hàng</button>
                  <a type="button" class="btn btn-outline-secondary" href="index.php">Hủy bỏ</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>
