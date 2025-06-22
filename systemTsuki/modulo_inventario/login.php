<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "tsuki_joyeria");

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT id_cliente, nombre_cliente, contrasena FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($id_cliente, $nombre, $contrasena_hash);
    $stmt->fetch();

    if ($id_cliente && password_verify($contrasena, $contrasena_hash)) {
        $_SESSION['cliente_id'] = $id_cliente;
        $_SESSION['cliente_nombre'] = $nombre;
        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Credenciales inválidas.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../../pagina_web/css/sesion_registro.css">
</head>
<body>
   <div class="contenedor">
        <div class="logo">
            <img src="../../pagina_web/logo_banner/logo noche.png" alt="Logo de la joyería">
        </div>
    <div class="formulario">
      <h2>Iniciar sesión</h2>
      <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
      <form method="POST" action="">
        <label for="correo">Correo</label>
        <input type="email" name="correo" required>

        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Entrar</button>
      </form>

      <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
  </div>
</body>
</html>
