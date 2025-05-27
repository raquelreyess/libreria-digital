<?php
$current_page = basename($_SERVER['PHP_SELF']);
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: registro.php");
    exit();
}


require_once '../../conexion.php';

// Parámetros
$busqueda = $_GET['buscar'] ?? '';
$genero = $_GET['genero'] ?? '';
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$por_pagina = 20;
$inicio = ($pagina - 1) * $por_pagina;

// Obtener géneros para el filtro
$generos = $conexion->query("SELECT * FROM generos")->fetchAll(PDO::FETCH_OBJ);

// Filtros dinámicos
$condiciones = [];
$params = [];

if (!empty($busqueda)) {
    $condiciones[] = "(titulo LIKE ? OR autor LIKE ?)";
    $busqueda_param = "%$busqueda%";
    $params[] = $busqueda_param;
    $params[] = $busqueda_param;
}

if (!empty($genero)) {
    $condiciones[] = "id_genero = ?";
    $params[] = $genero;
}

$where = count($condiciones) ? "WHERE " . implode(" AND ", $condiciones) : "";

// Total de libros
$total_stmt = $conexion->prepare("SELECT COUNT(*) FROM libros $where");
$total_stmt->execute($params);
$total = $total_stmt->fetchColumn();
$total_paginas = ceil($total / $por_pagina);

// Libros por página
$sql = "SELECT * FROM libros $where ORDER BY id_libro DESC LIMIT $inicio, $por_pagina";
$stmt = $conexion->prepare($sql);
$stmt->execute($params);
$libros = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="../css/biblioteca.css">
</head>
<body>
    <header>
        <h1>Biblioteca Digital</h1>
    <ul class="nav-links">
       <li><a href="inicio.php" class="<?= $current_page == 'gestion_libros.php' ? 'activo' : '' ?>">inicio</a></li>
            <li><a href="biblioteca.php" class="<?= $current_page == 'biblioteca.php' ? 'activo' : '' ?>">Catalogo</a></li>
            <li><a href="actualizar_perfil.php" class="<?= $current_page == 'actualizar_perfil.php' ? 'activo' : '' ?>">Cuenta</a></li>
            <li><a href="planes.php" class="<?= $current_page == 'planes.php' ? 'activo' : '' ?>">Planes</a></li>
       <li><a href="../../cerrar_sesion_usuario.php">Cerrar Sesión</a></li>
    </ul>
        
        <form method="GET" class="busqueda">
            <input type="text" name="buscar" placeholder="Buscar por título o autor" value="<?= htmlspecialchars($busqueda) ?>">
            <select name="genero">
                <option value="">Todos los géneros</option>
                <?php foreach ($generos as $g): ?>
                    <option value="<?= $g->id_genero ?>" <?= $g->id_genero == $genero ? 'selected' : '' ?>>
                        <?= htmlspecialchars($g->nombre_genero) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Buscar</button>
        </form>
    </header>

    <main>
      <div class="libros-container">
    <?php foreach ($libros as $libro): ?>
        <div class="libro">
            <img src="<?= htmlspecialchars($libro->portada_url) ?>" alt="Portada">
            <a href="ver_libro.php?id=<?= $libro->id_libro ?>">
                <?= htmlspecialchars($libro->titulo) ?>
            </a>
            <div class="autor">
                <?= htmlspecialchars($libro->autor) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

        <div class="paginacion">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <a href="?pagina=<?= $i ?>&buscar=<?= urlencode($busqueda) ?>&genero=<?= urlencode($genero) ?>"
                   class="<?= $i == $pagina ? 'actual' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </main>
</body>
</html>
