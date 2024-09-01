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
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $cedula = filter_input(INPUT_POST, 'cedula', FILTER_SANITIZE_STRING);
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confPassword = filter_input(INPUT_POST, 'confPassword', FILTER_SANITIZE_STRING);

    // Verificar si las contraseñas coinciden
    if ($password !== $confPassword) {
        echo "Las contraseñas no coinciden. Por favor, verifica e intenta nuevamente.";
        exit();
    }

    // Verificar que todos los campos sean válidos
    if (empty($nombre) || empty($apellidos) || empty($cedula) || empty($celular) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }

    // Cifrar la contraseña
    $contraseña = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Verificar si el usuario ya existe
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "El usuario con esta cédula ya está registrado.";
        } else {
            // Insertar nuevo usuario
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, cedula, celular, contraseña) VALUES (:nombre, :apellidos, :cedula, :celular, :contraseña)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':contraseña', $contraseña);

            if ($stmt->execute()) {
                echo "Registro exitoso";
                // Redirigir al usuario a otra página, si lo deseas
                header('Location: index.html');
                exit();
            } else {
                echo "Error: No se pudo completar el registro.";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        error_log("Error de registro: " . $e->getMessage());
    }

    // Cerrar la conexión
    $conn = null;
} else {
    echo "Método de solicitud no válido.";
}
?>