<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD6Q31QwQK0pv7twtzD32efp6hLa0uFEs&libraries=places&language=es"></script>
    <style>
    #map {
      height: 500px;
      width: 300px;
    }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Buscar Viaje <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_realizadas2.php">Reservas Solicitadas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfilpropio_p.php">Mi Perfil</a>
            </li>
            <li class="nav-item">
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
      <h1>Formulario de Búsqueda</h1>
      <form method="post" action="listaViaje_p.php">
  <div class="form-group">
    <input name="origen" type="text" class="form-control" id="Input1" placeholder="Origen">
    <script>
          var input_or = document.getElementById("Input1");
          var autocomplete = new google.maps.places.Autocomplete(input_or);
        </script>
  </div>
  <div class="form-group">
    <input name="destino" type="text" class="form-control" id="Input2" placeholder="Destino">
    <script>
          var input_des = document.getElementById("Input2");
          var autocomplete = new google.maps.places.Autocomplete(input_des);
        </script>
  </div>
  <div class="form-group">
    <input name="fecha" type="date" class="form-control" id="Input3" placeholder="Fecha">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Buscar Viaje</button>
</form>

    </div>
    </div>
  </div>
</div>

  </body>
</html>
