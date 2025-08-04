<?php
require_once '../models/PagoModel.php';
require_once __DIR__ . '/../libs/PHPMailer/Mailer.php';
session_start();

$pagoModel = new Pago();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'registrar') {
    $id_socio = $_SESSION['usuario']['id_socio'] ?? null;
    $nombre = $_SESSION['usuario']['nombre'] ?? '';
    $apellido = $_SESSION['usuario']['apellido'] ?? '';
    $correo = $_SESSION['usuario']['correo_electronico'] ?? '';

    $mes = $_POST['mes'] ?? '';
    $monto = $_POST['monto'] ?? 0;
    $medio_pago = $_POST['medio_pago'] ?? 'efectivo';

    if ($id_socio && $mes && $pagoModel->registrarPago($id_socio, $mes, $monto, $medio_pago)) {
       
        Mailer::enviarComprobantePago($correo, $nombre, $apellido, $mes, $monto, $medio_pago);
        header("Location: ../views/Pagos_socio.php?exito=1");
        exit;
    } else {
        header("Location: ../views/Pagos_socio.php?error=1");
        exit;
    }
}
