<?php
// db.php - Archivo de conexión a la base de datos

$host = "localhost";
$port = "3325";
$dbname = "dniinventario";
$username = "root";
$password = "1919";

$conexion = new mysqli($host, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>




