<?php
session_start();

// Inicializa el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if (isset($_POST['id_producto'], $_POST['cantidad'])) {
    $id = intval($_POST['id_producto']);
    $cantidad = intval($_POST['cantidad']);

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] += $cantidad;
    } else {
        $_SESSION['carrito'][$id] = $cantidad;
    }
}

header("Location: carrito_ver.php");
exit();
?>