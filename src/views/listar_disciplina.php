<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../assets/stylev6.css">
</head>

<body id="top">
    <?php include "../views/navbar.php"; ?>
    <h2><br>Listado de Socios - <?php echo htmlspecialchars($nombreDisciplina); ?></h2>

    <?php if (empty($socios)): ?>
        <h1 style="text-align: center;">No hay socios inscriptos en esta disciplina.</h1>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Género</th>
                    <th>Correo Electrónico</th>
                    <th>Fecha Nacimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($socios as $socio): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($socio['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($socio['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($socio['dni']); ?></td>
                        <td><?php echo htmlspecialchars($socio['genero']); ?></td>
                        <td><?php echo htmlspecialchars($socio['correo_electronico']); ?></td>
                        <td><?php echo htmlspecialchars($socio['fecha_nacimiento']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br>
    <p style="text-align: center;"><a href="../views/actividades_admin.php">Volver a actividades</a></p>
</body>
