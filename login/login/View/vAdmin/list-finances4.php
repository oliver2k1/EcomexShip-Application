<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include "../../Model/connect.php";
?>
<?php
  if(isset($_GET['name_user'])&&$_GET['name_user']!=""){
    $name_user = $_GET['name_user'];
  }else{
    die('Không tồn tại người dùng');
  }
?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
                <h4 class="card-header">Thống kê tài chính:<span class="text-primary"> <?php echo $name_user ?></span></h4>
                <div class="table-responsive text-nowrap">
                    <table class="table" style="color: #000;">
                    <thead>
                        <tr>
                        <th>Thời gian</th>
                        <th>Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Truy vấn dữ liệu theo từng tháng
                        $query = "SELECT MONTH(`time`) AS month, YEAR(`time`) AS year, SUM(`price`) AS total_doanh_thu
                                FROM `vnpay` WHERE `name_user` = '$name_user' 
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
