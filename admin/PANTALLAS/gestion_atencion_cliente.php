<?php require('../header.php') ?>

        <h2>Responder a Consulta</h2>
        <form id="respuestaForm">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="juan.perez" readonly>
            
            <label for="mensaje">Mensaje Recibido:</label>
            <textarea id="mensaje" name="mensaje" readonly>No puedo descargar un libro.</textarea>
            
            <label for="respuesta">Respuesta:</label>
            <textarea id="respuesta" name="respuesta" required></textarea>
            
            <button type="submit">Enviar Respuesta</button>
            <button type="button" onclick="window.location.href='admin_atencion_a_cliente.html'">Cancelar</button>
        </form>
    <?php require('../footer.php') ?>

