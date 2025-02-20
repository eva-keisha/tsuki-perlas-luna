<?php
require 'conexion.php';  // Asegúrate de que tu conexión a la base de datos está bien configurada

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    
    // Manejo de la imagen
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen'];
        $nombreImagen = time() . "_" . basename($imagen["name"]); // Evita nombres duplicados
        $rutaDestino = "uploads/" . $nombreImagen;  // Asegúrate de que 'uploads/' tenga permisos de escritura

        if (move_uploaded_file($imagen["tmp_name"], $rutaDestino)) {
            $sql = "UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, stock=?, categoria=?, imagen=? WHERE id_producto=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdissi", $nombre, $descripcion, $precio, $stock, $categoria, $rutaDestino, $id_producto);
        } else {
            echo json_encode(["success" => false, "message" => "Error al mover la imagen"]);
            exit();
        }
    } else {
        // Si no se sube una nueva imagen, solo actualizar los otros campos
        $sql = "UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, stock=?, categoria=? WHERE id_producto=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $nombre, $descripcion, $precio, $stock, $categoria, $id_producto);
    }

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error en la consulta"]);
    }

    $stmt->close();
    $conn->close();
}
?>
