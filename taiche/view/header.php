<?php


if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'true') {
        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session.
        session_destroy();

        // Redirect to home page
        header("Location: home_page_user.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="FontAwesome.Pro.6.3.0/css/all.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="main.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .navbar {
            background-color: #007bff !important;
        }

        .navbar-brand {
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ccc !important;
        }

        .container {
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <div class="header">
        <h1>THU MUA ĐỒ ĐIỆN TỬ</h1>
    </div>

    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home_page_user.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product_form.php">Bán thiết bị</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Tình trạng sản phẩm</a>
                </li>
                
            </ul>
            <?php
            if (isset($_SESSION['khachang']['username'])) {
                echo "<span style=\"font-size: 20px; color:white;\">Xin chào: <b style=\"font-weight: bold; color:blue;\">{$_SESSION['khachang']['username']}  </b></span> 
                    <a href=\"{$_SERVER['PHP_SELF']}?logout=true\" style=\"font-size: 20px; margin-left: 20px;\">Đăng xuất</a>";
            }
            ?>
            
        </div>
    </nav>

    <div class="container">
        <!-- Your content goes here -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
