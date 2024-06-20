<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administrator Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #c1d0c1; /* Background color */
        background-image: url('bus.png');
        background-size:cover;
    background-position:25%;
    background-repeat: no-repeat;
    }
    .navbar {
        background-color: #333;
        padding: 10px 20px;
    }
    .navbar a {
        color: #1c1b1b;
        text-decoration: none;
        margin-right: 20px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: rgba(203, 246, 204, 0.4); /* Reduced opacity */
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        text-align: center;
    }
    h1, h2 {
        color: #333;
    }
    h1 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    
    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .admin-info {
        margin-top: 30px;
    }
    .admin-info p {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }
    .admin-info h3 {
        color: #333;
        font-size: 20px;
        margin-bottom: 20px;
    }
    .button-container {
        margin-top: 30px;
    }
    .button-container button {
        padding: 15px 30px;
        margin: 0 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .button-container button.orders {
        background-color: #6ba0cb;
        color: #100f0f;
    }
    .button-container button.invoice {
        background-color: #6ba0cb;
        color: #141313;
    }
    .button-container button:hover {
        filter: brightness(90%);

    }
    .navbar {
    background-color: #c1d0c1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: large;
}

@font-face {
    font-family: 'choler';
    src: url('cholericregular-gwxe1.ttf');
}

@font-face {
    font-family: 'cool';
    src: url('Akrobat-Regular.otf');
    
}

.container h1{
    font-family: 'cool';
    font-weight: 1500;
}

.container h3{
    color: #161616;
    font-size: 60px;
    font-family: 'choler';
}
</style>
</head>
<body>

    <div class="navbar">
        <div class="logo">SPAREPARTS</div>
        <div class="links">           
            
            <a href="../index/index.php">LOGOUT</a>     
        </div>
    </div>

<div class="container">
    <h1>STATE TRANSPORT CORPORATION</h1>
    <div class="admin-info">
        
        <h3>WELCOME ADMIN</h3>
    </div>
    <div class="button-container">
        <button class="orders" onclick="redirectToAdministratorPage()">ORDERS</button>
        <button class="invoice" onclick="redirectToInvoicePage()">INVOICE</button>
    </div>
</div>

<script>
    function redirectToAdministratorPage() {
        window.location.href = '../admin_orders/admin_orders.php';
    }

    function redirectToInvoicePage() {
        window.location.href = "../admin_invoice/admin_invoice.php";
    }
</script>

</body>
</html>
