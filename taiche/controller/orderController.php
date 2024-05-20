<?php
class OrderController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function showOrders($search, $page) {
        $limit = 10; // Number of records per page
        $offset = $page * $limit;
        $search = $this->conn->real_escape_string($search);

        $query = "SELECT * FROM `sanpham` WHERE `idsanpham` LIKE '%$search%' LIMIT $limit OFFSET $offset";
        $result = mysqli_query($this->conn, $query);
        
        $countQuery = "SELECT COUNT(*) as total FROM `sanpham` WHERE `idsanpham` LIKE '%$search%'";
        $countResult = mysqli_query($this->conn, $countQuery);
        $totalRecords = mysqli_fetch_assoc($countResult)['total'];
        $totalPage = ceil($totalRecords / $limit);

        return ['orders' => $result, 'totalpage' => $totalPage];
    }
}
?>
