<?php

/* Incluyo el php que tiene la funcion para conectarse con la base de datos */
Include('conectorDB.php');

/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Función para cargar todos los libros de la base de datos */
function loadBooks(){

  /* Recupero la conexión que es una variale globlal */
  global $conection;

  /* Creacion de la sentencia para introducir el nuevo lote */
  $sentence = "SELECT * FROM libros LIMIT 200";

  /* Obtengo todos los libros */
  $query = mysqli_query($conection, $sentence) or die("ERROR_CONSULTA_DB");

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

  /* Obtengo todos los campos que necesito para pintarlos */
  $titulo =  '<p class="truncate"><b>Titulo: </b> '. $book[titulo] .' </p>';
  $autor =  '<p class="truncate"><b>Autor: </b> '. $book[autor] .' </p>';
  $editorial =  '<p class="truncate"><b>Editorial: </b> '. $book[editorial] .' </p>';
  $coleccion =  '<p class="truncate"><b>Colección: </b> '. $book[coleccion] .' </p>';
  $ISBN =  '<p class="truncate"><b>ISBN: </b> '. $book[isbn] .' </p>';

  /* Pinto el libro con todos sus campos */
  echo '

  <div class="col s12 m6 l4">
    <div class="card-panel  brown lighten-5 z-depth-3">
      <div class="valign-wrapper">

        '. $disponibilidad .'

        <div class="col s8 book">
          '. $titulo .'
          '. $autor .'
          '. $editorial .'
          '. $coleccion .'
          '. $ISBN .'
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
    <div class="modal-content">
      <div class="">
        <h5 class="tittle-modal teal-text">Buscar libros</h5>
        <a class="modal-action modal-close btn-floating btn-close-modal teal lighten-1 right"><i class="material-icons">close</i></a>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <input value="" id="first_name2" type="text" class="validate">
          <label class="active" for="first_name2">Título del libro</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" id="first_name2" type="text" class="validate">
          <label class="active" for="first_name2">ISBN del libro</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" id="first_name2" type="text" class="validate">
          <label class="active" for="first_name2">Autor del libro</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" id="first_name2" type="text" class="validate">
          <label class="active" for="first_name2">Editorial del libro</label>
        </div>

        <div class="input-field col s12 m6">
          <input value="" id="first_name2" type="text" class="validate">
          <label class="active" for="first_name2">Colección</label>
        </div>

        <div class="col s12 hide-on-med-and-up">

          <div class="switch center-align">
            <label>
              Todos
              <input type="checkbox">
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
          <input type="checkbox">
          <span class="lever"></span>
          Solo disponibles
        </label>
        <div class="btnModal">
          <a class="modal-action modal-close waves-effect waves-light btn">Buscar</a>
        </div>

      </div>
    </div>

    <div class="modal-footer hide-on-med-and-up">
      <center><a class="modal-action modal-close waves-effect waves-light btn">Buscar</a></center>
    </div>
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
    <h5 class="teal-text center-align">Mostrando solo los últimos 200 libros.</h5>

    <div class="books row">

      <?php

      loadBooks();

      ?>

    </main>

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

</body>

</html>
