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

$sql = "SELECT id_producto, nombre_producto, precio, imagen, categoria FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Tsuki</title>
    <link rel="stylesheet" href="../css/styles.css">
     <link rel="stylesheet" href="../../pagina_web/css/inicio_diseño.css">
  <link rel="stylesheet" href="../../pagina_web/css/productos.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
    <script defer src="../JS/filtrar_catalogo.js"></script>
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
    
    <section class="catalogo">
        <aside class="filtros">
            <h2>Filtros</h2>
            <input type="text" id="search" placeholder="Buscar por nombre...">
            <h3>Categorías</h3>
            <ul>
                <li><input type="checkbox" class="categoria" value="anillos"> Anillos</li>
                <li><input type="checkbox" class="categoria" value="conjuntos"> Conjuntos</li>
                <li><input type="checkbox" class="categoria" value="collares"> Collares</li>
                <li><input type="checkbox" class="categoria" value="accesorios"> Accesorios</li>
                <li><input type="checkbox" class="categoria" value="aretes"> Aretes</li>
                <li><input type="checkbox" class="categoria" value="pulseras"> Pulseras</li>
            </ul>
        </aside>
        
        <div class="productos">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='producto' data-categoria='" . htmlspecialchars($row['categoria']) . "'>";
                    echo '<img src="' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre_producto']) . '">';
                    echo "<h3>" . htmlspecialchars($row["nombre_producto"]) . "</h3>";
                    echo "<p>$" . htmlspecialchars($row["precio"]) . "</p>";
                    echo "<a href='detalle_producto.php?id_producto=" . $row["id_producto"] . "'><button>Ver más</button></a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }
            $conn->close();
            ?>
        </div>
    </section>
    
    <footer>
        <p>© 2025 Tsuki Joyería. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
