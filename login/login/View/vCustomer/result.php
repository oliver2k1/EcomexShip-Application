<?PHP 
  include "taskbar.php";
  include "navigation.php";
?>
<?PHP
  if ((!isset($_GET['idOrder'])) || $_GET['idOrder'] === ''){
    echo "<script>window.location = list-all.php</script>";
  }else{
    $order_id = $_GET['idOrder'];
    $name_user = $_GET['name_user'];
    $show_order = $order->find_by_id_customer($order_id,$name_user);
  }
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Responsive Table -->
    <div class="card">
                <h4 class="card-header">Kết quả tìm kiếm cho mã đơn hàng <span class="text-danger"><?php echo $order_id ?></span></h4>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr class="text-nowrap">
                        <th></th>
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên người nhận</th>
                        <th>Thành tiền</th>
                        <th>Thời gian nhận hàng</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                         <th>Label</th> 
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        if(isset($show_order)){
                          $i = 0;
                          while($result = $show_order->fetch_assoc()){
                            $i++;
                      ?>
                      <tr>
                        <td><a type="button" target="_blank" href="../../Dungchung/barcode.php?idOrder=<?php echo $result['idOrder'] ?>&quantity=<?php echo $result['quantity'] ?>&service=<?php echo $result['service'] ?>" id="showToastPlacement" class="btn btn-primary d-block"><i class="fas fa-print"></i></a></td>
                        <td><a href="detail.php?idOrder=<?php echo $result['idOrder'] ?>"><?php echo $result['idOrder'] ?></a></td>
                        <td><span class="text-dark"><?php echo $result['name_product'] ?></span></td>
                        <td><?php echo $result['name_consignee'] ?></td>
                        <td><span class="text-nowrap"><?php echo number_format($result['price']) ?> VNĐ</span></td>
                        <td><?php echo $result['delivery_time'] ?></td>
                        <td>
                            <?php 
                              if ($result['trangthai'] == 1) {
                                echo "<span class='badge bg-label-info me-1'>Đang vận chuyển</span>";
                              } elseif ($result['trangthai'] == 2) {
                                echo "<span class='badge bg-label-success me-1'>Đã hoàn thành</span>";
                              } elseif ($result['trangthai'] == 3) {
                                echo "<span class='badge bg-label-danger me-1'>Đơn chú ý</span>";
                              } elseif ($result['trangthai'] == 4) {
                                echo "<span class='badge bg-label-secondary me-1'>Đơn đã hủy</span>";
                              }elseif ($result['trangthai'] == 5) {
                                echo "<span class='badge bg-label-info me-1'>Đang giao phát</span>";
                              }elseif ($result['trangthai'] == 6) {
                                echo "<span class='badge bg-label-warning me-1'>Tạo nhãn label</span>";
                              }elseif ($result['trangthai'] == 7) {
                                echo "<span class='badge bg-label-info me-1'>Đã nhập kho</span>";
                              }elseif ($result['trangthai'] == 8) {
                                echo "<span class='badge bg-label-info me-1'>Đã xuất kho</span>";
                              }else {
                                echo "<span class='badge bg-label-warning me-1'>Chưa xử lý</span>";
                              }
                            ?>
                        </td>
                        <td><?php if($result['payment']==1){
                          echo "<span class='badge bg-label-success me-1'>Đã thanh toán</span>" ;
                        }else{
                          echo "<span class='badge bg-label-warning me-1'>Chưa thanh toán</span>";
                        } ?></td>
                         <?php
                          $idOrder = $result['idOrder'];
                          $show_label = $order->Show_label($idOrder);
                          if($show_label){
                            while($label = mysqli_fetch_assoc($show_label)){
                            echo'<td><a target="_blank" href="../../Dungchung/pdf/'.$label['filename'].'" class="btn btn-info" download>Download</a></td>';
                            }
                          } else {
                              echo "<td><span class='badge bg-label-secondary me-1'>Chưa có label</span></td>";
                          }
                        ?>
                      </tr>
                      <?PHP
                          }
                        } 
                      ?>
                    </tbody>
                  </table>
                </div>  
              </div>
              <!--/ Responsive Table -->
            </div>
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

    </div>

<?php 
  include "../../Dungchung/js.php";
?>

