<?php
require_once '../dao/NhanHangDAO.php';

class NhanHangController {
    private $nhanHangDAO;

    public function __construct($conn) {
        $this->nhanHangDAO = new NhanHangDAO($conn);
    }

    public function getAllCatelog() {
        return $this->nhanHangDAO->getAllCatelog();
    }

    public function addCatelog($name) {
        return $this->nhanHangDAO->addCatelog($name);
    }
    public function deleteCatelog($id) {
        return $this->nhanHangDAO->deleteCatelog($id);
    }
    public function editCatelog($id, $name)
    {
        return $this->nhanHangDAO->editCatelog($id, $name);
    }
    public function getCatelogById($id)
{
    return $this->nhanHangDAO->getCatelogById($id);
}

}
?>
