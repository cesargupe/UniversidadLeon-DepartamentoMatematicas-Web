<?php

/* Comienzo de la sesion*/
session_start();


/* Si la sesión del usuario a caducao salgo */
if(!isset($_SESSION['user'])){

  exit();

}

/* Incluyo el conector de la base de datos. */
Include('../conectorDB.php');

/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Respuesta que devolvere si todo es correcto */
$response = "ok";

/* Funcion para eliminar todo el contenido. */
deleteAllBooks();
deleteAllMagacines();

/* Devolvemos la respuesta. */
echo $response;

function deleteAllBooks(){

  /* Llamada a las variables globales a utilizar */
  global $conection;

  /* Creamos la sentencia para eliminar el contenido. */
  $sentence = "TRUNCATE TABLE libros";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die("error");

}

function deleteAllMagacines(){

  /* Llamada a las variables globales a utilizar */
  global $conection;

  /* Creamos la sentencia para eliminar el contenido. */
  $sentence = "TRUNCATE TABLE revistas";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die("error");

}

?>
