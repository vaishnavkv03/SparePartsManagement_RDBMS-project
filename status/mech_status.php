<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
    <link href="mech_statusStyle.css" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="logo"> SPAREPARTS</div>
        <div class="links">           
            <a href="../mech-index/mech_index.php">BACK</a>
            <a href="">ABOUT</a>
            <a href="../../index/index.php">LOGOUT</a>     
        </div>
    </div>
    <div class="mainD">
        <div class="hm">
            ORDER STATUS
        </div>
        <div class="status">
            <?php
            require_once __DIR__ . '/../../config/database.php'; // Adjusted path to database.php

            // Fetch order status data
            $sql = "SELECT order_id, parts_name, quantity, ordered_by, ordered_date, status_of_order FROM parts_order";
            $result = $conn->query($sql);

            if ($result === FALSE) {
                echo "Error: " . $conn->error;
            } else {
                if ($result->num_rows > 0) {
                    // Output data in a table
                    echo "<table class='status-table'>
                            <tr>
                                <th>Order ID</th>
                                <th>Parts Name</th>
                                <th>Quantity</th>
                                <th>Ordered By</th>
                                <th>Ordered Date</th>
                                <th>Status</th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["order_id"] . "</td>
                                <td>" . $row["parts_name"] . "</td>
                                <td>" . $row["quantity"] . "</td>
                                <td>" . $row["ordered_by"] . "</td>
                                <td>" . $row["ordered_date"] . "</td>
                                <td>" . $row["status_of_order"] . "</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>no orders found.</p>";
                }
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
