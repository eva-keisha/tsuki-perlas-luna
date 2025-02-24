  <!-- procesar_registro.php -->
  <?php
    include 'conexion.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_cliente= $_POST['nombre_'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO clientes (nombre, correo, telefono, direccion, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $direccion, $password);
        
        if ($stmt->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>