<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manufacturer Registration</title>
  <link rel="stylesheet" href="manu_styles.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Register Manufacturer</h2>
      <?php
      session_start();
      if (isset($_SESSION['registration_message'])) {
          echo "<p class='error-message'>{$_SESSION['registration_message']}</p>";
          unset($_SESSION['registration_message']);
      }
      ?>
      <form id="registerForm" action="manu_reg_process.php" method="post">
        <div class="form-group">
          <input type="text" id="company_name" name="company_name" placeholder="Company Name" required>
        </div>
        <div class="form-group">
          <input type="text" id="company_address" name="company_address" placeholder="Company Address" required>
        </div>
        <div class="form-group">
          <input type="text" id="contact" name="contact" placeholder="Contact" required>
        </div>
        <div class="form-group">
          <input type="password" id="pw" name="pw" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="password" id="confirm_pw" name="confirm_pw" placeholder="Confirm Password" required>
        </div>
        <button type="submit">Register</button>
      </form>
      <p>Already a member? <a href="manu_login.php">Login here</a></p>
    </div>
  </div>
  <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      const password = document.getElementById('pw').value;
      const confirmPassword = document.getElementById('confirm_pw').value;
      if (password !== confirmPassword) {
        alert('Passwords do not match. Please try again.');
        event.preventDefault();
      }
    });
  </script>
  <script src="admin_scripts.js"></script>
</body>
</html>
