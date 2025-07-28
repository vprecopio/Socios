<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}
include 'navbar.php'; // navbar del admin
?>

<link rel="stylesheet" href="../assets/stylev5.css">

<div class="contenedor-actividades">
    <h2 class="titulo-actividades">Actividades - Panel Admin</h2>

    <div class="cards-actividades">
        <div class="card-actividad" onclick="location.href='../controllers/ActividadesAdminController.php?disciplina=1'">
            <img src="../assets/guantes.png" alt="Boxeo">
            <h3>Boxeo</h3>
        </div>

        <div class="card-actividad" onclick="location.href='../controllers/ActividadesAdminController.php?disciplina=2'">
            <img src="../assets/pelota.png" alt="Básquet">
            <h3>Basquet</h3>
        </div>

        <div class="card-actividad" onclick="location.href='../controllers/ActividadesAdminController.php?disciplina=3'">
            <img src="../assets/voley.png" alt="Voley">
            <h3>Voley</h3>
        </div>
    </div>
</div>

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
