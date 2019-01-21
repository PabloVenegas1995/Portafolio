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
    <style>
    #map {
      height: 500px;
      width: 300px;
    }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="conductor.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="conductor.php">Publicar Viaje</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="listaViaje_c.php">Mis Viajes <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_pendientes2.php">Solicitudes de Reserva</a>
            </li>
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>
      <div class="container-fluid">
  <div id="r1"class="row">
    <div class="col ml-4 mt-3">
      <h1>Formulario Viaje</h1>
      <form method="post" action="agregar_viaje.php">
  <div class="form-group">
    <input name="Fecha" type="date" class="form-control" id="Input2" placeholder="Fecha" required>
    <br>
    <input name="Asientos" type="number" class="form-control" id="Input3" placeholder="Asientos" required>
    <br>
    <input name="Asientosesp" type="number" class="form-control" id="Input4" placeholder="Asientos para bebes" required>
    <br>
    <input name="N" type="number" class="form-control" id="Input5" placeholder="N° Paradas intermedias" required>
	<br>
    <input name="Restr2pers" type="hidden" value="false">
    <input name="Restr2pers" type="checkbox" value="true">  Máximo dos pasajeros atrás
	<br>
    <input name="Restrporta" type="hidden" value="false">
    <input name="Restrporta" type="checkbox" value="true">  Equipaje en el portamaletas
  </div>

  <button type="submit" class="btn btn-primary mb-2" onclick=saludar()>Enviar</button>
</form>
    </div>

  </div>
</div>

  </body>
</html>
