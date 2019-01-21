function preguntar(id){
  alertify.confirm('Eliminar Solicitud', 'Estas seguro de eliminar?', function(){ eliminarSolicitud(id) }
                , function(){ alertify.error('Cancelado')});
}

function terminarViaje(id){
  alertify.confirm('Terminar Viaje', 'Viaje Listo?', function(){ finalizarViaje(id) }
                , function(){ alertify.error('Cancelado')});
}

function preguntar2(id){
  alertify.confirm('Eliminar Solicitud', 'Estas seguro de eliminar?', function(){ eliminarSolicitud_pendiente(id) }
                , function(){ alertify.error('Cancelado')});
}

function preguntar3(id){
  alertify.confirm('Aceptar Solicitud', 'Estas seguro de aceptar?', function(){ aceptarSolicitud_pendiente(id) }
                , function(){ alertify.error('Cancelado')});
}

function eliminarSolicitud(id){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"eliminarSolicitud.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$("#tabla").load("tabla_solicitudes_realizadas.php");
				alertify.success("Viaje Eliminado Correctamente!");
			}else{
				alertify.error(cadena+"Error!");
			}
		}
	});
}

function finalizarViaje(id){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"terminarViaje.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$("#tablaViajes").load("tablaViajes.php");
				alertify.success("Viaje Finalizado Correctamente!");
			}else{
				alertify.error("Error!");
			}
		}
	});
}


function eliminarSolicitud_pendiente(id){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"eliminarSolicitud.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$("#tabla2").load("tabla_solicitudes_pendientes.php");
				alertify.success("Solicitud Eliminada Correctamente!");
			}else{
				alertify.error("Error!");
			}
		}
	});
}

function aceptarSolicitud_pendiente(id){
	cadena = "id=" + id;

	$.ajax({
		type:"POST",
		url:"aceptarSolicitud.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$("#tabla2").load("tabla_solicitudes_pendientes.php");
				alertify.success("Solicitud Aceptada Correctamente!");
			}else{
				alertify.error("Error!");
			}
		}
	});
}
