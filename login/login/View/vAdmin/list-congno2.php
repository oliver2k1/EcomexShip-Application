<?php 
  include "taskbar.php";
  include "navigation.php";
  include "../../Model/connect.php";
?>
<?php 
  $order = new order();
  $count = $order->show_number_order_all($name_user);
  $result = $order->show_congno($name_user);
?>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <h4 class="card-header">Thống kê công nợ</h4>
      <div class="table-responsive text-nowrap">
      <table class="table" style="color: #000;">
        <thead>
            <tr>
                <th>Tên khách hàng</th>
                <th>Tổng đơn hàng</th>
                <th>Tổng công nợ</th>
                <th>Chưa thanh toán</th>
                <th>Đã thanh toán</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['name_user']; ?></td>
                    <td class="text-primary"><?php echo $count; ?></td>
                    <td class="text-primary"><?php echo $row['tong_tien']; ?></td>
                    <td class="text-primary"><?php echo $row['chua_thanh_toan']; ?></td>
                    <td class="text-primary"><?php echo $row['da_thanh_toan']; ?></td>
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