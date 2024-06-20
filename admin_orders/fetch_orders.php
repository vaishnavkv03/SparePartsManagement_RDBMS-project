<?php
include 'db_connect.php';

$status = $_GET['status'];

$sql = "SELECT order_id, parts_name, ordered_by, quantity, total_amount, ordered_date 
        FROM parts_order 
        WHERE status_of_order='$status'";
$result = $conn->query($sql);

$orders = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

echo json_encode($orders);

$conn->close();
?>
