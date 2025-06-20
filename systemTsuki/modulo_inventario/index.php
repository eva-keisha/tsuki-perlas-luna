<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener 3 productos representativos
$sql = "SELECT nombre_producto, imagen FROM productos LIMIT 3";
$result = $conn->query($sql);
$colecciones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $colecciones[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tsuki no Umi - Joyería de Perlas</title>
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
           <li><a href="carrito_ver.php">Carrito</a></li>
            <li><a href="wishlist_ver.php">Wishilist</a></li>
        </ul>
      </nav>
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

<!-- Botones flotantes -->
<div class="floating-buttons">
  <button onclick="loadPanel('carrito')" class="cart-btn">🛒 Carrito</button>
  <button onclick="loadPanel('wishlist')" class="wishlist-btn">💖 Wishlist</button>
</div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content container">
      <div class="text">
        <h1>Perlas con Elegancia Atemporal</h1>
        <p>Tsuki no Umi combina la mística lunar con la sofisticación moderna.</p>
        <a href="productos.html" class="btn">Descubre la colección</a>
      </div>
      <div class="image">
        <img src="../../pagina_web/logo_banner/banner noche.png" alt="Banner de perlas">
      </div>
    </div>
  </section>

  <!-- BENEFICIOS -->
  <section class="beneficios container">
    <div class="beneficio"><h3>📦 Envío Gratis</h3><p>En todos los pedidos nacionales.</p></div>
    <div class="beneficio"><h3>✨ Diseño Exclusivo</h3><p>Joyería única y artesanal.</p></div>
    <div class="beneficio"><h3>🎁 Empaque Premium</h3><p>Cada joya, una experiencia.</p></div>
    <div class="beneficio"><h3>💎 Calidad Suprema</h3><p>Perlas auténticas seleccionadas.</p></div>
  </section>

  <!-- SOBRE NOSOTROS -->
  <section class="sobre-nosotros section-alternate">
    <div class="container flex">
      <div class="texto">
        <h2>Tsuki no Umi (月の海)</h2>
        <p>Inspirada en la luna y el mar, Tsuki no Umi es una joyería especializada en perlas de calidad excepcional. Fusionamos tradición, artesanía y elegancia en cada pieza.</p>
      </div>
      <div class="imagen">
        <img src="../../pagina_web/productos/imgs_collar/img_co3.jpg" alt="Perlas elegantes">
      </div>
    </div>
  </section>

  <!-- COLECCIONES DINÁMICAS -->
  <section class="colecciones">
    <div class="container">
      <h2>Nuestras Colecciones</h2>
      <div class="galeria">
        <?php
        foreach ($colecciones as $coleccion) {
            echo "<div class='coleccion'>";
            echo "<img src='" . htmlspecialchars($coleccion['imagen']) . "' alt='" . htmlspecialchars($coleccion['nombre_producto']) . "'>";
            echo "<h3>" . htmlspecialchars($coleccion['nombre_producto']) . "</h3>";
            echo "<p>Diseño exclusivo con perlas únicas.</p>";
            echo "</div>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- HISTORIA -->
  <section class="historia section-alternate">
    <div class="container flex">
      <div class="imagen">
        <img src="productos/imgs_conjuntos/img_c6.jpg" alt="Historia de Tsuki no Umi">
      </div>
      <div class="texto">
        <h2>Nuestra Historia</h2>
        <p>Fundada con la visión de reflejar la luna sobre el mar, Tsuki no Umi fusiona la estética japonesa con el lujo moderno. Cada pieza cuenta una historia de elegancia y significado.</p>
      </div>
    </div>
  </section>

  <!-- CATALOGO-->
    <section class="catalogos-productos">
        <h2>Catalogo</h2>
        <div class="catalogos-contenedor">
            <a href="catalogo.php" class="catalogo-item">
                <img src="../../pagina_web/icons/arete.png" alt="Aretes">
                <p>Aretes</p>
            </a>
            <a href="catalogo.php" class="catalogo-item">
                <img src="../../pagina_web/icons/collar-de-perlas.png" alt="Collares">
                <p>Collares</p>
            </a>
            <a href="catalogo.php" class="catalogo-item">
                <img src="../../pagina_web/icons/joyas.png" alt="Conjuntos">
                <p>Conjuntos</p>
            </a>
            <a href="catalogo.php" class="catalogo-item">
                <img src="../../pagina_web/icons/pulsera.png" alt="Pulseras">
                <p>Pulseras</p>
            </a>
            <a href="catalogo.php" class="catalogo-item">
                <img src="../../pagina_web/icons/anillos.png" alt="Anillos">
                <p>Anillos</p>
            </a>
            <a href="catalogo.php" class="catalogo-item">
                <img src="../../pagina_web/icons/accesorio.png" alt="Accesorios">
                <p>Accesorios</p>
            </a>
        </div>
    </section>

  <!-- CONTACTO -->
  <section class="contacto">
    <div class="container flex">
      <div class="texto">
        <h2>Contáctanos</h2>
        <p><strong>📍 Dirección:</strong> [Dirección ficticia]</p>
        <p><strong>📞 Teléfono:</strong> [Número de contacto]</p>
        <p><strong>📧 Correo:</strong> contacto@tsukinoumi.com</p>
        <p><strong>🌐 Web:</strong> <a href="#">www.tsukinoumi.com</a></p>
      </div>
      <div class="imagen">
        <img src="../../pagina_web/productos/image.png" alt="Mapa de ubicación">
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <p>&copy; 2024 Tsuki no Umi. Todos los derechos reservados.</p>
  </footer>

<script>
function openPanel() {
  document.getElementById("side-panel").classList.add("open");
}

function closePanel() {
  document.getElementById("side-panel").classList.remove("open");
}

function loadPanel(type) {
  const panelTitle = document.getElementById("panel-title");
  const panelContent = document.getElementById("panel-content");

  if (type === 'carrito') {
    panelTitle.innerText = "Mi Carrito";
    fetch('carrito_ver.php?embedded=1')
      .then(res => res.text())
      .then(html => {
        panelContent.innerHTML = html;
        openPanel();
      });
  } else if (type === 'wishlist') {
    panelTitle.innerText = "Mi Wishlist";
    fetch('wishlist_ver.php?embedded=1')
      .then(res => res.text())
      .then(html => {
        panelContent.innerHTML = html;
        openPanel();
      });
  }
}
</script>

</body>
</html>

<?php $conn->close(); ?>
