<?php
class OrderDAO {
    public function fetchOrders($search, $page, $conn) {
        $offset = $page * 12;
        $totalpage = 0;

        // Query to get total pages
        $sql = "SELECT CEIL(COUNT(*) / 12) AS 'totalpage' FROM `sanpham`";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $totalpage = (int)$row['totalpage'];
        }

        // Query to fetch products
        $sql = "SELECT * FROM `sanpham`";
        if (!empty($search)) {
            $sql .= " WHERE idsanpham LIKE '%$search%'";
        }
        $sql .= " LIMIT $offset, 12";
        $result = mysqli_query($conn, $sql);

        return ['orders' => $result, 'totalpage' => $totalpage];
    }
}
?>
