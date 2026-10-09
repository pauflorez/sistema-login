<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'usuario') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tarjeta">
        <h2>Bienvenido Usuario:<br><span style="color: #007bff;"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span></h2>
        <p>Este es tu panel estándar.</p>
        <a href="logout.php" style="display: block; margin-top: 20px; padding: 10px; background-color: #dc3545; color: white; border-radius: 5px;">Cerrar Sesión</a>
    </div>
</body>
</html>
