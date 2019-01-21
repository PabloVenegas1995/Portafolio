<?php
  session_start();

$username = $_SESSION['username'];

if(isset($_POST['marca'])) $marca=$_POST['marca'];
if(isset($_POST['modelo'])) $modelo=$_POST['modelo'];
if(isset($_POST['patente'])) $patente=$_POST['patente'];

$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
$result = pg_query($db, "	UPDATE iteracion2.vehiculo
							SET   marca = '$marca', modelo = '$modelo', patente = '$patente'
							WHERE conductor = '$username'");
echo "Datos actualizados correctamente";echo "<br>";

?> 
<meta http-equiv="refresh" content="1;url=perfilpropio_c.php" /> 
