<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_SESSION['id_socio'])) {
    die("⚠️ Error: No hay ID de socio en la sesión. Iniciá sesión nuevamente.");
}

require_once '../models/Socio.php';

$id_socio = $_SESSION['id_socio'];

$socioModel = new Socio();
$carnet = $socioModel->obtenerCarnet($id_socio);

if (!$carnet) {
    $carnet = [
        'nombre' => 'No disponible',
        'apellido' => 'No disponible',
        'dni' => 'No disponible',
        'categoria' => 'No disponible'
    ];
}

require_once '../views/carnet.php';
