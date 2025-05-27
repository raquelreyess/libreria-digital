<?php
require('../header.php');
require('../../conexion.php');

// Obtener todos los géneros disponibles
$generos_stmt = $conexion->query("SELECT * FROM generos");
$generos = $generos_stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['generos']) && is_array($_POST['generos'])) {
    foreach ($_POST['generos'] as $id_genero) {
        $stmt = $conexion->prepare("INSERT INTO multiples_generos (id_libro, id_genero) VALUES (?, ?)");
        $stmt->execute([$id_libro_insertado, $id_genero]);
    }
}

?>

<div style="max-width: 600px; margin: auto; padding: 20px;">
    <h2>Agregar nuevo libro</h2>
    <br>

    <form action="../PHP/agregar_libro.php" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" placeholder="Título del libro" required><br><br>

        <label for="autor">Autor:</label><br>
        <input type="text" id="autor" name="autor" placeholder="Nombre del autor" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="5" placeholder="Breve descripción del libro" required></textarea><br><br>

        <label for="fecha_publicacion">Fecha de publicación:</label><br>
        <input type="date" id="fecha_publicacion" name="fecha_publicacion" required><br><br>

        <label for="portada_url">URL de la portada:</label><br>
        <input type="text" id="portada_url" name="portada_url" placeholder="https://..."><br><br>

        <label>Géneros:</label><br>
        <?php foreach ($generos as $genero): ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $genero['id_genero'] ?>">
                <label class="form-check-label"><?= htmlspecialchars($genero['nombre_genero']) ?></label>
            </div>
        <?php endforeach; ?>
        <br><br>

        <label for="archivo">Archivo EPUB o PDF:</label><br>
        <input type="file" id="archivo" name="archivo" accept=".epub,.pdf" required><br><br>

        <button type="submit">Agregar libro</button>
    </form>
</div>

<?php require('../footer.php'); ?>
