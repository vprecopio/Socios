<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}
include 'navbar_socio.php';
?>

<link rel="stylesheet" href="../assets/stylev6.css">

<div class="deporte-container">
    <h2>Basquet</h2>
    <p class="descripcion">
    El basquetbol al ser un deporte de equipo nos permite llevar adelante la actividad basada en juegos recreativos y deportivos cuyo principal objetivo es que chicos y chicas aprendan los valores del deporte y puedan desarrollarlos tanto dentro como fuera de la cancha, valores como la inclusión social, la solidaridad, el compañerismo y la igualdad.
    </p>

    <div class="info-deporte">
        <table>
            <tr><td><strong>Días:</strong></td><td>Lunes a Viernes</td></tr>
            <tr><td><strong>Horarios:</strong></td><td>8 a 22 hs</td></tr>
            <tr><td><strong>Sector:</strong></td><td>Sede Social – Gimnasio de Boxeo Oscar «Ringo» Bonavena.2</td></tr>
            <tr><td><strong>Se realiza en:</strong></td><td>Calle Falsa 123, Springfield</td></tr>
        </table>
    </div>

    <form method="POST" action="../controllers/InscripcionController.php" onsubmit="return confirmarInscripcion();">
        <input type="hidden" name="id_tipo_disciplina" value="2">
        <button type="submit" class="btn-inscribirse">Inscribirse</button>
    </form>

    <script>
        function confirmarInscripcion() {
        return confirm("¿Estás seguro que deseas inscribirte en esta disciplina?");
        }
    </script>

</div>
