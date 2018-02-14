<?php

session_start();

/*
* En caso de que un usuario este logueado, se le redirija a la pagina que le
* corresponde.
*/
if(!isset($_SESSION['user'])){ /* Si un usuario no ha iniciado sesion */

  header("Location: login.php");

}

function getUsername(){

  return $_SESSION['user'];

}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Administración</title>

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- CSS propios de estilo -->
  <link rel="stylesheet" type="text/css" href="css/admin.css">


</head>

<body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!--Import Font Awesome-->
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

  <!-- Scripts propios -->
  <script src="js/admin.js"></script>

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
            <li><a href="admin.php"><i class="material-icons" title="Administracion">perm_identity</i></a></li>
            <li><a href="./routes/closeSesion.php"><i class="fas fa-sign-out-alt"></i></a></li>
          </ul>

          <ul class="left hide-on-small-only">
            <li><a href="index.php">Pagina principal</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="revistas.php">Revistas</a></li>
          </ul>

          <ul class="side-nav" id="mobile-demo">
            <li><a href="index.php">Pagina principal</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="revistas.php">Revistas</a></li>
          </ul>

        </div>
      </nav>
    </div>

  </header>

  <main>

    <div class="row">

      <h4 class="center-align tittle teal-text">Bienvenid@ <?php echo getUsername(); ?></h4>


      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-4 row">

          <h5 class="center teal-text">Gestión de la Biblioteca</h5>

          <form id="form" action="" name="myForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">

            <div class="file-field input-field col s12">
              <div class="btn">
                <span>Archivo CSV</span>
                <input id="file" name="file" type="file" accept=".csv">
              </div>
              <div class="file-path-wrapper">
                <input name="file" class="file-path validate truncate" type="text" placeholder="Selecciona el archivo CSV con la base de datos">
              </div>
            </div>


            <div class="input-field col s12">
              <select class="icons">
                <option value="" disabled selected>Selecciona el contenido</option>
                <option value="" data-icon="img/book.png" class="left circle">Libros</option>
                <option value="" data-icon="img/magacine.png" class="left circle">Revistas</option>
              </select>
              <label>Tipo de contenido</label>
            </div>

            <div class="center col s12">
              <br><button onclick="" class="btn waves-effect waves-light" type="submit" name="action">Actualizar contenido
                <i class="material-icons right">send</i>
              </button>
            </div>

            <div class="center col s12">
              <br><a onclick="deleteContent();" class="btn red red lighten-2 waves-effect waves-light">Eliminar contenido</a>
            </div>

          </form>

          <br><center><div id="preloader" style="display: none;">

            <div class="preloader-wrapper big active">
              <div class="spinner-layer spinner-teal-only">
                <div class="circle-clipper left">
                  <div class="circle"></div>
                </div><div class="gap-patch">
                  <div class="circle"></div>
                </div><div class="circle-clipper right">
                  <div class="circle"></div>
                </div>
              </div>
            </div>

            <p class="teal-text">Subiendo contenido...</p>

          </div></center>

          <div id="finishUpload" style="display: none;" onclick="resetView();">
            <p class="center-align grey-text text-darken-1 text-footer">Archivo subido con éxito.</p>
            <center><a class="waves-effect waves-light btn">Subir más contenido</a></center>
          </div>

        </div>

      </div>

    </div>

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
