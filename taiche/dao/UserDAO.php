// dao/UserDAO.php
<?php
include_once '../config/connect.php';
include_once '../model/User.php';

class UserDAO {
    public function getUserByUsernameAndPassword($username, $password) {
        global $conn;
        $sql = "SELECT * FROM `khachang` WHERE username = '$username' AND `matKhau` = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return new User($result->fetch_assoc());
        } else {
            return null;
        }
    }
}
?>
