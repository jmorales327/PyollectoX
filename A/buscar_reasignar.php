<?php
include 'conexion.php';

$sql = "SELECT Id, Placa, Rango, Nombre, Apellido, Telefono FROM personal WHERE Rango = 'Reasignar' AND Nombre = 'Reasignar' AND Apellido = 'Reasignar'";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultados);
?>
