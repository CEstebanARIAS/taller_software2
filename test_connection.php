<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión a la base de datos
include 'conexion/db.php';

// Verificar la conexión
if ($conn->ping()) {
    echo " Conexión exitosa!";
} else {
    echo "Error en la conexión: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>