<?php
session_start();
require_once '../../conexion.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../registro.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: biblioteca.php");
    exit();
}

$id_libro = intval($_GET['id']);
$id_usuario = $_SESSION['user_id'];

// Obtener información del libro
$sql = "SELECT l.*, g.nombre_genero 
        FROM libros l
        LEFT JOIN generos g ON l.id_genero = g.id_genero
        WHERE l.id_libro = ?";

$stmt = $conexion->prepare($sql);
$stmt->execute([$id_libro]);
$libro = $stmt->fetch(PDO::FETCH_OBJ);

if (!$libro) {
    echo "<p>Libro no encontrado.</p>";
    exit();
}

// Verificar límite de descargas para usuarios básicos
if ($_SESSION['tipo_cliente'] == 2) { // Plan básico (ID 2)
    // Obtener descargas del usuario en el mes actual
    $stmt = $conexion->prepare("SELECT COUNT(*) as total 
                               FROM descargas 
                               WHERE id_usuario = ? 
                               AND MONTH(fecha) = MONTH(CURRENT_DATE()) 
                               AND YEAR(fecha) = YEAR(CURRENT_DATE())");
    $stmt->execute([$id_usuario]);
    $descargas_mes = $stmt->fetch(PDO::FETCH_OBJ)->total;
    
    if ($descargas_mes >= 3) {
        echo "<script>
                alert('Has alcanzado tu límite de 3 descargas este mes. Actualiza a Premium para descargas ilimitadas.');
                window.location.href = 'actualizar_perfil.php';
              </script>";
        exit();
    }
}

// Procesar la descarga
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['descargar'])) {
    try {
        // Registrar la descarga
        $stmt = $conexion->prepare("INSERT INTO descargas (id_usuario, id_libro) VALUES (?, ?)");
        $stmt->execute([$id_usuario, $id_libro]);
        
        // Descargar el archivo
        $archivo = basename($libro->archivo_url);
        $ruta_archivo = "../../uploads/epubs/" . $archivo;
        
        if (file_exists($ruta_archivo)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/epub+zip');
            header('Content-Disposition: attachment; filename="'.basename($ruta_archivo).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta_archivo));
            readfile($ruta_archivo);
            exit;
        } else {
            echo "<p>El archivo no está disponible.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error al registrar la descarga: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($libro->titulo) ?> - Detalles</title>
    <link rel="stylesheet" href="../css/ver_libro.css">
    <style>
        .boton-descarga {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            transition: background-color 0.3s;
        }
        .boton-descarga:hover {
            background-color: #45a049;
        }
        .info-descargas {
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($libro->titulo) ?></h1>
        <div class="detalle-libro">
            <img src="<?= htmlspecialchars($libro->portada_url) ?>" alt="Portada">
            <div class="info">
                <p><strong>Autor:</strong> <?= htmlspecialchars($libro->autor) ?></p>
                <p><strong>Género:</strong> <?= htmlspecialchars($libro->nombre_genero ?? 'Sin género') ?></p>
                <p><strong>Año:</strong> <?= htmlspecialchars($libro->anio_publicacion ?? 'Sin especificar') ?></p>
                <p><strong>Descripción:</strong></p>
                <p><?= nl2br(htmlspecialchars($libro->descripcion)) ?></p>

                <form method="POST">
                    <button type="submit" name="descargar" class="boton-descarga">Descargar EPUB</button>
                </form>

                <?php if ($_SESSION['tipo_cliente'] == 2): ?>
                    <?php
                    $stmt = $conexion->prepare("SELECT COUNT(*) as total 
                                              FROM descargas 
                                              WHERE id_usuario = ? 
                                              AND MONTH(fecha) = MONTH(CURRENT_DATE()) 
                                              AND YEAR(fecha) = YEAR(CURRENT_DATE())");
                    $stmt->execute([$id_usuario]);
                    $descargas_mes = $stmt->fetch(PDO::FETCH_OBJ)->total;
                    $restantes = max(0, 3 - $descargas_mes);
                    ?>
                    <div class="info-descargas">
                        <p>Descargas este mes: <?= $descargas_mes ?>/3</p>
                        <p>Te quedan <?= $restantes ?> descargas este mes.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <a href="biblioteca.php" class="volver">← Volver a la biblioteca</a>
    </div>
</body>
</html>