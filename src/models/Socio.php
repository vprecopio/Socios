<?php
include_once "Database.php"; 

class Socio {
    private $conn;
    private $table_name = "socios";

    public $id_socio;
    public $nombre;
    public $apellido;
    public $dni;
    public $genero;
    public $correo_electronico;
    public $fecha_nacimiento;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellido, dni, genero, correo_electronico, fecha_nacimiento) 
                  VALUES (:nombre, :apellido, :dni, :genero, :correo_electronico, :fecha_nacimiento)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":correo_electronico", $this->correo_electronico);
        $stmt->bindParam(":fecha_nacimiento", $this->fecha_nacimiento);
    
        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); 
        }
    
        return false;
    }    
    
    public function obtenerNombreApellidoPorUsuario($usuario) {
        $query = "SELECT s.nombre, s.apellido
                  FROM login l
                  INNER JOIN socios s ON l.id_socio = s.id_socio
                  WHERE l.usuario = :usuario";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

    public function obtenerCarnet($id_socio) {
        $query = "SELECT s.nombre, s.apellido, s.dni, tc.nombre AS categoria
                  FROM socios s
                  LEFT JOIN categorias c ON s.id_socio = c.id_socio
                  LEFT JOIN tipo_categoria tc ON c.id_tipo_categoria = tc.id_tipo_categoria
                  WHERE s.id_socio = :id_socio";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_socio', $id_socio, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

    public function getById($id_socio) {
        $stmt = $this->conn->prepare("SELECT * FROM socios WHERE id_socio = ?");
        $stmt->execute([$id_socio]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    

}
?>