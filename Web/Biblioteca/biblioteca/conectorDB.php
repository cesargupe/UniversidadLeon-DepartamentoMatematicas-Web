<?php
/*****************************************************************************/
/*                                                                           */
/*                           DEFINICION CONSTANTES                           */
/*                                                                           */
/*****************************************************************************/

define ('username', 'cesar');
define ('password', '1002');
define ('database', 'biblioteca');
define ('host', 'localhost');
define ('ERROR_CONEXION_DB', 'No se ha podido establecer conexion.');
define ('ERROR_CONSULTA_DB', 'Error al ejecutar la consulta.');
define ('ERROR_LOGIN', 'Usuario o contraseña incorrectos.');


/*
 * Funcion para establecer conexion con la base de datos.
 *
 * La funcion devuelve la conexión establecida, si no hay ningun error.
 *
 * Si ocurre algun error, se muestra un pront y automaticamente se
 * detiene la ejecución.
 */
function conectDB()
{

  /*
   *Conexion a la base de datos, si esta no se establece se muestra un mensaje
   */
  $conection = mysqli_connect(
    host, username, password, database
  ) or die (ERROR_CONEXION_DB);

  /*
   * Devolucion de la conexion establecida, si no se establece conexion la
   * ejecucion muere, por lo tanto no llega a este punto.
   */
  return $conection;

}

?>
