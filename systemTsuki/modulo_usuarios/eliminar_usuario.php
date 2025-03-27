<?php
require "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_usuario"])) {
    $id_usuario = intval($_POST["id_usuario"]);

    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al eliminar el usuario"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Solicitud inválida"]);
}

$conn->close();
?>


<?php
require 'conexion.php';

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
    $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el usuario']);
    }
}
?>
