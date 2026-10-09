<?php
require 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $tipo = $_POST['tipo']; // 'admin' o 'usuario'

    // Elegir la tabla correspondiente
    $tabla = ($tipo === 'admin') ? 'administradores' : 'usuarios';

    try {
        $stmt = $pdo->prepare("INSERT INTO $tabla (usuario, password) VALUES (?, ?)");
        $stmt->execute([$usuario, $password]);
        $mensaje = "¡Cuenta creada exitosamente como " . htmlspecialchars($tipo) . "!";
    } catch (PDOException $e) {
        $mensaje = "Error: El usuario ya existe o hubo un problema al registrar.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cuentas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Crear Cuenta</h2>
    
    <?php if ($mensaje): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre de usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Tipo de cuenta:</label><br>
        <select name="tipo">
            <option value="usuario">Usuario normal</option>
            <option value="admin">Administrador</option>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>

    <br>
    <a href="login.php">Ir a Iniciar Sesión</a>
</body>
</html>
