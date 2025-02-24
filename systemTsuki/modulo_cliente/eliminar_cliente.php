<?php
require "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_cliente"])) {
    $id_cliente = intval($_POST["id_cliente"]);

    $sql = "DELETE FROM clientes WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cliente);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el cliente"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Solicitud inválida"]);
}

$conn->close();
?>
