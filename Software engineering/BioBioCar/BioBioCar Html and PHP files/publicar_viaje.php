<html>
	<head>
		<title>Publicar Viaje</title>
	</head>
	<?php
	session_start;
	$r=$_SESSION['username'];		
	?>
	<body>
		<h1>Publicar Viaje</h1>
		<form action="procesar.php" method="post">
		<input name="ID" type="text" value="ID">
		<input name="Fecha" type="text" value="Fecha">
		<input name="Hora" type="text" value="Hora">
		<input name="N" type="text" value="numero de paradas">
		<input type="submit" value="Enviar">
		</form>
	</body>
</html>