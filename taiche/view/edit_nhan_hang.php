<?php
include '../view/header_admin.php';
require_once '../config/connect.php';
require_once '../controller/NhanHangController.php';

$nhanHangController = new NhanHangController($conn);

$id = !empty($_GET['Catid']) ? (int)$_GET['Catid'] : 0;
$row = $nhanHangController->getCatelogById($id);
$error = '';

if (!$row) {
    // Handle the case where no record is found for the given ID
    $error = 'Không tìm thấy dữ liệu cho ID đã cho.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['catelogname'];
    if (empty($name)) {
        $error = 'Tên nhãn hàng không được để trống';
    } else {
        if ($nhanHangController->editCatelog($id, $name)) {
            header('location: nhan_hang.php');
            exit();
        } else {
            $error = 'Có lỗi xảy ra khi chỉnh sửa nhãn hàng';
        }
    }
}
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Sửa nhãn hàng</h3>
    </div>
    <div class="panel-body">
        <?php if ($row): ?>
            <form action="" method="POST" role="form">
                <div class="form-group">
                    <label for="">Tên nhãn hàng</label>
                    <input type="text" class="form-control" name="catelogname" value="<?php echo isset($row['catelogname']) ? htmlspecialchars($row['catelogname']) : ''; ?>">
                    <?php if ($error) : ?>
                        <small class="help-block"><?php echo $error; ?></small>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </form>
        <?php else: ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</div>
