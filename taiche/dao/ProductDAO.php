<?php
class ProductDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertProduct($data) {
        $idnhanhang = $data['catelogid'];
        $tensp = $data['tensanpham'];
        $status= 'Chờ duyệt';
        $tinhtrang = $data['tinhtrang'];
        $noidung = $data['noidung'];
        $price = $data['gia'];
        $phone = $data['phone'];
        $email = $data['email'];
        $nh = $data['nganhang'];
        $idkhachhang=$data['idkhachhang'];

        $sql = "INSERT INTO `sanpham`(`catelogid`, `tensanpham`, `tinhtrang`, `noidung`, `gia`, `phone`, `email`, `nganhang`,`status`,`idkhachhang`) 
                VALUES ('$idnhanhang','$tensp','$tinhtrang', '$noidung', '$price', '$phone', '$email', '$nh','$status','$idkhachhang')";
        return mysqli_query($this->conn, $sql);
    }
}
?>
