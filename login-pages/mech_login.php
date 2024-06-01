<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mechanic Login Page</title>
  <link rel="stylesheet" href="mech_styles.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Mech Login</h2>
      <?php
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo "<p class='error-message'>{$_SESSION['login_error']}</p>";
          unset($_SESSION['login_error']);
      }
      ?>
      <form action="mech_login_process.php" method="post">
        <p>New user? <a href="mech_registration.php">Register here</a></p>
        <div class="form-group">
          <input type="text" id="mech_name" name="mech_name" placeholder="Mechanic Name" required>
        </div>
        <div class="form-group">
          <input type="password" id="pw" name="pw" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  </div>
  <script src="admin_scripts.js"></script>
</body>
</html>
