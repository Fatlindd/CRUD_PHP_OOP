<?php
include_once 'lib/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registerUser($name, $username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `register` (`name`, `username`, `email`, `password`) VALUES ('$name', '$username', '$email', '$hashedPassword')";
        return $this->db->executeQuery($query);     
    }

    public function loginUser($email, $password) {
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "SELECT * FROM `register` WHERE `email`= '$email'";
        } 

        $result = $this->db->executeQuery($query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['data'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                return true; // Login successful
            }
        }
        return false; // Login failed
    }

    public function logoutUser() {
        session_start();
        session_destroy();
        return true;
    }

    public function isLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    public function isUserAdmin() {
        session_start();
        return isset($_SESSION['data']);
    }
}
?>
