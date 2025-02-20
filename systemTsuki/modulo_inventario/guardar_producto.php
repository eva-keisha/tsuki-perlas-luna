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

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $conn->real_escape_string($_POST["nombreProducto"]);
    $descripcion = $conn->real_escape_string($_POST["descripcion"]);
    $precio = $conn->real_escape_string($_POST["precio"]);
    $stock = $conn->real_escape_string($_POST["stock"]);
    $categoria = $conn->real_escape_string($_POST["categoria"]);

    // Manejo de imagen
    $imagen = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $uploadsDir = "uploads/";

        // Asegurar que la carpeta uploads existe
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0777, true);
        }

        // Generar un nombre único para la imagen
        $imagenNombre = time() . "_" . basename($_FILES["imagen"]["name"]);
        $rutaDestino = $uploadsDir . $imagenNombre;

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
            $imagen = $rutaDestino;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, stock, categoria, imagen) 
            VALUES ('$nombre_producto', '$descripcion', '$precio', '$stock', '$categoria', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto guardado correctamente.";
        header("Location: modulo_producto.html");
        exit; // Importante para que `header` funcione bien
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
