<?php
session_start();
session_unset();
session_destroy();
header("Location: usuario/PANTALLAS/registro.php");
exit();
