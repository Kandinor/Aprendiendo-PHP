<?php
class User {
    private $conn;
    private $table_name = 'users';

    public $id;
    public $email;
    public $password;
    public $token;
    public $active;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET email=:email, password=:password, token=:token, active=0";
        
        $stmt = $this->conn->prepare($query);
        
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $this->token = bin2hex(random_bytes(16));
        
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':token', $this->token);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function activate() {
        $query = "UPDATE " . $this->table_name . " SET active=1 WHERE token=:token";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':token', $this->token);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email=:email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                if ($row['active'] == 1) {
                    return true;
                }
            }
        }

        return false;
    }
}
?>
