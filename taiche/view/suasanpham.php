<?php
include 'header_admin.php';
require_once '../config/connect.php';

$id = !empty($_GET['idsanpham']) ? (int)$_GET['idsanpham'] : 0;
$result = mysqli_query($conn, "SELECT idsanpham, catelogid, tensanpham, tinhtrang, noidung, gia, status FROM sanpham WHERE idsanpham = $id");
$rowCustomer = mysqli_fetch_assoc($result);

$error = '';
if (isset($_POST['idsanpham'])) {
    $name = $_POST['tensanpham'];
    $dob = $_POST['tinhtrang'];
    $address = $_POST['noidung'];
    $phone = $_POST['gia'];
    $email = $_POST['status'];

    // Validate input fields if needed

    // Update the customer information
    $sql = "UPDATE sanpham SET tensanpham = '$name', tinhtrang = '$dob', noidung = '$address', gia = '$phone', status = '$email' WHERE idsanpham = $id";
    if (mysqli_query($conn, $sql)) {
        header('location: ../view/order_admin_view.php');
    } else {
        $error = 'Có lỗi, vui lòng thử lại';
    }
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Chỉnh sửa thông tin khách hàng</h3>
    </div>
    <div class="panel-body">
        <form action="" method="POST" role="form">
            <div class="form-group">
                <label for="">id sản phẩm</label>
                <input type="text" class="form-control" name="idsanpham" value="<?php echo isset($rowCustomer['idsanpham']) ? $rowCustomer['idsanpham'] : ''; ?>" readonly>
            </div>
            <input type="hidden" name="tensanpham" value="<?php echo isset($rowCustomer['tensanpham']) ? $rowCustomer['tensanpham'] : ''; ?>">
            <input type="hidden" name="tinhtrang" value="<?php echo isset($rowCustomer['tinhtrang']) ? $rowCustomer['tinhtrang'] : ''; ?>">
            <input type="hidden" name="noidung" value="<?php echo isset($rowCustomer['noidung']) ? $rowCustomer['noidung'] : ''; ?>">
            
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" class="form-control" name="gia" value="<?php echo isset($rowCustomer['gia']) ? $rowCustomer['gia'] : ''; ?>">
            </div>

            <input type="hidden" name="status" value="<?php echo isset($rowCustomer['status']) ? $rowCustomer['status'] : ''; ?>">
            
            <button type="submit" class="btn btn-primary">Lưu lại</button>
        </form>
    </div>
</div>
