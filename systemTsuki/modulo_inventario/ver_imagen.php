<?php
include("../conexion.php"); // Ajuste de ruta

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Evita inyecciones SQL

    $sql = "SELECT imagen FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($imagen);
        $stmt->fetch();

        // Si la imagen se guarda como RUTA en la BD, carga el archivo
        if (file_exists($imagen)) {
            $mime = mime_content_type($imagen); // Detecta el tipo de imagen
            header("Content-Type: $mime");
            readfile($imagen);
        } else {
            echo "Imagen no encontrada.";
        }
    } else {
        echo "Imagen no encontrada.";
    }

    $stmt->close();
}
$conn->close();
?>
