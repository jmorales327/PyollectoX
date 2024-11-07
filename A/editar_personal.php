<?php
$host = 'localhost';
$port = 3325;
$dbname = 'dniinventario';
$user = 'root';
$password = '1919';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'], $data['placa'], $data['rango'], $data['nombre'], $data['apellido'], $data['telefono'])) {
        echo json_encode(['error' => 'Datos incompletos']);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE personal SET Placa = :placa, Rango = :rango, Nombre = :nombre, Apellido = :apellido, Telefono = :telefono WHERE Id = :id");
    $stmt->execute([
        ':placa' => $data['placa'],
        ':rango' => $data['rango'],
        ':nombre' => $data['nombre'],
        ':apellido' => $data['apellido'],
        ':telefono' => $data['telefono'],
        ':id' => $data['id']
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'No se realizaron cambios en el registro.']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
