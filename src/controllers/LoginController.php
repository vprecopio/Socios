<?php
require_once '../models/Database.php';
require_once '../models/User.php';  
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if (!empty($usuario) && !empty($contraseña)) {
        $database = new Database();
        $db = $database->connect();
        
        $stmt = $db->prepare("SELECT * FROM login WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contraseña, $user['contra'])) {
            $_SESSION['usuario'] = $user;
            $_SESSION['id_rol'] = $user['id_rol']; // Guardamos el rol
            $_SESSION['id_socio'] = $user['id_socio'];
        
            if ($user['id_rol'] == 1) {
                header("Location: ../views/inicio.php"); // Vista de administrador
            } elseif ($user['id_rol'] == 2) {
                header("Location: ../views/VistaSocio.php"); // Vista para socio
            } else {
                header("Location: ../index.php");
            }
            exit();
        } 
        else {
            header("Location: ../index.php?error=Usuario o contraseña incorrectos");
            exit();
        }
    } else {
        header("Location: ../index.php?error=Por favor, completa todos los campos");
        exit();
    }
}
?>
