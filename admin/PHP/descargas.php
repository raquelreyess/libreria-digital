<?php
session_start(); 
include "../../conexion.php";

$id_usuario = $_SESSION['id_usuario']; 
$id_libro = $_GET['id_libro'] ?? null;

if (!$id_libro) {
    echo "Libro no especificado.";
    exit;
}

// Consulta el tipo de cliente
$sql = $conexion->prepare("SELECT id_tipo_cliente FROM usuarios WHERE id_usuario = ?");
$sql->execute([$id_usuario]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no válido.";
    exit;
}

$tipo = $usuario['id_tipo_cliente'];

// Si es básico, verificamos cuántas descargas lleva este mes
if ($tipo == 1) {
    $stmt = $conexion->prepare("
        SELECT COUNT(*) 
        FROM descargas 
        WHERE id_usuario = ? AND MONTH(fecha) = MONTH(CURRENT_DATE()) AND YEAR(fecha) = YEAR(CURRENT_DATE())
    ");
    $stmt->execute([$id_usuario]);
    $descargas_mes = $stmt->fetchColumn();

    $limite = 3; 
    if ($descargas_mes >= $limite) {
        echo "Has alcanzado tu límite de descargas este mes.";
        exit;
    }
}

// Registrar la descarga
$registro = $conexion->prepare("INSERT INTO descargas (id_usuario, id_libro) VALUES (?, ?)");
$registro->execute([$id_usuario, $id_libro]);



//AUN NO SIRVE
header("Location: /ruta/a/descargar_archivo.php?id_libro=$id_libro");
exit;
?>
