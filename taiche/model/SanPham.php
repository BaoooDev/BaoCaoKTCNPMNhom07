<?php
class SanPham {
    private $catelogid;
    private $tensanpham;
    private $tinhtrang;
    private $noidung;
    private $gia;
    private $phone;
    private $email;
    private $nganhang;

    public function __construct($catelogid, $tensanpham, $tinhtrang, $noidung, $gia, $phone, $email, $nganhang) {
        $this->catelogid = $catelogid;
        $this->tensanpham = $tensanpham;
        $this->tinhtrang = $tinhtrang;
        $this->noidung = $noidung;
        $this->gia = $gia;
        $this->phone = $phone;
        $this->email = $email;
        $this->nganhang = $nganhang;
    }

    public function getCatelogid() { return $this->catelogid; }
    public function getTensanpham() { return $this->tensanpham; }
    public function getTinhtrang() { return $this->tinhtrang; }
    public function getNoidung() { return $this->noidung; }
    public function getGia() { return $this->gia; }
    public function getPhone() { return $this->phone; }
    public function getEmail() { return $this->email; }
    public function getNganhang() { return $this->nganhang; }
}
?>
