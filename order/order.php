<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "transportmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orders = json_decode($_POST['orders'], true);
    $successful = true;
    foreach ($orders as $order) {
        $partName = $order['partName'];
        $quantity = $order['quantity'];
        $orderDate = date("Y-m-d");
        $status = "Ordered";

        // Insert into parts_order table
        $sql = "INSERT INTO parts_order (parts_name, quantity, ordered_date, status_of_order) VALUES ('$partName', '$quantity', '$orderDate', '$status')";

        if ($conn->query($sql) !== TRUE) {
            $successful = false;
            $error = $conn->error;
            break;
        }
    }

    // Handle success or error with JavaScript alerts
    if ($successful) {
        echo "<script>
                alert('New record created successfully');
                window.location.href = 'order_page.php'; // Replace with the actual name of your ordering page
              </script>";
    } else {
        echo "<script>
                alert('Error: $error');
                window.location.href = 'order_page.html'; // Replace with the actual name of your ordering page
              </script>";
    }
}

$conn->close();
?>
