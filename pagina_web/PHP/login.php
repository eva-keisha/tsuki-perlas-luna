<?php
session_start();
require 'conexion.php'; // Conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Preparar consulta
    $stmt = $conn->prepare("SELECT id_cliente, contraseña FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_cliente, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($contraseña, $hashed_password)) {
            $_SESSION['id_cliente'] = $id_cliente;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Correo no registrado";
    }

    $stmt->close();
}

$conn->close();
?>
