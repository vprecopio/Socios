<?php
require_once '../models/Database.php';
require_once '../models/ActivacionModel.php';

$activacionModel = new ActivacionModel();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    $id_socio = $activacionModel->obtenerIdSocioPorToken($token);

    if (!$id_socio) {
        echo "<script>alert('Token inválido o expirado.'); window.location.href = '../index.php';</script>";
        exit;
    }

    include '../views/ActivarCuenta.php';
    exit;
}

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
    $usuario = $socio['correo_electronico'] ?? null;

    if (!$usuario) {
        echo "<script>alert('Socio no encontrado.'); window.location.href = '../index.php';</script>";
        exit;
    }

    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO login (usuario, contra, id_rol, id_socio) 
                            VALUES (:usuario, :contra, 2, :id_socio)");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contra', $hashed);
    $stmt->bindParam(':id_socio', $id_socio);
    $stmt->execute();

    $activacionModel->eliminarToken($id_socio);

    echo "<script>alert('Cuenta activada. Ya podés iniciar sesión.'); window.location.href = '../index.php';</script>";
    exit;
}
?>
