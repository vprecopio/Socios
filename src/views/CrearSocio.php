<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Socio</title>
    <link rel="stylesheet" href="../assets/stylev6.css">
</head>
<body id="top">
    <?php include "../views/navbar.php"; ?>

    <main>
        <div class="container">
            <h2>Registrar Nuevo Socio</h2>
            <form action="../controllers/SocioController.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required style="text-transform: capitalize">
                
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required style="text-transform: capitalize">
                
                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni" required pattern="\d{8}" maxlength="8" title="El DNI debe tener 8 dígitos numéricos">
     
                <label for="genero">Género</label>
                <select id="genero" name="genero" required>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                
                <label for="correo_electronico">Correo Electrónico</label>
                <input type="email" id="correo_electronico" name="correo_electronico" required>
                
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                
                <button type="submit" name="action" value="crear_socio">Registrar Socio</button>
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

</body>
</html>
