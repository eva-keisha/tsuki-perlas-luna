<?php
include("conexion.php"); // Asegúrate de que el archivo está en la ubicación correcta

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el ID del producto fue enviado
    if (isset($_POST["id_producto"])) {
        $id_producto = $conn->real_escape_string($_POST["id_producto"]);

        // Consulta para eliminar el producto
        $sql = "DELETE FROM productos WHERE id_producto = '$id_producto'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "message" => "Producto eliminado correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al eliminar el producto: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "ID de producto no proporcionado."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Solicitud inválida."]);
}

$conn->close();
?>
