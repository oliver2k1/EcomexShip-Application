<?php include '../../Dungchung/dbcon.php';
      include "taskbar.php";
      include "navigation.php";
?>
<div class="content-wrapper" >
  <div class="container-xxl flex-grow-1 container-p-y"  >
         <div class="row">
			<div class="card mb-3 ">
				<div class="card-header text-center">
				<h4>DANH SÁCH LABEL HIỆN CÓ</h4>
				<?php 
				if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && isset($_GET['filename'])) {
					$id = $_GET['id'];
					$filename = $_GET['filename'];
					$delete_label = $order->delete_label($id, $filename);
					echo $delete_label; 
				}					
				?>
				</div>
				<div class="card-body w-100 text-justify text-nowrap ">
				<div class="w-100">
					<table class="table table-bordered text-center mx-auto table-responsive">
						<thead >
							<th>Mã đơn hàng</th>
							<th>FileName</th>
							<th>Thời gian</th>
							<th>Người tạo</th>
							<th>Tải xuống</th>
							<th>Xóa</th>
						</thead>
						<tbody >
						<?php
							$selectQuery = "select * from pdf_data order by `time` desc";
							$squery = mysqli_query($con, $selectQuery);

							while (($result = mysqli_fetch_assoc($squery))) {
							echo "<tr>";
							echo "<td>" . $result['idOrder'] . "</td>";
							echo "<td>" . $result['filename'] . "</td>";
							echo "<td>" . $result['time'] . "</td>";
							echo "<td>" . $result['name_user'] . "</td>";
							echo '<td><a href="../../Dungchung/pdf/' . $result['filename'] . '" class="btn btn-info" download>Tải xuống</a></td>';
							echo '<td><a onclick="return confirm(\'Bạn có muốn xóa label này\')" href="?action=delete&id=' . $result['id'] . '&filename=' . $result['filename'] . '" class="btn btn-danger">Xóa</a></td>';
							echo "</tr>";
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
<?php 
  include "../../Dungchung/js.php";
?>
