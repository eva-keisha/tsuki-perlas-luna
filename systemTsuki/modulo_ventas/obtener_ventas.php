<?php
include '../conexion.php';

$query = "SELECT * FROM ventas";
$result = mysqli_query($conn, $query);

$ventas = [];

while ($row = mysqli_fetch_assoc($result)) {
    $ventas[] = $row;
}

echo json_encode($ventas);
?>
