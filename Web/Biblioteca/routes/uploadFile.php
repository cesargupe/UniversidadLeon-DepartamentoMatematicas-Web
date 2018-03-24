<?php

/* Comienzo de la sesion*/
session_start();


/* Si la sesión del usuario a caducao salgo */
if(!isset($_SESSION['user'])){

  exit();

}

/* Incluyo el conector de la base de datos. */
Include('../conectorDB.php');

/* Respuesta que devolvere si todo es correcto */
$response = "ok";

/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Obtenemos el archivo que ha enviado el usuario. */
$csvFile = $_FILES["file"]["tmp_name"];

/* Sio no se selecciona ningún archivo devolvemos el error. */
if(empty($csvFile)){

  echo "No has sellecionado ningún archivo.";
  exit();

}

/* Leemos el archivo CSV y lo almacenamos en una variable. */
$csv = readCSV($csvFile);

/* Recojo el tipo de contenido selleccionado (libros o revistas). */
$contentType = $_POST['contentType'];

/* Dependiendo del contenido realizamos una u otra accion. */
switch ($contentType) {

  case 'books':

    deleteAllBooks();

    foreach ($csv as $book) {

      saveBook($book);

    }


    break;

  case 'magacines':

    deleteAllMagacines();

    foreach ($csv as $magacine) {

      saveMagacine($magacine);

    }

    break;

  default:

    echo "Debes seleccionar el tipo de contenido";
    exit();

}



echo $response;

/* Función para guardar los libros del fichero CSV a la base de datos SQL. */
function saveBook($book){

  /* Recuperamos la variales globales que necesitamos. */
  global $conection, $response;

  /* Una vez leidos todos los libros salimos de la función. */
  if(count($book) <= 1) return;

  /* Comprobamos si el fichero CSV tiene más o menos campos de los que debería
   * tener. Si es así mostramos un error.
   */
  if(count($book) != 12){

    $response = "El fichero CSV seleccionado contiene errores.";
    return;

  }

  /* El numero indica el orden de introdución de cada libro, los últimos
   * números son de los ultimos libros.
   */
  $numero = mysqli_real_escape_string($conection, $book[9]);

  $autor = mysqli_real_escape_string($conection, str_replace(""," ",$book[0]));
  $titulo = mysqli_real_escape_string($conection, str_replace(""," ",$book[1]));
  $editorial = mysqli_real_escape_string($conection, $book[2]);
  $anio_edicion = mysqli_real_escape_string($conection, $book[3]);
  $coleccion = mysqli_real_escape_string($conection, $book[4]);
  $etiqueta = mysqli_real_escape_string($conection, str_replace(""," ",$book[5]));
  $fecha_prestamo = mysqli_real_escape_string($conection, $book[6]);
  $isbn = mysqli_real_escape_string($conection, $book[7]);
  $localizado = mysqli_real_escape_string($conection, $book[8]);
  $prestado = mysqli_real_escape_string($conection, $book[10]);
  $fecha_adquisicion = mysqli_real_escape_string($conection, $book[11]);

  $sentence = "INSERT INTO libros(

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
    localizado,
    fecha_adquisicion

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
    '$localizado',
    '$fecha_adquisicion'
  )";

  $query = mysqli_query($conection, $sentence) or die("Se ha producido un error actualizando los libros.");

}

function saveMagacine($magacine){

  global $conection, $response;

  if(count($magacine) != 14) return;

  $titulo = mysqli_real_escape_string($conection, str_replace(""," ",$magacine[0]));
  $numero = mysqli_real_escape_string($conection, $magacine[1]);
  $editor = mysqli_real_escape_string($conection, str_replace(""," ",$magacine[2]));
  $periodicidad = mysqli_real_escape_string($conection, $magacine[3]);
  $proveedor = mysqli_real_escape_string($conection, $magacine[4]);
  $antiguedad = mysqli_real_escape_string($conection, $magacine[5]);
  $ubicacion = mysqli_real_escape_string($conection, $magacine[6]);
  $centro_registro = mysqli_real_escape_string($conection, $magacine[7]);
  $prestado = mysqli_real_escape_string($conection, $magacine[8]);
  $financiacion = mysqli_real_escape_string($conection, $magacine[9]);
  $numeros = mysqli_real_escape_string($conection, str_replace(""," ",$magacine[10]));
  $estanteria = mysqli_real_escape_string($conection, $magacine[11]);
  $ultima_modificacion = mysqli_real_escape_string($conection, $magacine[13]);


  $sentence = "INSERT INTO revistas(

    titulo,
    numero,
    editor,
    periodicidad,
    proveedor,
    antiguedad,
    ubicacion,
    centro_registro,
    prestado,
    financiacion,
    numeros,
    estanteria,
    ultima_modificacion


  )
  VALUES (
    '$titulo',
    '$numero',
    '$editor',
    '$periodicidad',
    '$proveedor',
    '$antiguedad',
    '$ubicacion',
    '$centro_registro',
    '$prestado',
    '$financiacion',
    '$numeros',
    '$estanteria',
    '$ultima_modificacion'
  )";

  $query = mysqli_query($conection, $sentence) or die("Se ha producido un error actualizando las revistas.");

}


function deleteAllBooks(){

  /* Llamada a las variables globales a utilizar */
  global $conection;

  $sentence = "TRUNCATE TABLE libros";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die("error");

}

function deleteAllMagacines(){

  /* Llamada a las variables globales a utilizar */
  global $conection;

  $sentence = "TRUNCATE TABLE revistas";

  /* Ejecuacion de la sentencia */
  $query = mysqli_query($conection, $sentence) or die("error");

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
