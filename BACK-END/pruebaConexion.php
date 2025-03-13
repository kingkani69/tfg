<?php
// Habilitar la visualización de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost'; // Servidor de la base de datos
$data = 'concesionario'; // Nombre de la base de datos
$user = 'root'; // Usuario de MySQL
$pass = ''; // Contraseña de MySQL (déjala en blanco si no tiene)

// Opciones de conexión para un mejor rendimiento y seguridad
$chrs = 'utf8mb4';
$attr = "mysql:host=$host;dbname=$data;charset=$chrs";
$opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Modo de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Resultados como array asociativo
    PDO::ATTR_EMULATE_PREPARES => false, // Deshabilitar emulación de preparaciones
];

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
    // echo "Conexión exitosa"; // Puedes descomentar esto para pruebas
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
