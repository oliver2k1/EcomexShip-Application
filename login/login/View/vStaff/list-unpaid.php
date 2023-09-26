<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include_once "../../Model/connect.php";
?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
             <div class="card">
                <h5 class="card-header">Đơn hàng chưa thanh toán</h5>
                <?php
                  // Số lượng đơn hàng hiển thị trên một trang
                  $per_page = 10;

                  // Tính tổng số đơn hàng
                  $count_query = "SELECT COUNT(id) AS total FROM oder Where `status` = 1 and `payment` <> 1";
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
                  $order_result = $order->show_order_unpaid($offset,$per_page);
                ?>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr class="text-nowrap">
                        <th></th>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Tên người nhận</th>
                        <th>Quốc gia</th>
                        <th>Dịch vụ</th>
                        <th>Thời gian tạo</th>
                        <th>Thời gian nhận</th>
                        <th>Tracking number</th>
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
                        <td><a type="button" target="_blank" href="../../Dungchung/barcode.php?idOrder=<?php echo $result['idOrder'] ?>&quantity=<?php echo $result['quantity'] ?>&service=<?php echo $result['service'] ?>" id="showToastPlacement" class="btn btn-primary d-block"><i class="fas fa-print"></i></a></td>
                          <td><a href="edit-order.php?idOrder=<?php echo $result['idOrder'] ?>"><?php echo $result['idOrder'] ?></a></td>
                          <td><span class="text-dark"><?php echo $result['name_user'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['name_consignee'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['country'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['service'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['time'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['delivery_time'] ?></span></td>
                          <td><span class="text-dark"><?php echo $result['tracking_number'] ?></span></td>
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
                            echo'<td><a target="_blank" href="../../Dungchung/pdf/'.$label['filename'].'" class="btn btn-info" download>Tải xuống</a></td>';
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
                            <a class="dropdown-item" href="detail.php?idOrder=<?php echo $result['idOrder'] ?>"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
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
                      echo "<li class='page-item'><a class='page-link' href='list-unpaid.php?page=".$i."'>".$i."</a></li>";
                    }
                  }
                  echo "</ul>";
                  echo "</nav>";
                  mysqli_close($conn);
                ?>
               </div>
            </div>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>

