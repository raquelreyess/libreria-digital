<?php
require('header.php');
?>
<link rel="stylesheet" href="../css/nosotros.css">
<?php
require('nav.php');
include "../../conexion.php";
?>


    
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
            
           
            
            <div class="card">
                <h2>Únete a Nosotros</h2>
                <p>Forma parte de nuestra comunidad y descubre el placer de la lectura digital. Con Biblioteca Digital, los libros están a un clic de distancia.</p>
            </div>
        </section>
    </main>
<?php require('footer.php'); ?>
