<?php
include 'db.php';

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $celular = $_POST['celular'];
    $contraseña = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $check_sql = "SELECT * FROM usuarios WHERE cedula='$cedula'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "El usuario con esta cédula ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, apellidos, cedula, celular, contraseña) VALUES ('$nombre', '$apellidos', '$cedula', '$celular', '$contraseña')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>