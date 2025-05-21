<?php
session_start();
require_once 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    try {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['user_id'] = $usuario['id_usuario'];
            $_SESSION['user_name'] = $usuario['nombre'];
            $_SESSION['user_rol'] = $usuario['id_rol'];
            $_SESSION['tipo_cliente'] = $usuario['id_tipo_cliente'];

            header("Location: usuario/PANTALLAS/inicio.php");
            exit();
        } else {
            header("Location: usuario/PANTALLAS/registro.php?error=Credenciales incorrectas");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
} else {
    header("Location: usuario/PANTALLAS/registro.php");
    exit();
}
