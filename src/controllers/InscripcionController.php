<?php
session_start();
require_once '../models/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_socio = $_SESSION['id_socio'];
    $id_tipo_disciplina = $_POST['id_tipo_disciplina']; // Enviás el ID ahora

    $db = new Database();
    $pdo = $db->connect();

    $stmt = $pdo->prepare("SELECT * FROM disciplinas WHERE id_socio = ? AND id_tipo_disciplina = ?");
    $stmt->execute([$id_socio, $id_tipo_disciplina]);
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Ya estás inscripto en esta disciplina.'); window.location.href = '../views/actividades.php';</script>";
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO disciplinas (id_socio, id_tipo_disciplina) VALUES (?, ?)");
    $stmt->execute([$id_socio, $id_tipo_disciplina]);

    echo "<script>alert('Inscripción realizada con éxito.'); window.location.href = '../views/actividades.php';</script>";
    exit();
}
