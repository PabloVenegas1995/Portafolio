<?php
  session_start();

$username = $_SESSION['username'];

if(isset($_POST['nombrecompleto'])) $nombrecompleto=$_POST['nombrecompleto'];
if(isset($_POST['correo'])) $correo=$_POST['correo'];
if(isset($_POST['edad'])) $edad=$_POST['edad'];
if(isset($_POST['telefono'])) $telefono=$_POST['telefono'];
if(isset($_POST['profesion'])) $profesion=$_POST['profesion'];
if(isset($_POST['fumador'])) $fumador=$_POST['fumador'];
if(isset($_POST['intereses'])) $intereses=$_POST['intereses'];

$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
$result = pg_query($db, "	UPDATE iteracion2.usuario
							SET correo = '$correo', nombre_completo = '$nombrecompleto', edad = '$edad', profesion = '$profesion', telefono = '$telefono', intereses = '$intereses', fumador = '$fumador'  
							WHERE username = '$username'");
echo "Datos actualizados correctamente";echo "<br>";

?> 
<meta http-equiv="refresh" content="1;url=perfilpropio_c.php" /> 
