<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];

$conn = new mysqli("localhost", "root", "", "tsuki_joyeria");

foreach ($carrito as $id => $cantidad) {
    $stmt = $conn->prepare("INSERT INTO pedidos (id_producto, cantidad, fecha) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $id, $cantidad);
    $stmt->execute();
}

$_SESSION['carrito'] = []; // Vaciar carrito
echo "<h1>¡Gracias por tu pedido!</h1>";
?>
