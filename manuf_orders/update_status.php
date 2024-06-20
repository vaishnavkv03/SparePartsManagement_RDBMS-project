<?php
// Database connection parameters
$servername = "localhost";  // Your database server name or IP address
$username = "root";         // Your database username
$password = "password";     // Your database password
$dbname = "transportmanagement"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];

    // Update status_of_order to 'manufactured'
    $sql = "UPDATE parts_order SET status_of_order = 'manufactured' WHERE order_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    
    if ($stmt->execute()) {
        echo "Order status updated successfully.";
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();

// Redirect back to the orders list page
header("Location: manu_orders.php");
exit();
?>
