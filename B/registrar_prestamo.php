
<?php
include 'conexion.php';

$sql = "SELECT * FROM prestamos";
$result = $conn->query($sql);

$equipos = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $equipos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($equipos);

$conn->close();
?>
