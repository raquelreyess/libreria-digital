<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once('../conexion.php'); // ajusta si está en otra carpeta

    $nombre = $_POST['username'] ?? '';
    $correo = $_POST['email'] ?? '';
    $telefono = $_POST['phone'] ?? '';
    $contrasena = $_POST['password'] ?? '';
    $confirmar = $_POST['confirm_password'] ?? '';
    $plan = $_POST['plan'] ?? '';

    if ($contrasena !== $confirmar) {
        die("❌ Las contraseñas no coinciden.");
    }

    $pass_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $id_tipo_cliente = ($plan === "Premium") ? 3 : 2;

    $sql = "INSERT INTO usuarios (nombre, correo, telefono, contraseña, id_rol, id_tipo_cliente)
            VALUES (?, ?, ?, ?, 2, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $correo, $telefono, $pass_hash, $id_tipo_cliente);

    if ($stmt->execute()) {
        $id_usuario = $stmt->insert_id;

        if ($id_tipo_cliente === 3) {
            $num_tarjeta = $_POST['card_number'] ?? '';
            $nombre_tarjeta = $_POST['card_name'] ?? '';
            $fecha_exp = $_POST['expiry_date'] ?? '';
            $cvv = $_POST['cvv'] ?? '';

            $sql_pago = "INSERT INTO pagos (id_usuario, num_tarjeta, nombre_tarjeta, fecha_expiracion, cvv)
                        VALUES (?, ?, ?, ?, ?)";
            $stmt_pago = $conexion->prepare($sql_pago);
            $stmt_pago->bind_param("issss", $id_usuario, $num_tarjeta, $nombre_tarjeta, $fecha_exp, $cvv);
            $stmt_pago->execute();
        }

        echo "✅ Registro exitoso.";
    } else {
        echo "❌ Error al registrar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="sesion.css">
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2>Crear Cuenta</h2>
            <p>Únete a nuestra plataforma</p>
        </div>
        
        <form class="register-form" action="registro.php" method="POST">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required placeholder="Ingresa tu nombre de usuario">
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required placeholder="tucorreo@ejemplo.com">
            </div>
            
            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" id="phone" name="phone" placeholder="+52 123 456 7890">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required placeholder="Mínimo 8 caracteres">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Repite tu contraseña">
                </div>
            </div>
            
            <div class="form-group">
                <label for="plan">Plan Deseado</label>
                <select id="plan" name="plan">
                    <option value="Basico">Básico (Gratis)</option>  
                    <option value="Premium">Premium ($9.99/mes)</option> 
                </select>
            </div>
            
            <div class="payment-section">
                <h3>Información de Pago</h3>
                
                <div class="form-group">
                    <label for="card_number">Número de tarjeta</label>
                    <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456">
                </div>
                
                <div class="form-group">
                    <label for="card_name">Nombre en la tarjeta</label>
                    <input type="text" id="card_name" name="card_name" placeholder="Como aparece en la tarjeta">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry_date">Fecha de expiración</label>
                        <input type="month" id="expiry_date" name="expiry_date">
                    </div>
                    
                    <div class="form-group">
                        <label for="cvv">Código de seguridad</label>
                        <input type="text" id="cvv" name="cvv" maxlength="3">
                    </div>
                </div>
            </div>
            
            <div class="form-footer">
                <button type="submit" class="register-btn">Registrarse</button>
                <p class="login-link">¿Ya tienes una cuenta? <a href="login.html">Inicia sesión</a></p>
            </div>
        </form>
    </div>
</body>
</html>
