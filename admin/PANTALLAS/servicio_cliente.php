<?php
include "../../conexion.php";
session_start();

// Verificar si el usuario está autenticado y si es admin (puedes ajustar según tu lógica)
$is_admin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';

// Obtener todas las consultas ordenadas por fecha
$sql = "SELECT c.*, u.nombre FROM consultas c JOIN usuarios u ON c.id_usuario = u.id_usuario ORDER BY c.fecha_creacion DESC";
$consultas = $conexion->query($sql)->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicio al Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Servicio al Cliente</h2>

    <?php foreach ($consultas as $consulta): ?>
        <div class="card mb-3">
            <div class="card-header">
                <strong><?= htmlspecialchars($consulta->asunto) ?></strong><br>
                <small>De: <?= htmlspecialchars($consulta->nombre) ?> | Fecha: <?= $consulta->fecha_creacion ?> | Estado: <?= $consulta->estado ?></small>
            </div>
            <div class="card-body">
                <?php
                $stmt = $conexion->prepare("SELECT m.*, u.nombre FROM mensajes_consulta m LEFT JOIN usuarios u ON m.id_usuario = u.id_usuario WHERE m.id_consulta = ? ORDER BY m.fecha ASC");
                $stmt->execute([$consulta->id_consulta]);
                $mensajes = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>

                <?php foreach ($mensajes as $msg): ?>
                    <div class="mb-2">
                        <strong><?= $msg->es_admin ? 'Administrador' : htmlspecialchars($msg->nombre) ?>:</strong>
                        <p><?= nl2br(htmlspecialchars($msg->mensaje)) ?></p>
                        <small class="text-muted"><?= $msg->fecha ?></small>
                        <hr>
                    </div>
                <?php endforeach; ?>

                <?php if ($is_admin && $consulta->estado === 'abierta'): ?>
                    <form method="POST" action="responder_consulta.php" class="mt-3">
                        <input type="hidden" name="id_consulta" value="<?= $consulta->id_consulta ?>">
                        <div class="mb-2">
                            <label>Respuesta:</label>
                            <textarea name="mensaje" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Responder</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
