<?php

session_start();

/*
* En caso de que un usuario este logueado, se le redirija a la pagina que le
* corresponde.
*/
if(!isset($_SESSION['user'])){ /* Si un usuario no ha iniciado sesion */

  header("Location: login.php");

}

/* Incluyo el php que tiene la funcion para conectarse con la base de datos
 * y registrar entrada en el log.
 */
Include('./conectorDB.php');


/* Establezco conexion con la base de datos */
$conection = conectDB();

/* Función para obtener el nombre de usuario y pintarlo. */
function getUsername(){

  return $_SESSION['user'];

}

/* Funcion para obtener los usuarios de la base de datos */
function getUsers(){

  /* Llamada a las variables globales a utilizar */
  global $conection;

  /* Creacion de la sentencia para obtener los usuarios */
  $sentence = "SELECT * FROM usuarios WHERE username NOT LIKE 'admin'";

  /* Ejecuto la sentencia */
  $query = mysqli_query($conection, $sentence) or die("ERROR_CONSULTA_DB");

  /* Recorro toda la lista de usuarios y pinto uno por uno */
  while($user = mysqli_fetch_array($query)){

    printUser($user);

  }

}

/* Función para pintar los usuarios uno por uno */
function printUser($user){

  echo '<p class="user-text">'. $user['username'] .' <a id="'. $user['username'] .'" onclick="deleteUser(this.id);" class="btn-floating btn-delete red lighten-2"><i class="material-icons">delete_forever</i></a></p>';

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

  <!-- Modal addUser -->
  <div id="modal_addUser" class="modal">

    <div class="modal-content">

      <div class="row">

        <form id="form_addUser" action="" name="myForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">

        <h5 class="tittle-modal center teal-text">Nuevo Usuario</h5>
        <a class="modal-action modal-close btn-floating btn-close-modal teal lighten-1 right"><i class="material-icons">close</i></a>

        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input name="username" id="username" type="text" class="validate">
          <label for="username">Nombre de usuario</label>
        </div>

        <div class="input-field col s12">
          <i class="material-icons prefix">lock</i>
          <input name="password" id="password" type="password" name="pass">
          <label for="password">Contraseña</label>
        </div>

        <center><button name="action" type="submit" class="modal-action modal-close modal-submit waves-effect waves-light btn">Añadir</button></center>

        </form>

      </div>

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

      <div class="col s10 offset-s1 m8 offset-m2 l6 offset-l1">
        <div class="card-panel grey lighten-4 row">

          <h5 class="center teal-text">Gestión de la Biblioteca</h5>

          <form id="form_sendContent" action="" name="myForm" method="post" accept-charset="utf-8" enctype="multipart/form-data">

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
              <select name="contentType" class="icons">
                <option value="" disabled selected>Selecciona el contenido</option>
                <option value="books" data-icon="img/book.png" class="left circle">Libros</option>
                <option value="magacines" data-icon="img/magacine.png" class="left circle">Revistas</option>
              </select>
              <label>Tipo de contenido</label>
            </div>

            <div class="center col s12">
              <br><button onclick="" class="btn waves-effect waves-light" type="submit" name="action">Actualizar contenido
                <i class="material-icons right">send</i>
              </button>
            </div>

            <div class="center col s12">
              <br><a onclick="deleteContent();" class="btn red lighten-2 waves-effect waves-light">Eliminar contenido</a>
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
            <p class="center-align grey-text text-darken-1 text-footer">Se ha actualizado el contenido.</p>
            <center><a class="waves-effect waves-light btn">Subir más contenido</a></center>
          </div>

        </div>

      </div>

      <div class="col s10 offset-s1 m8 offset-m2 l4">
        <div class="card-panel grey lighten-4 row">

          <center>

            <h5 class="teal-text">Administradores</h5>

            <div id="users" class="users">

              <?php getUsers(); ?>

            </div>

            <a href="#modal_addUser" class="modal-trigger waves-effect waves-light btn"><i class="material-icons right">add</i>Añadir usuario</a>

          </center>

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
