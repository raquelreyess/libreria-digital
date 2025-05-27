<?php
require('header.php');
require('nav.php');
include "../../conexion.php";
?>
    <section class="planes">
        <p>Suscríbete al plan premium y obtén toda la biblioteca de libros a tu disposición</p>

        <div class="planes-contenedor">
            <!-- Plan Gratuito -->
            <div class="plan">
                <h2>Plan Gratuito</h2>
                <p>$0/mes</p>
                <ul>
                    <li>Máximo 3 descargas por mes</li>
                </ul>
            </div>

            <!-- Plan Premium -->
            <div class="plan">
                <h2>Plan Premium</h2>
                <p>$99 MNX/mes</p>
                <ul>
                    <li>Acceso a todo el catálogo</li>
                    <li>Descargas ilimitadas</li>
                </ul>
                <a href="actualizar_perfil.php">
                    <button onclick="alert('Redirigiendo al pago del Plan Premium')">Suscribirse</button>
                </a>
            </div>
        </div>
    </section>
</main>

<?php require('footer.php'); ?>
