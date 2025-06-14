<?php
include '../conexion.php';

$id = $_GET['id'] ?? 0;

// Obtener datos del proveedor
$stmt = $conn->prepare("SELECT * FROM proveedores WHERE id_proveedor = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$proveedor = $result->fetch_assoc();
$stmt->close();

// Obtener materiales asociados
$sql = "SELECT id_material FROM proveedor_material WHERE id_proveedor = $id";
$res = $conn->query($sql);
$materiales = [];
while ($row = $res->fetch_assoc()) {
    $materiales[] = (int)$row['id_material'];
}

$proveedor['materiales'] = $materiales;

echo json_encode($proveedor);
$conn->close();
