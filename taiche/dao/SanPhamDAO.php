<?php
// SanPhamDAO.php

class SanPhamDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTotalPages() {
        $sql = "SELECT CEIL((SELECT COUNT(*) FROM `sanpham`) / 12) AS 'totalpage'";
        $result = mysqli_query($this->conn, $sql);
        $totalpage = 0;
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalpage = $row["totalpage"];
        }
        return $totalpage;
    }

    public function getProducts($search, $page) {
        $offset = max(0, $page * 12);
        $sql = "SELECT sanpham.*, catelog.catelogname FROM `sanpham`";
        $sql .= " LEFT JOIN catelog ON sanpham.catelogid = catelog.catelogid";
        if (!empty($search)) {
            $sql .= " WHERE sanpham.idsanpham = '$search'";
        }
        $sql .= " LIMIT $offset, 12";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function updateProductStatus($idsanpham, $status) {
        $update_sql = "UPDATE sanpham SET status='$status' WHERE idsanpham='$idsanpham'";
        mysqli_query($this->conn, $update_sql);
    }
}
?>
