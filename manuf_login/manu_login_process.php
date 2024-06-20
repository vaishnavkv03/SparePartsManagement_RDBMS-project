<?php
// Include the database connection file
require_once __DIR__ . '/../config/database.php';

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $company_name = $_POST["company_name"];
    $pw = $_POST["pw"];

    // Prepare and bind the SQL statement
    $sql = "SELECT company_id, company_name, pw FROM manufacturer WHERE company_name = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $company_name);
    $stmt->execute();
    $stmt->store_result();

    // Check if a row was returned
    if ($stmt->num_rows > 0) {
        // Bind the result variables
        $stmt->bind_result($company_id, $db_company_name, $db_pw);
        $stmt->fetch();

        // Verify the password
        if (password_verify($pw, $db_pw)) {
            // Password is correct, set session variables and redirect to welcome page
            $_SESSION["company_id"] = $company_id;
            $_SESSION["company_name"] = $db_company_name;
            header("Location: ../manuf_index/manuf_index.php");
            exit();
        } else {
            // Password is incorrect, set error message in session variable
            $_SESSION['login_error'] = "Invalid company name or password.";
            header("Location: manu_login.php");
            exit();
        }
    } else {
        // No matching company name found, set error message in session variable
        $_SESSION['login_error'] = "No user found with the given company name.";
        header("Location: manu_login.php");
        exit();
    }

    // Close statement
    $stmt->close();
}
?>
