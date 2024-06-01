<?php
// Start the session
session_start();

// Check if there's a login message in the session
if (isset($_SESSION['login_message'])) {
    // Display the login message in an alert
    echo "<script>alert('{$_SESSION['login_message']}');</script>";

    // Clear the login message from the session
    unset($_SESSION['login_message']);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <form action="login_process.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p>New user? <a href="register.php">Register here</a></p>
</body>
</html>

