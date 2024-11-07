<?php
include 'conexion.php';

$columnasPermitidas = ['Placa', 'Nombre', 'Apellido', 'Reasignar', 'Rango', 'Telefono'];
$campo = $_GET['campo'] ?? 'Placa';

if (!in_array($campo, $columnasPermitidas)) {
    echo json_encode(['error' => 'Campo no válido']);
    exit;
}

$valor = $_GET['valor'] ?? '';
try {
    $sql = "SELECT Id, Placa, Rango, Nombre, Apellido, Telefono FROM personal WHERE $campo LIKE :valor";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue(':valor', '%' . $valor . '%');
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($resultados);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
