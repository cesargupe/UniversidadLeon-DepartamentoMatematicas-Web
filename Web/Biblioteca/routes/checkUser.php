<?php

/* Comienzo de la sesion*/
session_start();

/* Incluyo el php que tiene la funcion para conectarse con la base de datos
* y registrar entrada en el log.
*/
Include('../conectorDB.php');

/* Defino la constante con el error */
define('ERROR', '<p class="red-text center-align">El nombre de usuario o la contraseña no son correctos.</p>');


/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Obtengo los valores insertados en el form mediante POST */
$username = mysqli_real_escape_string($conection, $_POST['username']);
$password = mysqli_real_escape_string($conection, $_POST['password']);


/* Compruebo si el usuario y la contraseña corresponden con un usuario real */
if (isValidUser()){

  /* Si el usuario existe creamos una variable de sesión con su nombre
   * y redirigimos a la página de administracion.
   */
  $_SESSION['user'] = $username;
  header('Location: ../admin.php');

}else {

  /* Si no existe el usuario redirigimos a la misma pagina con un error */
  $_SESSION['error'] = ERROR;
  header('Location: ../login.php');

}


/* Cierre de la conexión a la base de datos. */
mysqli_close($conection);


/*
* Funcion que devuelve el numero de usuarios, en los que concuerda el nombre de
* usuario y la contraseña introducida en el formulario.
*/
function isValidUser(){

  /* Llamada a las variables globales a utilizar */
  global $conection, $username, $password;

  /*
  * Creacion de una sentencia para recoger el tipo de usuario, para un usuario
  * con el nombre y contraseña introducidos en el form.
  */
  $sentence = "SELECT * FROM usuarios WHERE username='$username'";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die("ERROR_CONSULTA_DB");

  /* Numero de usuarios devueltos por la query*/
  $numeroDatosDevueltos = mysqli_num_rows($query);

  /* Si existe ese nombre de usuario, se raliza el primer paso de la verificación */
  if ($numeroDatosDevueltos > 0) {

    /* Obtenemos la contraseña encriptada de ese usuario. */
    $password_cryp = mysqli_fetch_array($query)['password'];

    /* Comprouebo si la contraseña introducida se corresponde con la original. */
    if (password_verify($password, $password_cryp)){

      /* Si se corresponde. */
      return true;

    }else {

      /* No se corresponde. */
      return false;

    }

  }

  /* Si no existe el usuario devuelvo false */
  return false;

}
