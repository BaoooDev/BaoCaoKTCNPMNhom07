<?php
// File: SanPhamController.php

require_once '../dao/SanPhamDAO.php';

class SanPhamController {
    private $sanPhamDAO;

    public function __construct($conn) {
        $this->sanPhamDAO = new SanPhamDAO($conn);
    }

    public function getProducts($search, $page) {
        $offset = max(0, ($page - 1) * 12);
        return $this->sanPhamDAO->getProducts($search, $offset, 12);
    }

    public function getTotalPages() {
        return $this->sanPhamDAO->getTotalPages();
    }
}
?>