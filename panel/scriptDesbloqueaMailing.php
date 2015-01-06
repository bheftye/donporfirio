<?php
	function __autoload($nombre_clase) {
		$nombre_clase = strtolower($nombre_clase);
	    include realpath(dirname(__FILE__)).'/clases/'.$nombre_clase .'.php';
	}

	$progresoMailing = new ProgresoMailing();
	$progresosMailingNoTerminados = $progresoMailing -> listarProgresosMailingNoTerminados();
	if(count($progresosMailingNoTerminados) > 0){
			$progresoMailing -> desbloquearEnvios();		
	}
?>