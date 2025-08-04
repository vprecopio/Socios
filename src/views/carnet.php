<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}
?>

<?php include 'navbar_socio.php'; ?>

<link rel="stylesheet" href="../assets/stylev6.css">

<div class="carnet">
    <div class="carnet-flex">
        <div class="carnet-info">
            <h2>Carnet de Socio</h2>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($carnet['nombre']) ?></p>
            <p><strong>Apellido:</strong> <?= htmlspecialchars($carnet['apellido']) ?></p>
            <p><strong>DNI:</strong> <?= htmlspecialchars($carnet['dni']) ?></p>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($carnet['categoria']) ?></p>
        </div>
        <div class="carnet-logo">
            <img src="../assets/logo-CADU.png" alt="Escudo CADU">
        </div>
    </div>
</div>
