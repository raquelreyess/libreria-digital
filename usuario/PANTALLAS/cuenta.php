<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
<link rel="stylesheet" href="../css/general.css">
</head>

<body>
<header>
    <nav class="navbar">
        <div class="logo">
            <img src="imagenes/logo.jpg" alt="Logo biblioteca Digital">
Mi cuenta
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
    <section class="perfil-container">
        <div class="perfil-columnas">
            <div class="perfil-seccion">
                <h3>Información Personal</h3>
                <form id="perfilForm" class="perfil-formulario">
                    <div class="form-grupo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" value="Juan Pérez" required>
                    </div>
                    
                    <div class="form-grupo">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" value="juanperez@email.com" required>
                    </div>
                    
                    <div class="form-grupo">
                        <label for="plan">Plan Actual:</label>
                        <input type="text" id="plan" value="Premium" disabled>
                    </div>
                    
                    <a class="btn_c perfil-btn" href="editardatos.html">Editar datos</a>
                </form>
            </div>
    
            <div class="perfil-seccion">
                <h3>Estado de Suscripción</h3>
                <div class="suscripcion-info">
                    <p><strong>Plan Actual:</strong> Premium</p>
                    <p><strong>Próximo Pago:</strong> 10 de marzo de 2025</p>
                </div>
                <button class="btn-secundario">Cancelar Suscripción</button>
            </div>
        </div>
        
        <div>
            <a class="btn_c" href="atencion.html">Atención a cliente</a>
            <a class="btn_c" href="buzon.html">Buzón</a>
        </div>
    </section>
</main>



<footer>
<div class="footer-content">
    <div class="footer-links">
        <a href="atencion_a_cliente.html">Atencion a cliente</a>
        <a href="frecuentes.html">Preguntas frecuentes</a>
        <a href="nosotros.html">Nosotros</a>
    </div>
    <p class="footer-quote">"Un libro es un sueño que tienes en tus manos." – Neil Gaiman</p>
</div>
<p>© 2025 Biblioteca Digital. Todos los derechos reservados.</p>
</footer>
</body>
</html>