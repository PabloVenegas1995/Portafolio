<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mi Perfil</title>
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
              <a class="nav-link" href="test2.php">Buscar Viaje</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="solicitudes_realizadas2.php">Reservas Solicitadas</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="perfilpropio_p.php">Mi Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="valoracionespendientes.php">Valoraciones Pendientes</a>
            </li>
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>
     <div class="container-fluid">
		<div id="r1"class="row">
			<div class="col ml-4 mt-3">

				<h1><?php echo "$rut"?></h1>
	  <?php
$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  $consulta = pg_query($db, "SELECT * FROM iteracion2.usuario, iteracion2.pasajero
                             WHERE usuario.username='$rut' and pasajero.username = '$rut' ");

  $consulta2 = pg_query($db, "SELECT AVG(estrellas) FROM iteracion2.valoracion
                             WHERE valoracion.destino = '$rut' and valoracion.estado = 'realizada'");


$datos=pg_fetch_array($consulta);
$datos1=pg_fetch_array($consulta2);

echo ' <h3>Nombre Completo: ' .$datos['nombre_completo']. ' Mi nota es: ' .round($datos1['avg'],2). ' <h3> ';
echo " <h3>Rut: ".$datos['rut']. ' <h3> ';
echo " <h3>Correo: ".$datos['correo']. ' <h3> ';
echo " <h3>Edad: ".$datos['edad']. ' <h3> ';
echo " <h3>Telefono: ".$datos['telefono']. ' <h3> ';
echo " <h3>Profesión: ".$datos['profesion']. ' <h3> ';
echo " <h3>Intereses: ".$datos['intereses']. ' <h3> ';
if ($datos['fumador'] == 't') {
echo  'Fumador: <img src="https:openclipart.org/download/202732/checkmark.svg" alt="YES" width="30" height="40" />';
} if ($datos['fumador'] == 'f') {

echo  'Fumador: <img src="https://openclipart.org/download/15815/Arnoud999-Right-or-wrong-5.svg" alt="NO" width="30" height="40" />';
}

?>

<form action="editarperfil_p.php" method="post">
  <input type='hidden' name='nombrecompleto' value='<?php echo "$datos[nombre_completo]";?>'/>
  <input type='hidden' name='correo' value='<?php echo "$datos[correo]";?>'/>
  <input type='hidden' name='edad' value='<?php echo "$datos[edad]";?>'/>
  <input type='hidden' name='telefono' value='<?php echo "$datos[telefono]";?>'/>
  <input type='hidden' name='profesion' value='<?php echo "$datos[profesion]";?>'/>
  <input type='hidden' name='intereses' value='<?php echo "$datos[intereses]";?>'/>
  <input type='hidden' name='fumador' value='<?php echo "$datos[fumador]";?>'/>

  <input type="submit" value="Editar mis datos personales">
</form>
