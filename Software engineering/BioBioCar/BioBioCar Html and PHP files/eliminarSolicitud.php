<?php
	$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERROR'. pg_last_error());
	$dato = $_POST['id'];
	$consulta = pg_query($db, "DELETE FROM iteracion2.reserva as R WHERE R.id = '$dato';");
	if($consulta){echo true;}
	else{echo false;}
?>
