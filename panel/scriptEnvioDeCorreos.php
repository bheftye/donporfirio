<?php 
	function __autoload($nombre_clase) {
		$nombre_clase = strtolower($nombre_clase);
	    include realpath(dirname(__FILE__)).'/clases/'.$nombre_clase .'.php';
	}

	//Link Necesario Para que los usuarios se puedan desuscribir.
	$linkParaDesuscribir = "http://plataformacerouno.com/desuscribir/";

	$progresoMailing = new ProgresoMailing();
	$progresosMailingNoTerminados = $progresoMailing -> listarProgresosMailingNoTerminados();
	
	if(count($progresosMailingNoTerminados) > 0){
		$progreoMailingMasViejo = $progresosMailingNoTerminados[0];
		enviarCorreos($progreoMailingMasViejo -> idMailing);
		
	}
	//function tempcorreo1($idcorreo1,$destinatario, $urlDesuscribir = "",$correoPrueba="")

	function enviarCorreo($idCorreo, $destinatario, $urlDesuscribir , $plantilla){
		$tempcorreo1 = null;
		switch ($plantilla) {
			case '1':
				$tempcorreo1= new tempcorreo1($idCorreo, $destinatario, $urlDesuscribir);
				break;
			default:
				echo "Sin plantilla";
				break;
		}
		
		if($tempcorreo1 != null){
			$enviado = $tempcorreo1->enviar();
			return $enviado;
		}

		return false;
	}

	function enviarCorreos($idMailing){
		try{
			$progresoMailing = new ProgresoMailing($idMailing);
			$progresoMailing -> obtenerProgresoMailing();
			$plantilla = $progresoMailing -> plantilla;
			
			$enviosPermitido = $progresoMailing -> permisoEnvios;
			if($enviosPermitido == 0){
				$boletin = new boletin();
				$boletinesActivos = array();

				$idCorreo = $progresoMailing -> idCorreo;
				$correo = new correo1($idCorreo);
				$correo -> obtenerCorreo1();
				
				$i = $progresoMailing -> enviados;
				$j = 1;
				while($i < $progresoMailing -> numCorreos && $j < 300  ){

							$boletinesActivos = $boletin -> obtenerBoletinesConLimite($i);
							var_dump($boletinesActivos);
							foreach ($boletinesActivos as $boletinActivo){
								if($progresoMailing -> enviados < $progresoMailing -> numCorreos){
								 	try{
									 	$enviado = enviarCorreo($idCorreo, $boletinActivo["correo"], $linkParaDesuscribir.$boletinActivo["token"], $plantilla);
									 	if($enviado){
									 		$progresoMailing -> agregarUnEnviado();
											sleep(8);
									 	}
									 	else{
									 		$excepcion = new Excepciones();
									 		$excepcion -> descripcion = $i.":No se envío un correo ->".$boletinActivo["correo"]." | ".$boletinActivo["idboletin"];
									 		$excepcion -> insertarExcepcion();
									 		//exit();
									 	}
								 	}catch(Exception $e){
								 		$excepcion = new Excepciones();
										$excepcion -> descripcion = $e -> getMessage();
										$excepcion -> insertarExcepcion();
										continue;
								 	}
								}
							}
							$i += 50;
							$j+=50;
					
					/*$tempcorreo1= new tempcorreo4($idCorreo,0,39142);
					$enviado2 = $tempcorreo1->enviar();
					usleep(8000000);
					$tempcorreo1= new tempcorreo4($idCorreo,0,39141);
					usleep(8000000);
					$enviado3 = $tempcorreo1->enviar();
					if(!$enviado2 || !$enviado3 ){
						$excepcion = new Excepciones();
				 		$excepcion -> descripcion = $i.":No se envío un correo ->39142 y 39141";
				 		$excepcion -> insertarExcepcion();
				 		exit();
					}*/
				}

				if($progresoMailing -> enviados == $progresoMailing -> numCorreos){
					$fechaYHoraFinal = date("Y-m-d h:i:sa");
					$progresoMailing -> fechaYHoraFinal = $fechaYHoraFinal;
					$progresoMailing -> status = 1;
					$progresoMailing -> actualizarFechaYHoraFinal();
					$progresoMailing -> actualizarStatus();
					$progresoMailing -> bloquearEnvio();
					$tempcorreo5 = new tempcorreo5($progresoMailing -> idMailing);
					$tempcorreo5 -> enviar();
				}
			}

		}catch(Exception $e){

			$excepcion = new Excepciones();
			$excepcion -> descripcion = $e -> getMessage();
			$excepcion -> insertarExcepcion();

		}
	}
?>