<?php
$host = 'localhost';
$port = 3325;
$dbname = 'dniinventario';
$user = 'root';
$password = '1919';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Contar el total de empleados (filas donde Nombre y Apellido no son "Reasignar")
    $totalPersonalStmt = $pdo->prepare("SELECT COUNT(*) FROM personal WHERE Nombre != 'Reasignar' AND Apellido != 'Reasignar'");
    $totalPersonalStmt->execute();
    $totalPersonal = $totalPersonalStmt->fetchColumn();

    // Contar el total de espacios vacíos para reasignar
    $totalReasignarStmt = $pdo->prepare("SELECT COUNT(*) FROM personal WHERE Nombre = 'Reasignar' AND Apellido = 'Reasignar'");
    $totalReasignarStmt->execute();
    $totalReasignar = $totalReasignarStmt->fetchColumn();

    echo json_encode([
        'totalPersonal' => $totalPersonal,
        'totalReasignar' => $totalReasignar
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
