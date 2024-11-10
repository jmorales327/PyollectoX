<?php
include 'conexion.php'; // Asegúrate de que este archivo esté en la misma carpeta

if (isset($_GET['placa'])) {
    $placa = $_GET['placa'];

    $stmt = $conn->prepare("SELECT nombre, apellido, rango FROM personal WHERE placa = ?");
    $stmt->bind_param("s", $placa);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $solicitante = $result->fetch_assoc();
        echo json_encode($solicitante);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
    $conn->close();
}
?>
