<?php
session_start();
$wishlist = $_SESSION['wishlist'] ?? [];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tsuki_joyeria";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_GET['embedded'])) {
    header("Location: index.php");
    exit;
}
?>

<h1>Mi Lista de Deseos</h1>
<ul>
<?php
foreach ($wishlist as $id => $_) {
    $sql = "SELECT nombre_producto, imagen FROM productos WHERE id_producto = $id";
    $result = $conn->query($sql);
    if ($result && $producto = $result->fetch_assoc()) {
        echo "<li><img src='{$producto['imagen']}' width='50'> " . htmlspecialchars($producto['nombre_producto']) . "</li>";
    }
}
?>
</ul>
