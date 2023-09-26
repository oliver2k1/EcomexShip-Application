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
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
          if ($_SERVER["REQUEST_METHOD"] =='POST' && isset($_POST['submit'])){
            $thongbao = $order->insert_thongbao($_POST);
          }
        ?>
        <?php
          if(isset($thongbao)){
            echo $thongbao;
          }
        ?>
              <?php
          if(isset($_GET['id']) && $_GET['id']!=""){
          $id = $_GET['id'];
          $xoathongbao = $order->delete_thongbao($id);
        }
      ?>
      <?php
        if(isset($xoathongbao)){
          echo $xoathongbao;
        }
      ?>
      <?php
      $per_page = 10;
      $count_query = "SELECT COUNT(id) AS total FROM `thongbao`";
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
      $order_result = $order->getListThongBao($offset, $per_page);
      // Lấy danh sách đơn hàng cho trang hiện tại
    ?>
    <div style="display:flex">
      <h5 class="card-header">Danh sách thông báo</h5>
      <button id="add-service" style="margin: 10px 0" type="button" class="btn btn-outline-primary" data-bs-target="#collapseExample" data-bs-toggle="collapse">Thêm thông báo</button>
        </div>
        <div class="collapse" id="collapseExample"> 
          <form  action="notification.php" method="post" enctype="multipart/form-data">
              <table class="table">
                <thead>
                  <tr class="text-nowrap">
                    <th>Thời gian</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Hiển thị</th>
                    <th>Hình ảnh</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                <td>
                  <input type="text" class="form-control" value="<?php 
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    echo date('Y:m:d H:i:s');
                  ?>" name="time" readonly>
                </td>
                <td>
                  <input type="text" min="0" class="form-control" name="tieude" required>
                </td>
                <td>
                  <input type="text" min="0" class="form-control" name="noidung" required>
                </td>
                <td>
                  <select class="form-select" name="quyen">
                    <option value="1" selected>Nhân viên</option>
                    <option value="2">Khách hàng</option>
                  </select>
                </td>
                <td>
                    <input type="file" name="image_noti" class="account-file-input" accept="image/png, image/jpeg" required/>
                </td>
              </tr>
                </tbody>
              </table> 
            <div class="row">
              <div class="col text-center"> 
                <br>
                  <input type="submit" class="btn btn-primary " name="submit" value="Lưu"></input>
              </div>
            </div> 
         </form>
        </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>Thời gian</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Hình ảnh</th>
                        <th>Hiển thị</th>
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
                        <td class="text-primary"><?php echo $result['time'];?></td>
                        <td><?php echo $result['tieude']?></td>
                        <td><?php echo substr($result['noidung'], 0, 100);?></td>
                        <td><img src="<?php echo $result['image'] ?>" alt="" style="height: 100px"></td>
                        <td><?php if($result['quyen']==1){
                            echo 'Nhân viên';
                        }else{
                            echo 'Khách hàng';
                        }?></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="return confirm('Bạn có chắc chắn muốn xóa thông báo này?')" href="notification.php?id=<?=$result["id"]?>"
                              ><i class="bx bx-trash me-1"></i>Xóa</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php 
                          }
                        } else {
                          echo "<tr><td colspan='9'>Không có chi phí</td></tr>";
                        }
                      ?>
                    </tbody>
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
                          echo "<li class='page-item'><a class='page-link' href='notification.php?page=".$i."'>".$i."</a></li>";
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

    <?php 
  include "../../Dungchung/js.php";
?>
