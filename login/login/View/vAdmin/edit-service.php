<?php
  include "taskbar.php";
  include "navigation.php";
?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <?php
            if(isset($_REQUEST["id"])==false)
              die("<p>chưa có id dịch vụ</p>");
            $id = $_REQUEST["id"];//lấy id dịch vụ
            if($id=="" || is_numeric($id)==false)
              die("<p>id không được rỗng và phải là số</p>");
            $row = getService($id);//lấy thông tin dịch vụ theo id   
            ?>   
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header">Sửa thông tin dịch vụ</h5>
              <div class="card-body">
                <form action="../../Controller/ctrAdmin/update-service.php">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="firstName" class="form-label">Tên dịch vụ</label>
                        <input class="form-control"  required type="text" name="tName" id="nameUpdate" value="<?=$row["name"]?>">
                        <input class="form-control"  required type="hidden" name="idUpdate" id="nameUpdate" value="<?=$row["id"]?>" >
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="mb-3">
                        <label for="input2" class="form-label">Giá trị đầu (gam)</label>
                        <input class="form-control"  required type="number" name="tStart" value="<?=$row["weight_from"]?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="mb-3">
                        <label for="input3" class="form-label">Giá trị cuối (gam)</label>
                        <input class="form-control"  required type="number" value="<?=$row["weight_to"]?>" name="tEnd">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="mb-3">
                        <label for="input3" class="form-label">Thành tiền</label>
                        <input class="form-control"  required type="number" value="<?=$row["price"]?>" name="tPrice">
                      </div>
                    </div>
                  <div class="mt-2 text-center">
                    <input type="submit" class="btn btn-primary me-2" name="b2" id="b2" value="Lưu thay đổi">
                    <button type="reset" onclick="goBack()" class="btn btn-outline-secondary">Hủy bỏ</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
</div>
      
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
<?php 
  include "../../Dungchung/js.php";
?>
