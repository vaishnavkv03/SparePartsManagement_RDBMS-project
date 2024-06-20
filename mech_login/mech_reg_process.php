<?php
// Include the database connection file
//require_once __DIR__ . '/../../config/database.php'; // Adjusted path to database.php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "transportmanagement";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve fields from the form
    $mech_name = $_POST["mech_name"];
    $depot = $_POST["depot"];
    $pw = $_POST["pw"];
    $ph = $_POST["ph"];

    // Check if mech_name is already taken
    $check_sql = "SELECT * FROM mechanics WHERE mech_name = ?";
    $stmt = $conn->prepare($check_sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Output the error message if preparation fails
    }

    $stmt->bind_param("s", $mech_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Mechanic name already taken.";

        // Redirect back to registration page
        header("Location: mech_registration.php");
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO mechanics (mech_name, pw, depot, ph) VALUES (?, ?, ?, ?)";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Output the error message if preparation fails
    }

    $stmt->bind_param("ssss", $mech_name, $hashed_password, $depot, $ph);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Set success message in session variable
        $_SESSION['registration_message'] = "Mechanic registered successfully.";

        // Redirect to welcome page
        header("Location: mech_login.php");
        exit();
    } else {
        // Set error message in session variable
        $_SESSION['registration_message'] = "Error: Registration failed.";

        // Redirect back to registration page
        header("Location: mech_registration.php");
        exit();
    }

    // Close statement
    $stmt->close();
}
?>
