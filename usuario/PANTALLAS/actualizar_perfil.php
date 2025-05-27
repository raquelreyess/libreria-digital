<?php
session_start();
require_once '../../conexion.php';

function obtenerUsuario($conexion, $id) {
    try {
        $stmt = $conexion->prepare("SELECT u.*, tc.nombre_tipo, tc.costo_mensual 
                                  FROM usuarios u 
                                  JOIN tipos_cliente tc ON u.id_tipo_cliente = tc.id_tipo 
                                  WHERE u.id_usuario = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al obtener usuario: " . $e->getMessage());
    }
}

function obtenerTiposCliente($conexion) {
    try {
        $stmt = $conexion->query("SELECT * FROM tipos_cliente");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al obtener tipos de cliente: " . $e->getMessage());
    }
}

function cambiarPlanBasico($conexion, $idUsuario) {
    try {
        $stmt = $conexion->prepare("UPDATE usuarios SET id_tipo_cliente = 2 WHERE id_usuario = :id");
        $stmt->bindParam(':id', $idUsuario);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Error al cambiar plan: " . $e->getMessage());
    }
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: registro.php");
    exit();
}

$usuario = obtenerUsuario($conexion, $_SESSION['user_id']);
$tiposCliente = obtenerTiposCliente($conexion);

// Procesar cambio de plan básico a premium
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_plan'])) {
    require 'PHP/procesar_pago.php';
    exit();
}

// Procesar cambio de premium a básico
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['downgrade'])) {
    cambiarPlanBasico($conexion, $_SESSION['user_id']);
    $_SESSION['tipo_cliente'] = 2; // Actualizar sesión
    header("Location: actualizar_perfil.php?success=plan_actualizado");
    exit();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/perfil.css">
   
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
    
    <div class="container">
        <h1>Actualizar Información de Usuario</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert success">
                <?= htmlspecialchars($_GET['success'] == 'plan_actualizado' ? 
                   "Tu plan ha sido actualizado correctamente." : 
                   "Pago procesado correctamente. Ahora eres usuario Premium.") ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert error">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <div class="user-info">
            <h2>Información Actual</h2>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($usuario['correo']) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($usuario['telefono']) ?></p>
            <p><strong>Plan Actual:</strong> <?= htmlspecialchars($usuario['nombre_tipo']) ?> ($<?= $usuario['costo_mensual'] ?>/mes)</p>
        </div>

        <div class="plan-section">
            <h2>Cambiar Plan</h2>
            
            <?php if ($usuario['id_tipo_cliente'] == 2): // Plan básico (2) ?>
                <form action="actualizar_perfil.php" method="POST" id="form-pago">
                    <h3>Actualizar a Premium</h3>
                    <p>Para cambiar al plan premium ($9.99/mes), por favor ingresa los datos de tu tarjeta:</p>
                    
                    <div class="form-group">
                        <label for="numero_tarjeta">Número de Tarjeta:</label>
                        <input type="text" id="numero_tarjeta" name="numero_tarjeta" 
                               pattern="\d{16}" title="16 dígitos sin espacios" 
                               required placeholder="1234567890123456">
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre_tarjeta">Nombre en la Tarjeta:</label>
                        <input type="text" id="nombre_tarjeta" name="nombre_tarjeta" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="mes_expiracion">Mes de Expiración:</label>
                            <select id="mes_expiracion" name="mes_expiracion" required>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>">
                                        <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="anio_expiracion">Año de Expiración:</label>
                            <select id="anio_expiracion" name="anio_expiracion" required>
                                <?php for ($i = date('Y'); $i <= date('Y') + 10; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" name="cvv" required 
                                   pattern="\d{3,4}" title="3 o 4 dígitos" 
                                   placeholder="123" maxlength="4">
                        </div>
                    </div>
                    
                    <input type="hidden" name="nuevo_plan" value="3">
                    <button type="submit" name="cambiar_plan" class="btn-primary">
                        Actualizar a Premium - $9.99/mes
                    </button>
                </form>
            
            <?php else: // Plan premium (3) ?>
                <form action="actualizar_perfil.php" method="POST">
                    <h3>Cambiar a Plan Básico</h3>
                    <p>Al cambiar al plan básico ($0/mes):</p>
                    <ul>
                        <li>Perderás acceso inmediato a los beneficios premium</li>
                        <li>No se realizarán más cargos a tu tarjeta</li>
                        <li>Podrás volver a premium en cualquier momento</li>
                    </ul>
                    <button type="submit" name="downgrade" class="btn-secondary">
                        Cambiar a Básico (Gratis)
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        // Validación básica del formulario de pago
        document.getElementById('form-pago')?.addEventListener('submit', function(e) {
            const tarjeta = document.getElementById('numero_tarjeta').value.replace(/\s/g, '');
            const cvv = document.getElementById('cvv').value;
            
            if (!/^\d{16}$/.test(tarjeta)) {
                alert('El número de tarjeta debe tener 16 dígitos');
                e.preventDefault();
                return false;
            }
            
            if (!/^\d{3,4}$/.test(cvv)) {
                alert('El CVV debe tener 3 o 4 dígitos');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>