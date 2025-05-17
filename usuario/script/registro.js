document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos del DOM
    const loginContainer = document.getElementById('login-container');
    const registerContainer = document.getElementById('register-container');
    const tipoCuenta = document.getElementById('tipoCuenta');
    const pagoDiv = document.getElementById('pago');

    // Función para mostrar el formulario de registro
   window.mostrarRegistro = function () {
    const loginContainer = document.getElementById('login-container');
    const registerContainer = document.getElementById('register-container');
    loginContainer.classList.add('hidden');
    registerContainer.classList.remove('hidden');
};


    // Función para mostrar el formulario de login
    window.mostrarLogin = function() {
        registerContainer.classList.add('hidden');
        loginContainer.classList.remove('hidden');
        resetForm('register');
    };

    // Función para mostrar u ocultar los campos de pago
    window.mostrarPago = function() {
        if (tipoCuenta.value === 'tarjeta') {
            pagoDiv.classList.remove('hidden');
            pagoDiv.querySelectorAll('input').forEach(input => {
                input.required = true;
            });
        } else {
            pagoDiv.classList.add('hidden');
            pagoDiv.querySelectorAll('input').forEach(input => {
                input.required = false;
                input.value = '';
            });
        }
    };

    // Función para resetear los formularios
    function resetForm(type) {
        const form = document.querySelector(`#${type}-container form`);
        if (form) form.reset();
    }

    // Función para mostrar notificaciones
    window.mostrarNotificacion = function(mensaje, tipo = 'success') {
        const notification = document.getElementById('notification');
        notification.textContent = mensaje;
        notification.className = `notification-show ${tipo}`;

        setTimeout(() => {
            notification.className = 'notification-hidden';
        }, 5000);
    };

    // Inicializar comportamiento del select por si el usuario ya seleccionó una opción
    if (tipoCuenta) {
        tipoCuenta.addEventListener('change', mostrarPago);
        mostrarPago(); // Ejecutar al cargar por si viene precargado
    }

    // Comprobar si se debe mostrar directamente el registro
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('show') && urlParams.get('show') === 'register') {
        mostrarRegistro();
    }
});
