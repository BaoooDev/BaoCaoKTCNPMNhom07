<?php
require_once 'header.php';
require_once '../controller/OrderController.php';
require_once '../config/connect.php';

session_start(); // Bắt đầu session
$idkhachhang = isset($_SESSION['customer']['idkhachhang']) ? $_SESSION['customer']['idkhachhang'] : null; // Lấy idkhachhang từ session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thông tin đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 20px;
        }

        .pagination {
            justify-content: center;
        }

        .panel {
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .panel-heading {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
        }

        .panel-title {
            font-size: 1.2em;
            margin: 0;
        }

        .panel-body {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tình trạng sản phẩm</h3>
            </div>
            <div class="panel-body">
                <form action="order.php" method="GET" class="form-inline mb-3">
                    <label for="idsanpham" class="mr-2">Tìm kiếm sản phẩm bằng mã:</label>
                    <input type="text" id="idsanpham" name="search" class="form-control mr-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $page = isset($_GET['page']) ? (int)$_GET['page'] - 1 : 0;
                $page = max(0, $page);

                $orderController = new OrderController($conn);
                $result = $orderController->showOrders($search, $page);
                $orders = $result['orders'];
                $totalpage = $result['totalpage'];

                if (mysqli_num_rows($orders) > 0) {
                ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID sản phẩm</th>
                                <th>Nhãn hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Tình trạng</th>
                                <th>Nội dung</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($orders)) {
                                $catelogid = $row['catelogid'];
                                $query = "SELECT catelogname FROM catelog WHERE catelogid = $catelogid";
                                $result_category = mysqli_query($conn, $query);
                                $catelogname = ($result_category && mysqli_num_rows($result_category) > 0) ? mysqli_fetch_assoc($result_category)['catelogname'] : 'Unknown category';
                                $isOwner = $row['idkhachhang'] == $idkhachhang; // Kiểm tra xem sản phẩm có thuộc về user không
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['idsanpham']); ?></td>
                                    <td><?php echo htmlspecialchars($catelogname); ?></td>
                                    <td><?php echo htmlspecialchars($row['tensanpham']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tinhtrang']); ?></td>
                                    <td><?php echo htmlspecialchars($row['noidung']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gia']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                    <td>
                                        <?php if ($isOwner && $row['status'] == 'Đã nhận' && !empty($row['gia'])): ?>
                                            <form action="update_order_status.php" method="POST" class="d-inline">
                                                <input type="hidden" name="idsanpham" value="<?php echo htmlspecialchars($row['idsanpham']); ?>">
                                                <input type="hidden" name="action" value="accept">
                                                <button type="submit" class="btn btn-success btn-sm">Đồng ý</button>
                                            </form>
                                            <form action="update_order_status.php" method="POST" class="d-inline">
                                                <input type="hidden" name="idsanpham" value="<?php echo htmlspecialchars($row['idsanpham']); ?>">
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="btn btn-danger btn-sm">Từ chối</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalpage; $i++) {
                                echo "<li class='page-item " . (($i == $page + 1) ? 'active' : '') . "'><a class='page-link' href='?page=$i&search=$search'>$i</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                <?php
                } else {
                    echo "<p>Không có sản phẩm nào.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="mt-5">
        <?php require_once 'footer.php'; ?>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
