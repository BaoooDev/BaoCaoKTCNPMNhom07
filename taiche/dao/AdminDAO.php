<?php
class AdminDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function login($username, $password) {
        $sql = "SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
