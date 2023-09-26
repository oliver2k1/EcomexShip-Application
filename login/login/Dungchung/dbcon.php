<?php
	$host = 'localhost';
	$user = 'eco33771_ecomex';
	$password = 'Ecomex@123';
	$database = 'eco33771_ecomex';
	$con = mysqli_connect($host, $user, $password, $database);
	if (!$con){
		?>
			<script>alert("Connection Unsuccessful!!!");</script>
		<?php
	}
?>
