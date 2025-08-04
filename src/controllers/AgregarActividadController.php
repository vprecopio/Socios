<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

require_once '../models/ActividadModel.php';

$nombre = $_POST['nombre'] ?? '';
$dias = $_POST['dias'] ?? '';
$horarios = $_POST['horarios'] ?? '';
$sector = $_POST['sector'] ?? '';
$lugar = $_POST['lugar'] ?? '';

if ($nombre && $dias && $horarios && $sector && $lugar) {
    $model = new ActividadModel();
    $model->agregarActividad($nombre, $dias, $horarios, $sector, $lugar);
    header('Location: ../views/actividades_admin.php');
} else {
    echo "Todos los campos son obligatorios.";
}
