<?php
session_start();
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

if (isset($_GET['id_producto'])) {
    $id = intval($_GET['id_producto']);
    $_SESSION['wishlist'][$id] = true;
}
header("Location: wishlist_ver.php");
exit();
?>