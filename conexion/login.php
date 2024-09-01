<?php
// Habilitar la visualización de errores (Solo para desarrollo; en producción, desactivar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar la sesión solo si no está ya iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir el archivo de conexión a la base de datos
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos
    $cedula = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
    $contraseña = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Verificar que los datos no estén vacíos
    if (empty($cedula) || empty($contraseña)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }

    try {
        // Usar declaraciones preparadas para evitar inyecciones SQL
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($contraseña, $user['contraseña'])) {
            // Verificar si la sesión está iniciada y generar un nuevo token CSRF si es necesario
            if (!isset($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }

            // Guardar el ID del usuario en la sesión
            $_SESSION['usuario_id'] = $user['id'];

            // Redirigir al index principal
            header("Location: index.html");
            exit();
        } else {
            echo "Cédula o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        error_log("Error de autenticación: " . $e->getMessage());
    }

    // Cerrar la conexión
    $conn = null;
} else {
    echo "Método de solicitud no válido.";
}
?>