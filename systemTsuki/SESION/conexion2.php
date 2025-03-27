<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tsuki_joyeria";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa"; // Solo para prueba
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
