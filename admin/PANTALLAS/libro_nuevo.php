

<?php require('../header.php') ?>


        <div m-auto>
            <label for="keywords">Busca rapida:</label>
            <input type="text" id="keywords" name="keywords" placeholder="Buscar...">
        </div>

        <br>
        <br>
<form action="../PHP/agregar_libro.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="titulo" placeholder="Título" required><br>
  <input type="text" name="autor" placeholder="Autor" required><br>
  <textarea name="descripcion" placeholder="Descripción"></textarea><br>
  <input type="date" name="fecha_publicacion"><br>
  <input type="text" name="portada_url" placeholder="URL de la portada"><br>
  <select name="id_genero" required>
    <option value="1">Ficción</option>
    <option value="2">Ciencia</option>
  </select><br>
  <label>Archivo EPUB o PDF:</label>
  <input type="file" name="archivo" accept=".epub,.pdf" required><br><br>

  <button type="submit">Agregar libro</button>
</form>


    <?php require('../footer.php') ?>


