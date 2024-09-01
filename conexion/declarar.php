<?php
// Habilitar la visualización de errores (Solo para desarrollo; en producción, desactivar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión a la base de datos
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos
    $usuario_id = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);
    $patrimonio = filter_input(INPUT_POST, 'patrimonio', FILTER_VALIDATE_FLOAT);
    $ingresos = filter_input(INPUT_POST, 'ingresos', FILTER_VALIDATE_FLOAT);
    $tarjeta = filter_input(INPUT_POST, 'tarjeta', FILTER_VALIDATE_FLOAT);
    $compras = filter_input(INPUT_POST, 'compras', FILTER_VALIDATE_FLOAT);
    $consignaciones = filter_input(INPUT_POST, 'consignaciones', FILTER_VALIDATE_FLOAT);

    // Verificar si los datos son válidos
    if ($usuario_id === false || $patrimonio === false || $ingresos === false || $tarjeta === false || $compras === false || $consignaciones === false) {
        echo "Datos de entrada no válidos.";
        exit();
    }

    // Cálculo para determinar si debe declarar
    $debe_declarar = ($patrimonio >= 190854000 || $ingresos >= 59377000 || $tarjeta >= 59377000 || $compras >= 59377000 || $consignaciones >= 59377000) ? 1 : 0;

    try {
        // Preparar la declaración SQL
        $stmt = $conn->prepare("INSERT INTO declaraciones (usuario_id, patrimonio, ingresos, tarjeta, compras, consignaciones, debe_declarar) VALUES (:usuario_id, :patrimonio, :ingresos, :tarjeta, :compras, :consignaciones, :debe_declarar)");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':patrimonio', $patrimonio);
        $stmt->bindParam(':ingresos', $ingresos);
        $stmt->bindParam(':tarjeta', $tarjeta);
        $stmt->bindParam(':compras', $compras);
        $stmt->bindParam(':consignaciones', $consignaciones);
        $stmt->bindParam(':debe_declarar', $debe_declarar);

        if ($stmt->execute()) {
            echo $debe_declarar ? "Debes declarar renta." : "No debes declarar renta.";
        } else {
            echo "Error al registrar la declaración.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
} else {
    echo "Método de solicitud no válido.";
}
?>