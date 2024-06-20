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

// Fetch data from parts_order where status is 'manufactured'

$sql = "SELECT order_id, parts_name, quantity, ordered_by, ordered_date, total_amount FROM parts_order WHERE status_of_order = 'manufactured'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE</title>
    <link href="invoice_style.css" rel="stylesheet">
    <script>
        function pay(orderId, totalAmount) {
            var username = prompt("Enter your username:");
            var password = prompt("Enter your password:");
            if (username != null && password != null) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "pay_order.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload(); // Reload the page to see the updated status
                    }
                };
                xhr.send("order_id=" + orderId + "&username=" + username + "&password=" + password + "&total_amount=" + totalAmount);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">SPAREPARTS</div>
            <div class="links">           
                <a href="../admin_index/admin_index.php">BACK</a>
                <a href="admin_invHis.php">HISTORY</a>
                <a href="../index/index.php">LOGOUT</a>     
            </div>
        </div>
        <div class="hero">
            INVOICE
        </div>
        <div class="ttt">
            <?php
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Order ID</th>
                            <th>Parts Name</th>
                            <th>Quantity</th>
                            <th>Ordered By</th>
                            <th>Ordered Date</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>";
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["order_id"]."</td>";
                    echo "<td>".$row["parts_name"]."</td>";
                    echo "<td>".$row["quantity"]."</td>";
                    echo "<td>".$row["ordered_by"]."</td>";
                    echo "<td>".$row["ordered_date"]."</td>";
                    echo "<td>".$row["total_amount"]."</td>";
                    echo '<td><button onclick="pay('.$row["order_id"].', '.$row["total_amount"].')">Pay</button></td>';
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Nothing to pay";
            }
            ?>
        </div>
    </div>
    
</body>
</html>

<?php
// Close connection
$conn->close();
?>