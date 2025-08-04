<?php
require_once '../models/PagoModel.php';
require_once __DIR__ . '/../libs/PHPMailer/Mailer.php';
require_once '../models/ComprobantePDF.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'registrar_admin') {
    $id_socio = $_POST['id_socio'] ?? null;
    $mes = $_POST['mes'] ?? '';
    $monto = $_POST['monto'] ?? 0;
    $medio_pago = $_POST['medio_pago'] ?? 'efectivo';

    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';

    $pagoModel = new Pago();
    $fecha_pago = date('Y-m-d H:i:s');
    $id_pago = $pagoModel->registrarPago($id_socio, $mes, $monto, $medio_pago);

    if ($id_pago) {
        
        Mailer::enviarComprobantePago($correo, $nombre, $apellido, $mes, $monto, $medio_pago, $fecha_pago, $id_pago);
        header("Location: ../views/CrudSocio.php?exito=1");
        exit;
    } else {
        header("Location: ../views/CrudSocio.php?error=1");
        exit;
    }
}
