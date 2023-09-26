<?PHP 
  include "taskbar.php";
  include "navigation.php";
?>
<?php
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
  if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['submit'])){
    $update_user = $order->update_profile($_POST);
  }
?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
              <form  method="POST" action="account-setting.php" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="card mb-4">
                  <h5 class="card-header">Thông tin cá nhân</h5>
                  <?php
                    if(isset($update_user)){
                      echo $update_user;
                    }
                  ?>
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <img src="<?php echo $_SESSION["avatar"]; ?>" alt="Ảnh đại diện" style="max-width: 200px; max-height:300px">
                        <div class="button-wrapper">
                          <label for="avatar" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Tải ảnh mới</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              name="avatar" 
                              id="avatar"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <p class="text-muted mb-0">Được phép JPG hoặc PNG.</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Họ và tên</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="name"
                              value="<?php echo $_SESSION["name"]; ?>"
                              readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Tên đăng nhập</label>
                            <input class="form-control" type="text"  value="<?php echo $_SESSION["user"]; ?>" readonly/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="email"
                              id="email"
                              name="email"
                              value="<?php echo $_SESSION["email"]; ?>"
                              placeholder="john.doe@example.com"
                              />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                              <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="123 123 123"
                                value="<?php echo $_SESSION["phone"]; ?>"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" name="submit" class="btn btn-primary me-2">Lưu thay đổi</button> 
                          <a href="index.php" class="btn btn-outline-secondary">Quay lại</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>

