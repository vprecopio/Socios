<?php
require_once "../models/Database.php";

$token = $_GET['token'] ?? '';
if (empty($token)) {
    die("Token no válido.");
}

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT id_socio FROM activaciones WHERE token = :token");
$stmt->bindParam(":token", $token);
$stmt->execute();
$datos = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$datos) {
    die("Token inválido o expirado.");
}

$id_socio = $datos['id_socio'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
</head>
<body>
<main>
    <div class="container">
        <h2>Restablecer contraseña</h2>
        <form action="../controllers/RestablecerContraController.php" method="POST">
            <input type="hidden" name="id_socio" value="<?php echo htmlspecialchars($id_socio); ?>">
            <label for="password">Nueva Contraseña</label>
            <input type="password" name="password" required>
            <label for="confirm">Confirmar Contraseña</label>
            <input type="password" name="confirm" required>
            <button type="submit">Guardar nueva contraseña</button>
        </form>
    </div>
</main>
</body>
</html>
