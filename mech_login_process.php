<?php
// Include the database connection file
require_once "database.php";

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $mech_name = $_POST["mech_name"];
    $pw = $_POST["pw"];

    // Prepare and bind the SQL statement
    $sql = "SELECT mech_name, pw FROM mechanics WHERE mech_name = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Output the error message if preparation fails
    }

    $stmt->bind_param("s", $mech_name);
    $stmt->execute();
    $stmt->store_result();

    // Check if a row was returned
    if ($stmt->num_rows > 0) {
        // Bind the result variables
        $stmt->bind_result($db_mech_name, $db_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($pw, $db_password)) {
            // Password is correct, set session variables and redirect to welcome page
            $_SESSION["mech_name"] = $db_mech_name;
            header("Location: welcome.php");
            exit();
        } else {
            // Password is incorrect, set error message and redirect back to login page
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: mech_login.php");
            exit();
        }
    } else {
        // No matching username found, set error message and redirect back to login page
        $_SESSION['login_error'] = "No user found with the provided username.";
        header("Location: mech_login.php");
        exit();
    }

    // Close statement
    $stmt->close();
}
?>
