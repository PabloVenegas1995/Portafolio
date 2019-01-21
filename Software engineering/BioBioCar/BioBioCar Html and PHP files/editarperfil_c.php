<?php
  session_start();

if(isset($_POST['nombrecompleto'])) $nombrecompleto=$_POST['nombrecompleto'];
if(isset($_POST['correo'])) $correo=$_POST['correo'];
if(isset($_POST['edad'])) $edad=$_POST['edad'];
if(isset($_POST['telefono'])) $telefono=$_POST['telefono'];
if(isset($_POST['profesion'])) $profesion=$_POST['profesion'];
if(isset($_POST['fumador'])) $fumador=$_POST['fumador'];
if(isset($_POST['intereses'])) $intereses=$_POST['intereses'];
echo "Editar datos de " .$_SESSION['username']; echo "<br>";echo "<br>";

?>
<form action="guardardatospersonales_c.php" method="post">
	Nombre Completo:<br>
  	<input type="text" name="nombrecompleto" value='<?php echo "$nombrecompleto";?>'><br>
  	Correo:<br>
 	<input type="text" name="correo" value='<?php echo "$correo";?>'><br>
  	Edad:<br>
  	<input type="text" name="edad" value='<?php echo "$edad";?>'><br>
  	Telefono:<br>
  	<input type="text" name="telefono" value='<?php echo "$telefono";?>'><br>
  	Profesion:<br>
  	<input type="text" name="profesion" value='<?php echo "$profesion";?>'><br>
  	Intereses:<br>
  	<input type="text" name="intereses" value='<?php echo "$intereses";?>'><br>
  	Fumador:<br>
  	<select name="fumador">
  		<option value="true">Verdadero</option>
  		<option value="false" selected>Falso</option>  
	</select> 
	<br>
  	<br>
  	<input type="submit" value="Guardar Cambios">
</form> 
<form action="perfilpropio_c.php">
  <input type="submit" value="Cancelar">
</form> 

