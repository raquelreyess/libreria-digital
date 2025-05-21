<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>CATALOGO</h1>
       <nav>
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
        <h2>Catálogo de Libros</h2>

        <form action="/buscar" method="GET">
            <div>
                <label for="keywords">Buscar tu libro:</label>
                <input type="text" id="keywords" name="keywords" placeholder="Buscar...">
            </div>
    
            <div>
                <label for="category">Categoría:</label>
                <select id="category" name="category">
                    <option value="todos">Todos</option>
                    <option value="tecnologia">Tecnología</option>
                    <option value="deportes">Deportes</option>
                    <option value="cultura">Cultura</option>
                    <option value="cultura">Misterio/suspenso</option>
                    <option value="cultura">Academico</option>
                    <option value="cultura">Terror</option>
                    <option value="cultura">Bibliografia</option>
                    <option value="cultura">Cientifico</option>
                    <option value="cultura">Romance</option>
                    <option value="cultura">No ficcion</option>
                    <option value="cultura">Clasicos</option>
                    <option value="cultura">Historico</option>
                    <option value="cultura">Ciencia ficcion</option>
                    <option value="cultura">poesia</option>
                    <option value="cultura">Arte</option>
                    <option value="cultura">Religion</option>
                    <option value="cultura">Mitologia</option>
                    <option value="cultura">Filosofia</option>
                    <option value="cultura">Auto ayuda</option>
                    <option value="cultura">Negocios</option>


                </select>
            </div>
    
    
            <div>
                <label for="sort">Idioma:</label>
                <select id="sort" name="sort">
                    <option value="relevancia">Español</option>
                    <option value="fecha">Ingles</option>
                    <option value="fecha">Aleman</option>
                    <option value="fecha">Frances</option>
                    <option value="fecha">Portugues</option>
                    <option value="fecha">Italiano</option>
                </select>
            </div>
    
            <button type="submit">Buscar</button>
        </form>

        <section class="catalogo">
            <h2>Catálogo de Libros</h2>
            <div class="libro">
                <a href="detalles.html">
                <img src="imagenes catalogo/libro1.jpg" alt="Libro 1">
            </a>
           

                <h3>El Arte de Programar</h3>
                <p>Autor: John Doe</p>
           
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro2.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
      
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro3.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
      
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro4.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro5.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro6.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro7.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro8.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro9.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>

            <div class="libro">
                <img src="imagenes catalogo/libro10.jpg" alt="Libro 2">
                <h3>Introducción a HTML</h3>
                <p>Autor: Jane Doe</p>
            </div>
        </section>
<br> <br>
        <a href="..">siguiente pagina -></a>
        <br><br><br><br><br><br><br><br><br>
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