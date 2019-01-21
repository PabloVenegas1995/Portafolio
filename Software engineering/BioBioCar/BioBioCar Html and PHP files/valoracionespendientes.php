<?php
  session_start();
  $typeuser = $_SESSION['usertype'];
  if ($typeuser == 'pasajero') {
?>
  <!DOCTYPE html>
<html>
  <head>
    <script>
    function goBack() {
      window.history.back()
    }
  </script>
    <title>Valoraciones Pendientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="funciones.js"></script>
     </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="test2.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="test2.php">Buscar Viaje <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_realizadas2.php">Reservas Solicitadas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfilpropio_p.php">Mi Perfil</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="valoracionespendientes.php">Valoraciones Pendientes</a>
            </li>

          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>

<div class="container-fluid">
  <div id="r1"class="row">
    <div class="col ml-4 mt-3 text-center">
      <div id="tabla2">
      </div>
    </div>
    </div>
  </div>
  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $("#tabla2").load("valoracionviaje.php")
  });
</script>

<?php
if (isset($_POST['SubmitButton'])) {
  $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  $idviaje = $_POST['viaje'];
  $nota = $_POST['nota'];
  $comentario = $_POST['comentario'];
  $evaluador = $_POST['origen'];
  //echo $nota;
  //echo $idviaje;
  //echo $evaluador;
  $consulta1 = pg_query($db, "UPDATE iteracion2.valoracion SET estado = 'completada', estrellas = '$nota' , comentario = '$comentario' WHERE idviaje = '$idviaje' and origen = '$evaluador' ");

  }

}
  if ($typeuser == 'conductor')
  {
  ?>
  <!DOCTYPE html>
<html>
  <head>
    <script>
    function goBack() {
      window.history.back()
    }
  </script>
    <title>Valoraciones Pendientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="funciones.js"></script>
     </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="conductor.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="conductor.php">Publicar Viaje<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_pendientes2.php">Reservas Solicitadas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfilpropio_c.php">Ver Mi Perfil</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="valoracionespendientes.php">Valoraciones Pendientes</a>
            </li>

          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>

<div class="container-fluid">
  <div id="r1"class="row">
    <div class="col ml-4 mt-3 text-center">
      <div id="tabla2">
      </div>
    </div>
    </div>
  </div>
  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $("#tabla2").load("valoracionviaje.php")
  });
</script>

<?php
if (isset($_POST['SubmitButton'])) {
  $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  $idviaje = $_POST['viaje'];
  $nota = $_POST['nota'];
  $comentario = $_POST['comentario'];

  $evaluador = $_POST['origen'];
  $consulta1 = pg_query($db, "UPDATE iteracion2.valoracion SET estado = 'completada', estrellas = '$nota' WHERE idviaje = '$idviaje' and origen = '$evaluador' ");

  }
}
  ?>
