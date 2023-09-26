<?php 
require_once '../../Dungchung/dbcon.php';
?>
<div class="layout-page">
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center " id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                <form class="d-flex" action="result.php" method="get">
                    <input type="number" id="search-bar" name="idOrder" required class="form-control me-2" placeholder="Nhập mã đơn hàng ..." autofocus>
                    <button type="submit" class="btn btn-outline-primary"><i class="bx bx-search"></i></button>
                  </form>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <div
                      type="button"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasBackdrop2"
                      aria-controls="offcanvasBackdrop"
                      class="menu-link"
                    >
                    <i id="icon" class="fas fa-comment"><span class="messageIndicator" style="display: none; color: red;">&#8226;</span></i>
                  </div>
                </li>
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <div
                      type="button"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasBackdrop"
                      aria-controls="offcanvasBackdrop"
                      class="menu-link"
                    >
                    <i id="icon" class="bx bx-bell"></i>
                  </div>
                  </li>
                  <!------------------------------------------------------------------------------------------------->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php echo $_SESSION["avatar"]; ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="account-setting.php">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php echo $_SESSION["avatar"]; ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">
                            <?php
                              echo $_SESSION["name"];
                            ?>
                            </span>
                            <small class="text-muted">Nhân viên hỗ trợ</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="account-setting.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Trang cá nhân</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="change-password.php">
                        <i class="bx bx-lock me-2"></i>
                        <span class="align-middle">Đổi mật khẩu</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../../logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Đăng xuất</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
              <!-- Fullscreen Modal -->
              <div class="col-lg-4 col-md-6">
                      <div class="mt-3">
                        <!-- Modal -->
                        <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-fullscreen" role="document">
                            <div class="modal-content" style="background-image: url('../../assets/img/bgr.jpg');background-repeat: no-repeat;background-size: cover;">
                            <div class="">
                                <h2 class="modal-title d-flex justify-content-center align-items-center text-primary " id="modalFullTitle">Hướng dẫn sử dụng phần mềm quản lý đơn hàng của công ty ECOMEX<span style="color:#878F20">SHIP</span></h2>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                            </div>
                              <div class="modal-body">
                              <div class="container">
                                  <div class="row">
                                    <div class="col-md-6 ">
                                      <h4 class="text-primary">I. Tài khoản</h4>
                                      <p>
                                        <span class="text-primary">a. Đăng nhập:</span> Khách hàng sau khi được cấp tài khoản sẽ đăng nhập vào hệ thống qua trang đăng nhập của <span class="text-primary">ECOMEX</span><span style="color:#878F20">SHIP</span> bằng tên đăng nhập (username) và mật khẩu (password) đã được cấp.
                                      </p>
                                      <p>
                                      <span class="text-primary">b. Đổi mật khẩu:</span> Sau khi được cấp tài khoản, khách hàng vui lòng thực hiện thay đổi mật khẩu mặc định mà công ty cấp.
                                      </p>
                                      <p>
                                      <span class="text-primary">c. Quên mật khẩu:</span> Trường hợp khách hàng quên mật khẩu, liên hệ nhân viên hoặc ADMIN để xác minh và cấp lại mật khẩu.
                                      </p>
                                      <h4 class="text-primary">II. <span class="text-primary">Quản lý đơn hàng</span></h4>
                                      <p><span class="text-primary">a. Tạo đơn hàng </span></p>
                                      <p>1. Khách hàng nhấn chọn <span class="text-primary">Tạo đơn hàng </span>để sử dụng chức năng tạo đơn.</p>
                                      <p>2. Phần mềm sẽ hiện form nhập thông tin đơn hàng để thực hiện tạo 1 đơn mỗi lần.</p>
                                      <p>3. Khách hàng nhập thông tin người nhận và thông tin gói hàng của mình .</p>
                                      <p>4. Những trường dữ liệu đánh dấu * sẽ không được để trống khi gửi.</p>
                                      <p>5. Sau khi nhập thông tin, khách hàng bấm nút <span class="text-primary">tạo đơn hàng</span> để lưu lại đơn hàng lên hệ thống.</p>
                                      <p><span class="text-primary">b. Import Excel</span></p>
                                      <p>1. Khách hàng nhấn chọn <span class="text-primary">Import Excel</span> để sử dụng chức năng tạo đơn hàng loạt bằng hình thức điền thông tin vào form <span class="text-primary">Excel</span> mẫu. </p>
                                      <p>2. Khách hàng thực hiện tải form <span class="text-primary">Excel</span> mẫu về và điền thông tin đơn hàng vào trong file.</p>
                                      <p>3. Khách hàng vui lòng điền thông tin vào đúng những cột đã quy định và không điền thừa ở bất kỳ cột nào khác.</p>
                                      <p>4. Những cột có màu <span style="color:#878F20">xanh lá cây</span> sẽ là những trường bắt buộc điền thông tin.<p>
                                      <p>5. Những cột có màu <span class="text-primary">xanh da trời</span> khách hàng có thể bỏ trống. </p>
                                      <p>6. Nếu gặp lỗi ở bất kỳ đơn hàng nào trong file, dữ liệu sẽ không được gửi đi. Khách hàng vui lòng kiểm tra lại thông tin đã đúng định dạng, thừa hay thiếu cột nào và upload lại tệp.</p>
                                      <p><span class="text-primary">c. Đơn hàng đã tạo </span></p>
                                      <p>1. Khách hàng nhấn chọn <span class="text-primary">Đơn hàng đã tạo </span>để sử dụng chức năng gửi đơn hàng.</p>
                                      <p>2. Phần mềm sẽ hiện danh sách các đơn hàng đã tạo.</p>
                                      <p>3. Khách hàng kiểm tra và chỉnh sửa thông tin đơn hàng chính xác trước khi gửi.</p>
                                      <p>4. Nếu tạo thừa đơn hàng khách hàng vui lòng xóa ở bước này.</p>
                                      <p>5. Khách hàng nhấn nút <span style="color:#878F20">gửi đơn hàng</span> để gửi đơn lên hệ thống.</p>
                                      <p><span class="text-primary">d. Danh sách đơn hàng </span></p>
                                      <p>1. <span class="text-primary">Tất cả: </span>Hiển thị tất cả đơn hàng đã tạo.</p>
                                      <p>2. <span class="text-warning">Chờ xử lý: </span>Hiển thị danh sách đơn hàng chưa được xử lý.</p>
                                      <p>3. <span class="text-info">Tạo label: </span>Hiển thị danh sách đơn hàng đã tạo label.</p>
                                      <p>4. <span class="text-info">Đang vận chuyển: </span>Hiển thị danh sách đơn hàng đang vận chuyển.</p>
                                      <p>5. <span class="text-info">Đã nhập kho: </span>Hiển thị danh sách đơn hàng đã nhập kho.</p>
                                      <p>6. <span class="text-info">Đã xuất kho: </span>Hiển thị danh sách đơn hàng đã xuất kho.</p>
                                      <p>7. <span class="text-info">Đang giao phát: </span>Hiển thị danh sách đơn hàng đang giao phát.</p>
                                      <p>8. <span class="text-success">Đã hoàn thành: </span>Hiển thị danh sách đơn hàng đã hoàn thành.</p>
                                      <p>9. <span class="text-warning">Chưa thanh toán: </span>Hiển thị danh sách đơn hàng chưa thanh toán.</p>
                                      <p>10. <span class="text-success">Đã thanh toán: </span>Hiển thị danh sách đơn hàng đã thanh toán.</p>
                                      <p>11. <span class="text-success">Đơn rủi ro: </span>Hiển thị danh sách đơn hàng rủi ro, hoàn hàng.</p>
                                      <p>12. <span class="text-secondary">Đơn đã hủy: </span>Hiển thị danh sách đơn hàng đã hủy.</p>
                                    </div>
                                    <div class="col-md-6 d-flex flex-column align-items-center">
                                      <img src="../../assets/img/hd1.jpg" alt="login" height="220" width="450">
                                      <p class="mt-2"><em>Hình 1.1 Giao diện đăng nhập</em></p>
                                      <img src="../../assets/img/hd5.jpg" alt="login" height="220" width="450">
                                      <p class="mt-2"><em>Hình 1.2 Giao diện thông tin cá nhân</em></p>
                                      <img src="../../assets/img/hd2.jpg" alt="login" height="220" width="450">
                                      <p class="mt-2"><em>Hình 2.1 Giao diện tạo đơn hàng</em></p>
                                      <img src="../../assets/img/hd3.jpg" alt="login" height="220" width="450">
                                      <p class="mt-2"><em>Hình 2.2 Giao diện import excel</em></p>
                                      <img src="../../assets/img/hd4.jpg" alt="login" height="220" width="450">
                                      <p class="mt-2"><em>Hình 2.3 Giao diện đơn hàng đã tạo</em></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 <!-- Toggle Between Modals -->
                 <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasBackdropLabel" class="offcanvas-title text-primary">Đơn hàng mới</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                    <table class="table" style="color: #000;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Thời gian</th>
                        </tr>
                      </thead>
                      <tbody id="orderTableBody">
                        <!-- Các dòng đơn hàng sẽ được thêm vào đây -->
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Name</label>
                            <input type="text" value="Đinh Thị Thanh Hà" class="form-control"  readonly/>
                          </div>
                        </div>
                        <div class="row g-2">
                          <div class="col mb-0">
                            <label for="dobBasic" class="form-label">SĐT</label>
                            <input type="text" id="dobBasic" class="form-control" value="0908518661" readonly/>
                          </div>
                          <div class="col mb-0">
                            <label for="emailBasic" class="form-label">Email</label>
                            <input type="text" id="emailBasic" class="form-control" value="ecomexship@gmail.com" readonly/>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 <!-- ////////////////////////////////////////////////////////////////////////////////////// -->
                 <div class="container">
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop2" aria-labelledby="offcanvasBackdropLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title text-primary" id="offcanvasBackdropLabel">Hộp thư đến</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="chat-container">
                                <div class="chat-box">
                                    <div id="chat-messages">
                                      <span id="current-user" data-username="<?php echo $_SESSION['name'] ?>"></span>
                                    </div>
                                    <form id="message-form">
                                        <div class="input-group">
                                            <input type="text" id="input-message" class="form-control" placeholder="Nhập tin nhắn">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Gửi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="user-list">
                                    <ul class="list-group" id="user-list">
                                      <?php 
                                      $currentUsername = $_SESSION['name'];
                                      $sql ="SELECT u.name
                                      FROM user AS u
                                      LEFT JOIN (
                                          SELECT sender, MAX(created_at) AS created_at
                                          FROM messages
                                          WHERE recipient = '$currentUsername'
                                          GROUP BY sender
                                      ) AS m ON u.name = m.sender
                                      WHERE u.name != '$currentUsername' AND u.quyen != 3
                                      ORDER BY created_at DESC";
                                      $result = $con->query($sql);
                                      if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                          $name = $row["name"];
                                      ?>
                                      <li class="list-group-item " onclick="activateUser(event)" data-receiver="<?php echo $row["name"] ?>"><?php echo $row["name"] ?></li>
                                      <?php
                                        }
                                      }
                                      ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>