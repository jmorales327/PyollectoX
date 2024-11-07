<?php
include 'conexion.php';

$sql = "SELECT Id FROM personal WHERE nombre = 'Reasignar' ORDER BY Id ASC LIMIT 1";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$espacioVacio = $stmt->fetch(PDO::FETCH_ASSOC);

if ($espacioVacio) {
    $idDisponible = $espacioVacio['Id'];
} else {
    $sql = "SELECT MAX(Id) AS max_id FROM personal";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $idDisponible = $resultado['max_id'] + 1;
}

echo json_encode(['id' => $idDisponible]);
?>

