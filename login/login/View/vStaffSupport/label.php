<?php
include "taskbar.php";
include "navigation.php";
?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 mx-auto">
                <div class="card mb-3">
                    <div class="card-header text-center">
                        <strong>UPLOAD LABEL</strong>
                    </div>
                    <div class="card-body">
                        <form action="../../Dungchung/upload-label.php" method="post" enctype="multipart/form-data" target="_blank">
                            <div class="form-input py-2">
                                <div class="form-group">
                                    <input type="file" name="pdf_file" class="form-control" accept=".pdf" required/>
                                </div>
                                <div class="form-group">
                                    <br>
                                    <input type="submit" class="btn btn-primary" name="submit" value="Tải lên">
                                </div>
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

