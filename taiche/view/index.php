<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../img/R.jpg');
             background-size: cover;;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 400px;
            text-align: center;
        }
        .btn-primary {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color: brown;">Welcome to <br> E-Recycle service</h1>
        <a href="customer_login.php" class="btn btn-primary">User Login</a>
        <a href="adminLogin.php" class="btn btn-primary">Admin Login</a>
    </div>
</body>
</html>
