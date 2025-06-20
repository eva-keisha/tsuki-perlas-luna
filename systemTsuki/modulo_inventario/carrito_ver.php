<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$total = 0;
if (!isset($_GET['embedded'])) {
    header("Location: index.php");
    exit;
}
?>


<h1>Tu carrito</h1>
<table>
    <tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>
    <?php foreach ($carrito as $id => $cantidad):
        $sql = "SELECT nombre_producto, precio FROM productos WHERE id_producto = $id";
        $result = $conn->query($sql);
        if ($result && $producto = $result->fetch_assoc()):
            $subtotal = $producto['precio'] * $cantidad;
            $total += $subtotal;
    ?>
        <tr>
            <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
            <td><?= $cantidad ?></td>
            <td>$<?= number_format($producto['precio'], 2) ?></td>
            <td>$<?= number_format($subtotal, 2) ?></td>
        </tr>
    <?php endif; endforeach; ?>
</table>
<p><strong>Total: $<?= number_format($total, 2) ?></strong></p>
<a href="checkout.php">Finalizar compra</a>
?>