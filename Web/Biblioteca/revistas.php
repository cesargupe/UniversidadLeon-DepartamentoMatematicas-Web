<?php

/* Incluyo el php que tiene la funcion para conectarse con la base de datos */
Include('conectorDB.php');

/* Establezco conexion con la base de datos */
$conection = conectDB();


/* Función para cargar todos los libros de la base de datos */
function loadMagacines(){

  /* Recupero la conexión que es una variale globlal */
  global $conection;

  /* Creacion de la sentencia para obtener las revistas */
  $sentence = "SELECT *, id FROM revistas ORDER BY id DESC LIMIT 200";

  /* Obtengo todos las revistas */
  $query = mysqli_query($conection, $sentence) or die("ERROR_CONSULTA_DB");

  /* Obtengo el numero de revistas devueltas */
  $numRows = mysqli_num_rows($query);

  if ($numRows >= 200) {

    /* Si hay 200 digo que solo muestro las 200 ultimas */
    echo '<h5 class="teal-text center-align col s12">Mostrando solo las revistas más recientes.</h5>';

  } elseif ($numRows != 0) {

    /* Si hay menos de 200 digo las que hay */
    echo '<h5 class="teal-text center-align col s12">Mostrando '. $numRows .' revistas.</h5>';

  } else {

    /* Si no hay ninguna revista muestro que no hay revistas */
    echo '<h5 class="teal-text center-align col s12">No se encontro ningún revista.</h5>';

  }


  /* Recorro toda la lista de revistas y pinto una por una */
  while($magacine = mysqli_fetch_array($query)){

    printMagacine($magacine);

  }

}

/* Esta funcion es para pintar las revistas obtenidos */
function printMagacine($magacine){

  /* Miramos si la revistas esta disponible, estará disponible solo si se
   * encuentra en la biblioteca, si no no */
 if($magacine[ubicacion] == "BIBLIOTECA" || true /* De momento pongo todos dispobibles */){

    $disponibilidad = '

    <div class="disponible">

      <div class="container-magacine-img">
        <center><img src="img/magacine.png" alt="" class="magacine-icon"></center>
      </div>
      <p class="magacine-status center-align">Disponible</p>

    </div>

    ';

  }else {

    $disponibilidad = '

    <div class="nodisponible">

      <div class="container-magacine-img">
        <center><img src="img/magacine.png" alt="" class="magacine-icon"></center>
      </div>
      <p class="magacine-status center-align">No disponible</p>

    </div>

    ';

  }

  /* Obtengo todos los campos que necesito para pintarlas */
  $titulo =  '<p class="truncate"><b>Titulo: </b> '. $magacine[titulo] .' </p>';
  $numRegistro =  '<p class="truncate"><b>Nº de registro: </b> '. $magacine[numero] .' </p>';
  $editor =  '<p class="truncate"><b>Editor: </b> '. $magacine[editor] .' </p>';
  $periodicidad =  '<p class="truncate"><b>Periodicidad: </b> '. $magacine[periodicidad] .' </p>';
  $proveedor =  '<p class="truncate"><b>Proveedor: </b> '. $magacine[proveedor] .' </p>';
  $antiguedad =  '<p class="truncate"><b>Antigüedad : </b> '. $magacine[antiguedad] .' </p>';
  $vistoUltimaVez =  '<p class="truncate"><b>Visto por última vez : </b> '. $magacine[ultima_modificacion] .' </p>';
  $numeros =  '<p id='. $magacine[numero] .' class="numeros truncate"><b>Números : </b> '. $magacine[numeros] .' </p>';

  /* Pinto la revista con todos sus campos */
  echo '

  <div class="col s12 m6 l4">
    <div class="card-panel brown lighten-5 z-depth-3">
      <div class="valign-wrapper">

        '. $disponibilidad .'

        <div class="magacine">
          '. $titulo .'
          '. $numRegistro .'
          '. $editor .'
          '. $periodicidad .'
          '. $proveedor .'
          '. $antiguedad .'
          '. $vistoUltimaVez .'
          '. $numeros .'
        </div>

      </div>
      <center>
        <a id="moreSize'. $magacine[numero] .'" onClick="moreSize('. $magacine[numero] .');" class="btn-floating waves-effect waves-light"><i class="material-icons">arrow_drop_down</i></a>
        <a id="lessSize'. $magacine[numero] .'" onClick="lessSize('. $magacine[numero] .');" class="btn-floating waves-effect waves-light" style="display: none;"><i class="material-icons">arrow_drop_up</i></a>
      </center>
    </div>
  </div>

  ';

}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Revistas</title>

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- CSS propios de estilo -->
  <link rel="stylesheet" type="text/css" href="css/revistas.css">

</head>

<body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!-- Scripts propios -->
  <script src="js/revistas.js"></script>

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
            <!--<li><a href="#modal_search"><i class="material-icons" title="Buscar revistas">search</i></a></li>-->
            <li><a href="login.php"><i class="material-icons" title="Administracion">perm_identity</i></a></li>
          </ul>

          <ul class="left hide-on-small-only">
            <li><a href="index.php">Pagina principal</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li class="active"><a href="revistas.php">Revistas</a></li>
          </ul>

          <ul class="side-nav" id="mobile-demo">
            <li class="active"><a href="index.php">Pagina principal</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li class="active"><a href="revistas.php">Revistas</a></li>
          </ul>

        </div>
      </nav>
    </div>

  </header>

  <main>

    <h4 class="center-align tittle teal-text">Revistas del Departamento de Matemáticas</h4>

    <div class="magacines row">

      <?php

      loadMagacines();

      ?>


  </div>



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
