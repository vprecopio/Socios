<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/stylev5.css">
    <script>
        function mostrarAlerta(mensaje) {
            alert(mensaje);
        }
    </script>
</head>
<body class="body-login">
    <div class="container">
        <h2>Iniciar Sesión</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <script>
                mostrarAlerta("<?php echo htmlspecialchars($_GET['error']); ?>");
            </script>
        <?php endif; ?>
        
        <form action="controllers/LoginController.php" method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" required>
            
            <label for="contraseña">Contraseña</label>
            <input type="password" name="contraseña" required>
            
            <button type="submit">Ingresar</button>
        </form>
        <p><a href="views/RecuperarContra.php">¿Olvidaste tu contraseña?</a></p>
    </div>
</body>
</html>
