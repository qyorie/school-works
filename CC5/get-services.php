<?php
include("dbconnection.php");

$sql = "SELECT service_id, service_name, price FROM service";
$result = mysqli_query($conn, $sql);

$services = [];
while ($row = mysqli_fetch_assoc($result)) {
  $services[] = $row;
}

echo json_encode($services);
?>