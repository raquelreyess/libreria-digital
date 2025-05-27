

<?php
require_once '../../../conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $telefono = $_POST['phone'];
    $password = $_POST['password'];
   $tipo_cliente = $_POST['tipo_cuenta'];

    // Validar tipo de cuenta
    $id_tipo_cliente = ($tipoCuenta === 'premium') ? 3 : 2; // 2 = Básico, 3 = Premium
    $id_rol = 2; 

    // Validar si se requiere tarjeta
    if ($id_tipo_cliente === 3) {
        if (empty($_POST['numero_tarjeta']) || empty($_POST['vencimiento']) || empty($_POST['cvv'])) {
            header("Location: ../registro.php?error=Faltan datos de tarjeta");
            exit();
        }
    }

    $contrasena_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Verificar si ya existe el correo
        $verificar = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = :correo");
        $verificar->bindParam(':correo', $correo);
        $verificar->execute();

        if ($verificar->rowCount() > 0) {
            header("Location: ../registro.php?error=El correo ya está registrado");
            exit();
        }

        // Insertar usuario
        $sql = "INSERT INTO usuarios (nombre, correo, telefono, contrasena, id_rol, id_tipo_cliente) 
                VALUES (:nombre, :correo, :telefono, :contrasena, :id_rol, :id_tipo_cliente)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':contrasena', $contrasena_hash);
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':id_tipo_cliente', $id_tipo_cliente);
        $stmt->execute();

        header("Location: ../registro.php?success=Usuario registrado correctamente");
        exit();
    } catch (PDOException $e) {
        header("Location: ../registro.php?error=Error en la base de datos");
        exit();
    }
} else {
    header("Location: ../registro.php");
    exit();
}
