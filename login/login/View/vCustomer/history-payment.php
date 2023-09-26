<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include_once "../../Model/connect.php";
?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">           
              <h5 class="card-header">Lịch sử thanh toán</h5>
              <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr>
                        <th>Mã hóa đơn</th>
                        <th>Thời gian</th>
                        <th>Số tiền</th>
                        <th>Ngân hàng</th>
                        <th>Mã gd ngân hàng</th>
                        <th>Mã gd VNPAY</th>
                        <th>Trạng thái</th>
                        <th>Nội dung</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
                 // Số lượng đơn hàng hiển thị trên một trang
                  $per_page = 10;
                  // Tính tổng số đơn hàng
                  $name_user = $_SESSION['name'];
                  $count_query = "SELECT COUNT(id) AS total FROM `vnpay` WHERE `name_user`= '$name_user'";
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
                  $order_result = $order->show_payment_customer($name_user,$offset,$per_page);
                  if (mysqli_num_rows($order_result) > 0) {
                    $i = ($current_page - 1) * $per_page;
                    while ($result = mysqli_fetch_assoc($order_result)) {
                      $i++;
                   ?>
                      <tr>
                        <td class="text-primary"><?php echo $result['idBill'] ?></td>
                        <td><?php echo date("Y:m:d-H:i:s", strtotime($result['time']))?></td>
                        <td><?php echo number_format($result['price']) ?> VNĐ</td>
                        <td><?php echo $result['vnp_bankcode'] ?></td>
                        <td><?php echo $result['vnp_banktranno'] ?></td>
                        <td><?php echo $result['vnp_transactionno'] ?></td>
                        <td><?php if($result['status']==1){
                          echo '<span class="badge bg-label-success me-1">Thành công</span>';
                        }else{
                          echo '<span class="badge bg-label-danger me-1">Thất bại</span>';
                        } ?></td>
                        <td><?php echo $result['content'] ?></td>
                      <?php 
                      }
                    }else {
                      echo "<tr><td colspan='9'>Không có hóa đơn</td></tr>";
                    }?>
                      </tr>
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
                      echo "<li class='page-item'><a class='page-link' href='history-payment.php?page=".$i."'>".$i."</a></li>";
                    }
                  }
                  echo "</ul>";
                  echo "</nav>";
                  mysqli_close($conn);
                ?>
              </div>
              <!--/ Borderless Table -->
            </div>
            <!-- / Content -->
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

    </div>
<?php 
  include "../../Dungchung/js.php";
?>


