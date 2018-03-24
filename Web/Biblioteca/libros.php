<?php

/* Incluyo el php que tiene la funcion para conectarse con la base de datos */
Include('conectorDB.php');

/* Establezco conexion con la base de datos */
$conection = conectDB();


/* Función para cargar todos los libros de la base de datos */
function loadBooks(){

  /* Recupero la conexión que es una variale globlal */
  global $conection;

  /* Obtengo el titulo, autor, etc introducido en el buscador en caso de
   * que exixta. Lo escapo para evitar un ataque SQL Inyection.
   */
  $autor = mysqli_real_escape_string($conection, $_POST["autor"]);
  $titulo = mysqli_real_escape_string($conection, $_POST["titulo"]);
  $editorial = mysqli_real_escape_string($conection, $_POST["editorial"]);
  $coleccion = mysqli_real_escape_string($conection, $_POST["coleccion"]);
  $anio = mysqli_real_escape_string($conection, $_POST["anio"]);

  /* Si queremos buscar solo los libros disponibles creamos la condición.*/
  if($_POST["disponible"] == "on") {

    $disponible = "prestado = 'BIBLIOTECA' AND";

  }

  /* Creacion de la sentencia para obtener los libros */
  $sentence = "SELECT *, id FROM libros WHERE

  ". $disponible ."
  autor LIKE '%". $autor ."%' AND
  titulo LIKE '%". $titulo ."%' AND
  editorial LIKE '%". $editorial ."%' AND
  coleccion LIKE '%". $coleccion ."%' AND
  anio_edicion LIKE '%". $anio ."%'

  ORDER BY id DESC LIMIT 40";

  /* Obtengo todos los libros */
  $query = mysqli_query($conection, $sentence) or die("ERROR_CONSULTA_DB");

  /* Obtengo el numero de libros devueltos */
  $numRows = mysqli_num_rows($query);

  if ($numRows >= 40) {

    /* Si hay 200 digo que solo muestro los 200 ultimos */
    echo '<h5 class="teal-text center-align col s12">Mostrando solo las adquisiciones más recientes.</h5>';

  } elseif ($numRows != 0) {

    /* Si hay menos de 200 digo los que hay */
    echo '<h5 class="teal-text center-align col s12">Mostrando '. $numRows .' libros.</h5>';

  } else {

    /* Si no hay ningún libro muestro que no hay libros */
    echo '<h5 class="teal-text center-align col s12">No se encontro ningún libro.</h5>';

  }


  /* Recorro toda la lista de libros y pinto uno por uno */
  while($book = mysqli_fetch_array($query)){

    printBook($book);

  }

}

/* Esta funcion es para pintar los libros obtenidos */
function printBook($book){

  /* Miramos si el libro esta disponible, estará disponible solo si se
   * encuentra en la biblioteca, si no no */
  if($book[prestado] == "BIBLIOTECA"){

    $disponibilidad = '

    <div class="disponible">

      <div class="container-book-img">
        <center><img src="img/book.png" alt="" class="book-icon"></center> <!-- notice the "circle" class -->
      </div>
      <p class="book-status center-align">Disponible</p>

    </div>

    ';

  }else {

    $disponibilidad = '

    <div class="nodisponible">

      <div class="container-book-img">
        <center><img src="img/book.png" alt="" class="book-icon"></center> <!-- notice the "circle" class -->
      </div>
      <p class="book-status center-align">No disponible</p>

    </div>

    ';

  }

  /* Si no exixste el campo en la base de datos indicamos que hay que consultar con la administración. */
  if(empty($book[titulo])) $book[titulo] =  'Consultar con la administración';
  if(empty($book[autor])) $book[autor] =  'Consultar con la administración';
  if(empty($book[editorial])) $book[editorial] =  'Consultar con la administración';
  if(empty($book[anio_edicion])) $book[anio_edicion] =  'Consultar con la administración';
  if(empty($book[isbn])) $book[isbn] =  'Consultar con la administración';
  if(empty($book[fecha_prestamo])) $book[fecha_prestamo] =  'Consultar con la administración';
  if(empty($book[fecha_adquisicion])) $book[fecha_adquisicion] =  'Anterior a 24/03/2018';


  /* Obtengo todos los campos que necesito para pintarlos */
  $titulo =  '<p class="truncate"><b>Título: </b> '. $book[titulo] .' </p>';
  $autor =  '<p class="truncate"><b>Autor: </b> '. $book[autor] .' </p>';
  $editorial =  '<p class="truncate"><b>Editorial: </b> '. $book[editorial] .' </p>';
  $anio =  '<p class="truncate"><b>Año de edición: </b> '. $book[anio_edicion] .' </p>';
  $coleccion =  '<p class="truncate"><b>Colección: </b> '. $book[coleccion] .' </p>';
  $ISBN =  '<p class="truncate"><b>ISBN: </b> '. $book[isbn] .' </p>';
  $fechaPrestamo =  '<p class="truncate"><b>Visto por última vez : </b> '. $book[fecha_prestamo] .' </p>';
  $fechaAdquisicion =  '<p class="truncate"><b>Fecha de adquisición : </b> '. $book[fecha_adquisicion] .' </p>';

  /* Si no hay coleccion indicamos que no existe ninguna coleccion. */
  if(empty($book[coleccion])) $coleccion =  '<p class="truncate"><b>No existe ninguna colección</b></p>';


  /* Pinto el libro con todos sus campos */
  echo '

  <div class="col s12 m6">
    <div class="card-panel brown lighten-5 z-depth-3">
      <div class="valign-wrapper">

        '. $disponibilidad .'

        <div class="book">
          '. $titulo .'
          '. $autor .'
          '. $editorial .'
          '. $anio .'
          '. $coleccion .'
          '. $fechaPrestamo .'
          '. $fechaAdquisicion .'
        </div>

      </div>
    </div>
  </div>

  ';

}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Libros</title>

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- CSS propios de estilo -->
  <link rel="stylesheet" type="text/css" href="css/libros.css">


</head>

<body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!-- Scripts propios -->
  <script src="js/libros.js"></script>

  <!-- Modal buscador -->
  <div id="modal_search" class="modal">

    <form name="myForm" action="libros.php"
    onsubmit="return true;" accept-charset="utf-8" method="POST"
    enctype="multipart/form-data">

    <div class="modal-content">
      <div class="">
        <h5 class="tittle-modal teal-text">Buscar libros</h5>
        <a class="modal-action modal-close btn-floating btn-close-modal teal lighten-1 right"><i class="material-icons">close</i></a>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <input value="" name="titulo" id="titulo" type="text" class="validate">
          <label class="active" for="titulo">Título del libro</label>
        </div>

        <!--<div class="input-field col s12 m6">
          <input value="" name="isbn" id="isbn" type="text" class="validate">
          <label class="active" for="isbn">ISBN del libro</label>
        </div>-->

        <div class="input-field col s12 m6">
          <input value="" name="autor" id="autor" type="text" class="validate">
          <label class="active" for="autor">Autor del libro</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" name="anio" id="anio" type="text" class="validate">
          <label class="active" for="anio">Año de edición</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" name="editorial" id="editorial" type="text" class="validate">
          <label class="active" for="editorial">Editorial del libro</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" name="coleccion" id="coleccion" type="text" class="validate">
          <label class="active" for="coleccion">Colección</label>
        </div>

        <div class="col s12 hide-on-med-and-up">

          <div class="switch center-align">
            <label>
              Todos
              <input name="disponible" type="checkbox">
              <span class="lever"></span>
              Solo disponibles
            </label>

          </div>

        </div>



      </div>


    </div>
    <div class="modal-footer hide-on-small-only">
      <div class="switch center-align">
        <label>
          Todos
          <input name="disponible" type="checkbox">
          <span class="lever"></span>
          Solo disponibles
        </label>
        <div class="btnModal">
          <button name="action" type="submit" class="modal-action modal-close waves-effect waves-light btn">Buscar</button>
        </div>

      </div>
    </div>

    <div class="modal-footer hide-on-med-and-up">
      <center><button name="action" type="submit" class="modal-action modal-close waves-effect waves-light btn">Buscar</button></center>
    </div>

    </form>


  </div>

  <header>

    <div class="navbar">
      <nav class="teal lighten-1" role="navigation">
        <div class="nav-wrapper">

          <ul class="left hide-on-small-only">
            <a class="logo" href="http://departamentos.unileon.es/matematicas/"><img class="responsive-img logo-small" src="img/logo-universidad.png"></a>
          </ul>

          <ul class="left hide-on-med-and-up">
            <a class="logo hide-on-med-and-up" href="/"><img class="responsive-img logo-small brand-logo" src="img/logo-universidad.png"></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          </ul>


          <ul class ="right">
            <li><a class="modal-trigger" href="#modal_search"><i class="material-icons" title="Buscar revistas">search</i></a></li>
            <li><a href="login.php"><i class="material-icons" title="Administracion">perm_identity</i></a></li>
          </ul>

          <ul class="left hide-on-small-only">
            <li><a href="index.php">Pagina principal</a></li>
            <li class="active"><a href="libros.php">Libros</a></li>
            <li><a href="revistas.php">Revistas</a></li>
          </ul>

          <ul class="side-nav" id="mobile-demo">
            <li><a href="index.php">Pagina principal</a></li>
            <li class="active"><a href="libros.php">Libros</a></li>
            <li><a href="revistas.php">Revistas</a></li>
          </ul>

        </div>
      </nav>
    </div>

  </header>

  <main>

    <h4 class="center-align tittle teal-text">Libros del Departamento de Matemáticas</h4>

    <div class="books row">

      <?php

      loadBooks();

      ?>

    </main>

    <!--
    <footer class="page-footer teal lighten-1">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Universidad de León</h5>
            <p class="text-footer">Biblioteca del Departamento de Matemáticas</p>
          </div>
          <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Sobre nosotros</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="http://www.unileon.es/">Universidad de León</a></li>
              <li><a class="grey-text text-lighten-3" href="http://departamentos.unileon.es/matematicas/">Departamento de Matemáticas</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">

          <span class="white-text">Web desarrollada por <a class="grey-text text-lighten-2" target="blank" href="https://es.linkedin.com/in/c%C3%A9sar-guti%C3%A9rrez-p%C3%A9rez-83432214a">César Gutiérrez Pérez</a></span>

        </div>
      </div>
    </footer>
  -->

</body>

</html>
