<?php
// Include the database connection file
require_once "database.php";

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company_name = $_POST["company_name"];
    $company_address = $_POST["company_address"];
    $contact = $_POST["contact"];
    $pw = $_POST["pw"];
    $confirm_pw = $_POST["confirm_pw"];

    // Check if passwords match
    if ($pw !== $confirm_pw) {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Passwords do not match.";
        // Redirect back to registration page
        header("Location: manu_register.php");
        exit();
    }

    // Check if company name is already taken
    $check_sql = "SELECT * FROM manufacturer WHERE company_name = ?";
    $stmt = $conn->prepare($check_sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $company_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Company name already taken.";
        // Redirect back to registration page
        header("Location: manu_register.php");
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO manufacturer (company_name, company_address, contact, pw) VALUES (?, ?, ?, ?)";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $company_name, $company_address, $contact, $hashed_password);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Set success message in session variable
        $_SESSION['registration_message'] = "Registration successful. Please login.";
        // Redirect to success page
        header("Location: manu_register_success.php");
        exit();
    } else {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Registration failed.";
        // Redirect back to registration page
        header("Location: manu_register.php");
        exit();
    }

    // Close statement
    $stmt->close();
}
?>
