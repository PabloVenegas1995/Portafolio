<?php
    session_start();
	$r=$_SESSION['username'];
	$f = $_POST['Fecha'];
	$a = $_POST['Asientos'];
	$ae = $_POST['Asientosesp'];
	$n = $_POST['N'];
	$r1 = $_POST['Restr2pers'];
	$r2 = $_POST['Restrporta'];
    $n+=2;


	$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");


?>
<html>

<style>

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: relative;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}

.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>

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
        <a class="navbar-brand" href="conductor.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="listaViaje_c.php">Mis Viajes <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Publicar Viaje</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_pendientes2.php">Solicitudes de Reserva</a>
            </li>
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>

		<h1>Inserte Paradas del viaje</h1>
	<form autocomplete="off" action="agregar_parada.php" method="post">
		<?php
			for($i = 0; $i < $n; $i++){
				?>
				<br>
			    <?php if($i==0){
					echo'<h3>Origen</h3>';
				}
				else if($i==$n-1){
					echo'<h3>Destino</h3>';
				}
				else{
					echo'<h3>Parada '. $i .'</h3>';
				}
        echo '
				<input id="dat'.$i.'" name="parada['.$i.'][comuna]" type="text" placeholder="Comuna" required>
				<input name="parada['.$i.'][direccion]" type="text" placeholder="Dirección" required>
				<input name="parada['.$i.'][hora]" type="time" placeholder="Hora" required>

        <script>
          var input'.$i.' = document.getElementById("dat'.$i.'");
          var autocomplete = new google.maps.places.Autocomplete(input'.$i.');
        </script>';
        ?>
				<?php
			}
			echo '<input name="fechaviaje" type="hidden" value="' . htmlspecialchars($f) . '" />'."\n";
			echo '<input name="asientos" type="hidden" value="' . htmlspecialchars($a) . '" />'."\n";
			echo '<input name="asientosesp" type="hidden" value="' . htmlspecialchars($ae) . '" />'."\n";
			echo '<input name="r1" type="hidden" value="' . htmlspecialchars($r1) . '" />'."\n";
			echo '<input name="r2" type="hidden" value="' . htmlspecialchars($r2) . '" />'."\n";
			echo '<input name="numeroparadas" type="hidden" value="' . htmlspecialchars($n) . '" />'."\n";
		?>
		<br>
		<br>
		<input type="submit" value="Enviar">
		</form>

	</body>
</html>
