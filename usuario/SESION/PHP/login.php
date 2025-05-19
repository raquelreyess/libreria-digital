<?php
require_once '../../../conexion.php';
require_once '../../../session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['contrasena'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['loggedin'] = true;
            $_SESSION['csrf_token'] = bin2hex(random_bytes(15));
            
            header("Location: ../../PANTALLAS/inicio.html?success=Sesión iniciada correctamente");
            exit();
        } else {
            header("Location: ../registro.php?error=Credenciales incorrectas");
            exit();
        }
    } catch(PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        header("Location: ../registro.php?error=login_error");
        exit();
    }
}

// Redirigir si se accede directamente
header("Location: ../registro.php");
exit();
?>