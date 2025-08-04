<?php
require_once '../models/Socio.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

$id_socio = $_GET['id_socio'] ?? null;

if (!$id_socio) {
    header("Location: CrudSocio.php");
    exit();
}

$socioModel = new Socio();
$socio = $socioModel->getById($id_socio);
if (!$socio) {
    echo "Socio no encontrado.";
    exit();
}

$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Pago</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<main class="formulario-centro">
    <h2>Registrar pago a <?php echo $socio['nombre'] . ' ' . $socio['apellido']; ?></h2>
    <form action="../controllers/PagoAdminController.php" method="POST">
        <input type="hidden" name="id_socio" value="<?php echo $id_socio; ?>">
        <input type="hidden" name="correo" value="<?php echo $socio['correo_electronico']; ?>">
        <input type="hidden" name="nombre" value="<?php echo $socio['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $socio['apellido']; ?>">

        <label>Mes a pagar:</label>
        <select name="mes" required>
            <?php foreach ($meses as $mes): ?>
                <option value="<?php echo $mes; ?>"><?php echo $mes; ?></option>
            <?php endforeach; ?>
        </select>

        <label>Monto (AR$):</label>
        <input type="number" name="monto" step="0.01" required>

        <label>Medio de pago:</label>
        <select name="medio_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
            <option value="mercado_pago">Mercado Pago</option>
        </select>

        <button type="submit" name="accion" value="registrar_admin">Confirmar Pago</button>
    </form>
</main>
</body>
</html>
