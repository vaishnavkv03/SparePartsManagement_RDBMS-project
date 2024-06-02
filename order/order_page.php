<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Parts for Manufacturing</title>
    <link href="stylesTemp.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">SPAREPARTS</div>
            <div class="links">           
                <a href="">HOME</a>
                <a href="">PROFILE</a>
                <a href="">LOGOUT</a>     
            </div>
        </div>
        <div class="text1">
            <p>ORDERS</p>
        </div>
        <form id="orderForm" action="order.php" method="post">
            <div class="orderElem">
                <div class="inp">
                    <div class="elem">
                        <label for="part-select">SELECT:</label>
                        <select id="part-select" name="part_id" onchange="calculateTotal()">
                            <option value="">Select Part</option>
                            <!-- Add options dynamically from PHP -->
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

                            $sql = "SELECT part_id, parts_name, cost FROM parts";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["part_id"] . "' data-name='" . $row["parts_name"] . "' data-cost='" . $row["cost"] . "'>" . $row["parts_name"] . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No parts found</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="elem">
                        <label for="quantity">QUANTITY:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1" onchange="calculateTotal()">
                    </div>
                    <div class="elem">
                        <label for="total">TOTAL AMOUNT:</label>
                        <input type="text" id="total" name="total" readonly>
                    </div>
                </div>
                <div class="but2">
                    <button class="but" type="button" onclick="addToTable()">ADD TO ORDER</button>
                </div>
            </div>
        </form>
        <table id="orderTable">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be added here dynamically -->
            </tbody>
        </table>
        <div class="but2">
            <button class="but" type="button" onclick="submitOrder()">SUBMIT ORDER</button>
        </div>
    </div>
    <script>
        function calculateTotal() {
            var partSelect = document.getElementById("part-select");
            var quantity = document.getElementById("quantity").value;
            var cost = partSelect.options[partSelect.selectedIndex].dataset.cost;
            var total = quantity * cost;
            document.getElementById("total").value = "Rs." + total.toFixed(2);
        }

        function addToTable() {
            var partSelect = document.getElementById("part-select");
            var partName = partSelect.options[partSelect.selectedIndex].dataset.name;
            var quantity = document.getElementById("quantity").value;
            var total = document.getElementById("total").value;

            if (partName && quantity > 0) {
                var table = document.getElementById("orderTable").getElementsByTagName('tbody')[0];
                var newRow = table.insertRow();

                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);

                cell1.innerHTML = partName;
                cell2.innerHTML = quantity;
                cell3.innerHTML = total;

                // Reset the form fields
                document.getElementById("orderForm").reset();
                document.getElementById("total").value = '';
            } else {
                alert("Please select a part and enter a valid quantity.");
            }
        }

        function submitOrder() {
            var table = document.getElementById("orderTable");
            var rowCount = table.rows.length;
            if (rowCount <= 1) {
                alert("Please add at least one order to submit.");
                return;
            }

            var orders = [];
            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                var partName = row.cells[0].innerHTML;
                var quantity = row.cells[1].innerHTML;
                var total = row.cells[2].innerHTML;

                orders.push({ partName: partName, quantity: quantity, total: total });
            }

            var form = document.createElement("form");
            form.method = "POST";
            form.action = "order.php";

            var ordersField = document.createElement("input");
            ordersField.type = "hidden";
            ordersField.name = "orders";
            ordersField.value = JSON.stringify(orders);
            form.appendChild(ordersField);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
