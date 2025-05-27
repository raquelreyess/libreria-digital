<?php
require('header.php');
require('nav.php');
include "../../conexion.php";
?>

    <section class="faq">
            
        <div class="faq-item" onclick="toggleAnswer('answer1')">
            <h3>¿Cómo descargo un libro?</h3>
            <p id="answer1">Para descargar un libro, inicia sesión en tu cuenta, busca el libro que deseas y haz clic en el botón de descarga.</p>
        </div>
        <div class="faq-item" onclick="toggleAnswer('answer2')">
            <h3>¿Necesito suscripción para leer libros?</h3>
            <p id="answer2">Algunos libros son gratuitos, pero para acceder a nuestra colección premium necesitas una suscripción.</p>
        </div>
        <div class="faq-item" onclick="toggleAnswer('answer3')">
            <h3>¿Puedo leer libros sin conexión?</h3>
            <p id="answer3">Sí, puedes descargar los libros y acceder a ellos sin conexión desde tu dispositivo.</p>
        </div>
        <div class="faq-item" onclick="toggleAnswer('answer4')">
            <h3>¿Qué formatos de libros están disponibles?</h3>
            <p id="answer4">Nuestros libros están disponibles en formatos PDF, EPUB y MOBI.</p>
        </div>
        <div class="faq-item" onclick="toggleAnswer('answer5')">
            <h3>¿Cómo cancelo mi suscripción?</h3>
            <p id="answer5">Puedes cancelar tu suscripción desde la sección “Mi Cuenta” en la configuración de tu perfil.</p>
        </div>
    </section>
</main>



<footer>
<div class="footer-content">
    <div class="footer-links">
        <a href="preguntas_frecuentes.php">Preguntas frecuentes</a>
        <a href="nosotros.php">Nosotros</a>
    </div>
    <p class="footer-quote">"Un libro es un sueño que tienes en tus manos." – Neil Gaiman</p>
</div>
<p>© 2025 Biblioteca Digital. Todos los derechos reservados.</p>
</footer>

<script src="script/general.js"></script>
</body>
</html>