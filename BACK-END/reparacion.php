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
        $id_reparacion = $_POST['ID_Reparacion'];
        $id_coche = $_POST['ID_Coche'];
        $id_empleado = $_POST['ID_Empleado'];
        $coste= $_POST['Coste'];
        $descripcion = $_POST['Descripcion'];
        $fecha = $_POST['fecha_de_reaparacion'];
        // Validar los datos del formulario
        if (!empty($nombre) && !empty($direccion) && !empty($telefono) && !empty($correo)) {
            $sql = "INSERT INTO cliente (ID_Reparacion, ID_Coche, ID_Empleado, Coste , Descripcion , fecha_de_reparacion) VALUES (:ID_Reparacion, :ID_Coche, :ID_Empleado, :Coste , :Descripcion , :fecha_de_reparacion)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'ID_Reparacion' => $id_reparacion,
                'ID_Coche' => $id_coche,
                'ID_Empleado' => $id_empleado,
                'Coste' => $coste,
                'Descripcion' => $descripcion,
                'fecha_de_reparacion' => $fecha,
            ]);
            $salida = "Formulario Enviado.";
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
                <button id="boton1" name="boton1" class="button">Enviar Informe</button>
                <input type="text" name="propietario" placeholder="Propietario" required>
                <input type="text" name="coche" placeholder="Modelo del Coche" required>
                <input type="text" name="descripcion" placeholder="Descripcion" required>
                
                <input type="date" name="fecha_de_reparacion" placeholder="Fecha de Reparacion" required>
            </form>
        </div>
    </header>
    <div class="container">
        <div class="centered-div">
            <p><?php if ($salida != "") echo $salida; ?></p>
        </div>
    </div>
    <div class="container">
        <span class="text-muted">© 2025 Concesionario JG'S</span>
    </div>
</body>
</html>
