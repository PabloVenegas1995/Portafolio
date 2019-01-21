<?php
session_start();
$usuario = $_SESSION['username']; 
$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());

	$dato = $_POST['viaje'];
	$consulta = pg_query($db, "DELETE FROM reserva WHERE reserva.idviaje='$dato';");
	if(!$consulta){echo "Error al borrar";}
	else{echo "Solicitud eliminada correctamente";}
?>

<meta http-equiv="refresh" content="3;url=solicitudes_realizadas.php"/>