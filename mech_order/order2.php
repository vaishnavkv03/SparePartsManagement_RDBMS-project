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

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve fields from the form
  $orders = json_decode($_POST['orders'], true);
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the username and password match those in the database
  $sql = "SELECT pw FROM mechanics WHERE mech_name = ?";
  $stmt = $conn->prepare($sql);
  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $db_password)) {
      // Username and password match, proceed with order insertion
      $orderDate = date("Y-m-d");
      $status = "Ordered";

      foreach ($orders as $order) {
        $partName = $order['partName'];
        $quantity = $order['quantity'];
        $total = str_replace("Rs.", "", $order['total']); // Remove "Rs." prefix

        // Insert order into database
        $sql = "INSERT INTO parts_order (parts_name, quantity,total_amount, ordered_date, status_of_order, ordered_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
          die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("siisss", $partName, $quantity, $total, $orderDate, $status, $username);

        if ($stmt->execute()) {
          // Order placed successfully
          $_SESSION['order_message'] = "Order placed successfully!";
        } else {
          // Error placing order
          $_SESSION['order_message'] = "Error placing order.";
        }
      }
    } else {
      // Password doesn't match
      $_SESSION['order_message'] = "Invalid username or password.";
    }
  } else {
    // Username not found
    $_SESSION['order_message'] = "Invalid username or password.";
  }

  // Redirect back to the order page
  header("Location: index2.php");
  exit();
}
?>
