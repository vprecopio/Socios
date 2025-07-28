<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include_once "../controllers/SocioController.php";
$socio = new Socio();
$socios = $socio->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Socios</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
    <script>
        function confirmarEliminacion(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este socio?")) {
                document.getElementById("eliminar-form-" + id).submit();
            }
        }
    </script>
</head>
<body id="top">
    <?php include "../views/navbar.php"; ?>
    <h2><br>Listado de Socios</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Género</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($socios as $s) { ?>
                <tr>
                    <td><?php echo $s["nombre"]; ?></td>
                    <td><?php echo $s["apellido"]; ?></td>
                    <td><?php echo $s["dni"]; ?></td>
                    <td><?php echo $s["genero"]; ?></td>
                    <td><?php echo $s["correo_electronico"]; ?></td>
                    <td>
                    <?php
                    $fechaOriginal = $s["fecha_nacimiento"];
                    $fechaFormateada = date("d/m/Y", strtotime($fechaOriginal));
                    echo $fechaFormateada;
                    ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

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