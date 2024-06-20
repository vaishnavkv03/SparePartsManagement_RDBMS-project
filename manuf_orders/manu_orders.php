<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDERS</title>
    <link href="manu_ordStyles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">SPAREPARTS</div>
            <div class="links">           
                <a href="../manuf_index/manuf_index.php">BACK</a>
                <a href="../index/index.php">LOGOUT</a>     
            </div>
        </div>
        <div class="orders">
            <div class="hero">
                <p class="hp">ORDERS LIST</p>
            </div>
            <table border="1">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Parts Name</th>
                        <th>Quantity</th>
                        <th>Ordered Date</th>
                        <th>Depot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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

                    // SQL query to fetch approved orders along with depot information
                    $sql = "SELECT po.order_id, po.parts_name, po.quantity, po.ordered_date, m.depot
                            FROM parts_order po
                            JOIN mechanics m ON po.ordered_by = m.mech_name
                            WHERE po.status_of_order = 'approved'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["order_id"] . "</td>
                                    <td>" . $row["parts_name"] . "</td>
                                    <td>" . $row["quantity"] . "</td>
                                    <td>" . $row["ordered_date"] . "</td>
                                    <td>" . $row["depot"] . "</td>
                                    <td>
                                        <form method='post' action='update_status.php'>
                                            <input type='hidden' name='order_id' value='" . $row["order_id"] . "'>
                                            <input type='submit' value='Manufactured'>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No approved orders found</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
