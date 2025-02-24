<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tsuki_joyeria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta corregida (nombre_usuario en lugar de nombre_usuaio)
$sql = "SELECT id_usuario, nombre_usuario, correo, contraseña, rol FROM usuarios";
$result = $conn->query($sql);

// Verificar si la consulta tuvo éxito
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);

$conn->close();
?>
