<?php
include '../config/connect.php';
require_once '../controller/NhanHangController.php';

$nhanHangController = new NhanHangController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = !empty($_POST['catelogid']) ? (int)$_POST['catelogid'] : 0;

    if ($nhanHangController->deleteCatelog($id)) {
        header('Location: nhan_hang.php');
        exit();
    } else {
        echo 'Có lỗi xảy ra khi xóa nhãn hàng';
    }
} else {
    echo 'Không thấy yêu cầu POST';
}
?>
