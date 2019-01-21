<?php
  session_start();
$typeuser = $_SESSION['usertype'];
$username = $_SESSION['username'];


if ($typeuser == 'pasajero') {
	$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  	$consulta = pg_query($db, "SELECT V1.id, V1.fecha, V1.estado, U.nombre_completo, V.estado, V.origen FROM iteracion2.valoracion as V, iteracion2.viaje as V1, iteracion2.usuario as U
                             WHERE V.origen = '$username' and V.idviaje = V1.id and U.username = V.destino and V.estado = 'pendiente' and V1.estado = 'completado'");
?>
<table class="table table-hover table-condensed table-bordered">
  <thead>
    <th scope="col">Fecha del viaje</th>
    <th scope="col">Estado del viaje</th>
    <th scope="col">Nombre del conductor del viaje</th>
    <th scope="col">Estado de la valoracion</th>
    <th scope="col">Valorar</th>
  </thead>
  <tbody>
<?php
$nrow = pg_num_rows($consulta);
	for ($i = 0; $i < $nrow; $i++) {
    $row = pg_fetch_array($consulta, $i);
//    $usuarioanalizar = pg_query($db, "SELECT V.conductor FROM iteracion2.viaje as V WHERE V.id = '$row[9]'");
    ?>
    <tr>
    	<th scope="row"><?php echo $row[1]; ?></th>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td>
        	<form method="post" target="_self">
        		<select name="nota">
        			<option value="5" selected>5 estrellas</option>
        			<option value="4" >4 estrellas</option>
        			<option value="3" >3 estrellas</option>
        			<option value="2" >2 estrellas</option>
        			<option value="1" >1 estrella</option>
        		</select>
				<textarea name="comentario" rows="1" cols="50"> Ingrese su comentario en esta lugar</textarea>
        		<input type="hidden" value="<?php echo $row[0]; ?>" name="viaje"/>
        		<input type="hidden" value="<?php echo $row[5]; ?>" name="origen"/>        		
        		<input type="submit" value= "Valorar" name="SubmitButton"/>
        	</form>
		</td>
    </tr>
    
<?php
}

?>
  </tbody>
    </table>
<?php


}

if ($typeuser == 'conductor') {
	$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b") or die ('ERORR'. pg_last_error());
  	$consulta = pg_query($db, "SELECT V1.id, V1.fecha, V1.estado, U.nombre_completo, V.estado, V.origen FROM iteracion2.valoracion as V, iteracion2.viaje as V1, iteracion2.usuario as U
                             WHERE V.origen = '$username' and V.idviaje = V1.id and U.username = V.destino and V.estado = 'pendiente' and V1.estado = 'completado'");
?>
<table class="table table-hover table-condensed table-bordered">
  <thead>
    <th scope="col">Fecha del viaje</th>
    <th scope="col">Estado del viaje</th>
    <th scope="col">Nombre del pasajero del viaje</th>
    <th scope="col">Estado de la valoracion</th>
    <th scope="col">Valorar</th>
  </thead>
  <tbody>
<?php
$nrow = pg_num_rows($consulta);
	for ($i = 0; $i < $nrow; $i++) {
    $row = pg_fetch_array($consulta, $i);
//    $usuarioanalizar = pg_query($db, "SELECT V.conductor FROM iteracion2.viaje as V WHERE V.id = '$row[9]'");
    ?>
    <tr>
    	<th scope="row"><?php echo $row[1]; ?></th>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $row[3]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td>
        	<form method="post" target="_self">
        		<select name="nota">
        			<option value="5" selected>5 estrellas</option>
        			<option value="4" >4 estrellas</option>
        			<option value="3" >3 estrellas</option>
        			<option value="2" >2 estrellas</option>
        			<option value="1" >1 estrella</option>
        		</select>
				<textarea name="comentario" rows="10" cols="10"> Ingrese su comentario en esta lugar </textarea>
        		<input type="hidden" value="<?php echo $row[0]; ?>" name="viaje"/>
        		<input type="hidden" value="<?php echo $row[5]; ?>" name="origen"/>        		
        		<input type="submit" value= "Valorar" name="SubmitButton"/>
        	</form>
		</td>
    </tr>
    
<?php
}

?>
  </tbody>
    </table>
<?php

}
?>