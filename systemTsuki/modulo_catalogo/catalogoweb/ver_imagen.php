<?php
// Ajuste de ruta para conexión
require '../../conexion.php'; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Consulta para obtener la imagen
    $sql = "SELECT imagen FROM productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($imagen);
        $stmt->fetch();

        // Enviar imagen con cabecera correcta
        header("Content-Type: image/jpeg");
        echo $imagen;
    } else {
        echo "Imagen no encontrada.";
    }

    $stmt->close();
}
$conn->close();
?>
