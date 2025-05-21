<?php
include "../../conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $id_tipo_cliente = $_POST['id_tipo_cliente'] ?? 1; // por defecto 1: básico

    if ($nombre && $correo && $telefono && $contrasena) {
        $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);
        $id_rol = 1; // administrador

        try {
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, telefono, contrasena, id_rol, id_tipo_cliente) 
                                        VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $correo, $telefono, $contrasena_hashed, $id_rol, $id_tipo_cliente]);
            $mensaje = "Administrador creado correctamente.";
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $mensaje = "El correo ya está registrado.";
            } else {
                $mensaje = "Error al crear administrador: " . $e->getMessage();
            }
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Agregar nuevo administrador</h3>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Correo electrónico:</label>
            <input type="email" name="correo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de cliente:</label>
            <select name="id_tipo_cliente" class="form-control">
                <option value="1">Básico</option>
                <option value="2">Premium</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear administrador</button>
        <a href="gestion_usuarios.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
