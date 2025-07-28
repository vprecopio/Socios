<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registrarUsuario($usuario, $contraseña, $id_rol) {
        try {
            
            $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);
    
            $sql = "INSERT INTO login (usuario, contra, id_rol) VALUES (:usuario, :contra, :id_rol)";
    
            $conn = $this->db->connect();
            
            $stmt = $conn->prepare($sql);
    
            $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->bindValue(':contra', $hashed_password, PDO::PARAM_STR);
            $stmt->bindValue(':id_rol', $id_rol, PDO::PARAM_INT);
    
            var_dump($usuario, $hashed_password, $id_rol);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
}
?>