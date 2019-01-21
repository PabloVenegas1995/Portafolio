<?php
session_start();
$usuario = $_SESSION['username']; 
$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());


if(isset($_POST['cancelar'])){
	$dato = $_POST['viaje'];
	$consulta = pg_query($db, "DELETE FROM reserva WHERE reserva.idviaje='$dato';");
	if(!$consulta){echo "Error al borrar";}
	else{echo "Solicitud eliminada correctamente";}
}
if(isset($_POST['aceptar'])){
	$dato = $_POST['viaje'];
	$consulta = pg_query($db, "UPDATE reserva SET estado = 'aceptada' WHERE reserva.idviaje = '$dato';");
	if(!$consulta){echo "Error al actualizar";}
	else{echo "Solicitud aceptada correctamente";}
}

?>

<meta http-equiv="refresh" content="3;url=solicitudes_pendientes.php"/>