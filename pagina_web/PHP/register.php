<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Verificar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT id_cliente FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El correo ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO clientes (nombre_cliente, correo, contraseña, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $correo, $contraseña, $telefono, $direccion);

        if ($stmt->execute()) {
            echo "Registro exitoso. <a href='login.html'>Inicia sesión</a>";
        } else {
            echo "Error en el registro.";
        }
    }

    $stmt->close();
}

$conn->close();
?>
