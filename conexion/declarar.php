<?php
include 'db.php';

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['usuario_id']; // Debes obtener el ID del usuario logueado
    $patrimonio = $_POST['patrimonio'];
    $ingresos = $_POST['ingresos'];
    $tarjeta = $_POST['tarjeta'];
    $compras = $_POST['compras'];
    $consignaciones = $_POST['consignaciones'];

    $debe_declarar = ($patrimonio >= 190854000 || $ingresos >= 59377000 || $tarjeta >= 59377000 || $compras >= 59377000 || $consignaciones >= 59377000) ? 1 : 0;

    $sql = "INSERT INTO declaraciones (usuario_id, patrimonio, ingresos, tarjeta, compras, consignaciones, debe_declarar) VALUES ('$usuario_id', '$patrimonio', '$ingresos', '$tarjeta', '$compras', '$consignaciones', '$debe_declarar')";

    if ($conn->query($sql) === TRUE) {
        echo $debe_declarar ? "Debes declarar renta." : "No debes declarar renta.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>