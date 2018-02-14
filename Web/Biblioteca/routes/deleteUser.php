<?php

/* Comienzo de la sesion*/
session_start();

/* Incluyo el php que tiene la funcion para conectarse con la base de datos
* y registrar entrada en el log.
*/
Include('../conectorDB.php');

/* Respuesta que devolvere si todo es correcto */
$response = "ok";

/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Obtengo los valores insertados en el form mediante POST */
$username = mysqli_real_escape_string($conection, $_POST['username']);

/* Funcion para eliminar el usuario */
deleteUser();

/* Devolvemos la respuesta. */
echo $response;

/* Cierre de la conexión a la base de datos. */
mysqli_close($conection);


/*
* Funcion que devuelve el numero de usuarios, en los que concuerda el nombre de
* usuario y la contraseña introducida en el formulario.
*/
function deleteUser(){

  /* Llamada a las variables globales a utilizar */
  global $conection, $username;

  /* Sentencia para eliminar el usuario */
  $sentence = "DELETE FROM usuarios WHERE username='$username'";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die("No se ha podido eliminar el usuario.");

  /* Numero de usuarios devueltos por la query*/
  $numeroDatosDevueltos = mysqli_num_rows ( $query);

}
