<?php
$dsn = "mysql:host=localhost;dbname=sistema_login;charset=utf8mb4";
$usuario_db = "root";
$password_db = "";

try {
    $pdo = new PDO($dsn, $usuario_db, $password_db, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>