<?php
// Assuming your database credentials
$servername = "localhost";
$username = "root";
$password = "password";
$database = "transportmanagement";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$order_id = $_POST['order_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$total_amount = $_POST['total_amount'];

// Authenticate user
$sql = "SELECT * FROM admin_user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Update the order status
        $update_sql = "UPDATE parts_order SET status_of_order = 'paid' WHERE order_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $order_id);
        if ($update_stmt->execute() === TRUE) {
            // Insert into invoice
            $invoice_sql = "INSERT INTO invoice (order_id, total_amount, date_of_invoice, status_of_order) VALUES (?, ?, CURDATE(), 'paid')";
            $invoice_stmt = $conn->prepare($invoice_sql);
            $invoice_stmt->bind_param("id", $order_id, $total_amount);
            if ($invoice_stmt->execute() === TRUE) {
                echo "Payment successful. Invoice generated.";
            } else {
                echo "Error: " . $invoice_stmt->error;
            }
        } else {
            echo "Error updating record: " . $update_stmt->error;
        }
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Invalid username or password.";
}

// Close connection
$conn->close();
?>