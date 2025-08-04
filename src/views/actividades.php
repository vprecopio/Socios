<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}
require_once 'navbar_socio.php';
require_once '../models/ActividadModel.php';
$model = new ActividadModel();
$actividades = $model->obtenerTodasLasActividades();
?>

<link rel="stylesheet" href="../assets/stylev5.css">

<div class="contenedor-actividades">
    <h2 class="titulo-actividades">Actividades</h2>

    <div class="cards-actividades">
        
        <div class="card-actividad" onclick="location.href='boxeo.php'">
            <img src="../assets/guantes.png" alt="Boxeo">
            <h3>Boxeo</h3>
        </div>

        <div class="card-actividad" onclick="location.href='basquet.php'">
            <img src="../assets/pelota.png" alt="Basquet">
            <h3>Basquet</h3>
        </div>

        <div class="card-actividad" onclick="location.href='voley.php'">
            <img src="../assets/voley.png" alt="Voley">
            <h3>Voley</h3>
        </div>

        <?php foreach ($actividades as $actividad): ?>
            <?php if ($actividad['id_tipo_disciplina'] > 3): ?>
                <div class="card-actividad" onclick="location.href='ver_actividad.php?id=<?= $actividad['id_tipo_disciplina'] ?>'">
                    <img src="../assets/default.png" alt="<?= htmlspecialchars($actividad['nombre']) ?>">
                    <h3><?= htmlspecialchars($actividad['nombre']) ?></h3>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

