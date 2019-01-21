<?php
// Conectando y seleccionado la base de datos
$dbconn = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");

if($dbconn){
  echo "Conexión Existosa";
}else{
  echo "Erro de conexión";
}
// Cerrando la conexión
pg_close($dbconn);
?>
