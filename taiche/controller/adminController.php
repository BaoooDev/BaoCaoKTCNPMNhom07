<?php
session_start();
ob_start();
require_once '../config/connect.php';
require_once '../dao/AdminDAO.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($password)) {
        echo "Mật khẩu không được để trống.";
        exit;
    }

    $password = md5($password);
    $adminDAO = new AdminDAO($conn);
    $admin = $adminDAO->login($username, $password);

    if ($admin) {
        $_SESSION['admin']['username'] = $username;
        header('Location: ../view/home_page_admin.php');
        exit();
    } else {
        echo "Thông tin tài khoản hoặc mật khẩu không chính xác";
    }
}
class AdminController {
    private $adminDAO;

    public function __construct($conn) {
        $this->adminDAO = new AdminDAO($conn);
    }

                
}
?>
