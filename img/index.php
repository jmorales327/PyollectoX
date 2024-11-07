<?php
require_once 'db_connection.php';

$resultados = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campo = $_POST['campo'] ?? 'placa';
    $valor = $_POST['valor'] ?? '';
    $resultados = buscar($conn, $campo, $valor);
} else {
    // Obtener todos los registros al cargar la página
    $resultados = obtenerTodosLosRegistros($conn);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #0073e6;
            padding: 15px;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }
        .container {
            padding: 20px;
        }
        .search-form {
            margin: 20px 0;
        }
        .search-form select, 
        .search-form input, 
        .search-form button {
            padding: 8px;
            margin-right: 10px;
        }
        .search-form button {
            background-color: #0073e6;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">INICIO</a>
        <a href="#">BÚSQUEDA</a>
        <a href="#">FORMULARIO</a>
        <a href="#">REGISTROS</a>
        <a href="#">CONFIGURACIÓN</a>
    </div>

    <div class="container">
        <h2>Personal</h2>
        
        <form class="search-form" method="POST">
            <select name="campo">
                <option value="placa">Placa</option>
                <option value="rango">Rango</option>
                <option value="nombre">Nombre</option>
                <option value="apellido">Apellido</option>
            </select>
            <input type="text" name="valor" placeholder="Buscar..." value="<?php echo htmlspecialchars($_POST['valor'] ?? ''); ?>">
            <button type="submit">Buscar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Placa</th>
                    <th>Rango</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultados && $resultados->num_rows > 0) {
                    while ($row = $resultados->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['placa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['rango']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No se encontraron resultados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>