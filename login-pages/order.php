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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Parts for Manufacturing</title>
    <style>
        /* Basic styling for demonstration purposes */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select, input[type="number"] {
            padding: 8px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Parts for Manufacturing</h1>
        <form action="order.php" method="post" onsubmit="return validateForm()">
            <label for="part-select">Select Part:</label>
            <select id="part-select" name="part_id">
                <option value="">Select Part</option>
                <?php
                // SQL query to fetch parts data
                $sql = "SELECT part_id, parts_name, cost FROM parts";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["part_id"] . "' data-cost='" . $row["cost"] . "'>" . $row["parts_name"] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No parts found</option>";
                }
                ?>
            </select>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1" onchange="calculateTotal()">
            <label for="total">Total Income:</label>
            <input type="text" id="total" name="total" readonly>
            <button type="submit">Place Order</button>
        </form>
    </div>
    <script>
        function calculateTotal() {
            var partSelect = document.getElementById("part-select");
            var quantity = document.getElementById("quantity").value;
            var cost = partSelect.options[partSelect.selectedIndex].dataset.cost;
            var total = quantity * cost;
            document.getElementById("total").value = "$" + total.toFixed(2);
        }

        function validateForm() {
            var partSelect = document.getElementById("part-select");
            var quantity = document.getElementById("quantity").value;

            if (partSelect.value === "") {
                alert("Please select a part.");
                return false;
            }

            if (quantity <= 0) {
                alert("Please enter a valid quantity.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
