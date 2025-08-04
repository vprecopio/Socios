<?php
require_once 'Database.php';

class ActividadModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function agregarActividad($nombre, $dias, $horarios, $sector, $lugar) {
        $stmt = $this->conn->prepare("
            INSERT INTO tipo_disciplina (nombre, dias, horarios, sector, lugar) 
            VALUES (:nombre, :dias, :horarios, :sector, :lugar)
        ");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':dias', $dias);
        $stmt->bindParam(':horarios', $horarios);
        $stmt->bindParam(':sector', $sector);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->execute();
    }

    public function obtenerTodasLasActividades() {
        $stmt = $this->conn->query("SELECT * FROM tipo_disciplina");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
