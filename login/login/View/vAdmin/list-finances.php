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
                <h4 class="card-header">Thống kê tài chính</h4>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr>
                        <th>Thời gian</th>
                        <th>Doanh thu</th>
                        <th>Chi phí</th>
                        <th>Lợi nhuận</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT * FROM report order by `time` DESC ";
                      $result = $conn->query($query);
                      while($row = $result->fetch_assoc()){
                      ?>
                      <tr>
                        <td  class="text-primary"><?php echo $row['time'] ?></td>
                        <td  ><?php echo number_format($row['doanh_thu']) ?> VNĐ</td>
                        <td  ><?php echo number_format($row['chi_phi']) ?> VNĐ</td>
                        <td  ><?php echo number_format($row['loi_nhuan']) ?> VNĐ</td>
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
