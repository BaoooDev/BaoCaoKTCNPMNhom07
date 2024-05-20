<?php
// OrderAdminController.php
require_once '../dao/SanPhamDAO.php';

class OrderAdminController {
    private $sanphamDAO;

    public function __construct($conn) {
        $this->sanphamDAO = new SanPhamDAO($conn);
    }

    public function handleAction($action, $idsanpham, $status, $page) {
        if ($action == 'update') {
            $this->sanphamDAO->updateProductStatus($idsanpham, $status);
            header("Location: order_admin_view.php?page=" . ($page + 1));  // Corrected path
            exit();
        }
    }

    public function getTotalPages() {
        return $this->sanphamDAO->getTotalPages();
    }

    public function getProducts($search, $page) {
        return $this->sanphamDAO->getProducts($search, $page);
    }
}
?>
