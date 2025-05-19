<?php

require('../header.php');
include "../../conexion.php";

// Agregar género
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_genero'])) {
    $nombre = trim($_POST['nombre_genero']);
    $solo_premium = isset($_POST['solo_premium']) ? 1 : 0;
    if ($nombre) {
        $stmt = $conexion->prepare("INSERT INTO generos (nombre_genero, solo_premium) VALUES (?, ?)");
        $stmt->execute([$nombre, $solo_premium]);
    }
}

// Eliminar género
if (isset($_GET['eliminar'])) {
    $stmt = $conexion->prepare("DELETE FROM generos WHERE id_genero = ?");
    $stmt->execute([$_GET['eliminar']]);
}

// Obtener géneros
$generos = $conexion->query("SELECT * FROM generos ORDER BY id_genero DESC")->fetchAll(PDO::FETCH_OBJ);
?>

<h2>Gestión de Géneros</h2>

<form method="POST" class="mb-3">
  <input type="text" name="nombre_genero" placeholder="Nuevo género" required>
  <label><input type="checkbox" name="solo_premium"> Solo Premium</label>
  <button type="submit" name="nuevo_genero" class="btn btn-primary">Agregar</button>
</form>

<table class="table table-bordered">
  <thead><tr><th>ID</th><th>Nombre</th><th>Premium</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach ($generos as $g): ?>
    <tr>
      <td><?= $g->id_genero ?></td>
      <td><?= htmlspecialchars($g->nombre_genero) ?></td>
      <td><?= $g->solo_premium ? 'Sí' : 'No' ?></td>
      <td><a href="?eliminar=<?= $g->id_genero ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar género?')">Eliminar</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('../footer.php'); ?>

