<?php
// Habilitar la visualización de errores (Solo para desarrollo; en producción, desactivar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar la sesión solo si no está ya iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Detalles de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taller_software2";
$port = 3307;

try {
    // Crear conexión utilizando PDO para mayor seguridad y manejo de excepciones
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa"; // Descomenta esta línea si necesitas confirmar la conexión en desarrollo
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Sanitizar y validar datos de entrada
        $cedula = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
        $contraseña = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Verificar si el usuario existe
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar la contraseña
            if (password_verify($contraseña, $user['contraseña'])) {
                // Generar un nuevo token CSRF si no está ya en la sesión
                if (!isset($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }

                // Guardar el ID del usuario en la sesión
                $_SESSION['usuario_id'] = $user['id'];

                // Redirigir al index principal
                header("Location: index.html");
                exit();
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Usuario no registrado";
        }
    } catch (PDOException $e) {
        echo "Error al autenticar al usuario: " . $e->getMessage();
        error_log("Error de autenticación: " . $e->getMessage());
    }
}

// Cerrar la conexión
$conn = null;
?>