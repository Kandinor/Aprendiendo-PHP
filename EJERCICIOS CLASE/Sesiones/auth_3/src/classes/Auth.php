<?php
class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($email, $password) {
        $user = new User($this->conn);
        $user->email = $email;
        $user->password = $password;

        return $user->create();
    }

    public function activateUser($token) {
        $user = new User($this->conn);
        $user->token = $token;

        return $user->activate();
    }

    public function login($email, $password) {
        $user = new User($this->conn);
        $user->email = $email;
        $user->password = $password;

        if ($user->login()) {
            session_start();
            $_SESSION['user_email'] = $email;
            return true;
        }

        return false;
    }

    public function sendPasswordReset($email) {
        // Implementar la lógica de envío de correo electrónico con el token de restablecimiento
        return true;
    }
}
?>
