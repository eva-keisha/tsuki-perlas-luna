<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST["id_cliente"];
    $total = $_POST["total"];
    $metodo_pago = $_POST["metodo_pago"];
    $fecha_venta = $_POST["fecha_venta"];

    $query = "INSERT INTO ventas (id_cliente, total, metodo_pago, fecha_venta)
              VALUES ('$id_cliente', '$total', '$metodo_pago', '$fecha_venta')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Venta registrada con éxito'); window.location.href = 'modulo_ventas.html';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
