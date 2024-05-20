<?php
class ProductController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->startSession();
    }

    private function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addProduct() {
        $idkhachhang = isset($_SESSION['customer']['idkhachhang']) ? $_SESSION['customer']['idkhachhang'] : null;

        if (!$idkhachhang) {
            return 'Bạn phải đăng nhập để thêm sản phẩm.';
        }

        $catelogid = $_POST['catelogid'];
        $tensanpham = $_POST['tensanpham'];
        $tinhtrang = $_POST['tinhtrang'];
        $noidung = $_POST['noidung'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $nganhang = $_POST['nganhang'];
        $gia = isset($_POST['gia']) ? $_POST['gia'] : 0; // Thêm giá nếu có

        if (empty($catelogid) || empty($tensanpham) || empty($tinhtrang) || empty($noidung) || empty($phone) || empty($email) || empty($nganhang)) {
            return 'Vui lòng điền đầy đủ thông tin.';
        }

        $stmt = $this->conn->prepare("INSERT INTO `sanpham` (`catelogid`, `tensanpham`, `tinhtrang`, `noidung`, `gia`, `phone`, `email`, `nganhang`, `status`, `idkhachhang`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Chờ duyệt', ?)");
        $stmt->bind_param("isssisssi", $catelogid, $tensanpham, $tinhtrang, $noidung, $gia, $phone, $email, $nganhang, $idkhachhang);

        if ($stmt->execute()) {
            header('Location: ../view/product_form.php?success=1');
            exit;
        } else {
            return 'Có lỗi xảy ra. Vui lòng thử lại.';
        }
    }
}
?>
