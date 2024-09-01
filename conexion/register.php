<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $celular = $_POST['celular'];
    $contraseña = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cedula = ?");
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El usuario con esta cédula ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, cedula, celular, contraseña) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellidos, $cedula, $celular, $contraseña);

        if ($stmt->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
