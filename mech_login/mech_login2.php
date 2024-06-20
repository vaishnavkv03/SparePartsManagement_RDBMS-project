<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mechanic Login Page</title>
  <link rel="stylesheet" href="mech_styles.css">
  <script type="text/javascript">
    window.onload = function() {
      <?php if (isset($_SESSION['order_message'])): ?>
        alert("<?php echo $_SESSION['order_message']; ?>");
        <?php unset($_SESSION['order_message']); // Unset the message to avoid repetitive alerts ?>
      <?php endif; ?>
    };
  </script>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Mech Login</h2>
      <!-- PHP code for error message -->
      <?php
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo "<p class='error-message'>{$_SESSION['login_error']}</p>";
          unset($_SESSION['login_error']);
      }
      ?>
      <form action="mech_login_process.php" method="post">
        <!-- New user registration link -->
        <p>New user? <a href="mech_registration.php">Register here</a></p>
        <div class="form-group">
          <input type="text" id="mech_name" name="mech_name" placeholder="Mechanic Name" required>
        </div>
        <div class="form-group">
          <input type="password" id="pw" name="pw" placeholder="Password" required>
        </div>
        <a href="../../index/index.php" class="back-home-btn bb">Home</a>
        <button type="submit">Login</button>
        <!-- Back/Home button -->
        
      </form>
    </div>
  </div>
  <!-- Script file -->
</body>
</html>
