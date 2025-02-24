<?php
header("Content-Type: application/json");
$response = ["success" => false];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "../conexion.php"; // Archivo para la conexión a la base de datos

    $id = $_POST["productId"] ?? null;
    $nombre = $_POST["nombre"] ?? "";
    $descripcion = $_POST["descripcion"] ?? "";
    $precio = $_POST["precio"] ?? 0;
    $stock = $_POST["stock"] ?? 0;
    $categoria = $_POST["categoria"] ?? "";
    $imagen = $_FILES["imagen"] ?? null;

    if ($id && $nombre && $descripcion && $precio >= 0 && $stock >= 0 && $categoria) {
        try {
            // Manejo de imagen (opcional)
            $rutaImagen = null;
            if ($imagen && $imagen["error"] === UPLOAD_ERR_OK) {
                $directorioDestino = "uploads/";
                if (!file_exists($directorioDestino)) {
                    mkdir($directorioDestino, 0777, true);
                }
                $rutaImagen = $directorioDestino . basename($imagen["name"]);
                move_uploaded_file($imagen["tmp_name"], $rutaImagen);
            }

            // Preparar la consulta SQL
            $sql = "UPDATE productos SET 
                        nombre_producto = ?, 
                        descripcion = ?, 
                        precio = ?, 
                        stock = ?, 
                        categoria = ?";
            $params = [$nombre, $descripcion, $precio, $stock, $categoria];

            if ($rutaImagen) {
                $sql .= ", imagen = ?";
                $params[] = $rutaImagen;
            }
            $sql .= " WHERE id_producto = ?";
            $params[] = $id;

            $stmt = $conn->prepare($sql);
            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {
                $response["success"] = true;
                $response["message"] = "Producto actualizado correctamente.";
            } else {
                $response["message"] = "No se realizaron cambios o ID no encontrado.";
            }
        } catch (Exception $e) {
            $response["message"] = "Error en la actualización: " . $e->getMessage();
        }
    } else {
        $response["message"] = "Datos incompletos.";
    }
} else {
    $response["message"] = "Método no permitido.";
}

echo json_encode($response);
?>
