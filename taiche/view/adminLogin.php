<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: linear-gradient(#f4d6cf, #8eccf5);
            font-family: Arial, sans-serif;
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
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        legend {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
        }

        .form-control {
            height: 50px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .login-link {
            font-size: 16px;
            text-align: center;
            display: block;
        }

        .login-link a {
            color: #007bff;
        }

        .login-link a:hover {
            color: #0056b3;
            text-decoration: none;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: calc(50% - 12px);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form action="../controller/adminController.php" method="post">
                <legend>Đăng Nhập Admin</legend>
                <div class="form-group">
                    <label for="username">Tài Khoản</label>
                    <input type="text" name="username" id="username" placeholder="Nhập tài khoản" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật Khẩu</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="form-control" required>
                        <div class="eye-icon" id="show-password-toggle">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" name="dangnhap" class="btn btn-primary btn-block">Đăng Nhập</button>

                
            </form>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <!-- JavaScript for password visibility toggle -->
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
