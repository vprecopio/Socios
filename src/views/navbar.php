<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}

$nombreUsuario = 'Admin';
?>

<nav class="navbar">
    <ul>
        <li><a href="inicio.php">Inicio</a></li>
        <li><a href="CrearSocio.php">Crear Socio</a></li>
        <li><a href="CrudSocio.php">Listado de Socio</a></li>
        <li><a href="actividades_admin.php">Actividades</a></li>
        <li><a href="../views/AgregarActividad.php">Agregar Actividad</a></li>
        <li><a href="Pagos_admin.php">Pagos</a></li>
        <li class="user-menu">
            <a href="#" onclick="toggleUserMenu(event)">
                <img src="../assets/user-icon.png" alt="Usuario" class="user-icon">
            </a>
            <div class="dropdown" id="userDropdown">
                <p><?php echo htmlspecialchars($nombreUsuario); ?></p>
                <a href="../controllers/LogoutController.php">Cerrar Sesión</a>
            </div>
        </li>
    </ul>
</nav>
