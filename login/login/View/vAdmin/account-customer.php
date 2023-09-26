<?PHP 
  include "taskbar.php";
  include "navigation.php";
  $conn = new mysqli("localhost","eco33771_ecomex","Ecomex@123","eco33771_ecomex");
	// Check connection
	if ($conn->connect_errno) {
	  echo "Kết nối MYSQLi lỗi";
	  exit();
	}
  $sql_lietke_taikhoanKH = "SELECT * FROM user WHERE quyen= 3";
	$query_lietke_taikhoanKH = mysqli_query($conn,$sql_lietke_taikhoanKH);
?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="card">
                <h5 class="card-header">Danh sách khách hàng</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;">
                    <thead>
                      <tr>
                        <th><strong></strong></th>
                        <th><strong>Tên khách hàng</strong></th>
                        <th><strong>Tên đăng nhập</strong></th>
                        <th><strong>Ảnh đại diện</strong></th>
                        <th><strong>Số điện thoại</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>Người tạo</strong></th>
                        <th></th>
                      </tr>
                      <?php
                    $i = 0;
                    while($row = mysqli_fetch_array($query_lietke_taikhoanKH)){
                      $i++;
                    ?>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><a href="list-customer.php?name_user=<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><img src="<?php echo $row['avatar'] ?>" alt="" style="width: 100px"></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['name_creater'] ?></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="xulya.php?id_cnmk=<?php echo $row['id'] ?>"
                              onclick="return confirm('Đặt lại mật khẩu của <?php echo $row['name'] ?> ?')">Đặt lại mật khẩu</a>
                                <a class="dropdown-item" href="xulya.php?id_kh=<?php echo $row['id'] ?>"
                                  onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản <?php echo $row['name'] ?> ?')">Xóa tài khoản</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php
                      } 
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php 
  include "../../Dungchung/js.php";
?>
