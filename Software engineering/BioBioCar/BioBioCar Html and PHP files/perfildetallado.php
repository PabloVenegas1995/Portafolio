<?php
  session_start();
$usertype = $_SESSION['usertype'];

if ($usertype == 'pasajero') {
?>
<!DOCTYPE html>
<html>
  <head>
  	<script>
		function goBack() {
    	window.history.back()
		}
	</script>
    <title>Perfil Detallado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="test2.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="test2.php">Buscar Viaje <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_realizadas2.php">Reservas Solicitadas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perfilpropio_p.php">Ver Mi Perfil</a>
            </li>
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>
     <div class="container-fluid">
		<div id="r1"class="row">
			<div class="col ml-4 mt-3">
				<h1>Perfil del conductor del viaje</h1>
<?php

$username_c = $_GET['Usuario'];

$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  $consulta = pg_query($db, "SELECT * FROM iteracion2.usuario, iteracion2.conductor , iteracion2.vehiculo
                             WHERE usuario.username='$username_c' and conductor.username = '$username_c' and vehiculo.conductor = '$username_c'");

  $consulta2 = pg_query($db, "SELECT AVG(estrellas) FROM iteracion2.valoracion
                             WHERE valoracion.destino = '$username_c' and iteracion2.estado = 'realizada' ");

$datos=pg_fetch_array($consulta);
$datos1=pg_fetch_array($consulta2);
echo '<button onclick="goBack()">Volver atras</button>';

echo ' <h3>Nombre Completo: ' .$datos['nombre_completo']. ' Su nota promedio es: ' .round($datos1['avg'],2). ' <h3> '; 
echo " <h3>Rut: ".$datos['rut']. ' <h3> ';
echo " <h3>Correo: ".$datos['correo']. ' <h3> ';
echo " <h3>Edad: ".$datos['edad']. ' <h3> ';
echo " <h3>Telefono: ".$datos['telefono']. ' <h3> ';
echo " <h3>Profesión: ".$datos['profesion']. ' <h3> ';
echo " <h3>Intereses: ".$datos['intereses']. ' <h3> ';

if ($datos['fumador'] == t) {
echo  'Fumador: <img src="https:openclipart.org/download/202732/checkmark.svg" alt="YES" width="30" height="40" />';  
} else { 
echo  'Fumador: <img src="https://openclipart.org/download/15815/Arnoud999-Right-or-wrong-5.svg" alt="NO" width="30" height="40" />';  
}echo "<br>";echo "<br>";

echo " <h3>Clase de Licencia: ".$datos['clase_licencia']. ' <h3> ';
$newDateString = date_format(date_create_from_format('Y-m-d', $datos['fecha_licencia']), 'd-m-Y');
echo " <h3>Fecha de obtencion de la licencia: ".$newDateString. ' <h3> ';

echo " <h3>Patente: ".$datos['patente']. ' <h3> ';
echo " <h3>Marca: ".$datos['marca']. ' <h3> ';
echo " <h3>Modelo: ".$datos['modelo']. ' <h3> ';
?>							  


<?php
} 
///////////////////////////////////////////////////////////////////////////////////////////////////
if ($usertype == 'conductor') {
?>	
<!DOCTYPE html>
<html>
  <head>
  	<script>
		function goBack() {
    	window.history.back()
		}
	</script>
    <title>Perfil Detallado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="conductor.php">BioBioCar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="listaViaje_c.php">Mis Viajes <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="conductor.php">Publicar Viaje</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_pendientes2.php">Solicitudes de Reserva</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="perfilpropio_c.php">Ver Mi Perfil</a>
            </li>
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>
     <div class="container-fluid">
		<div id="r1"class="row">
			<div class="col ml-4 mt-3">

				<h1>Perfil del usuario que solicito reserva</h1>
	  <?php
	  $username_p = $_GET['Usuario'];

$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  $consulta = pg_query($db, "SELECT * FROM iteracion2.usuario, iteracion2.pasajero 
                             WHERE usuario.username='$username_p' and pasajero.username = '$username_p' ");

  $consulta2 = pg_query($db, "SELECT AVG(estrellas) FROM iteracion2.valoracion
                             WHERE valoracion.destino = '$username_p' and valoracion.estado = 'realizada'");


$datos=pg_fetch_array($consulta);
$datos1=pg_fetch_array($consulta2);
echo $datos['nombre_completo'];
echo $username_p;
echo ' <h3>Nombre Completo: ' .$datos['nombre_completo']. ' Mi nota es: ' .round($datos1['avg'],2). ' <h3> '; 
echo " <h3>Rut: ".$datos['rut']. ' <h3> ';
echo " <h3>Correo: ".$datos['correo']. ' <h3> ';
echo " <h3>Edad: ".$datos['edad']. ' <h3> ';
echo " <h3>Telefono: ".$datos['telefono']. ' <h3> ';
echo " <h3>Profesión: ".$datos['profesion']. ' <h3> ';
echo " <h3>Intereses: ".$datos['intereses']. ' <h3> ';

if ($datos['fumador'] == t) {
echo  'Fumador: <img src="https:openclipart.org/download/202732/checkmark.svg" alt="YES" width="30" height="40" />';  
} else { 
echo  'Fumador: <img src="https://openclipart.org/download/15815/Arnoud999-Right-or-wrong-5.svg" alt="NO" width="30" height="40" />';  
}
?>
<button onclick="goBack()">Volver atras</button>


<?php

}

?>							  



<!--
echo "<a href=\"detalle.php?ID={$row['ID']}\">{$row['NAME']}</a><br>\n";
-->
