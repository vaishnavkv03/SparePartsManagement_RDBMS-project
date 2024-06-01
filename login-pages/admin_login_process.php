<?php
// Include the database connection file
require_once "database.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and bind the SQL statement
    $sql = "SELECT id, username, password FROM admin_user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Output the error message if preparation fails
    }
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Check if a row was returned
    if ($stmt->num_rows > 0) {
        // Bind the result variables
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $db_password)) {
            // Password is correct, set session variables and redirect to welcome page
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $db_username;
            header("Location: welcome.php");
            exit();
        } else {
            // Password is incorrect, redirect back to login page with error message
            header("Location: admin_login.php?error=InvalidCredentials");
            exit();
        }
    } else {
        // No matching username found, redirect back to login page with error message
        header("Location: admin_login.php?error=InvalidCredentials");
        exit();
    }

    // Close statement
    $stmt->close();
}
?>
