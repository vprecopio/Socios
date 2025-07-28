<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}

require_once '../models/Socio.php';

$socioModel = new Socio();
$usuario = $_SESSION['usuario']['usuario'];

$socio = $socioModel->obtenerNombreApellidoPorUsuario($usuario);

$nombreCompleto = $socio 
    ? $socio['nombre'] . ' ' . $socio['apellido'] 
    : htmlspecialchars($usuario);
