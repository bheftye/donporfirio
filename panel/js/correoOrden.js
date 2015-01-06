function enviarCorreo(id){
	$('.buttonSend').prop('disabled',true);
	$('.buttonSend').html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
    	url: 'operaciones.php',
    	type: 'POST',
    	dataType: false,
    	data: {'operaciones': 'correoPedidoEnviado', 'idorden': id},
    	cache:false,
		success:function(data){
			console.log(data);
			if(data == 1){
				$('.top-right').notify({
	    			message: { text: 'Correo Enviado Corréctamente.' },
	    			type:'blackgloss',
	    			fadeOut: { enabled: false, delay: 3000 }
	  			}).show();
	  			$('.buttonSend').prop('disabled',false);
				$('.buttonSend').html('Enviar Confirmación');
			}else{
				$('.top-right').notify({
	    			message: { text: 'Ha ocurrido un error inténtelo de nuevo.' },
	    			type:'blackgloss',
	    			fadeOut: { enabled: false, delay: 3000 }
	  			}).show();
	  			$('.buttonSend').prop('disabled',false);
				$('.buttonSend').html('Enviar Confirmación');
			}
		}
    })
}