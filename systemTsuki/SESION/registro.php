<?php
include 'conexion2.php'; // Incluir la conexión a la base de datos (mysqli)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los valores del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Cifrado de la contraseña

    // Verificar si el correo ya está registrado usando mysqli
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $correo); // Vincular el parámetro del correo
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El correo ya está registrado.";
    } else {
        // Insertar los datos del nuevo usuario usando mysqli
        $stmt = $conn->prepare("INSERT INTO clientes (nombre_cliente, correo, telefono, direccion, contrasena, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $direccion, $contrasena);  // Vincular parámetros
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Registro exitoso.";
        } else {
            echo "Error al registrar.";
        }

        $stmt->close(); // Cerrar el statement
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="post" action="registro.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br>

        <input type="submit" value="Registrar">
    </form>

    <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
</body>
</html>
