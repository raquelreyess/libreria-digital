
<?php
include "../../conexion.php";

$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : null;
$mensaje = "";
$datos = null;

if ($id) {
    // Obtener datos del libro
    $sql = $conexion->prepare("SELECT * FROM libros WHERE id_libro = ?");
    $sql->execute([$id]);
    $datos = $sql->fetch(PDO::FETCH_OBJ);
}

// Guardar cambios
if ($_SERVER["REQUEST_METHOD"] === "POST" && $datos) {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? '';
    $portada_url = $_POST['portada_url'] ?? '';

$archivo_url = $datos->archivo_url; // Mantener la actual por defecto

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
    $nombreOriginal = $_FILES['archivo']['name'];
    $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $nuevoNombre = uniqid() . '_' . basename($nombreOriginal);
    $carpetaDestino = __DIR__ . '/../../uploads/epubs/';
    $rutaRelativa = 'uploads/epubs/' . $nuevoNombre;
    $rutaFinal = $carpetaDestino . $nuevoNombre;

    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaFinal)) {
        $archivo_url = $rutaRelativa;

        // (Opcional) eliminar el archivo anterior si existe
        $archivoAntiguo = __DIR__ . '/../../' . $datos->archivo_url;
        if (file_exists($archivoAntiguo)) {
            unlink($archivoAntiguo);
        }
    }
}


   $update = $conexion->prepare("UPDATE libros SET titulo = ?, autor = ?, descripcion = ?, fecha_publicacion = ?, portada_url = ?, archivo_url = ? WHERE id_libro = ?");
$resultado = $update->execute([$titulo, $autor, $descripcion, $fecha_publicacion, $portada_url, $archivo_url, $id]);

    if ($resultado) {
        $mensaje = "Cambios guardados correctamente.";
        // Volver a cargar datos
        $sql = $conexion->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $sql->execute([$id]);
        $datos = $sql->fetch(PDO::FETCH_OBJ);
    } else {
        $mensaje = "Error al guardar los cambios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="../css/libro_editar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <h1>Gestión de libros</h1>
    <nav>
        <ul>
            <li><a href="gestion_libros.php" class="volver">Volver</a></li>
        </ul>
    </nav>
</header>

<main class="container py-4">

<?php if ($datos): ?>
    <form method="POST" enctype="multipart/form-data">
        <h5>EDITAR LIBRO</h5>

        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?= $mensaje ?></div>
        <?php endif; ?>

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($datos->titulo) ?>"><br>

        <label>Autor:</label><br>
        <input type="text" name="autor" value="<?= htmlspecialchars($datos->autor) ?>"><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"><?= htmlspecialchars($datos->descripcion) ?></textarea><br>

        <label>Fecha de publicación:</label><br>
        <input type="date" name="fecha_publicacion" value="<?= $datos->fecha_publicacion ?>"><br>

        <label>URL de la portada:</label><br>
        <input type="text" name="portada_url" value="<?= htmlspecialchars($datos->portada_url) ?>"><br>

        <?php if (!empty($datos->portada_url)): ?>
            <img src="<?= htmlspecialchars($datos->portada_url) ?>" alt="Portada" style="width:150px; margin-top:10px;"><br>
        <?php endif; ?>

       <label>Archivo EPUB/PDF actual:</label><br>
<?php if (!empty($datos->archivo_url)): ?>
    <a href="../../<?= htmlspecialchars($datos->archivo_url) ?>" target="_blank">Ver archivo actual</a><br>
<?php endif; ?>

<label>Subir nuevo archivo:</label><br>
<input type="file" name="archivo"><br>


        <button type="submit" class="btn btn-primary mt-2">Guardar cambios</button>
    </form>
<?php else: ?>
    <p>No se encontró el libro.</p>
<?php endif; ?>

</main>

<?php require('../footer.php'); ?>
</body>
</html>
