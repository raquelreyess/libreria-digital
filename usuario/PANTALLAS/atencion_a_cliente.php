<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
<link rel="stylesheet" href="../css/general.css">
</head>

<body>
<header>
    <nav class="navbar">
    <div class="logo">
        <img src="imagenes/logo.jpg" alt="Logo biblioteca Digital">
        Libreria Global-Pagina de inicio
    </div>
    <ul class="nav-links">
         <li><a href="inicio.php" class="<?= $current_page == 'gestion_libros.php' ? 'activo' : '' ?>">inicio</a></li>
            <li><a href="catalogo.php" class="<?= $current_page == 'catalogo.php' ? 'activo' : '' ?>">Catalogo</a></li>
            <li><a href="categorias.php" class="<?= $current_page == 'categorias.php' ? 'activo' : '' ?>">Categorias</a></li>
            <li><a href="cuenta.php" class="<?= $current_page == 'cuenta.php' ? 'activo' : '' ?>">Cuenta</a></li>
              <li><a href="../../cerrar_sesion_usuario.php">Cerrar Sesión</a></li>

    </ul>
</nav>
</header>


<main>
    <section class="form-section-a">
        <h1>Enviar una Solicitud</h1>
        <p class="info-box">
            Nuestro equipo de atención está disponible para ayudarte. Completa el formulario y nos pondremos en contacto contigo.
        </p>

        <form class="support-form">
            <label for="problema">Seleccione su problema:</label>
            <select id="problema">
                <option value="">Seleccione una opción...</option>
                <option value="cuenta">Problemas con la cuenta</option>
                <option value="pagos">Facturación y pagos</option>
                <option value="tecnico">Soporte técnico</option>
            </select>

            <label for="email">Correo Electrónico *</label>
            <input type="email" id="email" placeholder="tuemail@ejemplo.com" required>

            <label for="asunto">Asunto *</label>
            <input type="text" id="asunto" placeholder="Escribe un asunto..." required>

            <label for="mensaje">Mensaje *</label>
            <textarea id="mensaje" rows="5" placeholder="Describe tu problema..." required></textarea>

            <button type="submit" class="btn-submit">Enviar Solicitud</button>
        </form>
    </section>
</main>



<footer>
<div class="footer-content">
    <div class="footer-links">
        <a href="atencion_a_cliente.html">Atencion a cliente</a>
        <a href="preguntas_frecuentes.html">Preguntas frecuentes</a>
        <a href="nosotros.html">Nosotros</a>
    </div>
    <p class="footer-quote">"Un libro es un sueño que tienes en tus manos." – Neil Gaiman</p>
</div>
<p>© 2025 Biblioteca Digital. Todos los derechos reservados.</p>
</footer>
</body>
</html>