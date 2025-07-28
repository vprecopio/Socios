<?php
require_once '../models/Database.php';
require_once '../libs/PHPMailer/Mailer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    if (empty($email)) {
        echo "<script>alert('Correo requerido.'); window.history.back();</script>";
        exit;    
    }

    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT id_socio, nombre, apellido FROM socios WHERE correo_electronico = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $socio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$socio) {
        echo "<script>alert('Correo no encontrado.'); window.history.back();</script>";
        exit;
    }

    $token = bin2hex(random_bytes(32));

    $stmt = $conn->prepare("INSERT INTO activaciones (id_socio, token) VALUES (:id_socio, :token)
                            ON DUPLICATE KEY UPDATE token = :token");
    $stmt->execute([
        ':id_socio' => $socio['id_socio'],
        ':token' => $token
    ]);

    Mailer::enviarCorreoRecuperacion(
        $email,
        $socio['nombre'],
        $socio['apellido'],
        $token
    );

    echo "<script>alert('Revisá tu correo para restablecer la contraseña.'); window.location.href = '../index.php';</script>";    exit;
}
