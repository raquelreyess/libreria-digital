<?php
require('header.php');
include "../../conexion.php";
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros - Biblioteca Digital</title>
    <link rel="stylesheet" href="principal.css">
    <style>
        .nosotros {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .imagenes {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .imagenes img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-links">
       <li><a href="inicio.php" class="<?= $current_page == 'gestion_libros.php' ? 'activo' : '' ?>">inicio</a></li>
            <li><a href="catalogo.php" class="<?= $current_page == 'catalogo.php' ? 'activo' : '' ?>">Catalogo</a></li>
            <li><a href="categorias.php" class="<?= $current_page == 'categorias.php' ? 'activo' : '' ?>">Categorias</a></li>
            <li><a href="cuenta.php" class="<?= $current_page == 'cuenta.php' ? 'activo' : '' ?>">Cuenta</a></li>
            <li><a href="planes.html" class="<?= $current_page == 'planes.php' ? 'activo' : '' ?>">Planes</a></li>
            <li><a href="logout.html" class="<?= $current_page == 'logout.html' ? 'activo' : '' ?>">Cerrar Sesión</a></li>
    </ul>
        </nav>
    </header>
    
    <main>
        <section class="nosotros">
            <div class="card" style="grid-column: span 2;">
                <h1>Sobre Nosotros</h1>
                <p>Bienvenido a <strong>Biblioteca Digital</strong>, tu plataforma de lectura en línea diseñada para acercarte al conocimiento de manera accesible y sencilla.</p>
            </div>
            
            <div class="card">
                <h2>Nuestra Historia</h2>
                <p>Fundada en 2025, Biblioteca Digital nació con la idea de facilitar el acceso a la lectura sin barreras geográficas.</p>
            </div>
            
            <div class="card">
                <h2>¿Qué ofrecemos?</h2>
                <p>Explora un catálogo diverso con miles de libros en distintos géneros y formatos, accesibles desde cualquier dispositivo.</p>
            </div>
            
            <div class="card" style="grid-column: span 2;">
                <h2>Nuestro Compromiso</h2>
                <p>Nos esforzamos por mejorar continuamente nuestra plataforma para ofrecer una experiencia de usuario intuitiva y enriquecedora.</p>
            </div>
            
            <div class="imagenes" style="grid-column: span 2;">
            
                <img src="imagenes_fondos/biblioteca_digital.jpg" alt="Biblioteca Digital">
            </div>
            
            <div class="card">
                <h2>Únete a Nosotros</h2>
                <p>Forma parte de nuestra comunidad y descubre el placer de la lectura digital. Con Biblioteca Digital, los libros están a un clic de distancia.</p>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="servicio-cliente.html">Servicio al Cliente</a>
                <a href="preguntas-frecuentes.html">Preguntas Frecuentes</a>
                <a href="nosotros.html">Nosotros</a>
            </div>
            <p class="footer-quote">"Un libro es un sueño que tienes en tus manos." – Neil Gaiman</p>
        </div>
        <p>© 2025 Biblioteca Digital. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
