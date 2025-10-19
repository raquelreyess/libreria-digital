<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}


require_once '../../conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria digital</title>
    <link rel="stylesheet" href="../css/general_admin.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <header>
        <h1>Libreria digital</h1>
        <nav>
              <ul>
            <li><a href="gestion_libros.php" class="<?= $current_page == 'gestion_libros.php' ? 'activo' : '' ?>">Gestión de Libros</a></li>
            <li><a href="gestion_usuarios.php" class="<?= $current_page == 'gestion_usuarios.php' ? 'activo' : '' ?>">Usuarios</a></li>
            <li><a href="gestion_cruds.php" class="<?= $current_page == 'gestion_cruds.php' ? 'activo' : '' ?>">Administración</a></li>
            <li><a href="reportes.php" class="<?= $current_page == 'reportes.php' ? 'activo' : '' ?>">Reportes</a></li>
            <li><a href="../../cerrar_sesion.php" class="<?= $current_page == '../../cerrar_sesion.php' ? 'activo' : '' ?>">Cerrar Sesión</a></li>
        </ul>
        </nav>
    </header>
    
    <main>