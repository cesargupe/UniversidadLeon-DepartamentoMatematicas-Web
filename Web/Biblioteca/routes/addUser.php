<?php

/* Comienzo de la sesion*/
session_start();

/* Si la sesión del usuario a caducao salgo */
if(!isset($_SESSION['user']) && !$_COOKIE["enter"]){

  exit();

}

/* Incluyo el php que tiene la funcion para conectarse con la base de datos
 * y registrar entrada en el log.
 */
Include('../conectorDB.php');


/* Respuesta que devolvere si todo es correcto */
$response = array();
$response['success'] = "ok";
$response['username'] = $_POST['username'];

/* Respuesta que devolvere si hay error */
$error = array();
$error['success'] = "error";
$error['error'] = "Se ha producido un error, puede que ya exista este usuario.";

/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Si el usuario o la contraseña está vacía salgo */
if (empty($_POST['username']) || empty($_POST['password'])) {

  $error['error'] = "Debes de rellenar los campos usuario y contraseña.";
  echo json_encode($error);
  exit();

}

/* Obtengo los valores insertados en el form mediante POST y los escapo */
$username = mysqli_real_escape_string($conection, $_POST['username']);
$password = mysqli_real_escape_string($conection, $_POST['password']);

/* Encripto la contraseña para que no sea posible descifrarla si se intercepta. */
$password_cryp = password_hash($password, PASSWORD_DEFAULT);

/* Creacion de una sentencia para añadir el usuario */
$sentence .= "INSERT INTO usuarios(

  username,
  password

)
VALUES (

  '$username',
  '$password_cryp'

);";

/* Ejecuacion de la sentencia */
$query = mysqli_query($conection, $sentence) or die(json_encode($error));

/* Si todo ha ido bien devuelvo el ok */
echo json_encode($response);

?>
