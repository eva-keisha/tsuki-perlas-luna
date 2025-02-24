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
    // Recibe los datos del formulario
    $nombre_cliente = $_POST['nombre_cliente'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO clientes (nombre_cliente, correo, telefono, direccion) 
            VALUES (?, ?, ?, ?)";

    // Usar prepared statement para evitar inyecciones SQL
    if ($stmt = $conn->prepare($sql)) {
        // Vincula los parámetros
        $stmt->bind_param("ssss", $nombre_cliente, $correo, $telefono, $direccion);
        
        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Si la inserción fue exitosa, redirige o muestra un mensaje
            echo "Cliente registrado exitosamente!";
            header("Location: modulo_cliente.html");
        } else {
            echo "Error al registrar el cliente: " . $stmt->error;
        }
        
        // Cierra la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cierra la conexión
    $conn->close();
}
?>
