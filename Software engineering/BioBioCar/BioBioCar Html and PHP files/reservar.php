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
        <a class="navbar-brand" href="#">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="test2.php">Buscar Viaje <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Reservar Viaje</a>
            </li>
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>
      <div class="container-fluid">
  <div id="r1"class="row">
    
    
</div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -36.8189, lng: -73.0503},
          zoom: 8
        });
        var marker = new google.maps.Marker({
          position: {lat: 43.542194, lng: -5.676875},
          map: map,
          title: 'Acuario de Gijón'
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAphTjbmi1juA-223nXAICkGm0cXc30plA&callback=initMap"
    async defer></script>
  </body>
</html>
