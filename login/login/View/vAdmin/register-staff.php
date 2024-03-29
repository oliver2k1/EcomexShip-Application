<?php 
  session_start(); 
  ini_set('display_errors','Off');

  if($_SESSION["quyen"]!=1)
  die("không được vào dây");
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
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

    <title>Tạo tài khoản nội bộ</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/logo2.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <!-- <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

          <div class="card">
            <div class="card-body">

              <div class="app-brand justify-content-center">
                <a href="index.php" class="app-brand-link gap-2">
                <img src="../assets/img/logo.jpg" alt="" style="width: 200px">
                </a>
              </div>

              <h4 class="mb-2">Tài khoản nội bộ</h4>
              <p class="mb-4">Dành cho nhân viên công ty ECOMEX</p>

              <form id="formAuthentication" class="mb-3" action="index.php" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Tên đăng nhập</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Nhập tên đăng nhập"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Số điện thoại</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Mật khẩu</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Tên nhân viên</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="text"
                      id="name"
                      class="form-control"
                      name="name"
                      placeholder="VD: Issac, ..."
                    />
                  </div>
                </div>
                <div class="mb-3">
                </div>
                <button class="btn btn-primary d-grid w-100">Tạo tài khoản</button>
              </form>
            </div>
          </div>
 
        </div>
      </div>
    </div> -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.php" class="app-brand-link gap-2">
                <img src="../../assets/img/logo.jpg" alt="" style="width: 200px">
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Tài khoản nội bộ</h4>
              <p class="mb-4">Dành cho nhân viên công ty ECOMEX</p>

              <form id="formAuthentication" class="mb-3" action="xuly.php" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Tên đăng nhập</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Nhập tên đăng nhập"
                    autofocus
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" required/>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Số điện thoại</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required/>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Mật khẩu</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Tên nhân viên</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="text"
                      id="name"
                      class="form-control"
                      name="name"
                      placeholder="VD: Issac, ..."
                      required
                    />
                  </div>
                    <input
                      type="hidden"
                      id="quyen"
                      class="form-control"
                      name="quyen"
                      value="2"
                      readonly
                    />
                </div>
                <div class="mb-3">
                </div>
                <button class="btn btn-primary d-grid w-100" name="themtaikhoannv">Tạo tài khoản</button>
              </form>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>
