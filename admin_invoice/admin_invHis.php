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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INVOICE HISTORY</title>
  <link href="invHis_style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="logo">SPAREPARTS</div>
      <div class="links">
        <a href="admin_invoice.php">BACK</a>
        <a href="../index/index.php">LOGOUT</a>
      </div>
    </div>
    <div class="hero">
      INVOICE HISTORY
    </div>
    <div class="tabl">
      <?php
        // Assuming your database connection is established elsewhere (e.g., included file)

        $sql = "SELECT invoice_id, order_id, total_amount, date_of_invoice, status_of_order FROM invoice";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "<table>
                <tr>
                  <th>Invoice ID</th>
                  <th>Order ID</th>
                  <th>Total Amount</th>
                  <th>Date of Invoice</th>
                  <th>Status</th>
                </tr>";

          // Output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["invoice_id"]."</td>";
            echo "<td>".$row["order_id"]."</td>";
            echo "<td>".$row["total_amount"]."</td>";
            echo "<td>".$row["date_of_invoice"]."</td>";
            echo "<td>".$row["status_of_order"]."</td>";
            echo "</tr>";
          }
          echo "</table>";
        } else {
          echo "No Invoice History Found";
        }
      ?>
    </div>
  </div>
</body>
</html>
