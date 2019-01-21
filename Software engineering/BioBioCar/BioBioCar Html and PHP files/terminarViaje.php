<?php
	$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERROR'. pg_last_error());
	$viaje = $_POST['id'];
	$consulta = pg_query($db, "UPDATE iteracion2.viaje SET estado = 'completado' WHERE id = '$viaje';");
	$conductor = pg_query($db, "SELECT V.conductor FROM iteracion2.viaje as V WHERE V.id = '$viaje';");
	$pasajeros = pg_query($db, "SELECT R.pasajero FROM iteracion2.reserva as R WHERE R.idviaje = '$viaje' AND R.estado = 'aceptada';");
	$passenger = pg_fetch_array($pasajeros);
	$n = pg_num_rows($pasajeros);
	$cond = pg_fetch_array($conductor);
	for($i = 0; $i < $n; $i++){
			$valoracion = pg_query($db, "INSERT INTO iteracion2.valoracion(idviaje, origen, destino) VALUES('$viaje', '$cond[0]', '$passenger[$i]');");
			$valoracion2 = pg_query($db, "INSERT INTO iteracion2.valoracion(idviaje, origen, destino) VALUES('$viaje', '$passenger[$i]', '$cond[0]');");
	}
	if($consulta){echo true;}
	else{echo false;}
?>
