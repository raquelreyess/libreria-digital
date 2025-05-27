<?php
$current_page = basename($_SERVER['PHP_SELF']);
require('header.php');
require('nav.php');
include "../../conexion.php";
?>


    <section class="hero">
        <img src="../imagenes/fondos/fondo.jpg" alt="Librería Digital">
        <div class="overlay">
            <h1>Descubre Miles de Libros a tu Alcance</h1>
            <p>Tu puerta de entrada al conocimiento y a la cultura. Accesible para todos.
            </p>
            <a href="actualizar_perfil.php" class="btn_s">Suscríbete Ahora</a>
        </div>
    </section>

    <section class="info">
        <h2>¿Por qué elegir nuestra Biblioteca Digital?</h2>
        <div class="beneficios">
            <div>
                <h3>Acceso Ilimitado</h3>
                <p>Descarga y lee todos los libros que desees desde cualquier dispositivo.</p>
            </div>
            <div>
                <h3>Categorías Variadas</h3>
                <p>Explora géneros como ficción, ciencia, tecnología y más.</p>
            </div>
            <div>
                <h3>Planes Flexibles</h3>
                <p>Elige entre opciones gratuitas y premium según tus necesidades.</p>
            </div>
        </div>
    </section>
</main>


<?php require('footer.php'); ?>
