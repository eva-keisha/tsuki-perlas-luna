<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los clientes
$sql = "SELECT id_cliente, nombre_cliente, correo, telefono, direccion FROM clientes";
$result = $conn->query($sql);

$clientes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($clientes);

$conn->close();
?>
