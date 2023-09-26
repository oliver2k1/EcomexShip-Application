<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include_once "../../Model/order.php";
include_once "../../Model/connect.php";
?>
<?PHP
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_GET['kienhang'])||$_GET['kienhang']!=NULL){
    $kienhang = $_GET['kienhang'];
}else{
    die('Không tồn tại kiện hàng!');
}
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Responsive Table -->
    <form  method="post">
             <div class="card">
            <h5 class="card-header">
              Danh sách đơn hàng: 
              <span class="text-primary"><?php echo $kienhang ?></span>
              <button type="submit" name="action" value="vanchuyen" class="btn btn-warning" style="margin-right: 10px;" onclick="return confirm('Chuyển trạng thái đang vận chuyển! Tiếp tục ?')">Vận chuyển</button>
              <button type="submit" name="action" value="nhapkho" class="btn btn-info" style="margin-right: 10px;" onclick="return confirm('Chuyển trạng thái đã nhập kho! Tiếp tục ?')">Nhập kho</button>
              <button type="submit" name="action" value="xuatkho" class="btn btn-info" style="margin-right: 10px;" onclick="return confirm('Chuyển trạng thái đã xuất kho! Tiếp tục ?')">Xuất kho</button>
              <button type="submit" name="action" value="giaophat" class="btn btn-info" style="margin-right: 10px;" onclick="return confirm('Chuyển trạng thái đang giao phát! Tiếp tục ?')">Giao phát</button>
              <button type="submit" name="action" value="hoanthanh" class="btn btn-primary" style="margin-right: 10px;" onclick="return confirm('Chuyển trạng thái đang đã hoàn thành! Tiếp tục ?')">Hoàn thành</button>
              <button type="submit" name="action" value="xoakien" class="btn btn-dark" style="margin-right: 10px;" onclick="return confirm('Xóa đơn hàng khỏi kiện! Tiếp tục ?')">Xóa khỏi kiện</button>
            </h5>
                        <?php
            // Kiểm tra xem action có được gửi từ form hay không
            if (isset($_POST['action'])&&isset($_POST['idOrder']) && is_array($_POST['idOrder'])) {
              $action = $_POST['action'];
              $selectedIds = $_POST['idOrder'];
              // Xử lý các hành động tương ứng
              switch ($action) {
                case 'vanchuyen':
                  // Xử lý hành động vận chuyển
                  // ...
                  $set_trangthai = $order->setvanchuyen($selectedIds);
                  break;
                case 'nhapkho':
                  // Xử lý hành động nhập kho
                  // ...
                  $set_trangthai = $order->setnhapkho($selectedIds);
                  break;
                case 'xuatkho':
                  // Xử lý hành động xuất kho
                  // ...
                  $set_trangthai = $order->setxuatkho($selectedIds);
                  break;
                case 'giaophat':
                  // Xử lý hành động giao phát
                  // ...
                  $set_trangthai = $order->setgiaophat($selectedIds);
                  break;
                case 'hoanthanh':
                  // Xử lý hành động hoàn thành
                  // ...
                  $set_trangthai = $order->sethoanthanh($selectedIds);
                  break;
                case 'xoakien':
                  // Xử lý hành động hoàn thành
                  // ...
                  $set_trangthai = $order->xoakhoikien($selectedIds);
                 break;
                default:
                  // Hành động không hợp lệ
                  break;
              }
            }
            ?>
                 <?php
                if(isset($set_trangthai)){
                  echo $set_trangthai;
                }
              ?>
                 <?php
                  // Số lượng đơn hàng hiển thị trên một trang
                  $per_page = 100;

                  // Tính tổng số đơn hàng
                  $count_query = "SELECT COUNT(id) AS total FROM oder Where `status` = 1 AND `kienhang`='$kienhang'";
                  $count_result = mysqli_query($conn, $count_query);
                  $count_row = mysqli_fetch_assoc($count_result);
                  $total_records = $count_row['total'];
                  // Tính toán tổng số trang
                  $total_pages = ceil($total_records / $per_page);

                  // Xác định trang hiện tại
                  if (!isset($_GET['page'])) {
                    $current_page = 1;
                  } else {
                    $current_page = $_GET['page'];
                  }
                  // Tính toán offset để xác định đơn hàng bắt đầu từ đâu trên trang hiện tại
                  $offset = ($current_page - 1) * $per_page;
                  // Lấy danh sách đơn hàng cho trang hiện tại
                  $order_result = $order->show_order_by_kienhang($kienhang,$offset,$per_page);
                ?>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr class="text-nowrap">
                        <th></th>
                        <th><input type="checkbox" id="checkbox-all" onclick="toggleAll()"> Tất cả</th>
                        <th>Mã đơn hàng</th>
                        <th>Thông tin người nhận</th>
                        <th>Cân nặng (gam)</th>
                        <th>Quốc gia</th>
                        <th>Tracking number</th>
                        <th>Thời gian tạo</th>
                        <th>Trạng thái</th>
                        <th>Thành tiền</th>
                        <th>Thanh toán</th>
                        <th>Label</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php 
                        if (mysqli_num_rows($order_result) > 0) {
                          $i = ($current_page - 1) * $per_page;
                          while ($result = mysqli_fetch_assoc($order_result)) {
                            $i++;
                      ?>
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><input class="checkbox" type="checkbox" name="idOrder[]" value="<?php echo $result['idOrder'] ?>" id="idOrder"></td>
                        <td><a href="edit-order.php?idOrder=<?php echo $result['idOrder'] ?>"><?php echo $result['idOrder'] ?></a></td>
                          <td><span class="text-dark"><?php echo $result['name_consignee'].' '.$result['address_consignee'].' '.$result['city'].' '.$result['state'].' '.$result['zipcode'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['weight'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['country'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['tracking_number'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['time'] ?></span></td>
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
                          <td><span class="text-nowrap"><?php echo number_format($result['price']) ?> VNĐ</span></td>
                          <td><span class="text-dark"><?php if($result['payment']==1){
                            echo "<span class='badge bg-label-success me-1'>Đã thanh toán</span>";
                          }else{
                            echo "<span class='badge bg-label-warning me-1'>Chưa thanh toán</span>";
                          }
                           ?></span></td>
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
                      <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="detail.php?idOrder=<?php echo $result['idOrder'] ?>"><i class="menu-icon tf-icons bx bx-detail"></i>Chi tiết</a>
                        </div>
                      </div>
                    </td>
                      </tr>
                      <?php 
                          }
                        } else {
                          echo "<tr><td colspan='9'>Không có đơn hàng</td></tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                                <?php
                  // Hiển thị phân trang
                  echo "<nav aria-label='Page navigation example'>";
                  echo "<ul class='pagination justify-content-center'>";
                  $start_page = max(1, $current_page - 10);
                  $end_page = min($total_pages, $current_page + 9);

                  for ($i = $start_page; $i <= $end_page; $i++) {
                    if ($i == $current_page) {
                      echo "<li class='page-item active'><a class='page-link' href='#'>".$i."</a></li>";
                    } else {
                     echo "<li class='page-item'><a class='page-link' href='list-kienhang.php?kienhang=" . urlencode($kienhang) . "&page=" . $i . "'>" . $i . "</a></li>";
                    }
                  }
                  echo "</ul>";
                  echo "</nav>";
                  mysqli_close($conn);
                ?>
              </div>
              </form>
              <!--/ Responsive Table -->
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

    </div>
    <!-- / Layout wrapper -->

<?php 
  include "../../Dungchung/js.php";
?>

