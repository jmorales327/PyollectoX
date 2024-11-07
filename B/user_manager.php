<?php
// Configuración de la conexión
$host = 'localhost';
$usuarioDB = 'root';
$contrasenaDB = '1919';
$nombreDB = 'dniinventario';
$puerto = 3325;

$conexion = new mysqli($host, $usuarioDB, $contrasenaDB, $nombreDB, $puerto);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Configuración del encabezado para JSON
header('Content-Type: application/json');

// Función para manejar respuestas
function responder($exito, $mensaje, $datos = null) {
    echo json_encode([
        "success" => $exito,
        "message" => $mensaje,
        "data" => $datos
    ]);
    exit;
}

// Verificar que la acción esté definida
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'read':
        $result = $conexion->query("SELECT * FROM usuarios");
        if ($result) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            responder(true, "Usuarios cargados correctamente", $users);
        } else {
            responder(false, "Error al cargar usuarios: " . $conexion->error);
        }
        break;

    case 'create':
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $contrasena = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if ($nombre && $apellido && $usuario && $contrasena) {
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, usuario, contrasena) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $apellido, $usuario, $contrasena);
            if ($stmt->execute()) {
                responder(true, "Usuario creado exitosamente");
            } else {
                responder(false, "Error al crear usuario: " . $stmt->error);
            }
            $stmt->close();
        } else {
            responder(false, "Todos los campos son obligatorios para crear un usuario.");
        }
        break;

    case 'update':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $contrasena = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if ($id && $nombre && $apellido && $usuario && $contrasena) {
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre=?, apellido=?, usuario=?, contrasena=? WHERE id=?");
            $stmt->bind_param("ssssi", $nombre, $apellido, $usuario, $contrasena, $id);
            if ($stmt->execute()) {
                responder(true, "Usuario actualizado exitosamente");
            } else {
                responder(false, "Error al actualizar usuario: " . $stmt->error);
            }
            $stmt->close();
        } else {
            responder(false, "Todos los campos son obligatorios para actualizar un usuario.");
        }
        break;

    case 'delete':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id=?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                responder(true, "Usuario eliminado exitosamente");
            } else {
                responder(false, "Error al eliminar usuario: " . $stmt->error);
            }
            $stmt->close();
        } else {
            responder(false, "ID es requerido para eliminar un usuario.");
        }
        break;

    default:
        responder(false, "Acción no válida.");
        break;
}

// Cerrar la conexión
$conexion->close();
?>
