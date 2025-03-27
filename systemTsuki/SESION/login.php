<?php
include 'conexion2.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Limpiar los valores de correo y contraseña
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Verificar que los campos estén presentes
    if ($correo && $contrasena) {
        // Consultar si el correo existe en la base de datos usando PDO
        $stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el usuario existe y la contraseña es correcta
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            session_start();
            $_SESSION['usuario'] = $usuario['nombre_cliente'];  // Guardar el nombre del usuario en la sesión
            header('Location: index.php');  // Redirigir al usuario al inicio
            exit();
        } else {
            echo "Correo o contraseña incorrectos.";
        }
    } else {
        echo "Por favor ingrese ambos campos (correo y contraseña).";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="post" action="login.php">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <a href="registro.php">¿No tienes cuenta? Regístrate</a>
</body>
</html>
