<?php
class NhanHangDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCatelog() {
        $query = "SELECT * FROM catelog";
        return mysqli_query($this->conn, $query);
    }

    public function addCatelog($name) {
        $query = "INSERT INTO catelog(catelogname) VALUES('$name')";
        return mysqli_query($this->conn, $query);
    }
    public function deleteCatelog($id) {
        $stmt = $this->conn->prepare("DELETE FROM catelog WHERE catelogid = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function editCatelog($id, $name)
    {
        $query = "UPDATE catelog SET catelogname = ? WHERE catelogid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getCatelogById($id)
{
    $stmt = $this->conn->prepare("SELECT * FROM catelog WHERE catelogid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

}
?>
