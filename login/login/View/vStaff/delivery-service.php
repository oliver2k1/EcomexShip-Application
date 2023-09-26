<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include_once "../../Model/connect.php";
?>
</style>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
      <?php 
        if (isset($_SESSION['success_message'])) {
          echo '<div class="alert alert-success">'.$_SESSION['success_message'].'</div>';
          unset($_SESSION['success_message']);
      } else if (isset($_SESSION['error_message'])) {
          echo '<div class="alert alert-danger">'.$_SESSION['error_message'].'</div>';
          unset($_SESSION['error_message']);
      }
      ?>
      <?php
  $per_page = 10;
  $count_query = "SELECT COUNT(id) AS total FROM `service`";
  $count_result = mysqli_query($conn, $count_query);
  $count_row = mysqli_fetch_assoc($count_result);
  $total_records = $count_row['total'];
  $total_pages = ceil($total_records / $per_page);
  if (!isset($_GET['page'])) {
    $current_page = 1;
  } else {
    $current_page = $_GET['page'];
  }
  // Tính toán offset để xác định đơn hàng bắt đầu từ đâu trên trang hiện tại
  $offset = ($current_page - 1) * $per_page;
  $order_result = getListService($offset, $per_page);
  // Lấy danh sách đơn hàng cho trang hiện tại
?>
      <h5 class="card-header">Danh sách dịch vụ vận chuyển</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>Tên dịch vụ</th>
                        <th>Giá trị đầu (gam)</th>
                        <th>Giá trị cuối (gam)</th>
                        <th>Thành tiền (vnd)</th>
                      </tr>
                    </thead>
                    <?php
                    $order_result = getListService($offset, $per_page);
                    foreach($order_result as $row){//lặp từng dòng
                    ?>
                    <tbody>
                      <tr>
                        <td><a href="list-service.php?service=<?php echo $row["name"] ?>"><?=$row["name"]?></a></td>
                        <td><?=$row["weight_from"]?></td>
                        <td><?=$row["weight_to"]?></td>
                        <td><?php  $formatPrice = number_format($row['price'], 0, ',', '.');
                         echo $formatPrice; ?></td>
                      </tr>
                      
                    </tbody>
                    <?php
                    $i++;
                    }
                    ?>
                  </table>
                  <?php 
                      // Hiển thị phân trang
                      echo "<nav aria-label='Page navigation example'>";
                      echo "<ul class='pagination justify-content-center'>";
                      $start_page = max(1, $current_page - 5);
                      $end_page = min($total_pages, $current_page + 4);

                      for ($i = $start_page; $i <= $end_page; $i++) {
                        if ($i == $current_page) {
                          echo "<li class='page-item active'><a class='page-link' href='#'>".$i."</a></li>";
                        } else {
                          echo "<li class='page-item'><a class='page-link' href='delivery-service.php?page=".$i."'>".$i."</a></li>";
                        }
                      }
                      echo "</ul>";
                      echo "</nav>";
                      mysqli_close($conn);
                  ?>
                </div>
              </div>
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
    <!-- / Pop up delete modal-->
    <div class="modal" tabindex="-1" id="deleteModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Xóa dịch vụ này?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <a class="btn btn-primary" href="../../Controller/ctrAdmin/delete-service.php?id=<?=$row["id"]?>">Xóa</a>
          </div>
        </div>
      </div>
    </div>

    <?php 
  include "../../Dungchung/js.php";
?>
