<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
</head>
<body>
    <main>
        <div class="container">
            <h2>Recuperar contraseña</h2>
            <form action="../controllers/RecuperarContraController.php" method="POST">
                <label for="email">Correo electrónico registrado</label>
                <input type="email" name="email" required>
                <button type="submit">Enviar enlace</button>
            </form>
        </div>
    </main>
</body>
</html>
