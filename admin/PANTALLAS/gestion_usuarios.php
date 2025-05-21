 <?php require('../header.php');
include "../PHP/eliminar_usuario.php";
?>

<h2>Gestion de usuario</h2>
 
 <form method="GET" class="mb-3">
  <div class="input-group">
    <input type="text" name="buscar" class="form-control" placeholder="Buscar por ID o nombre" value="<?= htmlspecialchars($busqueda) ?>">

    <select name="genero" class="form-select">
      <option value="">Todos los usuarios</option>
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

<a href="crear_usuario.php" class="btn btn-success mb-3">Añadir nuevo Usuario</a>

       

 <div class="table-responsive">
  <table class="table table-striped table-hover table-bordered align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Plan</th>
              <th scope="col">???</th>

      </tr>
    </thead>
    <tbody>
      <?php 
      include "../../conexion.php";
      $sql = $conexion->query("SELECT * FROM usuarios");
      $usuarios = $sql->fetchAll(PDO::FETCH_OBJ);

      foreach ($usuarios as $datos): ?>
        <tr>
          <td><?= $datos->id_usuario ?></td>
          <td><?= $datos->nombre ?></td>
          <td><?= $datos->correo ?></td>
          <td><?= $datos->telefono ?></td>
          <td><?= $datos->id_tipo_cliente ?></td>
          
          <td>
            <a href="libro_editar.php?id=<?= $datos->id_usuario ?>" class="btn btn-sm btn-warning">Ver</a>
        <a href="gestion_usuarios.php?id_usuario=<?= $datos->id_usuario ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</a>

          </td>

        </tr>


      <?php endforeach; ?>
    </tbody>
  </table>
</div>


 <?php require('../footer.php') ?>
   