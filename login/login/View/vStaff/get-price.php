<?php 
$servername = "localhost";
$username = "eco33771_ecomex";
$password = "Ecomex@123";
$dbname = "eco33771_ecomex";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Kết nối CSDL thất bại: " . $e->getMessage();
}
$weight = floatval($_GET["total"]);
$service_id = $_GET["service"];

// Thực hiện truy vấn cơ sở dữ liệu để lấy giá trị giá
$sql = "SELECT price FROM `service` WHERE `name` = :service_id AND :weight >= weight_from AND :weight <= weight_to";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':service_id', $service_id);
$stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
  echo $result["price"];
} else {
  echo 0;
}
?>