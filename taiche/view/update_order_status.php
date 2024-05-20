<?php
session_start();
require_once '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idsanpham = $_POST['idsanpham'];
    $action = $_POST['action'];
    $idkhachhang = isset($_SESSION['customer']['idkhachhang']) ? $_SESSION['customer']['idkhachhang'] : null;

    if (!$idkhachhang) {
        echo "Bạn phải đăng nhập để thực hiện hành động này.";
        exit;
    }

    // Fetch the product to check ownership and current status
    $stmt = $conn->prepare("SELECT idkhachhang, status FROM sanpham WHERE idsanpham = ?");
    $stmt->bind_param("i", $idsanpham);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        if ($product['idkhachhang'] == $idkhachhang && $product['status'] == 'Đã nhận') {
            $newStatus = ($action == 'accept') ? 'Hoàn thành' : 'Hủy';
            $updateStmt = $conn->prepare("UPDATE sanpham SET status = ? WHERE idsanpham = ?");
            $updateStmt->bind_param("si", $newStatus, $idsanpham);
            if ($updateStmt->execute()) {
                header('Location: order.php?success=1');
                exit;
            } else {
                echo "Có lỗi xảy ra khi cập nhật trạng thái.";
            }
        } else {
            echo "Bạn không có quyền thực hiện hành động này.";
        }
    } else {
        echo "Sản phẩm không tồn tại.";
    }
}
?>
