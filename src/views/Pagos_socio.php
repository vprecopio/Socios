<?php
require_once '../models/PagoModel.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}

$pagoModel = new Pago();
$pagosRealizados = $pagoModel->obtenerPagosPorSocio($_SESSION['usuario']['id_socio']);
$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$mesActual = date('n');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagos del Socio</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
    <script>
        function pagarMes(mes) {
                if (confirm('¿Seguro que desea pagar ' + mes + '?')) {
                    fetch('../controllers/PagoController.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'mes=' + mes
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const btn = document.getElementById('btn-' + mes);
                            btn.textContent = 'Pagado';
                            btn.disabled = true;
                            btn.classList.remove('btn-pagar');
                            btn.classList.add('btn-pagado');
                        } else {
                        alert('Error al registrar el pago.');
                    }
                });
            }
        }   
    </script>
</head>
<body>
<?php include 'navbar_socio.php'; ?>

<main class="bienvenida-centro">
    <h2>Pagos del Año <?php echo date('Y'); ?></h2>
    <div class="pagos-grid">
        <?php for ($i = $mesActual - 1; $i < 12; $i++): 
            $mes = $meses[$i];
            $pagado = in_array($mes, $pagosRealizados);
        ?>
        <div class="pago-card">
            <span class="mes-label"><?php echo $mes; ?></span>
            <button id="btn-<?php echo $mes; ?>"
                class="<?php echo $pagado ? 'btn-pagado' : 'btn-pagar'; ?>"
                onclick="pagarMes('<?php echo $mes; ?>')"
                <?php echo $pagado ? 'disabled' : ''; ?>>
                <?php echo $pagado ? 'Pagado' : 'Pagar'; ?>
            </button>
        </div>
            <?php endfor; ?>
    </div>

</main>

</body>
</html>
