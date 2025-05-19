<?php

require_once('../../conexion.php');

function obtenerLibros() {
    global $conexion;
    $sql = $conexion->query("SELECT * FROM libros");
    return $sql->fetchAll(PDO::FETCH_OBJ);
}


$where = "WHERE 1=1";
$params = [];

if (!empty($_GET['buscar'])) {
    $where .= " AND (titulo LIKE ? OR id_libro LIKE ?)";
    $busqueda = '%' . $_GET['buscar'] . '%';
    $params[] = $busqueda;
    $params[] = $busqueda;
}

if (!empty($_GET['genero'])) {
    $where .= " AND id_libro IN (SELECT id_libro FROM multiples_generos WHERE id_genero = ?)";
    $params[] = $_GET['genero'];
}

if (!empty($_GET['anio'])) {
    $where .= " AND YEAR(fecha_publicacion) = ?";
    $params[] = $_GET['anio'];
}

$sql = $conexion->prepare("SELECT * FROM libros $where LIMIT 30");
$sql->execute($params);
?>