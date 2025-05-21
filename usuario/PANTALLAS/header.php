<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: registro.php");
    exit();
}


require_once '../../conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria digital</title>
    <link rel="stylesheet" href="../css/general.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <header>
         <nav class="navbar">
    <div class="logo">
        <img src="../imagenes/logo.jpg" alt="Logo biblioteca Digital">
        Libreria Digital-Pagina de inicio
    </div>
    <ul class="nav-links">
       <li><a href="inicio.php" class="<?= $current_page == 'gestion_libros.php' ? 'activo' : '' ?>">inicio</a></li>
            <li><a href="catalogo.php" class="<?= $current_page == 'catalogo.php' ? 'activo' : '' ?>">Catalogo</a></li>
            <li><a href="categorias.php" class="<?= $current_page == 'categorias.php' ? 'activo' : '' ?>">Categorias</a></li>
            <li><a href="cuenta.php" class="<?= $current_page == 'cuenta.php' ? 'activo' : '' ?>">Cuenta</a></li>
            <li><a href="planes.html" class="<?= $current_page == 'planes.php' ? 'activo' : '' ?>">Planes</a></li>
       <li><a href="../../cerrar_sesion_usuario.php">Cerrar Sesión</a></li>
    </ul>
</nav>
    </header>
    
    <main>