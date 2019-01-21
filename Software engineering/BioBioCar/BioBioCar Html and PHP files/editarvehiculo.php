<?php
  session_start();

if(isset($_POST['marca'])) $marca=$_POST['marca'];
if(isset($_POST['modelo'])) $modelo=$_POST['modelo'];
if(isset($_POST['patente'])) $patente=$_POST['patente'];

echo "Editar datos del vehiculo de " .$_SESSION['username']; echo "<br>";echo "<br>";

?>
<form action="guardardatosvehiculo.php" method="post">
	Patente:<br>
  	<input type="text" name="patente" value='<?php echo "$patente";?>'><br>
  	Marca:<br>
 	<input type="text" name="marca" value='<?php echo "$marca";?>'><br>
  	Modelo:<br>
  	<input type="text" name="modelo" value='<?php echo "$modelo";?>'><br>
	<br>
  	<br>
  	<input type="submit" value="Guardar Cambios">
</form> 
<form action="perfilpropio_c.php">
  <input type="submit" value="Cancelar">
</form> 

