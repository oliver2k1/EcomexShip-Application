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
                <h4 class="card-header">Thống kê tài chính (tháng)</h4>
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
                        // Truy vấn dữ liệu theo từng tháng
                        $query = "SELECT MONTH(`time`) AS month, YEAR(`time`) AS year, SUM(`doanh_thu`) AS total_doanh_thu, SUM(`chi_phi`) AS total_chi_phi, SUM(`loi_nhuan`) AS total_loi_nhuan 
                                FROM report 
                                GROUP BY YEAR(`time`), MONTH(`time`)
                                ORDER BY YEAR(`time`) DESC, MONTH(`time`) DESC";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                        $thang = $row['month'];
                        $nam = $row['year'];
                        $doanhthu = $row['total_doanh_thu'];
                        $chiphi = $row['total_chi_phi'];
                        $loinhuan = $row['total_loi_nhuan'];
                        ?>
                        <tr>
                            <td class="text-primary"><?php echo $thang . '/' . $nam; ?></td>
                            <td class="text-primary"><?php echo number_format($doanhthu) ?> VNĐ</td>
                            <td class="text-primary"><?php echo number_format($chiphi) ?> VNĐ</td>
                            <td class="text-primary"><?php echo number_format($loinhuan) ?> VNĐ</td>
                        </tr>
                        <?php
                        }
                        ?>
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
