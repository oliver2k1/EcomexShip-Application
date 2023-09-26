<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include_once "../../Model/order.php";
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
                <?php
                  if ($_SERVER["REQUEST_METHOD"] =='POST' && isset($_POST['submit'])){
                  $idOrders = $_POST['idOrder'];
                  $send_order= $order->send_order($idOrders);
                  }
                ?>
                <?php
                  if(isset($send_order)){
                    echo $send_order;
                  }
                ?>
                <h5 class="card-header">Đơn hàng đã lưu</h5>
                <?php
                    if(isset($_GET['idOrder']) && $_GET['idOrder']!=""){
                    $idOrder = $_GET['idOrder'];
                    $delete_order = $order->delete_order($idOrder);
                  }
                ?>
                <?php
                  if(isset($delete_order)){
                    echo $delete_order;
                  }
                ?>
                <div class="table-responsive text-nowrap">
                <form  action="./list-wait.php" method="post" id="f1">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr class="text-nowrap">
                        <th><input type="checkbox" id="checkbox-all" onclick="toggleAll()"> Tất cả</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên người nhận</th>
                        <th>Tên sản phẩm</th>
                        <th>Quốc gia</th>
                        <th>Dịch vụ</th>
                        <th>Thời gian tạo</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?PHP
                        $id_user = $_SESSION["name"];
                        $show_cart = $order->show_cart($id_user);
                        if($show_cart){
                          $i = 0;
                          while($result = $show_cart->fetch_assoc()){
                            $i++;
                    ?>
                      <tr>
                        <td><input class="checkbox" type="checkbox" name="idOrder[]" value="<?php echo $result['idOrder'] ?>" id="idOrder"></td>
                        <td><a href="detail.php?idOrder=<?php echo $result['idOrder'] ?>"><?php echo $result['idOrder'] ?></a></td>
                        <td><?php echo $result['name_consignee'] ?></td>
                        <td><?php echo $result['name_product'] ?></td>
                        <td><?php echo $result['country'] ?></td>
                        <td><?php echo $result['service'] ?></td>
                        <td><?php echo $result['time'] ?></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="edit-order.php?idOrder=<?php echo $result['idOrder'] ?>"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
                            <a class="dropdown-item" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')" href="list-wait.php?idOrder=<?php echo $result['idOrder'] ?>"><i class="bx bx-trash me-1"></i> Xóa đơn hàng</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?PHP
                          }
                        } 
                    ?>
                    </tbody>
                  </table>
              <div class="row">
                <div class="col text-center"> 
                  <br>
                  <button data-bs-toggle="modal" data-bs-target="#deleteModal" type="button" class="btn btn-primary" name="submit">Gửi đơn hàng</button>
                  <a type="reset" class="btn btn-outline-secondary" href="index.php">Quay lại</a>
              </div>
            </div>
        <div class="modal" tabindex="-1" id="deleteModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Xác nhận gửi đơn hàng?</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="submit">Gửi đơn hàng</button>
                <a type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Quay lại</a>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
  <div class="content-backdrop fade"></div>
</div>
</div>
</div>
</div>
<?php 
  include "../../Dungchung/js.php";
?>
