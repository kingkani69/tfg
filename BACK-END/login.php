<?php
session_start();
require 'pruebaConexion.php'; // Asegúrate de que este archivo tenga la conexión a la base de datos.

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(["error" => "Faltan datos"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nombre'];
            echo json_encode(["success" => "Inicio de sesión exitoso"]);
        } else {
            echo json_encode(["error" => "Credenciales incorrectas"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error de conexión"]);
    }
} else {
    echo json_encode(["error" => "Método no permitido"]);
}
?>
