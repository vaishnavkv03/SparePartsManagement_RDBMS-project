<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="mech_styles.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Create New Account</h2>
      <?php
      session_start();
      if (isset($_SESSION['registration_message'])) {
          echo "<p class='error-message'>{$_SESSION['registration_message']}</p>";
          unset($_SESSION['registration_message']);
      }
      ?>
      <form id="registerForm" action="mech_reg_process.php" method="post">
        <div class="form-group">
          <p>Already have an account? <a href="mech_login.php">Login here</a></p>
          <input type="text" id="mech_name" name="mech_name" placeholder="Mechanic Name" required>
        </div>
        <div class="form-group">
          <input type="text" id="depot" name="depot" placeholder="Depot" required>
        </div>
        <div class="form-group">
          <input type="password" id="pw" name="pw" placeholder="Password" required>
        </div>
        <div class="form-group">
          <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
          <input type="text" id="ph" name="ph" placeholder="Phone Number" required>
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </div>
  <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      const password = document.getElementById('pw').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      if (password !== confirmPassword) {
        alert('Passwords do not match. Please try again.');
        event.preventDefault();
      }
    });
  </script>
  <script src="admin_scripts.js"></script>
</body>
</html>
