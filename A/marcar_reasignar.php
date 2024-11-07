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

    if (!isset($data['id'])) {
        echo json_encode(['error' => 'ID no proporcionado']);
        exit;
    }

    // Actualizar los campos Rango, Nombre y Apellido con "Reasignar"
    $stmt = $pdo->prepare("UPDATE personal SET Rango = 'Reasignar', Nombre = 'Reasignar', Apellido = 'Reasignar' WHERE Id = :id");
    $stmt->execute([':id' => $data['id']]);

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>

