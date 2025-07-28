<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../controllers/NavbarSocioController.php';
?>

<nav class="navbar">
    <ul>
    <li><a href="../views/VistaSocio.php">Inicio</a></li>
    <li><a href="../controllers/CarnetController.php">Carnet</a></li>
        <li><a href="../views/actividades.php">Actividades</a></li>
        <li><a href="../views/Pagos_socio.php">Pagos</a></li>
        <li class="user-menu">
            <a href="#" onclick="toggleUserMenu(event)">
                <img src="../assets/user-icon.png" alt="Usuario" class="user-icon">
            </a>
            <div class="dropdown" id="userDropdown">
                <p><?= htmlspecialchars($nombreCompleto) ?></p>
                <a href="../controllers/LogoutController.php">Cerrar Sesión</a>
            </div>
        </li>
    </ul>
</nav>

<script>
    function toggleUserMenu(event) {
        event.preventDefault();
        event.stopPropagation();
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const userMenu = document.querySelector('.user-menu');
        if (!userMenu.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
</script>

<style>
    .dropdown {
    display: none;
    }
    .dropdown.show {
    display: block; 
    }
</style>