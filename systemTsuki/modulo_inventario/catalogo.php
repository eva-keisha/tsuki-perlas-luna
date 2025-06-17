<?php
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
    <script defer src="../JS/filtrar_catalogo.js"></script>
</head>
<body>
    <header>
        <h1>Tsuki</h1>
        <nav>
            <ul>
                <li><a href="../../pagina_web/index.html">Inicio html</a></li>
                  <li><a href="index.php">Inicio php</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><a href="#">Ofertas</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
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
