<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
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
          </ul>
        </div>
        <button type="button" class="btn btn-light mr-1"><?php $rut = $_SESSION['username']; echo "User: ".$rut ?></button>
        <button onclick="location.href='terminar_sesion.php';" type="button" class="btn btn-outline-danger">Logout</button>
      </nav>
      <div class="container-fluid">
  <div id="r1"class="row">
    <div class="col ml-4 mt-3">
      <h1>Mis Viajes</h1>
      <?php
      // datos de la busqueda //
      $_origen = $_POST['origen'];
      $_destino = $_POST['destino'];
      $_fecha = $_POST['fecha'];
      // conexion a la base //
      $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b")or die('Error en conectar: '. pg_last_error());
      // lista de viajes //
      $viajes = pg_query($db, "SELECT DISTINCT T.h1, T.h2, C.nombre_completo, T.fecha, T.id, T.Tid1, T.Tid2
                               FROM iteracion2.usuario as C, (SELECT V.id, V.fecha, V.conductor, P.h1, P.h2, P.Tid1, P.Tid2
                                                     FROM iteracion2.viaje as V, (SELECT T1.idviaje, T1.hora_origen as h1, T2.hora_destino as h2, T1.seq as Tid1, T2.seq as Tid2
                                                                       FROM iteracion2.tramo as T1, iteracion2.tramo as T2
                                                                       WHERE T1.idviaje = T2.idviaje AND T1.seq <= T2.seq AND T1.comuna_origen = '$_origen' AND T2.comuna_destino = '$_destino') as P
                                                     WHERE V.id = P.idviaje AND V.fecha = '$_fecha' AND V.estado = 'pendiente') as T
                               WHERE C.username = T.conductor;");
      $nviajes = pg_num_rows($viajes);
      echo '<table class="table table-dark">';
      echo '<thead>';
        echo '<tr>';
          echo '<th scope="col">Conductor</th>';
          echo '<th scope="col">Fecha(Año-Mes-Dia)</th>';
          echo '<th scope="col">Hora salida ' . $_origen . '</th>';
          echo '<th scope="col">Hora llegada ' . $_destino . '</th>';
          echo '<th scope="col"></th>';
        echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      for($i = 0; $i < $nviajes; $i++){
        $viaje = pg_fetch_array($viajes, $i);
        $tramos = pg_query($db, "SELECT * FROM iteracion2.tramo WHERE tramo.idviaje = '$viaje[4]'");
        $ntramos = pg_num_rows($tramos);
        $plazasnorm = pg_query($db, "SELECT MIN(T.asientos_disp) FROM iteracion2.tramo as T WHERE T.idviaje = '$viaje[4]' AND T.seq >= '$viaje[5]' AND T.seq <= '$viaje[6]'");
        $plazasesp = pg_query($db, "SELECT MIN(T.asientos_esp_disp) FROM iteracion2.tramo as T WHERE T.idviaje = '$viaje[4]' AND T.seq >= '$viaje[5]' AND T.seq <= '$viaje[6]'");
        $norm = pg_fetch_array($plazasnorm);
        $esp = pg_fetch_array($plazasesp);
        if($norm[0] > 0 || $esp[0] > 0){
          echo "<tr class='clickable-row' data-href='url://procesar.php'>";
          echo '<th scope="row">'. $viaje[2] . '</th>';
          echo '<td>' . $viaje[3] . '</td>';
          echo '<td>' . $viaje[0] . '</td>';
          echo '<td>' . $viaje[1] . '</td>';
          echo "<td> <a href='detalle.php?ID={$viaje[4]}&Origen={$viaje[5]}&Destino={$viaje[6]}'>Ver Detalle</a> </td>";
          echo "</tr>";
        }
      }
      echo '</tbody>';
      echo '</table>';
    ?>
  </div>
</div>
  </body>
</html>
