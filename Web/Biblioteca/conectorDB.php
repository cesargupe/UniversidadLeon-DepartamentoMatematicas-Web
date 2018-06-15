<?php
/*****************************************************************************/
/*                                                                           */
/*                           DEFINICION CONSTANTES                           */
/*                                                                           */
/*****************************************************************************/

define ('username', 'wwuledpm');
define ('password', '2nmr63f4');
define ('database', 'wwuledpm');
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
