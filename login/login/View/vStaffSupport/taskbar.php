<?php
session_start(); 
ini_set('display_errors','Off'); 
if($_SESSION["quyen"]!=5)
{
  header("Location: ../../Dungchung/error.php");
  exit();
}
include_once ("../../Model/order.php");
require_once("../../Model/tblService.php");
?>
<?php 
$order = new Order();
echo $order->show_status_order();
?>
<?php 
$order = new Order();
echo $order->show_status_finances();
?>
<?php 
  $order = new Order();
  $load_status = $order->load_status();
  echo $load_status;
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Ecomex </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo2.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/css/navi.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <img src="../../assets/img/logo.jpg" alt="" style="width: 200px">
              <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Trang chủ</div>
              </a>
            </li>
            <!-- Layouts -->
            <li class="menu-header small text-uppercase" style="color: #000;">
              <span class="menu-header-text">Quản lý tài khoản</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Tài khoản</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="account-setting.php" class="menu-link">
                    <div data-i18n="Account ">Cá nhân</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="./account-staff.php" class="menu-link">
                    <div data-i18n="Notifications">Nhân viên</div>
                  </a>
                </li>
                <!--<li class="menu-item">-->
                <!--  <a href="./account-customer.php" class="menu-link">-->
                <!--    <div data-i18n="Connections">Khách hàng</div>-->
                <!--  </a>-->
                <!--</li>-->
                <!-- <li class="menu-item">
                  <a href="register.php" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Thêm khách hàng</div>
                  </a>
                </li> -->
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Account Settings">Bảo mật</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="change-password.php" class="menu-link">
                    <div data-i18n="Account ">Đổi mật khẩu</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Components -->
            <li class="menu-header small text-uppercase" style="color: #000;"><span class="menu-header-text">Quản lý đơn hàng</span></li>
            <!-- Cards -->
            <!-- <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic Inputs">Tạo đơn hàng <span class="flex-shrink-0 badge badge-center rounded-pill">
                   </span></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="./create-order.php" class="menu-link">
                    <div data-i18n="Input groups">Tạo đơn hàng</div>
                  </a>
                </li>
              </ul>
            </li> -->
            <!-- User interface -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Danh sách đơn hàng</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="list-all-customer.php" class="menu-link">
                    <div data-i18n="Alerts">Tất cả <span class="lex-shrink-0 badge bg-primary">
                  <?php 
                  $order = new order();
                  $count = $order->show_number_order_epacket_label();
                  echo $count;
                  ?>
                   </span></div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Extended components -->


            <!-- Forms & Tables -->
            <!-- <li class="menu-header small text-uppercase" style="color: #000;"><span class="menu-header-text">Quản lý tài chính</span></li> -->
            <!-- Forms -->
            <!-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Thanh toán</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="./history-payment.php" class="menu-link">
                    <div data-i18n="Basic Inputs">Lịch sử thanh toán</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Thống kê</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="list-productivity.php" class="menu-link">
                    <div data-i18n="Text Divider">Năng suất</div>
                  </a>
                </li>
              </ul>
            </li> -->
            <!-- Tables -->
            <li class="menu-header small text-uppercase" style="color: #000;"><span class="menu-header-text">Chức năng khác</span></li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">Invoice & Label</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="invoice.php" class="menu-link">
                    <div data-i18n="Vertical Form">Tạo invoice</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="broke-label.php" class="menu-link">
                    <div data-i18n="Vertical Form">Tách file label</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="label.php" class="menu-link">
                    <div data-i18n="Vertical Form">Upload label tự động</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="label2.php" class="menu-link">
                    <div data-i18n="Vertical Form">Upload label thủ công</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="list-label.php" class="menu-link">
                    <div data-i18n="Vertical Form">Danh sách label</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">Tra cứu hành trình</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="https://www.ups.com/track?loc=vi_VN&requester=ST/" class="menu-link" target="_blank">
                    <div data-i18n="Vertical Form">UPS</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="https://www.usps.com/shipping/trackandconfirm.htm" class="menu-link" target="_blank">
                    <div data-i18n="Vertical Form">USPS</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="https://www.dhl.com/vn-en/home/tracking.html" class="menu-link" target="_blank">
                    <div data-i18n="Horizontal Form">DHL</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="https://www.fedex.com/vi-vn/tracking.html" class="menu-link" target="_blank">
                    <div data-i18n="Vertical Form">FEDEX</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="https://www.royalmail.com" class="menu-link" target="_blank">
                    <div data-i18n="Horizontal Form">ROYALMAIL</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="https://www.singpost.com/track-items" class="menu-link" target="_blank">
                    <div data-i18n="Horizontal Form">SINGPOST</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="https://auspost.com.au/mypost/track/#/search" class="menu-link" target="_blank">
                    <div data-i18n="Vertical Form">AUSPOST</div>
                  </a>
                </li> 
                <li class="menu-item">
                  <a href="https://www.canadapost-postescanada.ca/track-reperage/en" class="menu-link" target="_blank">
                    <div data-i18n="Vertical Form">CANADAPOST</div>
                  </a>
                </li> 
              </ul>
            </li>
            <!-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">Dịch vụ vận chuyển</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="delivery-service.php" class="menu-link">
                    <div data-i18n="Horizontal Form">Bảng giá dịch vụ</div>
                  </a>
                </li>
              </ul>
            </li> -->
            <!-- Misc -->
            <li class="menu-header small text-uppercase" style="color: #000;"><span class="menu-header-text">Hỗ trợ</span></li>
            <li class="menu-item">
            <div
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#basicModal"
                aria-controls="offcanvasBackdrop"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Hotline</div>
              </div>
            </li>
            <li class="menu-item">
              <div
                class="menu-link"
                type="button"
                 data-bs-toggle="modal" 
                 data-bs-target="#fullscreenModal"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation" type="button" data-bs-toggle="modal" data-bs-target="#fullscreenModal">Hướng dẫn </div>
              </div>
            </li>
          </ul>
        </aside>


       