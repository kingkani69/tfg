<?php
require 'Login.php';

$salida = "";

try {
    $conn = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    $salida = "Error en la conexión: " . $e->getMessage();
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['boton1'])) {
        $nombre = $_POST['Nombre'];
        $direccion = $_POST['Direccion'];
        $telefono = $_POST['Telefono'];
        $correo = $_POST['Correo_Electronico'];

        // Validar los datos del formulario
        if (!empty($nombre) && !empty($direccion) && !empty($telefono) && !empty($correo)) {
            $sql = "INSERT INTO cliente (Nombre, Direccion, Telefono, Correo_Electronico) VALUES (:Nombre, :Direccion, :Telefono, :Correo_Electronico)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'Nombre' => $nombre,
                'Direccion' => $direccion,
                'Telefono' => $telefono,
                'Correo_Electronico' => $correo,
            ]);
            $salida = "Usuario registrado.";
        } else {
            $salida = "Por favor, complete todos los campos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<link rel="stylesheet" href="registro.css">
<body>
    <header>
        <div class="buttons">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <button id="boton1" name="boton1" class="button">Registrarme</button>
                <button id="boton2" name="boton2" class="button">Iniciar Sesion</button>
                <input type="text" name="Nombre" placeholder="Nombre de usuario" required>
                <input type="text" name="Direccion" placeholder="Dirección" required>
                <input type="number" name="Telefono" placeholder="Teléfono" required>
                <input type="email" name="Correo_Electronico" placeholder="Correo Electrónico" required>
            </form>
        </div>
    </header>
    <div class="container">
        <div class="centered-div">
            <p><?php if ($salida != "") echo $salida; ?></p>
        </div>
    </div>
    <footer class="footer bg-light text-center">
    <div class="container">
        <span class="text-muted">© 2025 Concesionario JG'S</span>
    </div>
</footer>
</body>
</html>
