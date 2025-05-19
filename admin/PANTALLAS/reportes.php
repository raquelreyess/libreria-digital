<?php
session_start();
require('../header.php');
include "../../conexion.php";


?>

<div class="container mt-5">
  <h2 class="mb-4">Reportes de Descargas</h2>

  <h4>1. Descargas por Libro</h4>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID Libro</th>
        <th>Título</th>
        <th>Cantidad de Descargas</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $libros = $conexion->query("
        SELECT l.id_libro, l.titulo, COUNT(d.id_descarga) AS total_descargas
        FROM libros l
        LEFT JOIN descargas d ON l.id_libro = d.id_libro
        GROUP BY l.id_libro, l.titulo
        ORDER BY total_descargas DESC
      ");
      foreach ($libros as $libro): ?>
        <tr>
          <td><?= $libro['id_libro'] ?></td>
          <td><?= htmlspecialchars($libro['titulo']) ?></td>
          <td><?= $libro['total_descargas'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4 class="mt-5">2. Descargas por Género</h4>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Género</th>
        <th>Total de Descargas</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $generos = $conexion->query("
        SELECT g.nombre_genero, COUNT(d.id_descarga) AS total_descargas
        FROM generos g
        LEFT JOIN libros l ON g.id_genero = l.id_genero
        LEFT JOIN descargas d ON l.id_libro = d.id_libro
        GROUP BY g.nombre_genero
        ORDER BY total_descargas DESC
      ");
      foreach ($generos as $genero): ?>
        <tr>
          <td><?= htmlspecialchars($genero['nombre_genero']) ?></td>
          <td><?= $genero['total_descargas'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require('../footer.php'); ?>
