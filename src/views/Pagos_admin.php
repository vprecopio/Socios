<?php
require_once '../models/PagoModel.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

$pagoModel = new Pago();
$mes = $_GET['mes'] ?? null;
$pagos = $mes ? $pagoModel->obtenerPagosPorMes($mes) : [];
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagos de Socios</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<main class="bienvenida-centro">
    <h2>Seleccione un mes</h2>
    <div class="meses-grid">
        <?php foreach ($meses as $m): ?>
            <div class="mes-card">
                <a href="?mes=<?php echo $m; ?>"><?php echo $m; ?></a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($mes): ?>
        <h3>Socios que pagaron en <?php echo $mes; ?>:</h3>
        <table>
            <tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Fecha de Pago</th></tr>
            <?php foreach ($pagos as $p): ?>
                <tr>
                    <td><?php echo $p['nombre']; ?></td>
                    <td><?php echo $p['apellido']; ?></td>
                    <td><?php echo $p['dni']; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($p['fecha_pago'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>

    <script>
            function toggleUserMenu(event) {
            event.preventDefault();
            const dropdown = document.getElementById("userDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            }   

            document.addEventListener("click", function(event) {
                const dropdown = document.getElementById("userDropdown");
                const userMenu = document.querySelector(".user-menu");
                if (!userMenu.contains(event.target)) {
                    dropdown.style.display = "none";
                }
            });
    </script>

</body>
</html>
