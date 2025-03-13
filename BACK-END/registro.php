<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'pruebaConexion.php';

$response = array('message' => '');

try {
    $conn = new PDO($attr, $user, $pass, $opts);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST['Nombre']) && !empty($_POST['Direccion']) && !empty($_POST['Telefono']) && !empty($_POST['Correo_Electronico']) && !empty($_POST['Password'])) {
        $nombre = trim($_POST['Nombre']);
        $direccion = trim($_POST['Direccion']);
        $telefono = trim($_POST['Telefono']);
        $correo = trim($_POST['Correo_Electronico']);
        $password = password_hash($_POST['Password'], PASSWORD_BCRYPT); // Encriptar la contraseña

        // Comprobar si el correo ya existe
        $stmt = $conn->prepare("SELECT ID FROM cliente WHERE Correo_Electronico = :correo");
        $stmt->execute([':correo' => $correo]);

        if ($stmt->rowCount() > 0) {
            $response['message'] = "El correo ya está registrado.";
        } else {
            $sql = "INSERT INTO cliente (Nombre, Direccion, Telefono, Correo_Electronico, Password) 
                    VALUES (:nombre, :direccion, :telefono, :correo, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':correo' => $correo,
                ':password' => $password
            ]);

            $response['message'] = "Usuario registrado correctamente.";
        }
    } else {
        $response['message'] = "Por favor, complete todos los campos.";
    }
} catch (PDOException $e) {
    $response['message'] = "Error en la conexión: " . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
