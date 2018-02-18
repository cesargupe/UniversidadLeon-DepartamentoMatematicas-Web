<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Biblioteca del Departamento de Matemáticas</title>

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- CSS propios de estilo -->
  <link rel="stylesheet" type="text/css" href="css/index.css">


</head>

<body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <!-- Scripts propios -->
  <script src="js/index.js"></script>

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
            <li class="active"><a href="index.php">Pagina principal</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="revistas.php">Revistas</a></li>
          </ul>

          <ul class="side-nav" id="mobile-demo">
            <li class="active"><a href="index.php">Pagina principal</a></li>
            <li><a href="libros.php">Libros</a></li>
            <li><a href="revistas.php">Revistas</a></li>
          </ul>

        </div>
      </nav>
    </div>

  </header>

  <main>

    <div class="parallax-container">
      <div class="parallax"><img src="img/fondo-min.jpg" width="1000px"></div>

      <!--
      <h2 class="center-align tittle teal-text">Biblioteca del Departamento de Matemáticas</h2>
      <h5 class="center-align tittle teal-text">Universidad de León</h5>
    -->


  </div>

  <br><div class="container row">

    <div class="col s12 l6">
      <h5 class="center-align teal-text">Donde estamos</h5>
      <p align="justify">Puedes encontrar la biblioteca de nuestro departamento en la planta tercera del Edificio Tecnológico de la Escuela de Ingenierías Industrial e Informática (segunda fase).</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11743.763152741281!2d-5.593249301126628!3d42.620211763161386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd379a7f7a66a59f%3A0x577d5ee30544193e!2sDepartamento+de+Matem%C3%A1ticas!5e0!3m2!1ses!2ses!4v1516828218992" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

    <div class="col s12 l6">
      <h5 class="center-align teal-text">Información general</h5>
      <p align="justify">
        En la Biblioteca del Departemento de Matemáticas se encuetran disponibles
        algunas obras de bibliografía recomendada por los profesores para el estudio
        de las distintas asignaturas, así como libros de investigación de diversas
        áreas de las Matemáticas y temas relacionados.
      </p>

      <p align="justify">
        En la Hemeroteca del Departamento se encuentran los últimos números de las
        colecciones de revistas a las que está suscrito el Departamento.
      </p>
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
