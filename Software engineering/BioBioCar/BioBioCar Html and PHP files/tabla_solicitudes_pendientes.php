<?php
session_start();
$usuario = $_SESSION['username'];
$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
$reservas = pg_query($db, "SELECT DISTINCT R.id, R.idviaje, R.estado, R.pasajero
                        FROM iteracion2.reserva as R, iteracion2.viaje as V, iteracion2.pasajero as P
                        WHERE  V.conductor = '$usuario' AND V.id = R.idviaje");

?>
<table class="table table-hover table-condensed table-bordered">
  <thead>
    <th scope="col">Origen</th>
    <th scope="col">Destino</th>
    <th scope="col">Pasajero</th>
    <th scope="col">Asientos Solicitados</th>
    <th scope="col">Asientos Especiales</th>
    <th scope="col">Fecha</th>
    <th scope="col">Hora</th>
    <th scope="col">Valor</th>
    <th scope="col">Estado</th>
    <th scope="col">Acción1</th>
    <th scope="col">Acción2</th>
  </thead>
  <tbody>
  <?php
  $nrow = pg_num_rows($reservas);
	for ($i=0; $i < $nrow; $i++) {
    $row = pg_fetch_array($reservas, $i);
    $fila = pg_query($db, "SELECT DISTINCT T.comuna_origen, T1.comuna_destino, R.asientos, R.asientos_esp, R.estado, R.fecha, R.hora, R.precio_total
                           FROM iteracion2.tramo as T, iteracion2.tramo as T1, iteracion2.reserva as R, iteracion2.reservatramo as RT
                           WHERE R.id = '$row[0]' AND R.idviaje = '$row[1]' AND RT.idreserva = '$row[0]' AND RT.idviaje = '$row[1]'
                           AND T.seq = (SELECT MIN(rt.seq_tramo) FROM iteracion2.reservatramo as rt WHERE rt.idviaje = '$row[1]' AND rt.idreserva = '$row[0]')
                           AND T1.seq = RT.seq_tramo AND T1.seq = (SELECT MAX(rt.seq_tramo)FROM iteracion2.reservatramo as rt WHERE rt.idreserva = '$row[0]' AND rt.idviaje = '$row[1]')
                           AND T.seq <= T1.seq AND T.idviaje = '$row[1]' AND T1.idviaje = '$row[1]' ORDER BY fecha, hora DESC");
    $f = pg_fetch_array($fila)
    ?>
      <tr>
        <th scope="row"><?php echo $f[0]; ?></th>
        <td><?php echo $f[1]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $f[2]; ?></td>
        <td><?php echo $f[3]; ?></td>
        <td><?php echo $f[5]; ?></td>
        <td><?php echo $f[6]; ?></td>
        <td>$<?php echo (int)$f[7]; ?></td>
        <td><?php echo $f[4]; ?></td>
        <td>
          <button class="btn btn-danger" onclick="preguntar2('<?php echo $row[0]; ?>')">Eliminar</button>
        </td>
        <?php if($f[4] == "pendiente"){?>
        <td>
          <button class="btn btn-success" onclick="preguntar3('<?php echo $row[0]; ?>')">Aceptar</button>
        </td>
      <?php }?>
      </tr>
 <?php } ?>
      </tbody>
    </table>
