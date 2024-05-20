<?php
include_once '../dao/CustomerDAO.php';

class CustomerController {
    public function registerUser($name, $phone, $address, $email, $username, $password) {
        $customerDAO = new CustomerDAO();
        $result = $customerDAO->addUser($name, $phone, $address, $email, $username, $password);
        return $result;
    }
}
?>
