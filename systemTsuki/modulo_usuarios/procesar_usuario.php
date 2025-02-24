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

// Verifica si los datos fueron enviados por el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibe los datos del formulario y valida que no sean nulos
    $nombre_usuario = isset($_POST['nombre_usuario']) ? trim($_POST['nombre_usuario']) : null;
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : null;
    $contraseña = isset($_POST['contraseña']) ? trim($_POST['contraseña']) : null;
    $rol = isset($_POST['rol']) ? trim($_POST['rol']) : null;

    // Verifica que los datos requeridos no estén vacíos
    if (empty($nombre_usuario) || empty($correo) || empty($contraseña) || empty($rol)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Encriptar la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contraseña, rol) 
            VALUES (?, ?, ?, ?)";

    // Usar prepared statement para evitar inyecciones SQL
    if ($stmt = $conn->prepare($sql)) {
        // Vincula los parámetros correctamente
        $stmt->bind_param("ssss", $nombre_usuario, $correo, $hashed_password, $rol);
        
        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente!";
            header("Location: modulo_usuario.html");
            exit(); // Asegura que no se ejecuten más líneas después del header
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }
        
        // Cierra la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}

// Cierra la conexión
$conn->close();
?>
