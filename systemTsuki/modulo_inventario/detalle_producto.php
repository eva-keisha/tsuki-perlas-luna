<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id_producto']) && is_numeric($_GET['id_producto'])) {
    $id_producto = intval($_GET['id_producto']);
    $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto no especificado o inválido.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($producto['nombre_producto']); ?> - Tsuki</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/detalle_producto.css">
</head>
<body>
    <header>
        <h1>Tsuki</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><a href="#">Ofertas</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="detalle-producto">
    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" width="300">


        <div class="info-producto">
            <h2><?php echo htmlspecialchars($producto['nombre_producto']); ?></h2>
            <p><strong>Precio:</strong> $<?php echo htmlspecialchars($producto['precio']); ?></p>
            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="1" min="1">
            <button>Agregar al carrito</button>
        </div>
    </section>
    
    <footer>
        <p>© 2025 Tsuki Joyería. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
