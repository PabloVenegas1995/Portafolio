<?php
session_start();
$usuario = $_SESSION['username'];
$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
$reservas = pg_query($db, "SELECT DISTINCT T.comuna_origen, T1.comuna_destino, R.asientos, R.asientos_esp, R.estado, R.fecha, R.hora, R.precio_total, R.id
                        FROM iteracion2.reserva as R, iteracion2.tramo as T, iteracion2.tramo as T1, iteracion2.reservatramo as RT
                        WHERE  R.pasajero = '$usuario' AND R.id = RT.idreserva AND RT.idviaje = T.idviaje AND T.idviaje = T1.idviaje AND T.seq <= T1.seq
                        AND T1.seq = (SELECT MAX(RT.seq_tramo) FROM iteracion2.reservatramo as RT WHERE RT.idviaje = T1.idviaje AND RT.idreserva = R.id)
                        AND T.seq = (SELECT MIN(RT.seq_tramo) FROM iteracion2.reservatramo as RT WHERE RT.idviaje = T.idviaje AND RT.idreserva = R.id)");

?>
<table class="table table-hover table-condensed table-bordered">
  <thead>
    <th scope="col">Origen</th>
    <th scope="col">Destino</th>
    <th scope="col">Asientos Solicitados</th>
    <th scope="col">Asientos Especiales</th>
    <th scope="col">Estado</th>
    <th scope="col">Fecha</th>
    <th scope="col">Hora</th>
    <th scope="col">Monto</th>
    <th scope="col">Acción</th>
  </thead>
  <tbody>
  <?php
  $nrow = pg_num_rows($reservas);
	for ($i = 0; $i < $nrow; $i++) {
    $row = pg_fetch_array($reservas, $i);
    ?>
      <tr>
        <th scope="row"><?php echo $row[0]; ?></th>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td><?php echo $row[5]; ?></td>
        <td><?php echo $row[6]; ?></td>
        <td><?php echo $row[7]; ?></td>
        <td>
          <button class="btn btn-danger" onclick="preguntar('<?php echo $row[8]; ?>')">Eliminar</button>
        </td>
      </tr>
 <?php } ?>
      </tbody>
    </table>
