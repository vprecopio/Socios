<?php
require_once 'Database.php';

class ActivacionModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function obtenerIdSocioPorToken($token) {
        $stmt = $this->conn->prepare("SELECT id_socio FROM activaciones WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado['id_socio'] ?? null;
    }

    public function eliminarToken($id_socio) {
        $stmt = $this->conn->prepare("DELETE FROM activaciones WHERE id_socio = :id_socio");
        $stmt->bindParam(':id_socio', $id_socio);
        return $stmt->execute();
    }
}
?>
