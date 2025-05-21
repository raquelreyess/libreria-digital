<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Usuario</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <form action="../../procesar_login_admin.php" method="POST">
            <h2>Iniciar sesión como usuario</h2>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" required>
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" required>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
