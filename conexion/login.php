<?php
// Datos de conexión
$servername = "127.0.0.1";
$port = "3307"; // Puerto específico
$username = "root";
$password = "";
$dbname = "usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.<br>";
}

// Obtener datos del formulario
$cedula = $_POST['cedula'];
$password = $_POST['password'];

// Verificar usuario
$sql = "SELECT * FROM usuarios WHERE cedula='$cedula'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "Inicio de sesión exitoso";
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "No existe una cuenta con esa cédula";
}

// Cerrar conexión
$conn->close();
?>
