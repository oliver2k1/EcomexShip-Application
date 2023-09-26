<?PHP 
  include "taskbar.php";
  include "navigation.php";
?>
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white;"><span>Chức năng khác /</span> Tạo invoice</h4>
            <form action="export.php" target="_blank" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Nhập thông tin </h5>
                    <div class="card-body">
                        <div>
                          <label for="defaultFormControlInput" class="form-label">Ngày tạo invoice</label>
                          <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder=""
                            value="<?PHP echo date('M d, Y'); ?>"
                            name="time"
                          />
                        </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Company Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="defaultFormControlInput"
                          aria-describedby="defaultFormControlHelp"
                          name="CompanyName"
                        />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Address</label>
                        <input
                          type="text"
                          class="form-control"
                          id="defaultFormControlInput"
                          aria-describedby="defaultFormControlHelp"
                          name="address"
                        />
                      </div>
                        <div>
                          <label for="defaultFormControlInput" class="form-label">Postal code</label>
                          <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="VD: 13439"
                            name="zipcode"
                          />
                        </div>
                        <div>
                          <label for="defaultFormControlInput" class="form-label">State/ Country</label>
                          <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="VD: USA"
                            name="country"
                          />
                        </div>
                        <div>
                          <label for="defaultFormControlInput" class="form-label">Contact Name </label>
                          <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="VD: Xuan Vu"
                            name="contactName"
                          />
                        </div>
                        <div id="defaultFormControlHelp" class="form-text">
                            Tên tiếng việt không được ghi dấu
                        </div>
                        <div>
                          <label for="defaultFormControlInput" class="form-label">Phone/Fax No. </label>
                          <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="VD: 520 572 4652"
                            name="phone"
                          />
                        </div>
                        <div>
                        <label for="defaultFormControlInput" class="form-label">No. of pkgs</label>
                        <input
                          type="number"
                          class="form-control"
                          id="defaultFormControlInput"
                          name="pkgs"
                        />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Weight</label>
                        <input
                          type="text"
                          class="form-control"
                          id="defaultFormControlInput"
                          name="weight"
                        />
                        </div>
                        <div id="defaultFormControlHelp" class="form-text">
                            Nếu nội dung trong ô bị thiếu vui lòng bấm đúp chuột vào ô đó, nội dung sẽ hiện đầy đủ
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="row">
              <div class="col text-center"> 
                  <button type="submit" class="btn btn-primary" >Tạo invoice</button>
                  <a type="reset" class="btn btn-outline-secondary" href="index.php">Hủy bỏ</a>
              </div>
            </div>
          </form>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <script src="../assets/js/form-basic-inputs.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='./districts.min.js'></script>
  </body>
</html>
