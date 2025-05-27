<?php
include "../../conexion.php";

$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : null;
$mensaje = "";
$datos = null;

if ($id) {
    $sql = $conexion->prepare("SELECT * FROM libros WHERE id_libro = ?");
    $sql->execute([$id]);
    $datos = $sql->fetch(PDO::FETCH_OBJ);
}

// Obtener todos los géneros 
$generos_stmt = $conexion->query("SELECT * FROM generos");
$generos = $generos_stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener géneros asociados al libro actual
$generos_libro = [];
if ($datos) {
    $stmt_generos_libro = $conexion->prepare("SELECT id_genero FROM multiples_generos WHERE id_libro = ?");
    $stmt_generos_libro->execute([$id]);
    $generos_libro = $stmt_generos_libro->fetchAll(PDO::FETCH_COLUMN);
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && $datos) {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? '';
    $portada_url = $_POST['portada_url'] ?? '';
    $archivo_url = $datos->archivo_url;

    // Subida de nuevo archivo 
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

            // Eliminar archivo anterior si existe
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
        $sql = $conexion->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $sql->execute([$id]);
        $datos = $sql->fetch(PDO::FETCH_OBJ);
    } else {
        $mensaje = "Error al guardar los cambios.";
    }
}

// Actualizar géneros del libro
$conexion->prepare("DELETE FROM multiples_generos WHERE id_libro = ?")->execute([$id]);

if (!empty($_POST['generos'])) {
    $insert_genero = $conexion->prepare("INSERT INTO multiples_generos (id_libro, id_genero) VALUES (?, ?)");
    foreach ($_POST['generos'] as $id_genero) {
        if (is_numeric($id_genero)) {
            $insert_genero->execute([$id, $id_genero]);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="../css/libro_editar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-dark text-white p-3">
    <div class="container">
        <h1 class="h3">Gestión de libros</h1>
        <a href="gestion_libros.php" class="btn btn-outline-light btn-sm">Volver</a>
    </div>
</header>

<main class="container py-4">
<?php if ($datos): ?>
    <form method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        <h4 class="mb-3">Editar libro</h4>

        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?= $mensaje ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <label>Título:</label>
            <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($datos->titulo) ?>" required>
        </div>

        <div class="mb-3">
            <label>Autor:</label>
            <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($datos->autor) ?>" required>
        </div>

      <label>Géneros:</label><br>
<?php foreach ($generos as $genero): ?>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $genero['id_genero'] ?>"
            <?= in_array($genero['id_genero'], $generos_libro) ? 'checked' : '' ?>>
        <label class="form-check-label"><?= htmlspecialchars($genero['nombre_genero']) ?></label>
    </div>
<?php endforeach; ?>



        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="5" required><?= htmlspecialchars($datos->descripcion) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Fecha de publicación:</label>
            <input type="date" name="fecha_publicacion" class="form-control" value="<?= $datos->fecha_publicacion ?>" required>
        </div>

        <div class="mb-3">
            <label>URL de la portada:</label>
            <input type="text" name="portada_url" class="form-control" value="<?= htmlspecialchars($datos->portada_url) ?>">
            <?php if (!empty($datos->portada_url)): ?>
                <img src="<?= htmlspecialchars($datos->portada_url) ?>" alt="Portada" class="mt-2 rounded" style="width: 120px;">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Archivo EPUB/PDF actual:</label><br>
            <?php if (!empty($datos->archivo_url)): ?>
                <a href="../../<?= htmlspecialchars($datos->archivo_url) ?>" target="_blank">Ver archivo actual</a>
            <?php else: ?>
                <span class="text-muted">No hay archivo disponible.</span>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Subir nuevo archivo:</label>
            <input type="file" name="archivo" class="form-control" accept=".epub,.pdf">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
<?php else: ?>
    <div class="alert alert-danger">No se encontró el libro.</div>
<?php endif; ?>
</main>

<?php require('../footer.php'); ?>
</body>
</html>
