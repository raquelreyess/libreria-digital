<?php
session_start();
require_once '../../conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: registro.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_plan'])) {
    // Validar y sanitizar datos
    $numeroTarjeta = str_replace(' ', '', $_POST['numero_tarjeta']);
    if (!preg_match('/^\d{16}$/', $numeroTarjeta)) {
        header("Location: ../actualizar_perfil.php?error=Número de tarjeta inválido");
        exit();
    }
    
    $ultimos4 = substr($numeroTarjeta, -4);
    $nombreTarjeta = filter_var($_POST['nombre_tarjeta'], FILTER_SANITIZE_STRING);
    $mesExpiracion = filter_var($_POST['mes_expiracion'], FILTER_SANITIZE_NUMBER_INT);
    $anioExpiracion = filter_var($_POST['anio_expiracion'], FILTER_SANITIZE_NUMBER_INT);
    $cvv = filter_var($_POST['cvv'], FILTER_SANITIZE_NUMBER_INT);
    $nuevoPlan = filter_var($_POST['nuevo_plan'], FILTER_SANITIZE_NUMBER_INT);
    
    // Validar CVV
    if (!preg_match('/^\d{3,4}$/', $cvv)) {
        header("Location: ../actualizar_perfil.php?error=CVV inválido");
        exit();
    }
    
    // Validar fecha de expiración
    $fechaActual = new DateTime();
    $fechaExpiracion = new DateTime($anioExpiracion . '-' . $mesExpiracion . '-01');
    $fechaExpiracion->modify('last day of this month');
    
    if ($fechaExpiracion < $fechaActual) {
        header("Location: ../actualizar_perfil.php?error=La tarjeta ha expirado");
        exit();
    }
    
    try {
        // Iniciar transacción
        $conexion->beginTransaction();
        
        // 1. Registrar el pago
        $stmt = $conexion->prepare("INSERT INTO pagos (id_usuario, ultimos_4_tarjeta, nombre_en_tarjeta, fecha_expiracion) 
                                  VALUES (:id_usuario, :ultimos4, :nombre_tarjeta, :fecha_expiracion)");
        $stmt->bindParam(':id_usuario', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':ultimos4', $ultimos4, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tarjeta', $nombreTarjeta, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_expiracion', $fechaExpiracion->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();
        
        // 2. Actualizar el tipo de cliente
        $stmt = $conexion->prepare("UPDATE usuarios SET id_tipo_cliente = :nuevo_plan WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':nuevo_plan', $nuevoPlan, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        
        // 3. Actualizar la sesión
        $_SESSION['tipo_cliente'] = $nuevoPlan;
        
        // Confirmar transacción
        $conexion->commit();
        
 header("Location: /libreria-digital/usuario/PANTALLAS/actualizar_perfil.php?success=pago_exitoso");
        exit();
    } catch (PDOException $e) {
        // Revertir transacción en caso de error
        $conexion->rollBack();
        error_log("Error en procesar_pago: " . $e->getMessage());
        header("Location: ../actualizar_perfil.php?error=Ocurrió un error al procesar el pago");
        exit();
    }
}

header("Location: ../actualizar_perfil.php");
exit();
?>