<?php

$id_viaje = $_POST['id'];
$sec_viaje = $_POST['sec'];
$dist_viaje = $_POST['dist'];

$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
$consumo = pg_query($db, "SELECT C.consumo, viaj.asientos, viaj.asientos_esp
                            FROM iteracion2.catalogo as C, iteracion2.conductor as cond, iteracion2.viaje as viaj, iteracion2.vehiculo as v
                            WHERE viaj.id = '$id_viaje' AND viaj.conductor = cond.username AND v.conductor = cond.username AND v.marca = C.marca AND v.modelo = C.modelo");
$autonomia = pg_fetch_array($consumo);
$precio = ($dist_viaje*800)/($autonomia[0]*($autonomia[1]+$autonomia[2]));
$insert = pg_query($db, "UPDATE iteracion2.tramo SET distancia = '$dist_viaje', precio = '$precio' WHERE idviaje = '$id_viaje' AND seq = '$sec_viaje'");

//echo $id_viaje. " | ".$sec_viaje. " | ".$dist_viaje;
//if($insert){
//	echo 1;
//}else{
//	echo 0;
//}
echo $insert;
?>
