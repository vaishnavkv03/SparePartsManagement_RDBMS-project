<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      
      <form action="admin_login_process.php" method="post">
        <p>New user? <a href="admin_register.php">Register here</a></p>
        <div class="form-group">
          <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <a href="../index/index.php" class="back-home-btn bb">Home</a><br><br>
        <button type="submit">Login</button>
      </form>
    </div>
  </div>
  <script>
    // Function to get query parameters
    function getQueryParams() {
      let params = {};
      window.location.search.substring(1).split("&").forEach(function(pair) {
        let keyValue = pair.split("=");
        params[keyValue[0]] = decodeURIComponent(keyValue[1]);
      });
      return params;
    }

    // Check if there is an error query parameter and alert the user
    const queryParams = getQueryParams();
    if (queryParams['error'] === 'InvalidCredentials') {
      alert('Invalid username or password. Please try again.');
    }
  </script>
  <script src="admin_scripts.js"></script>
</body>
</html>
