<?php
$host = "localhost";
$usuario = "root";
$contraseña = ""; // o tu contraseña si configuraste una
$base_de_datos = "sistema_libros"; // cambia si tu base tiene otro nombre

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

echo "¡Conexión exitosa a la base de datos!";
?>