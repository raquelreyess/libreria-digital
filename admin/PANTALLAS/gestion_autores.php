<?php
require('../header.php');
include "../../conexion.php";



// Agregar autor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_autor'])) {
    $nombre = trim($_POST['nombre_autor']);
    if ($nombre) {
        $stmt = $conexion->prepare("INSERT INTO autores (nombre_autor) VALUES (?)");
        $stmt->execute([$nombre]);
    }
}

// Eliminar autor
if (isset($_GET['eliminar'])) {
    $stmt = $conexion->prepare("DELETE FROM autores WHERE id_autor = ?");
    $stmt->execute([$_GET['eliminar']]);
}

// Obtener autores
$autores = $conexion->query("SELECT * FROM autores ORDER BY id_autor DESC")->fetchAll(PDO::FETCH_OBJ);
?>

<h2>Gestión de Autores</h2>

<form method="POST" class="mb-3">
  <input type="text" name="nombre_autor" placeholder="Nuevo autor" required>
  <button type="submit" name="nuevo_autor" class="btn btn-primary">Agregar</button>
</form>

<table class="table table-bordered">
  <thead><tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach ($autores as $a): ?>
    <tr>
      <td><?= $a->id_autor ?></td>
      <td><?= htmlspecialchars($a->nombre_autor) ?></td>
      <td><a href="?eliminar=<?= $a->id_autor ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar autor?')">Eliminar</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require('../footer.php'); ?>
