<?PHP 
  include "taskbar.php";
  include "navigation.php";
  include_once "../../Dungchung/dbcon.php";
?>
         <div class="content-wrapper" >

            <div class="container-xxl flex-grow-1 container-p-y"  >
              <div class="row" >
                <div class=" mb-4 order-0">
                <!-- <div class="col-lg-8 mb-4 order-0"> -->
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Chào mừng quay trở lại <?php echo $_SESSION["name"] ?> 🎉</h5>
                          <p class="mb-4">
                            Bạn đang có <span class="text-primary"><?php
                            $id_user = $_SESSION["name"];
                            $order = new order(); 
                            $count = $order->show_number_order_new_customer($id_user);
                            echo $count
                             ?></span> đơn hàng chưa xử lý.
                          </p>

                          <a href="./list-new.php" class="btn btn-sm btn-outline-primary">Xem thống kê</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../../assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>

                          </div>
                          <span class="fw-semibold d-block mb-1">Doanh thu ngày</span>
                          <h3 class="card-title mb-2">$12,628</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../../assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span>Chi phí ngày</span>
                          <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                
                <!-- <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Tổng doanh thu</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="growthReportId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                2022
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                <a class="dropdown-item" href="javascript:void(0);">2019</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">Tăng trưởng 62%</div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2022</small>
                              <h6 class="mb-0">$32.5k</h6>
                            </div>
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2021</small>
                              <h6 class="mb-0">$41.2k</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="d-block mb-1">Lợi nhuận ngày
                          </span>
                          <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Lợi nhuận tháng</span>
                          <h3 class="card-title mb-2">$14,857</h3>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>  -->
          
            <!-- Content wrapper -->
        </div>
        <div class="card" style="padding:10px">
        <h3 class="card-title text-primary text-center">Bảng tin <i class="fas fa-volume-up"></i></h3>
            <?php
            $query = "SELECT * FROM `thongbao` WHERE `quyen` = 2 order by `time` DESC";
            $result = mysqli_query($con, $query);
            // Lặp qua kết quả truy vấn và hiển thị dữ liệu
            while ($row = mysqli_fetch_assoc($result)) {
                $tieude = $row['tieude'];
                $time = $row['time'];
                $noidung = $row['noidung'];
                $img = $row['image'];
            ?>
        <div class="row">
            <div class=" mb-3 order-0 " >
                <div class="card border">
                    <div class="card-body" >
                        <h5 class="card-title "><?php echo $tieude; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Thời gian: <?php echo $time; ?></h6>
                        <div class="d-flex justify-content-center">
                          <img class="card-text collapsed img-fluid" src="<?php echo $img ?>" alt="Tệp đính kèm" style="width: 70%">
                        </div>
                        <p class="card-text collapsed text-sm"><?php echo $noidung; ?></p>
                        <a href="#" class=" read-more">Đọc thêm</a>
                    </div>
                </div>
            </div>
        </div>
            <?php
            }
            // Đóng kết nối
            mysqli_close($conn);
            ?>
    </div>
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- build:js assets/vendor/js/core.js -->
    <?php 
  include "../../Dungchung/js.php";
?>