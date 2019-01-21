<?php
	//require 'clases.php';
	$id = $_POST['ID'];
	$o = $_POST['Origen'];
	$h = $_POST['Hora'];
	$r = $_POST['Rut'];
	//$n = $_POST['N'];
	$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b")or die('Error en conectar: '. pg_last_error());
	$insert = pg_query($db, "INSERT INTO viaje (id, fecha, hora, rutconductor)VALUES('$id', '$o', '$d', '$f', '$h', '$r');");
	/*$cons = pg_query($db, "SELECT * FROM public.viaje");
	$filas = pg_num_rows($cons);
	for($i = 0; $i < $filas; $i++){
		$row = pg_fetch_array($cons, $i);
		echo "id: " . $row[0]."<br>";
		echo ":origen " . $row[1]."<br>";
		echo "destino " . $row[2]."<br>";
		echo "fecha " . $row[3]."<br>";
		echo "hora " . $row[4]."<br>";
		echo "rut: " . $row[5]."<br>";
	}*/
	if(!$insert){
		echo "Error en consulta";
	}else{
		echo "Consulta wena";
	}
?>

