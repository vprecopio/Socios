<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}
require_once '../views/navbar.php';
?>

<link rel="stylesheet" href="../assets/stylev6.css">
<main>
    <div class="form-container">
        <h2>Agregar Nueva Actividad</h2>
        <form action="../controllers/AgregarActividadController.php" method="POST">
            <label for="nombre">Nombre de la actividad:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="dias">Días:</label>
            <input type="text" id="dias" name="dias" required>

            <label for="horarios">Horarios:</label>
            <input type="text" id="horarios" name="horarios" required>

            <label for="sector">Sector:</label>
            <input type="text" id="sector" name="sector" required>

            <label for="lugar">Se realiza en:</label>
            <input type="text" id="lugar" name="lugar" required>

            <button type="submit" class="btn">Agregar</button>
        </form>
    </div>
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
