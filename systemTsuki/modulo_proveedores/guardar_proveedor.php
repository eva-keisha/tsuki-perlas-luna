<?php
header('Content-Type: application/json');
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $tipo_proveedor = $_POST['tipo_proveedor'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $materiales = $_POST['materiales'] ?? [];

    if (empty($nombre) || empty($correo)) {
        echo json_encode(['success' => false, 'message' => 'Nombre y correo son obligatorios.']);
        exit;
    }

 $stmt = $conn->prepare("INSERT INTO proveedores (nombre, tipo_proveedor, correo, telefono) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $tipo_proveedor, $correo, $telefono);


    if ($stmt->execute()) {
        $proveedor_id = $stmt->insert_id;

        if (!empty($materiales)) {
            $stmtMat = $conn->prepare("INSERT INTO proveedor_material (id_proveedor, id_material) VALUES (?, ?)");
            foreach ($materiales as $id_material) {
                $stmtMat->bind_param("ii", $proveedor_id, $id_material);
                $stmtMat->execute();
            }
            $stmtMat->close();
        }

        $stmt->close();
        $conn->close();

        echo json_encode(['success' => true]);
        exit;
    } else {
        $stmt->close();
        $conn->close();
        echo json_encode(['success' => false, 'message' => 'Error al registrar proveedor.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}
?>
