<?php
require('../header.php');
include "../../conexion.php";

// Agregar género
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_genero'])) {
    $nombre = trim($_POST['nombre_genero']);
    
    if (!empty($nombre)) {
        try {
            $stmt = $conexion->prepare("INSERT INTO generos (nombre_genero) VALUES (?)");
            $stmt->execute([$nombre]);
            
            // Mensaje de éxito
            $_SESSION['mensaje'] = "Género agregado correctamente";
            $_SESSION['tipo_mensaje'] = "success";
        } catch (PDOException $e) {
            // Mensaje de error
            $_SESSION['mensaje'] = "Error al agregar género: " . $e->getMessage();
            $_SESSION['tipo_mensaje'] = "danger";
        }
        
        // Redirigir para evitar reenvío del formulario
        header("Location: gestion_generos.php");
        exit();
    }
}

// Eliminar género
if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    try {
        $stmt = $conexion->prepare("DELETE FROM generos WHERE id_genero = ?");
        $stmt->execute([$_GET['eliminar']]);
        
        $_SESSION['mensaje'] = "Género eliminado correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error al eliminar género: " . $e->getMessage();
        $_SESSION['tipo_mensaje'] = "danger";
    }
    
    // Redirigir para evitar reenvío del parámetro
    header("Location: gestion_generos.php");
    exit();
}

// Obtener géneros
$generos = $conexion->query("SELECT * FROM generos ORDER BY id_genero DESC")->fetchAll(PDO::FETCH_OBJ);
?>

<h2>Gestión de Géneros</h2>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?>">
        <?= $_SESSION['mensaje'] ?>
    </div>
    <?php unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
<?php endif; ?>

<form method="POST" class="mb-3 row g-3">
  <div class="col-auto">
    <input type="text" name="nombre_genero" class="form-control" placeholder="Nombre del nuevo género" required>
  </div>
  <div class="col-auto">
    <button type="submit" name="nuevo_genero" class="btn btn-primary">Agregar</button>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($generos) > 0): ?>
        <?php foreach ($generos as $g): ?>
        <tr>
          <td><?= $g->id_genero ?></td>
          <td><?= htmlspecialchars($g->nombre_genero) ?></td>
          <td>
            <a href="?eliminar=<?= $g->id_genero ?>" 
               class="btn btn-danger btn-sm" 
               onclick="return confirm('¿Estás seguro de eliminar este género?')">
              Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center">No hay géneros registrados</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require('../footer.php'); ?>