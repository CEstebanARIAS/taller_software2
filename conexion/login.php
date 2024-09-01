<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taller_software2";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['password'];

    // Usar declaraciones preparadas para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = ?");
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            echo "Bienvenido";
            // Redirigir al index principal
            header("Location: index.html");
            exit(); // Asegúrate de detener la ejecución del script después de redirigir
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no registrado";
    }

    $stmt->close();
}

$conn->close();
?>