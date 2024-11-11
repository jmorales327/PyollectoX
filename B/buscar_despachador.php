<?php
include 'conexion.php'; // Asegúrate de que este archivo esté en la misma carpeta

if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];

    $stmt = $conn->prepare("SELECT nombre, apellido, puesto FROM despachadores WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $despachador = $result->fetch_assoc();
        echo json_encode($despachador);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
    $conn->close();
}
?>
