<?php require('../header.php'); ?>

<?php
include "../../conexion.php";

// Parámetros
$busqueda = $_GET['buscar'] ?? '';
$genero_filtro = $_GET['genero'] ?? '';
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$por_pagina = 30;
$inicio = ($pagina - 1) * $por_pagina;

// Condiciones dinámicas
$condiciones = [];
$params = [];

if (!empty($busqueda)) {
    $condiciones[] = "(libros.id_libro LIKE ? OR libros.titulo LIKE ? OR libros.autor LIKE ?)";
    $busqueda_param = "%$busqueda%";
    $params = array_merge($params, [$busqueda_param, $busqueda_param, $busqueda_param]);
}

if (!empty($genero_filtro)) {
    $condiciones[] = "libros.id_genero = ?";
    $params[] = $genero_filtro;
}

$where = count($condiciones) ? "WHERE " . implode(" AND ", $condiciones) : "";

// Total de resultados
$total_stmt = $conexion->prepare("
    SELECT COUNT(*) 
    FROM libros
    $where
");
$total_stmt->execute($params);
$total_resultados = $total_stmt->fetchColumn();
$total_paginas = ceil($total_resultados / $por_pagina);

// Consulta principal con el nombre del género
$sql = "
    SELECT libros.*, generos.nombre_genero
    FROM libros
    INNER JOIN generos ON libros.id_genero = generos.id_genero
    $where
    ORDER BY libros.id_libro DESC
    LIMIT $inicio, $por_pagina
";
$stmt = $conexion->prepare($sql);
$stmt->execute($params);
$libros = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<form method="GET" class="mb-3">
  <div class="input-group">
    <input type="text" name="buscar" class="form-control" placeholder="Buscar por ID, título o autor" value="<?= htmlspecialchars($busqueda) ?>">

    <select name="genero" class="form-select">
      <option value="">Todos los géneros</option>
      <?php
      $generos = $conexion->query("SELECT * FROM generos");
      foreach ($generos as $g) {
          $selected = ($genero_filtro == $g['id_genero']) ? 'selected' : '';
          echo "<option value='{$g['id_genero']}' $selected>{$g['nombre_genero']}</option>";
      }
      ?>
    </select>

    <button class="btn btn-primary" type="submit">Buscar</button>
  </div>
</form>

<a href="libro_nuevo.php" class="btn btn-success mb-3">Añadir nuevo libro</a>

<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Fecha</th>
        <th>Género</th>
        <th>Portada</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($libros) === 0): ?>
        <tr><td colspan="6"><em>No se encontraron libros.</em></td></tr>
      <?php endif; ?>

      <?php foreach ($libros as $libro): ?>
        <tr>
          <td><?= $libro->id_libro ?></td>
          <td><?= htmlspecialchars($libro->titulo) ?></td>
          <td><?= $libro->fecha_publicacion ?></td>
          <td><?= htmlspecialchars($libro->nombre_genero) ?></td>
          <td>
            <?php if (!empty($libro->portada_url)): ?>
              <img src="<?= htmlspecialchars($libro->portada_url) ?>" alt="Portada" width="60">
            <?php else: ?>
              <em>No disponible</em>
            <?php endif; ?>
          </td>
          <td>
            <a href="libro_editar.php?id=<?= $libro->id_libro ?>" class="btn btn-sm btn-warning">Editar</a>
         <a href="../PHP/eliminar_libro.php?id_libro=<?= $libro->id_libro ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este libro?')">Eliminar</a>

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<nav>
  <ul class="pagination justify-content-center">
    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
      <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
        <a class="page-link" href="?buscar=<?= urlencode($busqueda) ?>&genero=<?= urlencode($genero_filtro) ?>&pagina=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>

<?php require('../footer.php'); ?>
