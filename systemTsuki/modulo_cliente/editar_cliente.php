<?php
require "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_cliente"])) {
    $id_cliente = intval($_POST["id_cliente"]);
    $nombre_cliente = $_POST["nombre_cliente"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];

    $sql = "UPDATE clientes SET nombre_cliente = ?, correo = ?, telefono = ?, direccion = ? WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre_cliente, $correo, $telefono, $direccion, $id_cliente);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar el cliente"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Solicitud inválida"]);
}

$conn->close();
?>
