<?php
include '../../conexion.php';

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$descripcion = $_POST['descripcion'];
$fecha_publicacion = $_POST['fecha_publicacion'];
$portada_url = $_POST['portada_url'];
$id_genero = $_POST['id_genero'];

$sql = "INSERT INTO libros (titulo, autor, descripcion, fecha_publicacion, portada_url, id_genero)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $titulo, $autor, $descripcion, $fecha_publicacion, $portada_url, $id_genero);

if ($stmt->execute()) {
    echo "Libro agregado correctamente.";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
