<?php
// Detalles de conexión a la base de datos
$host = 'localhost';
$dbname = 'dniinventario';
$user = 'root';
$password = '1919';
$port = 3325;

try {
    // Crear una conexión PDO
    $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("set names utf8");
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
