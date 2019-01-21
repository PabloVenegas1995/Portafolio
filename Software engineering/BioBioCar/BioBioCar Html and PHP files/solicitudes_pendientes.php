<?php
session_start();
$usuario = $_SESSION['username']; 
$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
$viaje = pg_query($db, "SELECT DISTINCT V.id, R.nroasientos, R.nroasientosesp, R.estado, R.rutpasajero
                        FROM reserva as R, viaje as V 
                        WHERE  V.rutconductor = '$usuario' AND V.id = R.idviaje");

$nrow = pg_num_rows($viaje);
if($nrow==0){
	echo '<h1>No tienes reservas pendientes</h1>';
	echo "<br><a href=test1.php>Volver a la pagina principal</a>"; 

}else{

	for ($i=0; $i < $nrow; $i++) { 
		$row = pg_fetch_array($viaje, $i);	 
		echo "Viaje: " .$row[0]. " Pasajero: " .$row[4];
		echo " Numero de asientos solicitados: " .$row[1]. " Numero de asientos especiales solicitados: " .$row[2];
		echo " Estado: " .$row[3];
		echo '<form action="solicitudes_pendientes_refresh.php" method="POST">';
		if($row[3] != 'aceptada'){echo '<input type="submit" name="aceptar" value="ACEPTAR RESERVA"/>';
		echo '<input type="submit" name="cancelar" value="CANCELAR RESERVA"/>
		<input name="viaje" type="hidden" value="' . htmlspecialchars($row[0]) . '" />
		</form>';}
		else{
		echo '<input type="submit" name="cancelar" value="CANCELAR RESERVA"/>
		<input name="viaje" type="hidden" value="' . htmlspecialchars($row[0]) . '" />
		</form>';
		echo "<br>";
		}
	}
		echo "<br><a href=test1.php>Volver a la pagina principal</a>"; 

}
?>