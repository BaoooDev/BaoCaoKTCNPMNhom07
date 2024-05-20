<?php
include 'header_admin.php';
require_once '../controller/NhanHangController.php';
require_once '../config/connect.php';

$nhanHangController = new NhanHangController($conn);
$catelog = $nhanHangController->getAllCatelog();

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['catelogname'];
    if (empty($name)) {
        $error = 'Tên nhãn hàng không được để trống';
    } else {
        if ($nhanHangController->addCatelog($name)) {
            $success = 'Thêm sản phẩm thành công';
            $catelog = $nhanHangController->getAllCatelog(); // Cập nhật danh sách nhãn hàng sau khi thêm mới
        } else {
            $error = 'Có lỗi, vui lòng thử lại';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Thêm mới nhãn hàng</h3>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label for="catelogname">Tên nhãn hàng</label>
                        <input type="text" class="form-control" id="catelogname" name="catelogname" placeholder="Nhập tên nhãn hàng">
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Danh sách nhãn hàng</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên nhãn hàng</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- duyệt dữ liệu sử dụng vòng lặp foreach -->
                        <?php foreach ($catelog as $row) : ?>
                            <tr>
                                <td><?php echo $row['catelogid']; ?></td>
                                <td><?php echo $row['catelogname']; ?></td>
                                <td><?php echo $row['status'] == 1 ? 'Đang hoạt động' : 'Khóa'; ?></td>
                                <td>
                                <a href="../view/edit_nhan_hang.php?Catid=<?php echo $row['catelogid']; ?>" class="btn btn-xs btn-primary">Sửa</a>
                                    <form action="../view/delete_nhan_hang.php" method="POST" style="display: inline;">
                                        <input type="hidden" name="catelogid" value="<?php echo $row['catelogid']; ?>">
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhãn hàng này không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="mt-5 bg-dark text-white text-center py-3">
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
