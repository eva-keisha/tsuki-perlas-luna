<?php
include '../conexion.php';
header('Content-Type: application/json');

// Consulta proveedores con alias correctos
        $sql = "SELECT 
    p.id,             
    p.nombre, 
    p.telefono As telefono, 
    p.correo As email,        
    p.tipo_proveedor AS tipo_proveedor, 
    COALESCE(GROUP_CONCAT(m.nombre_material SEPARATOR ', '), '') AS materiales
FROM proveedores p
LEFT JOIN proveedor_material pm ON p.id = pm.id_proveedor
LEFT JOIN materiales m ON pm.id_material = m.id_material
GROUP BY p.id";



$result = $conn->query($sql);

$proveedores = [];
while ($row = $result->fetch_assoc()) {
    $row['materiales'] = explode(', ', $row['materiales']);  // Para que JS reciba un array
    $proveedores[] = $row;
}

echo json_encode($proveedores);
$conn->close();
?>
