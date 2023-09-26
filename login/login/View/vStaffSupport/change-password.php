<?php 
  include "taskbar.php";
  include "navigation.php";
?>
    <div class="container">
      <div class="col-md-5 mx-auto">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title text-primary">Đổi mật khẩu</h3>
              </div>
              <?php
              // Kiểm tra xem người dùng đã nhấn nút "Đổi mật khẩu" chưa
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Kết nối đến cơ sở dữ liệu
                  $servername = "localhost";
                  $username = "eco33771_ecomex";
                  $password = "Ecomex@123";
                  $dbname = "eco33771_ecomex";
  
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  if ($conn->connect_error) {
                      die("Kết nối không thành công: " . $conn->connect_error);
                  }
  
                  // Lấy dữ liệu từ form
                  $currentPassword = md5($_POST["currentPassword"]);
                  $newPassword = md5($_POST["newPassword"]);
                  $confirmPassword = md5($_POST["confirmPassword"]);
                  $name_user = $_SESSION['user'];
                  // Kiểm tra mật khẩu hiện tại
                  // Tùy chỉnh logic kiểm tra mật khẩu hiện tại ở đây
                  $sql = "SELECT `password` FROM user WHERE `username` = '$name_user'"; // Giả sử bảng "users" có cột "password" và người dùng đang đăng nhập có ID là 1
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $storedPassword = $row["password"];
                      // Kiểm tra mật khẩu hiện tại
                      if ($currentPassword != $storedPassword) {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Mật khẩu hiện tại không đúng, vui lòng thử lại!.
                          <span id="countdown" class="float-end"></span>
                          </div> ';
                      }elseif ($newPassword != $confirmPassword) {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Mật khẩu mới không khớp
                          <span id="countdown" class="float-end"></span>
                          </div> ';
                      }elseif($currentPassword == $storedPassword && $newPassword == $confirmPassword){
                          $sql = "UPDATE user SET password = '$newPassword' WHERE `username` ='$name_user' "; // Giả sử người dùng đang đăng nhập có ID là 1
                          if ($conn->query($sql) === TRUE) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              Đổi mật khẩu thành công
                              <span id="countdown" class="float-end"></span>
                              </div> ';
                          } else {
                              echo "Lỗi khi đổi mật khẩu: " . $conn->error;
                          }
                      }
                  } else {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Lỗi! Không tìm thấy người dùng.
                      <span id="countdown" class="float-end"></span>
                      </div> ';
                  }
                  $conn->close();
              }
              ?>
              <div class="card-body">
                  <form method="POST" action="change-password.php">
                      <div class="form-group">
                          <label for="currentPassword">Mật khẩu hiện tại:</label>
                          <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                      </div>
                      <div class="form-group">
                          <label for="newPassword">Mật khẩu mới:</label>
                          <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                      </div>
                      <div class="form-group">
                          <label for="confirmPassword">Xác nhận mật khẩu mới:</label>
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                      </div>
                      <br>
                      <div class="text-center">
                          <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>
