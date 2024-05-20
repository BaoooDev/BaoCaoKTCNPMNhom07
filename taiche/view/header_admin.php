<?php
session_start();
ob_start();
    if (!isset($_SESSION['admin']['username'])) {
        header("Location: adminLogin.php");
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
            background-color: black;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .navbar {
            background-color: black !important;
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
                    <a class="nav-link" href="../view/home_page_admin.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/nhan_hang.php">Nhãn hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/order_admin_view.php">Quản lý sản phẩm</a>
                </li>
                
                
                <?php
                if (isset($_SESSION['admin']['username'])) {
                    echo "<li style=\"font-size: 20px; margin-top: 5px; color:white;\">Xin chào Admin <b style=\"font-weight: bold; color:blue;\">{$_SESSION['admin']['username']}  </b></li> 
                    <li>  <a href=\"../view/logout.php\" style=\"font-size: 20px; margin-top: 20px;\">Đăng xuất</a></li>";
                } 
                ?>
            </ul>
            
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
