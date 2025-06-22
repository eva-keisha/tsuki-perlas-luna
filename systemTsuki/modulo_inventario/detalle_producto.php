<?php
session_start();
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
     <link rel="stylesheet" href="../../pagina_web/css/inicio_diseño.css">
  <link rel="stylesheet" href="../../pagina_web/css/productos.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
</head>
<body>
      <!-- HEADER -->
<header class="header">
  <div class="container header-container">
    <div class="logo">
      <img src="../../pagina_web/logo_banner/logo noche.png" alt="Logo Tsuki no Umi">
    </div>
    <nav class="nav">
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="catalogo.php">Colecciones</a></li>
        <li><a href="sobre_nosotros.html">Nuestra Historia</a></li>
        <li><a href="contacto.html">Contacto</a></li>
     

        <?php if (isset($_SESSION['cliente_id'])): ?>
            <li><span style="color:black;">👤 <?php echo htmlspecialchars($_SESSION['cliente_nombre']); ?></span></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        <?php else: ?>
            <li><a href="login.php">Inicio de sesión</a></li>
            <li><a href="registro.php">Registrarse</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <!-- Botones flotantes -->
    <div class="floating-buttons">
      <button onclick="loadPanel('carrito')" class="cart-btn">🛒 Carrito</button>
      <button onclick="loadPanel('wishlist')" class="wishlist-btn">💖 Wishlist</button>
    </div>
  </div>

  <!-- Panel lateral para carrito y wishlist -->
  <div id="side-panel" class="side-panel">
    <div class="panel-header">
      <h2 id="panel-title">Mi Carrito</h2>
      <button onclick="closePanel()" class="close-btn">✕</button>
    </div>
    <div class="panel-content" id="panel-content">
      <p>Cargando...</p>
    </div>
  </div>
</header>
    <section class="detalle-producto">
    <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" width="300">


        <div class="info-producto">
            <h2><?php echo htmlspecialchars($producto['nombre_producto']); ?></h2>
            <p><strong>Precio:</strong> $<?php echo htmlspecialchars($producto['precio']); ?></p>
            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            
         <form action="carrito.php" method="POST">
    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" value="1" min="1">
    <button type="submit">Agregar al carrito</button>
</form>
        </div>
        <a href="wishlist.php?id_producto=<?= $producto['id_producto'] ?>">❤️ Añadir a Wishlist</a>

 <!-- mas prodcutos -->
    </section>
<h3 class="sugerencia-titulo">También te puede interesar:</h3>
<div class="otros-productos-elegantes">
<?php
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT id_producto, nombre_producto, imagen FROM productos WHERE id_producto != $id_producto LIMIT 4";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "<div class='producto-card'>";
    echo "<a href='detalle_producto.php?id_producto={$row['id_producto']}'>";
    echo "<div class='imagen-producto'><img src='{$row['imagen']}' alt='{$row['nombre_producto']}'></div>";
    echo "<div class='info-producto'>";
    echo "<p class='nombre-producto'>" . htmlspecialchars($row['nombre_producto']) . "</p>";
    echo "</div></a>";
    echo "</div>";
}
?>
</div>

    <footer>
        <p>© 2025 Tsuki Joyería. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
