<?php

/* Comienzo de la sesion*/
session_start();


/* Si la sesión del usuario a caducao salgo */
if(!isset($_SESSION['user'])){

  exit();

}

Include('../conectorDB.php');

/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Respuesta que devolvere si todo es correcto */
$response = "ok";

$csvFile = $_FILES["file"]["tmp_name"];
$csv = readCSV($csvFile);

deleteAllBooks();
saveBooks($csv);

echo $response;


function saveBooks($books){

  global $conection, $response;

  foreach ($books as $book) {

    if(count($book) != 11) continue;


    /* El numero indica el orden de introdución de cada libro, los últimos
     * números son de los ultimos libros.
     */
    $numero = mysqli_real_escape_string($conection, $book[9]);

    $autor = mysqli_real_escape_string($conection, $book[0]);
    $titulo = mysqli_real_escape_string($conection, $book[1]);
    $editorial = mysqli_real_escape_string($conection, $book[2]);
    $anio_edicion = mysqli_real_escape_string($conection, $book[3]);
    $coleccion = mysqli_real_escape_string($conection, $book[4]);
    $etiqueta = mysqli_real_escape_string($conection, str_replace(""," ",$book[5]));
    $fecha_prestamo = mysqli_real_escape_string($conection, $book[6]);
    $isbn = mysqli_real_escape_string($conection, $book[7]);
    $localizado = mysqli_real_escape_string($conection, $book[8]);
    $prestado = mysqli_real_escape_string($conection, $book[10]);

    $sentence .= "INSERT INTO libros(

      numero,
      isbn,
      autor,
      titulo,
      coleccion,
      editorial,
      etiqueta,
      anio_edicion,
      prestado,
      fecha_prestamo,
      localizado

    )
    VALUES (
      0, /* No usamos el numero porque no esta bien, a veces tiene texto. */
      '$isbn',
      '$autor',
      '$titulo',
      '$coleccion',
      '$editorial',
      '$etiqueta',
      '$anio_edicion',
      '$prestado',
      '$fecha_prestamo',
      '$localizado'
    );";

  }

  $query = mysqli_multi_query($conection, $sentence) or die("error");

  if ($query) {
    
  }

}


function deleteAllBooks(){

  /* Llamada a las variables globales a utilizar */
  global $conection;

  $sentence = "TRUNCATE TABLE libros";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die($jsondata);

}


function readCSV($csvFile){

  $file_handle = fopen($csvFile, 'r');

  while (!feof($file_handle)) {
    $line_of_text[] = fgetcsv($file_handle);
  }

  fclose($file_handle);
  return $line_of_text;

}

?>
