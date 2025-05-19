 <?php require('../header.php') ?>
<?php 
include "../PHP/eliminar_usuario.php";
?>

 
 <div>
            <label for="keywords">Busca rapida:</label>
            <input type="text" id="keywords" name="keywords" placeholder="Buscar...">
        </div>

        <br>
        <br>

        <a href="admin_nuevolibro.html" class="agregar-libro">Agregar Nuevo Libro</a>
 <br>
       

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
            <a href="libro_editar.php?id=<?= $datos->id_usuario ?>" class="btn btn-sm btn-warning">Editar</a>
        <a href="gestion_usuarios.php?id_usuario=<?= $datos->id_usuario ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</a>

          </td>

        </tr>


      <?php endforeach; ?>
    </tbody>
  </table>
</div>


 <?php require('../footer.php') ?>
   