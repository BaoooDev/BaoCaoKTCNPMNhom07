<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Khách Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(#f4d6cf, #8eccf5);
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        legend {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .login-link, .logout-link {
            color: #007bff;
            text-decoration: none;
        }
        .login-link:hover, .logout-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="../controller/CustomerLoginController.php" method="post">
                <legend class="text-center">Đăng Nhập Khách Hàng</legend>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Nhập tài khoản" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="show-password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng Nhập</button>
                <div class="form-group text-center">
                    Bạn chưa có tài khoản? <a href="register.php" class="login-link">Đăng Ký</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var passwordInput = document.getElementById('password');
            var passwordToggleBtn = document.getElementById('show-password-toggle');

            passwordToggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    passwordToggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    </script>
</body>
</html>
