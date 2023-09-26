<?php
include "taskbar.php";
include "navigation.php";
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 mx-auto">
            <div class="card mb-3">
                <div class="card-header text-center">
                    <strong>EXPORT DATA</strong>
                </div>
                <div class="card-body">
                    <form action="../../Dungchung/export-data-customer.php" method="post" target="_blank">
                        <div class="form-group">
                            <label for="start_date">Từ ngày:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                            <input type="hidden" class="form-control"  name="name_user" value="<?php echo $_SESSION['name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Đến ngày:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include "../../Dungchung/js.php";
?>