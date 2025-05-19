<?php
require_once '../../../conexion.php';
require_once '../../../session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
 $telefono = trim($_POST['phone']);
    $tipo_cuenta = $_POST['tipo_cuenta'] ?? 'basico';
    
    // Validaciones
    if (strlen($password) < 8) {
        header("Location: ../registro.php?error=La contraseña debe tener al menos 8 caracteres");
        exit();
    }
    
    try {
        $stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            header("Location: ../registro.php?error=El correo ya está registrado");
            exit();
        }
        
  $stmt = $conexion->prepare("SELECT id_tipo FROM tipos_cliente WHERE nombre_tipo = ?");
        $stmt->execute([$tipo_cuenta]);
        $id_tipo_cliente = $stmt->fetchColumn();

        if (!$id_tipo_cliente) {
            header("Location: ../registro.php?error=Tipo de cliente no válido");
            exit();
        }


        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, contrasena, correo, telefono, id_rol, id_tipo_cliente) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $passwordHash, $email, $telefono, 2, $id_tipo_cliente]);
        $id_usuario = $conexion->lastInsertId();
        
        if ($tipo_cuenta === 'premium' && !empty($_POST['numero_tarjeta'])) {
            $numero_tarjeta = preg_replace('/\s+/', '', $_POST['numero_tarjeta']);
            $vencimiento = substr($_POST['vencimiento'], 0, 4);
            $cvv = $_POST['cvv'];
            
            if (strlen($numero_tarjeta) == 16 && strlen($cvv) == 3) {
                $stmt = $conexion->prepare("INSERT INTO tarjeta (numero, vence, cvv, id_usuario) VALUES (?, ?, ?, ?)");
                $stmt->execute([$numero_tarjeta, $vencimiento, $cvv, $id_usuario]);
            }
        }
        
        header("Location: ../registro.php?success=Registro exitoso. Ahora puedes iniciar sesión.");
        exit();
        
    } catch(PDOException $e) {
        error_log("Register error: " . $e->getMessage());
        header("Location: ../registro.php?error=register_error");
        exit();
    }
}

header("Location: ../registro.php");
exit();
?>