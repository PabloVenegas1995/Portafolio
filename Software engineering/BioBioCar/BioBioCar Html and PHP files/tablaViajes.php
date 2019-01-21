<?php
  session_start();
  $r=$_SESSION['username'];
  $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b")or die('Error en conectar: '. pg_last_error());
  $consulta = pg_query($db, "SELECT T.comuna_origen, T1.comuna_destino, V.fecha, T.hora_origen, V.estado, V.id FROM iteracion2.viaje as V, iteracion2.tramo as T, iteracion2.tramo as T1
                        WHERE V.conductor = '$r' AND T.idviaje = V.id AND V.estado = 'pendiente' AND T1.idviaje = V.id AND T.seq = '0' AND T1.seq = (SELECT MAX(t.seq) FROM iteracion2.tramo as t WHERE t.idviaje = V.id)");
?>
<table class="table table-hover table-condensed table-bordered">   <!-- aquí se despliega la tabla-->
  <thead>
      <th scope="col">Origen</th>
      <th scope="col">Destino</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora Inicio</th>
      <th scope="col">Estado</th>
      <th scope="col">Acción</th>
  </thead>
  <tbody>
    <?php
    while($datos=pg_fetch_array($consulta)){
      echo '
          <tr>
            <th scope="row">'.$datos[0].'</th>
            <td>'.$datos[1].'</td>
            <td>'.$datos[2].'</td>
            <td>'.$datos[3].'</td>
            <td>'.$datos[4].'</td>
            <td><button class="btn btn-danger" onclick="terminarViaje('. $datos[5] .')">Terminar</button></td>
          </tr>
      ';
    }
    ?>
  </tbody>
</table>
