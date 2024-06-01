<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manufacturer Login</title>
  <link rel="stylesheet" href="manu_styles.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Manufacturer Login</h2>
      <?php
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo "<p class='error-message'>{$_SESSION['login_error']}</p>";
          unset($_SESSION['login_error']);
      }
      ?>
      <form action="manu_login_process.php" method="post">
        <div class="form-group">
          <input type="text" id="company_name" name="company_name" placeholder="Company Name" required>
        </div>
        <div class="form-group">
          <input type="password" id="pw" name="pw" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
      </form>
      <p>Not a member? <a href="manu_register.php">Register here</a></p>
    </div>
  </div>
  <script src="admin_scripts.js"></script>
</body>
</html>
