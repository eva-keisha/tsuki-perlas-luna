<?php
require "../conexion.php"; // Asegúrate de que el archivo de conexión es correcto

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_usuario"])) {
    $id_usuario = intval($_POST["id_usuario"]);
    $nombre_usuario = $_POST["nombre_usuario"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"]; // Corregido el error tipográfico
    $rol = $_POST["rol"];

    // Verificar si la conexión es válida
    if (!$conn) {
        echo json_encode(["success" => false, "message" => "Error en la conexión a la base de datos"]);
        exit;
    }

    $sql = "UPDATE usuarios SET nombre_usuario = ?, correo = ?, contraseña = ?, rol = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ssssi", $nombre_usuario, $correo, $contraseña, $rol, $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar el usuario: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Solicitud inválida"]);
}

$conn->close();
?>
