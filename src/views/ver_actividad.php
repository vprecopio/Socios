<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}
require_once '../models/ActividadModel.php';
include 'navbar_socio.php';

$id = $_GET['id'] ?? null;
$model = new ActividadModel();
$actividades = $model->obtenerTodasLasActividades();

$actividad = null;
foreach ($actividades as $a) {
    if ($a['id_tipo_disciplina'] == $id) {
        $actividad = $a;
        break;
    }
}
if (!$actividad) {
    echo "Actividad no encontrada.";
    exit();
}
?>

<link rel="stylesheet" href="../assets/stylev5.css">

<div class="deporte-container">
    <h2><?= htmlspecialchars($actividad['nombre']) ?></h2>

    <div class="info-deporte">
        <table>
            <tr><td><strong>Días:</strong></td><td><?= htmlspecialchars($actividad['dias']) ?></td></tr>
            <tr><td><strong>Horarios:</strong></td><td><?= htmlspecialchars($actividad['horarios']) ?></td></tr>
            <tr><td><strong>Sector:</strong></td><td><?= htmlspecialchars($actividad['sector']) ?></td></tr>
            <tr><td><strong>Se realiza en:</strong></td><td><?= htmlspecialchars($actividad['lugar']) ?></td></tr>
        </table>
    </div>

    <form method="POST" action="../controllers/InscripcionController.php" onsubmit="return confirmarInscripcion();">
        <input type="hidden" name="id_tipo_disciplina" value="<?= $actividad['id_tipo_disciplina'] ?>">
        <button type="submit" class="btn-inscribirse">Inscribirse</button>
    </form>

    <script>
        function confirmarInscripcion() {
            return confirm("¿Estás seguro que deseas inscribirte en esta disciplina?");
        }
    </script>
</div>
