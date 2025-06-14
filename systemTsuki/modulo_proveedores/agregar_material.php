<?php
include '../conexion.php';

$nombre = $_POST['nombre_material'] ?? '';

if (empty($nombre)) {
    echo json_encode(['success' => false, 'message' => 'Nombre vacío']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO materiales (nombre_material) VALUES (?)");
$stmt->bind_param("s", $nombre);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al insertar']);
}

$stmt->close();
$conn->close();
