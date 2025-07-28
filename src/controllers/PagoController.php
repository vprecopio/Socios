<?php
require_once '../models/PagoModel.php';
session_start();

$pagoModel = new Pago();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mes'])) {
    $mes = $_POST['mes'];
    $id_socio = $_SESSION['usuario']['id_socio'] ?? null;

    if ($id_socio && $pagoModel->registrarPago($id_socio, $mes)) {
        echo json_encode(['success' => true, 'mes' => $mes]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}
?>
