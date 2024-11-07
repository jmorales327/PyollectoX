<?php
session_start();
include 'db.php'; // Incluir el archivo de conexión

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

$query = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    $host = $_SERVER['HTTP_HOST']; // Detección automática del host
    header("Location: http://$host/C/inicio.php");
    exit;
} else {
    header("Location: index.php?error=1");
    exit;
}
?>
