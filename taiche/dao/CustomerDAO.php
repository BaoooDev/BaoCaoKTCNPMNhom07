<?php
include_once '../config/connect.php';

class CustomerDAO {
    public function addUser($name, $phone, $address, $email, $username, $password) {
        global $conn;
        $password = md5($password);
        $sql = "INSERT INTO `khachang`(`tenkhachhang`, `phone`, `address`, `email`, `username`, `matKhau`) VALUES ('$name','$phone','$address','$email','$username','$password')";
        $dk_sql = mysqli_query($conn, $sql);
        return $dk_sql;
    }
}
?>
