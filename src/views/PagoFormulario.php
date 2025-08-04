<?php
session_start();
$mes = $_GET['mes'] ?? '';
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2 || empty($mes)) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Pago</title>
    <link rel="stylesheet" href="../assets/stylev6.css">
</head>
<body>
<?php include 'navbar_socio.php'; ?>

<main class="formulario-centro">
    <h2>Formulario de pago - <?php echo htmlspecialchars($mes); ?></h2>
    <form action="../controllers/PagoController.php" method="POST">
        <input type="hidden" name="mes" value="<?php echo htmlspecialchars($mes); ?>">
        <label>Monto (AR$):</label>
        <input type="number" name="monto" step="0.01" required>

        <label>Medio de pago:</label>
        <select name="medio_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
            <option value="mercado_pago">Mercado Pago</option>
        </select>

        <button type="submit" name="accion" value="registrar">Confirmar Pago</button>
    </form>
</main>
</body>
</html>
