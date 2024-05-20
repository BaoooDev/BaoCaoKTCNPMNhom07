<?php
session_start();
ob_start();
include_once '../config/connect.php';

class CustomerLoginController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $use = $_POST['username'];
            $pass = $_POST['password'];

            if (empty($pass)) {
                echo "Mật khẩu không được để trống.";
                exit;
            }

            $pass = md5($pass);

            $sql = "SELECT * FROM `khachang` WHERE username = '$use' AND `matKhau` = '$pass'";
            $use_sql = mysqli_query($this->conn, $sql);

            if (mysqli_num_rows($use_sql) > 0) {
                $user = mysqli_fetch_assoc($use_sql);
                $_SESSION['customer']['username'] = $user['username'];
                $_SESSION['customer']['idkhachhang'] = $user['idkhachhang'];
                echo "đăng nhập thành công";
                header('location: ../view/home_page_user.php');
            } else {
                echo "thông tin tài khoản hoặc mật khẩu không chính xác";
            }
        }
    }
}

$controller = new CustomerLoginController($conn);
$controller->login();
?>
