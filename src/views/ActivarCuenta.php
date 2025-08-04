<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Activar Cuenta</title>
    <link rel="stylesheet" href="../assets/stylev6.css">
</head>
<body>
<main>
    <div class="container">
        <h2>Activá tu cuenta</h2>
        <form action="../controllers/ActivarCuentaController.php" method="POST">
            <input type="hidden" name="id_socio" value="<?php echo htmlspecialchars($id_socio); ?>">
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>

            <label for="confirm">Repetir Contraseña</label>
            <input type="password" name="confirm" required>

            <button type="submit">Establecer contraseña</button>
        </form>
    </div>
</main>
</body>
</html>
