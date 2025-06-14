<?php
include '../conexion.php';
header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID de proveedor no recibido']);
    exit;
}

$id = intval($_POST['id']);

$conn->begin_transaction();
try {
    $conn->query("DELETE FROM proveedor_material WHERE id_proveedor = $id");
    $conn->query("DELETE FROM proveedores WHERE id_proveedor = $id");
    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Proveedor eliminado correctamente']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
$conn->close();

?>
