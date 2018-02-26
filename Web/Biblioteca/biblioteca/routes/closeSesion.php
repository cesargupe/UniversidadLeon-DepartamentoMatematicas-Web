<?php

/* Comienzo de la sesion*/
session_start();

/* Elimino la variable de sesion del usuario */
session_unset();

/* Cierro la sesión */
session_destroy();

/* Redirijo a la pagina de inicio de sesión */
header("Location: ../login.php");

?>
