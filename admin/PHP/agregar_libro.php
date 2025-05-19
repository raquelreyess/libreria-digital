<?php
include "../../conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descripcion = $_POST['descripcion'] ?? null;
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? null;
    $portada_url = $_POST['portada_url'] ?? null;
    $id_genero = $_POST['id_genero'];

    // Validar archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
        $nombreOriginal = $_FILES['archivo']['name'];
        $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
        $nuevoNombre = uniqid() . '_' . basename($nombreOriginal);
        $carpetaDestino = __DIR__ . '../../uploads/epubs/';
        $rutaRelativa = 'uploads/epubs/' . $nuevoNombre;
        $rutaFinal = $carpetaDestino . $nuevoNombre;

        if (!is_dir($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaFinal)) {
            // Insertar en la base de datos
            $stmt = $conexion->prepare("INSERT INTO libros 
                (titulo, autor, descripcion, fecha_publicacion, portada_url, id_genero, archivo_url) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$titulo, $autor, $descripcion, $fecha_publicacion, $portada_url, $id_genero, $rutaRelativa]);

            header("Location: ../PANTALLAS/gestion_libros.php?mensaje=libro_agregado");
            exit();
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Archivo no válido.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
