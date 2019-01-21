<?php
  $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  $dato = $_POST['id'];
  $consulta = pg_query($db, "UPDATE iteracion2.reserva as R SET estado = 'aceptada' WHERE R.id = '$dato'");
  if($consulta){echo true;}
  else{echo false;}
?>
