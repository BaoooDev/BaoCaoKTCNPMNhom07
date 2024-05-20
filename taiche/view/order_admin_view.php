<?php
include '../view/header_admin.php';
require_once '../config/connect.php';
require_once '../controller/OrderAdminController.php';

$search = "";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
}

$page = 0;
if (isset($_GET["page"])) {
    $page = max(0, $_GET["page"] - 1); // Ensure the page number is never negative
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

$orderAdminController = new OrderAdminController($conn);

if (!empty($action)) {
    $idsanpham = isset($_GET['idsanpham']) ? $_GET['idsanpham'] : '';
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $orderAdminController->handleAction($action, $idsanpham, $status, $page);
}

$totalpage = $orderAdminController->getTotalPages();
$result = $orderAdminController->getProducts($search, $page);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Đặt phòng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var scrollPosition = localStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, scrollPosition);
                localStorage.removeItem('scrollPosition');
            }
        });

        function saveScrollPosition() {
            localStorage.setItem('scrollPosition', window.scrollY);
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách tất cả các sản phẩm</h3>
            </div>
            <div class="panel-body">
                <form action="order_admin_view.php" method="GET" class="form-inline mb-3">
                    <label for="idsanpham" class="mr-2">Tìm kiếm sản phẩm bằng mã:</label>
                    <input type="text" id="idsanpham" name="search" value="<?php echo $search; ?>" class="form-control mr-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <input type="hidden" name="page" value="<?php echo $page + 1; ?>">
                </form>
            </div>

            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID sản phẩm</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Nhãn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Tình trạng</th>
                            <th>Nội dung</th>
                            <th>STK Ngân Hàng</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['idsanpham']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['catelogname']; ?></td>
                                <td><?php echo $row['tensanpham']; ?></td>
                                <td><?php echo $row['tinhtrang']; ?></td>
                                <td><?php echo $row['noidung']; ?></td>
                                <td><?php echo $row['nganhang']; ?></td>
                                <td>
                                    <span class="current-price"><?php echo $row['gia']; ?></span>
                                    <?php if ($row['status'] == 'Đã nhận') { ?>
                                        <a href="suasanpham.php?idsanpham=<?php echo $row['idsanpham']; ?>" class="btn btn-primary btn-sm">Báo giá</a>
                                    <?php } ?>
                                </td>
                                <td>
                                <?php
                                    switch ($row['status']) {
                                        case 'Chờ duyệt':
                                            echo '<a href="order_admin_view.php?action=update&idsanpham=' . $row['idsanpham'] . '&status=Đã nhận&page=' . ($page + 1) . '&search=' . $search . '" class="btn btn-info btn-sm" onclick="saveScrollPosition()">Đã nhận</a>';
                                            break;
                                        case 'Đã nhận':
                                            echo '<a href="order_admin_view.php?action=update&idsanpham= ' . $row['idsanpham'] . '&status=Hoàn thành&page=' . ($page + 1) . '&search=' . $search . '" class="btn btn-success btn-sm" onclick="saveScrollPosition()">Hoàn Thành</a>';
                                            break;
                                        case 'Hoàn thành':
                                            echo '<a href="order_admin_view.php?action=update&idsanpham=' . $row['idsanpham'] . '&status=Tái chế&page=' . ($page + 1) . '&search=' . $search . '" class="btn btn-warning btn-sm" onclick="saveScrollPosition()">Tái chế</a>';
                                            echo '<a href="order_admin_view.php?action=update&idsanpham=' . $row['idsanpham'] . '&status=Bán lại&page=' . ($page + 1) . '&search=' . $search . '" class="btn btn-primary btn-sm" onclick="saveScrollPosition()">Bán lại</a>';
                                            break;
                                        case 'Tái chế':
                                                echo '<span class="btn btn-success btn-sm disabled">Tái chế</span>';
                                                break;
                                        case 'Bán lại':
                                                echo '<span class="btn btn-success btn-sm disabled">Bán lại</span>';
                                                break;
                                        case 'Hủy':
                                            echo '<span class="btn btn-danger btn-sm disabled">Hủy</span>';
                                            break;
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $totalpage; $i++) { ?>
                            <li class="page-item <?php echo ($i == $page + 1) ? 'active' : ''; ?>">
                                <a class="page-link" href='order_admin_view.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>'><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } else {
                echo "<p>Không có sản phẩm nào.</p>";
            } ?>
        </div>
    </div>
</body>
</html>
