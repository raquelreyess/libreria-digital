<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión / Registrarse</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
<div id="notification" class="notification-hidden"></div>
    <div class="container" id="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="../../procesar_login_usuario.php" method="post">
            <input type="email" name="email" placeholder="Correo Electrónico" required><br><br>
            <input type="password" name="password" placeholder="Contraseña" required><br><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
       <p>¿No tienes cuenta? <a href="#" onclick="mostrarRegistro(); return false;">Registrarse</a></p>

        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    </div>

    <div class="container hidden" id="register-container">
        <h2>Registro</h2>
        <form action="PHP/register.php" method="post">
            <input type="text" name="nombre" placeholder="Nombre Completo" required><br><br>
            <input type="email" name="email" placeholder="Correo Electrónico" required><br><br>
            <input type="password" name="password" placeholder="Contraseña" required><br><br>
            <input type="tel" name="phone" placeholder="Numero celular" required><br><br>

            <label>Introducir tarjeta:</label>
            <select id="tipoCuenta" name="tipo_cuenta" onchange="mostrarPago()">
                <option value="2">Basico</option> 
                <option value="3">Premium</option>
            </select><br><br>
            <div id="pago" class="hidden">
                <input type="text" name="numero_tarjeta" placeholder="Número de Tarjeta"><br><br>
                <input type="month" name="vencimiento" placeholder="Fecha de Vencimiento"><br><br>
                <input type="text" name="cvv" placeholder="CVV"><br><br>
            </div>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="#" onclick="mostrarLogin()">Inicia sesión</a></p> <br>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    </div>

 <script src="../script/registro.js" defer></script>

</body>
</html>