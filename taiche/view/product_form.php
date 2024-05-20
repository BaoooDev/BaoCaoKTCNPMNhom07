<?php
session_start();
include 'header.php';
require_once '../controller/ProductController.php';
require_once '../config/connect.php';

$catelog = mysqli_query($conn, "SELECT * FROM catelog");

$error = '';
$success = '';
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success = 'Thêm sản phẩm thành công.   
                Hãy gửi thiết bị về địa chỉ của chúng tôi:12 Nguyễn Văn Bảo phường 4 Quận Gò Vấp TP.HCM.
                Để được xem xét đánh giá thiết bị và đưa ra một mức giá hợp lý
    ';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new ProductController($conn);
    $error = $controller->addProduct();
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
                <h3 class="card-title">Thêm mới sản phẩm</h3>
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
                        <label for="catelogid">Tên nhãn hàng</label>
                        <select name="catelogid" id="catelogid" class="form-control">
                            <option value="">Chọn Nhãn Hàng</option>
                            <?php foreach ($catelog as $row): ?>
                                <option value="<?php echo $row['catelogid']; ?>"><?php echo $row['catelogname']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tensanpham">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="tensanpham" name="tensanpham" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="tinhtrang">Tình trạng</label>
                        <select class="form-control" id="tinhtrang" name="tinhtrang">
                            <option value="">Chọn tình trạng</option>
                            <?php
                            $query = "SELECT DISTINCT tinhtrang FROM sanpham";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['tinhtrang'] . "'>" . $row['tinhtrang'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="noidung">Mô tả</label>
                        <input type="text" class="form-control" id="noidung" name="noidung" placeholder="Nhập mô tả">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
                    </div>
                    <div class="form-group">
                        <label for="nganhang">Ngân Hàng</label>
                        <input type="text" class="form-control" id="nganhang" name="nganhang" placeholder="Nhập tên ngân hàng - STK ngân hàng (BIDV - 011223344)">
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="mt-5 bg-dark text-white text-center py-3">
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
