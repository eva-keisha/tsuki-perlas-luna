<?php
include '../conexion.php';

$id = $_POST['id_proveedor'];
$nombre = $_POST['nombre'];
$contacto = $_POST['contacto'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$materiales = $_POST['materiales'] ?? [];

// Actualizar proveedor
$stmt = $conn->prepare("UPDATE proveedores SET nombre = ?, contacto = ?, telefono = ?, email = ?, direccion = ? WHERE id_proveedor = ?");
$stmt->bind_param("sssssi", $nombre, $contacto, $telefono, $email, $direccion, $id);
$success = $stmt->execute();
$stmt->close();

if ($success) {
    // Borrar materiales previos
    $conn->query("DELETE FROM proveedor_material WHERE id_proveedor = $id");

    // Insertar nuevos materiales
    $stmt = $conn->prepare("INSERT INTO proveedor_material (id_proveedor, id_material) VALUES (?, ?)");
    foreach ($materiales as $mat) {
        $stmt->bind_param("ii", $id, $mat);
        $stmt->execute();
    }
    $stmt->close();

    echo json_encode(['success' => true, 'message' => 'Proveedor actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar proveedor']);
}

$conn->close();
