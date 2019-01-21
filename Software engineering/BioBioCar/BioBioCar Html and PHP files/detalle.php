<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
        width: 600px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="test2.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="test2.php">Buscar Viaje <span class="sr-only">(current)</span></a>
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

				<h1>Detalle Viaje</h1>
	  <?php

$id = (string)$_GET['ID'];
$origen = $_GET['Origen'];
$destino = $_GET['Destino'];

//echo '<script> initMap("Arauco","Lota")</script>';


$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
$viaje = pg_query($db, "SELECT *
                        FROM iteracion2.tramo as T
                        WHERE T.idviaje = '$id'
                        order by T.seq");
$conductor = pg_query($db, "SELECT U.nombre_completo, V.fecha
                        FROM iteracion2.viaje as V, iteracion2.conductor as C, iteracion2.usuario as U
                        WHERE V.id = '$id' AND V.conductor = C.username AND C.username=U.username");
$rowdriver = pg_fetch_array($conductor);
echo '<h2>Conductor: ' . $rowdriver[0] . '</h2><br>';
echo '<h2>Fecha: ' . $rowdriver[1] . '</h2><br>';
echo '<div class="container-fluid">
        <div class="row">
          <div class="col">';
    echo '<table class="table table-dark">';
    echo '<thead>';
    	echo '<tr>';
    		echo '<th scope="col">Parada</th>';
    		echo '<th scope="col">Hora Aprox</th>';
    		echo '<th scope="col">Plazas Disponibles</th>';
    		echo '<th scope="col">Plazas Especiales</th>';
    		echo '<th scope="col"></th>';
    	echo '</tr>';
     echo '</thead>';
     echo '<tbody>';
     $ori = null;
     $des = null;
    $nrow = pg_num_rows($viaje);
    for ($i=0; $i < $nrow; $i++) {
    	$row = pg_fetch_array($viaje, $i);
      if($i == 0){
        $ori = $row[2]; //origen del viaje
      }
    	if($i < $nrow-1){
    		echo '<td>' . $row[4] . ', ' . $row[2] . '</td>';
    		echo '<td>' . $row[6] . '</td>';
    		echo '<td>' . $row[9] . '</td>';
        echo '<td>' . $row[10] . '</td>';
    		echo '</tr>';
    	}
      else{
        $des = $row[3];
        echo '<td>' . $row[4] . ', ' . $row[2] . '</td>';
    		echo '<td>' . $row[6] . '</td>';
    		echo '<td>' . $row[9] . '</td>';
        echo '<td>' . $row[10] . '</td>';
    		echo '</tr>';
        echo '<td>' . $row[5] . ', ' . $row[3] . '</td>';
        echo '<td>' . $row[7] . '</td>';
        echo '<td>' . $row[9] . '</td>';
        echo '<td>' . $row[10] . '</td>';
    		echo '</tr>';
      }
    }
    	echo '</tbody>';?>
      <?php
    	echo '</table>';?>
      <button onclick="initMap('<?php echo $ori; ?>','<?php echo $des; ?>')">MAPA</button>
      <?php
           echo' </div>
          <div class="col">'?>
            <?php
         echo'<div id="map"><div>
          </div>
        </div>
        <div class="row">'?>
          <?php
        echo '</div>
      </div>';
	echo '<form action = "solicitar_reserva.php" method="POST" >';
	$plazasnorm = pg_query($db, "SELECT MIN(T.asientos_disp) FROM iteracion2.tramo as T WHERE T.idviaje = '$id' AND T.seq >= '$origen' AND T.seq <= '$destino'");
  $plazasesp = pg_query($db, "SELECT MIN(T.asientos_esp_disp) FROM iteracion2.tramo as T WHERE T.idviaje = '$id' AND T.seq >= '$origen' AND T.seq <= '$destino'");
	$rowplazanorm = pg_fetch_array($plazasnorm);
  $rowplazaesp = pg_fetch_array($plazasesp);
	echo '<li>Numero de plazas normales a solicitar:</li><li><input type="number" max=' . $rowplazanorm[0] . ' min ="1"name="normales" value="1" id = "normales"/></li>';
	echo '<li>Numero de plazas especiales a solicitar:</li><li><input type="number" max=' . $rowplazaesp[0] . ' min="0" value="0" name="especiales" id = "especiales"/></li>';
	echo '<input name="idviaje" type="hidden" value="' . htmlspecialchars($id) .'" />'."\n";
	echo '<input name="inicio" type="hidden" value="' . htmlspecialchars($origen) .'" />'."\n";
	echo '<input name="destino" type="hidden" value="' . htmlspecialchars($destino) .'" />'."\n";
	echo '<input type="submit" name="submit" value="Enviar solicitud de reserva"/>';
	echo '</form>';
	//echo $rowplaza[0];

?>
<div class="container">


</div>
</body>
</html>

<script>
      function initMap(o,d) {
        //alert(o + " " + d);
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);
          calculateAndDisplayRoute(directionsService, directionsDisplay,o,d);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay,o,d) {
        directionsService.route({
          origin: o,
          destination: d,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD6Q31QwQK0pv7twtzD32efp6hLa0uFEs">
    </script>




<!--
echo "<a href=\"detalle.php?ID={$row['ID']}\">{$row['NAME']}</a><br>\n";
-->
