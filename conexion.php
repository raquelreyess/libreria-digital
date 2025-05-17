<?php
$host = "localhost";
$usuario = "root";
$contraseña = ""; // o "tu_contraseña" si tienes una
$base_de_datos = "sistema_libros";

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
