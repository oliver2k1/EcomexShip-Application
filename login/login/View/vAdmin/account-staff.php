<?PHP 
  include "taskbar.php";
  include "navigation.php";
  $conn = new mysqli("localhost","eco33771_ecomex","Ecomex@123","eco33771_ecomex");
	// Check connection
	if ($conn->connect_errno) {
	  echo "Kết nối MYSQLi lỗi";
	  exit();
	}
  // $sql_lietke_taikhoanNV = "SELECT * FROM user ORDER BY thutu DESC";
  $sql_lietke_taikhoanNV = "SELECT * FROM user WHERE `quyen` = 2 OR `quyen` = 4 OR `quyen` = 5";
	$query_lietke_taikhoanNV = mysqli_query($conn,$sql_lietke_taikhoanNV);
?>
  <div class="content-wrapper">
           <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Danh sách nhân viên</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" style="color: #000;" >
                    <thead>
                      <tr>
                        <th></th>
                        <th>Tên nhân viên</th>
                        <th>Tên tài khoản</th>
                        <th>Chức vụ</th>
                        <th>Ảnh đại diện</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th></th>
                      </tr>
                      <?php
                    $i = 0;
                    while($row = mysqli_fetch_array($query_lietke_taikhoanNV)){
                      $i++;
                    ?>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $i ?></td>
                        <td><a href="list-staff.php?name_user=<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php if($row['quyen']==2){
                          echo "Nhân viên ưu tú";
                        }elseif($row['quyen']==4){
                          echo "Nhân viên kho";
                        }else{
                        echo "Nhân viên hỗ trợ";
                        } ?></td>
                        <td><img src="<?php echo $row['avatar'] ?>" alt="" style="width: 100px"></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['email'] ?></td>
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