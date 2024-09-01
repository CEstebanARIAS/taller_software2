<?php
include 'db.php';

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE cedula='$cedula'";
    $result = $conn->query($sql);

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

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>