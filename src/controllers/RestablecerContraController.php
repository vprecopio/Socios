<?php
require_once '../models/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_socio = $_POST['id_socio'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($pass !== $confirm) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        exit;
    }
    
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $pass)) {
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.'); window.history.back();</script>";
        exit;
    }    
    
    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT correo_electronico FROM socios WHERE id_socio = :id_socio");
    $stmt->bindParam(':id_socio', $id_socio);
    $stmt->execute();
    $socio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$socio) {
        echo "<script>alert('Socio no encontrado.'); window.location.href = '../index.php';</script>";
        exit;
    }

    $hashed = password_hash($pass, PASSWORD_DEFAULT);
    $usuario = $socio['correo_electronico'];

    $stmt = $conn->prepare("UPDATE login SET contra = :contra WHERE usuario = :usuario");
    $stmt->bindParam(':contra', $hashed);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM activaciones WHERE id_socio = :id_socio");
    $stmt->bindParam(':id_socio', $id_socio);
    $stmt->execute();

    echo "<script>alert('Contraseña restablecida correctamente.'); window.location.href = '../index.php';</script>";
    exit;
}
