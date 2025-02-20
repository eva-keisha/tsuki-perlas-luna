<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $id = $conn->real_escape_string($_GET["id"]);
    $sql = "SELECT * FROM productos WHERE id_producto = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();

        // Verifica si hay una imagen y concatena la ruta
        if (!empty($producto["imagen"])) {
            $producto["imagen"] = "imagenes/" . $producto["imagen"];
        } else {
            $producto["imagen"] = ""; // Imagen vacía si no tiene
        }

        echo json_encode($producto);
    } else {
        echo json_encode(["error" => "Producto no encontrado"]);
    }
} else {
    echo json_encode(["error" => "ID no proporcionado"]);
}

$conn->close();
?>
