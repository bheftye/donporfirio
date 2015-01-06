<?php

	/**
	* 
	*/
	include_once("conexion.php");
	class ProgresoMailing
	{
		var $idMailing;
		var $idCorreo;
		var $tipoCorreo;
		var $numCorreos;
		var $enviados;
		var $status;
		var $fechaYHoraInicio;
		var $fechaYHoraFinal;
		var $duracion;
		var $plantilla;
		var $permisoEnvios;
		
		function ProgresoMailing($idMailing = 0, $idCorreo = 0, $tipoCorreo = 0, $numCorreos = 0,$enviados = 0,$status = 0, $fechaYHoraInicio = "", $fechaYHoraFinal = "", $duracion = "", $plantilla = 0, $permisoEnvios = 1){
			$this -> idMailing = $idMailing;
			$this -> idCorreo = $idCorreo;
			$this -> tipoCorreo = $tipoCorreo;
			$this -> numCorreos = $numCorreos;
			$this -> enviados = $enviados;
			$this -> status = $status;
			$this -> fechaYHoraInicio = $fechaYHoraInicio;
			$this -> fechaYHoraFinal = $fechaYHoraFinal;
			$this -> duracion = $duracion;
			$this -> plantilla = $plantilla;
			$this -> permisoEnvios = $permisoEnvios;
		}

		function insertarProgresoMailing(){
			$sql = "INSERT INTO `progreso_mailing` (`idcorreo`, `tipocorreo`, `numcorreos`, `enviados`, `status`, `fechayhorainicio`, `fechayhorafinal`, `duracion`, `plantilla`, `permitido`) VALUES (".$this -> idCorreo.",".$this -> tipoCorreo.",".$this -> numCorreos.",".$this -> enviados.",".$this -> status.",'".$this -> fechaYHoraInicio."','".$this -> fechaYHoraFinal."','".$this -> duracion."','".$this -> plantilla."', '".$this -> permisoEnvios."')";
			$con = new conexion();
			$this -> idMailing = $con -> ejecutar_sentencia($sql);
			return;
		}

		function agregarUnEnviado(){
			$sql = "SELECT enviados FROM progreso_mailing WHERE idmailing = ".$this -> idMailing;
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)) {
				$enviados = $fila["enviados"];
				$this -> enviados = $enviados + 1;
				$this -> actualizarEnviados();
			}
			mysqli_free_result($temporal);
			return;
		}

		function actualizarEnviados(){
			$sql = "UPDATE progreso_mailing SET enviados = ".$this -> enviados." WHERE idmailing=".$this -> idMailing;
			$con = new conexion();
			$con -> ejecutar_sentencia($sql);
			return;
		}

		function actualizarFechaYHoraFinal(){
			$sql = "UPDATE progreso_mailing SET fechayhorafinal = '".$this -> fechaYHoraFinal."' WHERE idmailing=".$this -> idMailing;
			$con = new conexion();
			$con -> ejecutar_sentencia($sql);
			return;
		}

		function actualizarStatus(){
			$sql = "UPDATE progreso_mailing SET status = ".$this -> status." WHERE idmailing=".$this -> idMailing;
			$con = new conexion();
			$con -> ejecutar_sentencia($sql);
			return;
		}

		function actualizarDuracion(){
			$sql = "UPDATE progreso_mailing SET duracion = '".$this -> status."' WHERE idmailing=".$this -> idMailing;
			$con = new conexion();
			$con -> ejecutar_sentencia($sql);
			return;
		}

		function calcularDuracion(){
			
		}

		function bloquearEnvios(){
			$sql = "UPDATE progreso_mailing SET permitido = 1 WHERE status = 0 ";
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
		}

		function bloquearEnvio(){
			$sql = "UPDATE progreso_mailing SET permitido = 1 WHERE idmailing = ".$this -> idMailing;
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
		}

		function desbloquearEnvio(){
			$sql = "UPDATE progreso_mailing SET permitido = 0 WHERE idmailing = ".$this -> idMailing;
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
		}

		function desbloquearEnvios(){
			$sql = "UPDATE progreso_mailing SET permitido = 0 WHERE status = 0 ";
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
		}

		function obtenerProgresoMailing(){
			$sql = "SELECT * FROM progreso_mailing WHERE idmailing = ".$this -> idMailing;
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)) {
				$this -> idMailing = $fila["idmailing"];
				$this -> idCorreo = $fila["idcorreo"];
				$this -> tipoCorreo = $fila["tipocorreo"];
				$this -> numCorreos = $fila["numcorreos"];
				$this -> enviados = $fila["enviados"];
				$this -> status = $fila["status"];
				$this -> fechaYHoraInicio = $fila["fechayhorainicio"];
				$this -> fechaYHoraFinal = $fila["fechayhorafinal"];
				$this -> duracion = $fila["duracion"];
				$this -> plantilla = $fila["plantilla"];
				$this -> permisoEnvios = $fila["permitido"];
			}
			mysqli_free_result($temporal);
			return;
		}

		function listarProgresosMailingNoTerminados(){
			$progresosMailing = array();
			$sql = "SELECT * FROM progreso_mailing WHERE status = 0 ORDER BY idmailing ASC";
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)) {
				$progresoMailing = new ProgresoMailing();
				$progresoMailing -> idMailing = $fila["idmailing"];
				$progresoMailing -> idCorreo = $fila["idcorreo"];
				$progresoMailing -> tipoCorreo = $fila["tipocorreo"];
				$progresoMailing -> numCorreos = $fila["numcorreos"];
				$progresoMailing -> enviados = $fila["enviados"];
				$progresoMailing -> status = $fila["status"];
				$progresoMailing -> fechaYHoraInicio = $fila["fechayhorainicio"];
				$progresoMailing -> fechaYHoraFinal = $fila["fechayhorafinal"];
				$progresoMailing -> duracion = $fila["duracion"];
				$progresoMailing -> plantilla = $fila["plantilla"];
				$progresoMailing -> permisoEnvios = $fila["permitido"];
				array_push($progresosMailing, $progresoMailing);
			}
			mysqli_free_result($temporal);
			return $progresosMailing;
		}
	}
?>