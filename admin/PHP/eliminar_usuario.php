<?php
include "../../conexion.php";

if (!empty($_GET["id_usuario"]) && is_numeric($_GET["id_usuario"])) {
    $id = intval($_GET["id_usuario"]);

    $sql = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
    $resultado = $sql->execute([$id]);

    if ($resultado) {
        echo '<div class="alert alert-success">Se ha eliminado correctamente.</div>';
    } else {
        echo '<div class="alert alert-danger">Hubo un error al eliminar.</div>';
    }
} 
?>
