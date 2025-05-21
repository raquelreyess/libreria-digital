<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías de Libros</title>
    

    <style>/* General */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        
        nav ul {
            list-style: none;
            padding: 0;
        }
        
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        
        nav ul li a:hover {
            color: #ffcc00;
        }
      /* Sección de Más Populares */
      .mas-populares {
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            padding: 20px;
            margin: 20px auto;
            max-width: 90%;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .mas-populares img {
            width: 60%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        
        .mas-populares h2 {
            margin-left: 20px;
            color: #333;
        }


        /* Sección de Categorías */
        .categorias {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }
        
        .categoria {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        
        .categoria img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .categoria h3 {
            padding: 10px;
            margin: 0;
            color: #333;
        }
        
        .categoria a {
            text-decoration: none;
            display: block;
            color: inherit;
        }
        
        .categoria:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
        }
        
        footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 20px;
}

.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 10px;
}

.footer-links {
    margin-bottom: 10px;
}

.footer-links a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-weight: bold;
}

.footer-links a:hover {
    text-decoration: underline;
}

.footer-quote {
    font-style: italic;
    font-size: 14px;
}
        </style>

</head>


<body>
    <header>
        <h1>Categorias</h1>
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
   
       

        <section class="categorias">
            <div class="categoria">
                <a href="categoria-tecnologia.html">
                    <img src="imagenes_categorias/tecnologia.jpg" alt="Tecnología">
                    <h3>Tecnología</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria-deportes.html">
                    <img src="imagenes_categorias/deportes.jpg" alt="Deportes">
                    <h3>Deportes</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria-misterio.html">
                    <img src="imagenes_categorias/misterio.jpg" alt="Misterio">
                    <h3>Misterio / Suspenso</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria-terror.html">
                    <img src="imagenes_categorias/terror.jpg" alt="Terror">
                    <h3>Terror</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria-romance.html">
                    <img src="imagenes_categorias/romance.jpg" alt="Romance">
                    <h3>Romance</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria-filosofia.html">
                    <img src="imagenes_categorias/filosofia.jpg" alt="Filosofía">
                    <h3>Filosofía</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria_cienciaficcion.html">
                    <img src="imagenes_categorias/ciencia_ficcion.jpg" alt="Ciencia Ficción">
                    <h3>Ciencia Ficción</h3>
                </a>
            </div>

            <div class="categoria">
                <a href="categoria-autoayuda.html">
                    <img src="imagenes_categorias/auto_ayuda.jpg" alt="Autoayuda">
                    <h3>Autoayuda</h3>
                </a>
            </div>


          
        </section>
        <section class="mas-populares">
            <a href="populares.html">
            <img src="imagenes_categorias/populares.jpg" alt="Los Más Populares"></a>
            <h2>Descubre los libros más populares del momento</h2>
        </section>
    </main>

<?php
require('footer.php');
?>