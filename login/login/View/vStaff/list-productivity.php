<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include "../../Model/connect.php";
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

 <!-- Borderless Table -->
 <div class="card">
                <h4 class="card-header">Thống kê năng suất</h4>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr>
                        <th>Thời gian</th>
                        <th>Tất cả</th>
                        <th>Chưa xử lý</th>
                        <th>Tạo label</th>
                        <th>Vận chuyển</th>
                        <th>Giao phát</th>
                        <th>Hoàn thành</th>
                        <th>Chú ý</th>
                        <th>Đã hủy</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM daily_order order by `time` DESC ";
                      $result = $conn->query($query);
                      while($row = $result->fetch_assoc()){
                      ?>
                      <tr>
                        <td><?php echo $row['time'] ?></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-primary"><?php echo $row["all_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-warning"><?php echo $row["new_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-info"><?php echo $row["label_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-info"><?php echo $row["transporting_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-info"><?php echo $row["ship_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-success"><?php echo $row["done_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-danger"><?php echo $row["return_order"] ?></span></td>
                        <td><span class="flex-shrink-0 badge badge-center rounded-pill bg-secondary"><?php echo $row["cancel_order"] ?></span></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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

