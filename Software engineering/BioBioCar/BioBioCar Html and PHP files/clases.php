<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD6Q31QwQK0pv7twtzD32efp6hLa0uFEs&libraries=places&language=es"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
			function enviar(dist,id,sec){
				cadena = "id=" + id + "&sec=" + sec + "&dist=" + dist;

				$.ajax({
					type:"POST",
					url:"distanciaTramo.php",
					data:cadena,
					success:function(r){
						//alert(r);
					}
				});
			}
        	function calcular(o,d,id,sec){
        		var service = new google.maps.DistanceMatrixService;
  				service.getDistanceMatrix({
			    origins: [o],
			    destinations: [d],
			    travelMode: google.maps.TravelMode.DRIVING,
			    unitSystem: google.maps.UnitSystem.METRIC,
			    avoidHighways: false,
			    avoidTolls: false
			  }, function(response, status) {
			    if (status !== google.maps.DistanceMatrixStatus.OK) {
			      alert('Error was: ' + status);
			    } else {
			    	enviar(response.rows[0].elements[0].distance.value/1000,id,sec);
			    }
			  });

        }
</script>
<?php
  class Pasajero{
    public $user;
    public function __construct($username){
      $this->user = $username;
    }
    public function reservar($idviaje, $origen, $destino, $asientos_norm, $asientos_esp, $fecha, $hora){
      $controlador = new Controlador_Viajes($idviaje);
      $tramos = $controlador->obtenerTramo($idviaje, $origen, $destino);
      //echo "numero de tramos antes del count " . count($tramos);
      $reserva = new Reserva($this->user, $tramos, $idviaje, $asientos_norm, $asientos_esp, $fecha, $hora);

    }
  }
  class Controlador_Viajes{
    public $viaje;
    public function __construct($idviaje){
      $this->viaje = $idviaje;
    }
    public function obtenerTramo($idviaje, $origen, $destino){
      $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
      $consulta_tramos = pg_query($db, "SELECT T.seq FROM iteracion2.tramo as T WHERE T.idviaje = '$idviaje' AND T.seq >= '$origen' AND T.seq <= '$destino' ORDER BY T.seq");
      $n=pg_num_rows($consulta_tramos);
	  for($i = 0; $i < $n; $i++){
	      $tramos[$i] = pg_fetch_array($consulta_tramos,$i,PGSQL_NUM);  
	  }
      return $tramos;
    }
  }
  class Reserva{
    public $n_tramos;
    public $_inicio;
    public $_fin;
    public $estado;
    public function __construct($usuario, $tramos, $idviaje, $asientos_norm, $asientos_esp, $fecha, $hora){
      $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
      $this->n_tramos = count($tramos);
      //echo "numero de tramos" . $this->n_tramos;
      $this->_inicio = $tramos[0][0];
      $this->_fin = $tramos[$this->n_tramos-1][0];
      $s = pg_query($db, "SELECT SUM(T.precio) FROM iteracion2.tramo as T WHERE T.idviaje = '$idviaje' AND T.seq >= '$this->_inicio' AND T.seq <= '$this->_fin'");
      $precio = pg_fetch_array($s)[0] * ($asientos_norm + $asientos_esp);
      $this->estado = 'pendiente';
      $this->insertar_reserva($usuario, $idviaje, $asientos_norm, $asientos_esp, $this->estado, $precio, $fecha, $hora);
    }
    public function insertar_reserva($usuario, $idviaje, $asientos, $asientos_esp, $estado, $precio_total, $fecha, $hora){
      $db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
      $insertar_reserva = pg_query($db, "INSERT INTO iteracion2.reserva(pasajero, idviaje, asientos, asientos_esp, estado, precio_total, fecha, hora) VALUES ('$usuario', '$idviaje', '$asientos', '$asientos_esp', '$estado', '$precio_total', '$fecha', '$hora') RETURNING *") or die ('Error en conectar: '. pg_last_error());
      $n = pg_fetch_array($insertar_reserva);
      if($insertar_reserva){
        for($i = $this->_inicio; $i <= $this->_fin; $i++){
          $insertar_reserva_tramo = pg_query($db, "INSERT INTO iteracion2.reservatramo(idreserva, idviaje, seq_tramo) VALUES ('$n[0]', '$idviaje', '$i')") or die ('Error en conectar: '. pg_last_error());
        }
      }
      echo "Solicitudes Enviadas" . "<br>";
    }
  }
  class controlador_paradas{
  	public $pv;

  	function agregarparadas($comunas, $direcciones, $n){
  		$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
  		for($i = 0; $i < $n; $i++){
  			$this->pv[$i][0]=$comunas[$i];
  			$this->pv[$i][1]=$direcciones[$i];
  			$a0=$this->pv[$i][0];
  			$a1=$this->pv[$i][1];
  			$cons = pg_query($db, "SELECT * FROM iteracion2.parada as p WHERE p.comuna = '$a0' AND p.direccion = '$a1'");
  			if(pg_num_rows($cons) == 0){
  				$insert = pg_query($db, "INSERT INTO iteracion2.parada(comuna, direccion)
  				VALUES('$a0', '$a1');");
  			}
  		}
  	}
  	public function obtenerparadas(){
  		return $this->pv;
  	}
  }

  class viaje{
  	public $id;

  	function __construct($idviaje){
  		$this->id=$idviaje;
  	}

  	public function crearviaje($fecha, $n, $comunas, $direcciones, $horas, $asientos, $asientos_esp, $restr1, $restr2){

  		$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
  		$conp=new controlador_paradas();
  		$conp->agregarparadas($comunas, $direcciones, $n);
  		$pv=$conp->obtenerparadas();
  		for($i = 0; $i < $n-1; $i++){
  			$a0=$pv[$i][0];
  			$a1=$pv[$i][1];
  			$a2=$horas[$i];
  			$a3=$pv[$i+1][0];
  			$a4=$pv[$i+1][1];
  			$a5=$horas[$i+1];
  			$tramos = pg_query($db, "INSERT INTO iteracion2.tramo
  			(idviaje,seq,comuna_origen,comuna_destino,direccion_origen,direccion_destino,hora_origen,hora_destino,asientos_disp,asientos_esp_disp)
  			VALUES('$this->id','$i','$a0','$a3','$a1','$a4','$a2','$a5','$asientos','$asientos_esp');");
  			echo '<script> calcular("'.$a0.'","'.$a3.'","'.$this->id.'","'.$i.'"); </script>';
  		}
  	}
  }
  class conductor{
  	public $username;

  	function __construct($user){
  		$this->username=$user;
  	}
  	public function publicarviaje($fecha, $nroparadas, $comunas, $direcciones, $horas, $a, $ae, $restr1, $restr2){
  		$db = pg_connect("host='bdd.inf.udec.cl' port=5432 dbname=isw1b user=isw1b password=isw1b");
  		$insert = pg_query($db, "INSERT INTO iteracion2.viaje (fecha, estado, asientos, asientos_esp, restr_2pers, restr_portamaletas, conductor)VALUES('$fecha', 'pendiente', '$a', '$ae', '$restr1', '$restr2', '$this->username')RETURNING id;");
  		$rowid = pg_fetch_array($insert);
  		$viaje=$rowid[0];
  		$miviaje=new viaje($viaje);
  		$miviaje->crearviaje($fecha, $nroparadas, $comunas, $direcciones, $horas, $a, $ae, $restr1, $restr2);
  	}
  }
?>
