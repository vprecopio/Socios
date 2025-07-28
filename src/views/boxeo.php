<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php");
    exit();
}
include 'navbar_socio.php';
?>

<link rel="stylesheet" href="../assets/stylev5.css">

<div class="deporte-container">
    <h2>Boxeo</h2>
    <p class="descripcion">
        El boxeo es un deporte de combate donde dos personas se enfrentan en un ring utilizando solo sus puños para golpear al oponente, con el objetivo de noquearlo o ganar por decisión de los jueces. Se desarrolla en asaltos con un tiempo definido y bajo ciertas reglas.
    </p>

    <div class="info-deporte">
        <table>
            <tr><td><strong>Días:</strong></td><td>Lunes a Viernes</td></tr>
            <tr><td><strong>Horarios:</strong></td><td>8 a 22 hs</td></tr>
            <tr><td><strong>Sector:</strong></td><td>Sede Social – Gimnasio de Boxeo Oscar «Ringo» Bonavena.2</td></tr>
            <tr><td><strong>Se realiza en:</strong></td><td>Calle Falsa 123, Springfield</td></tr>
        </table>
    </div>

    <div class="body-login2">
        <form method="POST" action="../controllers/InscripcionController.php" onsubmit="return confirmarInscripcion();">
            <input type="hidden" name="id_tipo_disciplina" value="1">
            <button type="submit" class="btn-inscribirse">Inscribirse</button>
        </form>
    </div>  

    <script>
        function confirmarInscripcion() {
        return confirm("¿Estás seguro que deseas inscribirte en esta disciplina?");
        }
    </script>

</div>
