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
            <li><a href="biblioteca.php" class="<?= $current_page == 'biblioteca.php' ? 'activo' : '' ?>">Catalogo</a></li>
            <li><a href="actualizar_perfil.php" class="<?= $current_page == 'actualizar_perfil.php' ? 'activo' : '' ?>">Cuenta</a></li>
            <li><a href="planes.php" class="<?= $current_page == 'planes.php' ? 'activo' : '' ?>">Planes</a></li>
       <li><a href="../../cerrar_sesion_usuario.php">Cerrar Sesión</a></li>
    </ul>
</nav>
    </header>
    
    <main>