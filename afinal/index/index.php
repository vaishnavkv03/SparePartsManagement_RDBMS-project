<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transport Management System</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family:Arial, Helvetica, sans-serif;
    }
    
    .container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      margin-top: 20px; /* Adjusted margin to reduce space at the top */
    }

    body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-image: url('bus212.png');
  background-repeat: no-repeat;
  background-size: 100% 100%; /* Adjusted background size */
  background-attachment: scroll;
  min-height: 100vh;
  min-width: 100vw;
  position: relative;
}


    .header {
      background-image: url("C:\Users\vaish\Desktop\PROJECT\1860x1050-for-any-coach-operation (1).avif");
      background-size: cover;
      height: 20%; /* Reduced height */
      display: flex;
      justify-content: center;
      align-items: flex-start; /* Align items to the top */
      color: white;
    }

    .menu {
      display: flex;
      justify-content: space-around;
      width: 30%;
    }

    .content {
      display: flex;
      flex-direction: row;
      height: 60%;
    }

    .left-content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      margin-bottom: 270px;
    }

    .right-content {
      flex: 1;
      display: flex;
      font-family: 'akro';
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      margin-bottom: 350px; /* Lift up the content */
    }

    @font-face {
        font-family: 'mor';
        src: url('morality.otf');
    }

    @font-face {
        font-family: 'akro';
        src: url('Akrobat-Black.otf');
    }
    @font-face {
        font-family: 'cool';
        src: url('coolvetica\ rg.ttf');
    }

    .login-btn {
      margin: 10px 0;
      padding: 40px 70px; /* Increased padding for larger buttons */
      background-color: #374375;
      color: #fffce5;
      border: none;
      font-family: 'mor';
      border-radius: 18px; /* Slightly bigger buttons */
      cursor: pointer;
      transition: background-color 1s;
      /* Set a larger width here for bigger buttons */
      width: 220px;
      /* Center text alignment */
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-btn:hover {
      background-color: #0056b3;
    }

    a {
        text-decoration: none;
        color: #40619f;
        font-weight: 500;
        font-family: 'mor';
    }

    .address {
      color: #40619f;
      
      margin-left: 240px;
      font-family: 'cool';
      font-weight: 0;
      

    }
    .q{
        color: #374375;
    }

    .logo {
      max-width: 150%;
      height: auto;
      margin-bottom: 0.5px; /* Add space below the logo */
    }

    .company-name {
      font-size: 60px; /* Bigger font size */
      font-weight: bold;
      margin-top: 0.25px;
      font-family: 'cool';
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="menu">
        <a href="#">HOME</a>
        <a href="#">CONTACT US</a>
        <a href="#">ABOUT US</a>
      </div>
    </div>
    <div class="content">
      <div class="left-content">
        <h2 class="company-name">STATE <span class="q">TRANSPORT</span><br> CORPORATION</h2>
        <div class="address">Kalamassery P.O, Ernakulam, Kerala</div>
        <div class="col"></div>
      </div>
      <div class="right-content">
        <h2>SELECT ACCOUNT TYPE</h2>
        <a href=""><button class="login-btn">ADMINISTRATOR</button></a>
        <a href="../mech_test/login/mech_login.php"><button class="login-btn"> MECHANIC </button></a>
        <a href=""><button class="login-btn">MANUFACTURER</button></a>
      </div>
    </div>
  </div>
</body>
</html>
