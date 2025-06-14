<?php
include '../conexion.php';

$id = $_POST['id_material'] ?? 0;

$stmt = $conn->prepare("DELETE FROM materiales WHERE id_material = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
