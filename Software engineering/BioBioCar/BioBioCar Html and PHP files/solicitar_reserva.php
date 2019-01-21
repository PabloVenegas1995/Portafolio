<?php
  include 'clases.php';
  session_start();
  $user = $_SESSION['username'];
  $_idviaje = $_POST['idviaje'];
  $origen = $_POST['inicio'];
  $_normal = $_POST['normales'];
  $_especial = $_POST['especiales'];
  $destino = $_POST['destino'];
  $pasajero = new Pasajero($user);
  date_default_timezone_set('America/Santiago');
  $fecha = date("Y-m-d");
  $hora = date("H:i:s");
  $pasajero->reservar($_idviaje, $origen, $destino, $_normal, $_especial, $fecha, $hora);
?>
<meta http-equiv="refresh" content="0;url=test2.php"/>
