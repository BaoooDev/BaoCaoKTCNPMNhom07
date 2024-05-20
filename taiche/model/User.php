// model/User.php
<?php
class User {
    private $username;
    private $password;

    public function __construct($data) {
        $this->username = $data['username'];
        $this->password = $data['matKhau'];
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
}
?>
