<?php
	include 'clases.php';
	session_start();
	$r=$_SESSION['username'];
	$n = $_POST['numeroparadas'];
	$f = $_POST['fechaviaje'];
	$a = $_POST['asientos'];
	$ae = $_POST['asientosesp'];
	$r1 = $_POST['r1'];
	$r2 = $_POST['r2'];
	$parada = $_POST['parada'];
	for($i = 0; $i < $n; $i++){
		$comunas[$i] = $parada[$i]['comuna'];
		$direcciones[$i] = $parada[$i]['direccion'];
		$horas[$i] = $parada[$i]['hora'];
	}
	$driver=new conductor($r);
	$driver->publicarviaje($f, $n, $comunas, $direcciones, $horas, $a, $ae, $r1, $r2);
	echo "<h2>Viaje agregado correctamente</h2>";
	echo "<br><a href=conductor.php>Volver a la pagina principal</a>";
?>
