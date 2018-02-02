<?php

/* Comienzo de la sesion*/
session_start();

/* Si el usuario ya inicio sesión le redirigimos a la pagina de administración */
if(isset($_SESSION['user'])){

  header("Location: admin.php");

}

/* Esta función no indicara si se produjo un error iniciando sesión */
function printError(){

  /* Si hay algun error lo imprimimos y luego lo eliminamos */
  if(isset($_SESSION['error'])){

    echo $_SESSION['error'];
    unset($_SESSION['error']);

  }

}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Inicio de sesión</title>

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- CSS propios de estilo -->
  <link rel="stylesheet" type="text/css" href="css/login.css">


</head>

<body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!-- Scripts propios -->
  <script src="js/login.js"></script>

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
            <li><a href="login.php"><i class="material-icons" title="Administracion">perm_identity</i></a></li>
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

      <form name="myForm" action="./routes/checkUser.php"
      onsubmit="return true;" accept-charset="utf-8" method="POST"
      enctype="multipart/form-data">

      <h4 class="center-align tittle teal-text">Administración de la Biblioteca</h4>

      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-4 row">

          <h5 class="center teal-text">Inicio de sesión</h5>

          <div class="input-field">
            <i class="material-icons prefix">account_circle</i>
            <input name="username" id="username" type="text" class="validate">
            <label for="username">Nombre de usuario</label>
          </div>

          <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input name="password" id="password" type="password" name="pass">
            <label for="password">Contraseña</label>
          </div>

          <br><div class="center">
            <button class="btn  waves-effect waves-light" type="submit" name="action">Iniciar sesión
              <i class="material-icons right">send</i>
            </button>
          </div>

          <?php printError(); ?>

        </div>

      </div>

      </form>


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
