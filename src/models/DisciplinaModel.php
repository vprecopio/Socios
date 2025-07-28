<?php
require_once 'Database.php';

class DisciplinaModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getSociosPorDisciplina($id_tipo_disciplina) {
        $stmt = $this->conn->prepare("
            SELECT s.nombre, s.apellido, s.dni, s.genero, s.correo_electronico, s.fecha_nacimiento
            FROM socios s
            INNER JOIN disciplinas d ON s.id_socio = d.id_socio
            WHERE d.id_tipo_disciplina = :id_tipo_disciplina
        ");
        $stmt->bindParam(':id_tipo_disciplina', $id_tipo_disciplina, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNombreDisciplina($id_tipo_disciplina) {
        $stmt = $this->conn->prepare("SELECT nombre FROM tipo_disciplina WHERE id_tipo_disciplina = :id");
        $stmt->bindParam(':id', $id_tipo_disciplina, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['nombre'] ?? 'Desconocida';
    }
}
