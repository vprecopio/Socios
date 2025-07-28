<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}
require_once 'navbar_socio.php';
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
    </div>
</div>
