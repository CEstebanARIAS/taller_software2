<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taller_software2";
$port = 3307; // Especifica el puerto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos taller_software2 en el puerto 3307";
?>