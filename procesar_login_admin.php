<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"] ?? '';
    $contrasena = $_POST["contrasena"] ?? '';

    if (empty($correo) || empty($contrasena)) {
        header("Location: admin/PANTALLAS/login_admin.php?mensaje=Campos obligatorios");
        exit();
    }

    $sql = "SELECT * FROM usuarios WHERE correo = :correo AND id_rol = 1";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(['correo' => $correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION["admin_id"] = $usuario["id_usuario"];
        $_SESSION["admin_nombre"] = $usuario["nombre"];
        header("Location: admin/PANTALLAS/gestion_libros.php");
        exit();
    } else {
        header("Location: admin/PANTALLAS/login_admin.php?mensaje=Credenciales inválidas o no eres administrador");
        exit();
    }
}
?>
