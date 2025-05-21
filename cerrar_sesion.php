<?php
session_start();
session_unset();
session_destroy();
header("Location: admin/PANTALLAS/login_admin.php");
exit();
