<?php
session_start();
require 'conexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    // 1. Buscar primero en la tabla de administradores
    $stmtAdmin = $pdo->prepare("SELECT * FROM administradores WHERE usuario = ?");
    $stmtAdmin->execute([$usuario]);
    $admin = $stmtAdmin->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['usuario_id'] = $admin['id'];
        $_SESSION['nombre'] = $admin['usuario'];
        $_SESSION['rol'] = 'admin';
        header('Location: panel_admin.php');
        exit;
    }

    // 2. Si no está en administradores, buscar en usuarios
    $stmtUser = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmtUser->execute([$usuario]);
    $user = $stmtUser->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['nombre'] = $user['usuario'];
        $_SESSION['rol'] = 'usuario';
        header('Location: panel_usuario.php');
        exit;
    }

    $error = "Usuario o contraseña incorrectos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <?php if ($error): ?>
        <p style="color: red;"><strong><?php echo $error; ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
</body>
</html>