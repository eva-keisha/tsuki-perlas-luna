<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "tsuki_joyeria");

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id_cliente FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $mensaje = "El correo ya está registrado.";
    } else {
        $stmt = $conn->prepare("INSERT INTO clientes (nombre_cliente, correo, telefono, direccion, contrasena) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $direccion, $contrasena);

        if ($stmt->execute()) {
            $mensaje = "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
        } else {
            $mensaje = "Error al registrar.";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="../../pagina_web/css/sesion_registro.css">
</head>
<body>
    <div class="contenedor">
        <div class="logo">
            <img src="../../pagina_web/logo_banner/logo noche.png" alt="Logo de la joyería">
        </div>
    <div class="formulario">
      <h2>Registro de cliente</h2>
      <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
      <form method="POST" action="">
        <label for="nombre">Nombre completo</label>
        <input type="text" name="nombre" required>

        <label for="correo">Correo</label>
        <input type="email" name="correo" required>

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Registrarse</button>
      </form>

      <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
  </div>
</body>
</html>
