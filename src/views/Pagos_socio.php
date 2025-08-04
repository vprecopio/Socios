<?php
require_once '../models/PagoModel.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}

$pagoModel = new Pago();
$id_socio = $_SESSION['usuario']['id_socio'];

$pagosRealizadosDetalles = $pagoModel->obtenerPagosDetallesPorSocio($id_socio);

$pagosRealizados = [];
foreach ($pagosRealizadosDetalles as $p) {
    $pagosRealizados[$p['mes']] = $p;
}

$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$mesActual = date('n');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Pagos</title>
    <link rel="stylesheet" href="../assets/stylev6.css">
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #0284c7;
            color: white;
        }
        tr.pago-realizado {
            background-color: #d1f7d1;
        }
        tr.pago-pendiente {
            background-color: #f7d1d1;
        }
        .btn-pagar {
            background-color: #0284c7;
            border: none;
            color: white;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-pagar:disabled {
            background-color: #555;
            cursor: not-allowed;
        }
        .center {
            text-align: center;
            margin-top: 30px;
            font-size: 1.2em;
            color: #444;
        }
    </style>
</head>
<body>
<?php include 'navbar_socio.php'; ?>

<main>
    <h2 style="text-align:center; margin-top: 20px;">Historial de Pagos - Año <?php echo date('Y'); ?></h2>
    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Estado</th>
                <th>Fecha de Pago</th>
                <th>Monto (AR$)</th>
                <th>Medio de Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            for ($i = 0; $i < 12; $i++):
                $mes = $meses[$i];
                if (isset($pagosRealizados[$mes])) {
                    $pago = $pagosRealizados[$mes];
                    $estado = "Pagado";
                    $fecha_pago = date('d/m/Y H:i', strtotime($pago['fecha_pago']));
                    $monto = number_format($pago['monto'], 2, ',', '.');
                    $medio_pago = ucfirst(str_replace('_', ' ', $pago['medio_pago']));
                    $claseFila = "pago-realizado";
                    $botonPagar = '-';
                } else {
                    $estado = "Pendiente";
                    $fecha_pago = '-';
                    $monto = '-';
                    $medio_pago = '-';
                    $claseFila = "pago-pendiente";

                    $botonPagar = '-';
                }
            ?>
            <tr class="<?php echo $claseFila; ?>">
                <td><?php echo $mes; ?></td>
                <td><?php echo $estado; ?></td>
                <td><?php echo $fecha_pago; ?></td>
                <td><?php echo $monto; ?></td>
                <td><?php echo $medio_pago; ?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <?php if (count($pagosRealizados) === 0): ?>
        <p class="center">No se encontraron pagos registrados para este año.</p>
    <?php endif; ?>
</main>

</body>
</html>
