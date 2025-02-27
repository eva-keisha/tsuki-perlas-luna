<?php
$servername = "localhost"; // Servidor de la base de datos (normalmente localhost en XAMPP)
$username = "root"; // Usuario de MySQL (por defecto es root en XAMPP)
$password = ""; // Contraseña de MySQL (por defecto en XAMPP está vacía)
$database = "tsuki_joyeria"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 para evitar problemas con acentos y caracteres especiales
$conn->set_charset("utf8");

?>