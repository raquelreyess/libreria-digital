<?php
include "../../conexion.php";

if (!empty($_GET["id_libro"]) && is_numeric($_GET["id_libro"])) {
    $id = intval($_GET["id_libro"]);

    $sql = $conexion->prepare("DELETE FROM libros WHERE id_libro = ?");
    $resultado = $sql->execute([$id]);

    if ($resultado) {
        header("Location: ../PANTALLAS/gestion_libros.php?mensaje=eliminado");
        exit;
    } else {
        echo '<div class="alert alert-danger">Hubo un error al eliminar el libro.</div>';
    }
} else {
    echo '<div class="alert alert-warning">ID inválido.</div>';
}
?>
