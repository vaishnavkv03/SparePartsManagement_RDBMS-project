<?php
// Include the database connection file
require_once "database.php";

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username is already taken
    $check_sql = "SELECT * FROM admin_user WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Output the error message if preparation fails
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Username already taken.";

        // Redirect back to registration page
        header("Location: admin_register.php");
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO admin_user (username, password) VALUES (?, ?)";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Output the error message if preparation fails
    }

    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Set success message in session variable
        $_SESSION['registration_message'] = "User registered successfully.";

        // Redirect to login page
        header("Location: welcome_new_user.php");
        exit();
    } else {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Registration failed.";

        // Redirect back to registration page
        header("Location: admin_register.php");
        exit();
    }

    // Close statement
    $stmt->close();
}
?>
