<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
?>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_POST['usuario_id']; // Debes obtener el ID del usuario logueado
    $patrimonio = $_POST['patrimonio'];
    $ingresos = $_POST['ingresos'];
    $tarjeta = $_POST['tarjeta'];
    $compras = $_POST['compras'];
    $consignaciones = $_POST['consignaciones'];

    $debe_declarar = ($patrimonio >= 190854000 || $ingresos >= 59377000 || $tarjeta >= 59377000 || $compras >= 59377000 || $consignaciones >= 59377000) ? 1 : 0;

    // Usar declaraciones preparadas para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO declaraciones (usuario_id, patrimonio, ingresos, tarjeta, compras, consignaciones, debe_declarar) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiiii", $usuario_id, $patrimonio, $ingresos, $tarjeta, $compras, $consignaciones, $debe_declarar);

    if ($stmt->execute()) {
        echo $debe_declarar ? "Debes declarar renta." : "No debes declarar renta.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>