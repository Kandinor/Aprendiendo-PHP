<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'auth_db';
    private $username = 'auth_db';
    private $password = 'auth_db';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Error de conexión: ' . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
