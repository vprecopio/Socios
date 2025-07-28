<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        $this->host = getenv('MYSQL_HOST') ?: 'db'; // nombre del servicio MySQL en docker-compose
        $this->db_name = getenv('MYSQL_DATABASE') ?: 'mi_base';
        $this->username = getenv('MYSQL_USER') ?: 'usuario';
        $this->password = getenv('MYSQL_PASSWORD') ?: 'clave';
    }

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
