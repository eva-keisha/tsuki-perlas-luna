<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = array();
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);

$conn->close();
?>
