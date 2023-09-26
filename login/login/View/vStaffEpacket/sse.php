<?php
include_once "../../Model/connect.php";
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

$lastEventId = isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? intval($_SERVER["HTTP_LAST_EVENT_ID"]) : 0;
$query = "SELECT * FROM `oder` WHERE `idOrder` > $lastEventId AND `status` = 1 order by `time` asc";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Lỗi truy vấn: ' . mysqli_error($connection));
}
while ($row = mysqli_fetch_assoc($result)) {
    $eventId = $row['idOrder'];
    $data = json_encode($row);
    echo "id: $eventId\n";
    echo "data: $data\n\n";
    ob_flush();
    flush();
}
mysqli_close($conn);
?>