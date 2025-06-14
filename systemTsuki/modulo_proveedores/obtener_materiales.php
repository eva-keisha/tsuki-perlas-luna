<?php
include '../conexion.php';

$sql = "SELECT * FROM materiales";
$result = $conn->query($sql);

$materiales = [];
while ($row = $result->fetch_assoc()) {
    $materiales[] = $row;
}

echo json_encode($materiales);
$conn->close();
?>