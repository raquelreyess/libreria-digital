<?php
$host = "localhost";
$usuario = "root";
$contraseña = ""; 
$base_de_datos = "sistema_libros";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>

