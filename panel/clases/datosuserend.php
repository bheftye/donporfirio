<?php
include_once('conexion.php');
class datosuserend
{	
	var $iduserend;
	var $fechaCreacion;
	var $tipo;
//	SECCION DE NOMBRES	
	var $nombre;
	var $apellido;
//	SECCION DE LA DIRECCION	
	var $company;
	var $direccion;
	var $ciudad;
	var $postal;
	var $telefono;
	
	function datosuserend($iduserend = 0, $nombre = '', $apellido = '', $company = '', $direccion = '', $ciudad = '', $postal = '', $telefono = '', $tipo = ''){
		$this->iduserend=$iduserend;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->company = $company;
		$this->direccion = $direccion;
		$this->ciudad = $ciudad;
		$this->postal = $postal;
		$this->telefono = $telefono;
		$this->tipo = $tipo;
	}
	
	function insertarDatosUserend(){
		$con = new conexion();
		$sql = "INSERT INTO datosuserend (iduserend, nombre, apellido, company, direccion, ciudad, postal, telefono, tipo) VALUES (".$this->iduserend.", '".htmlspecialchars($this->nombre, ENT_QUOTES)."', '".htmlspecialchars($this->apellido, ENT_QUOTES)."', '".htmlspecialchars($this->company, ENT_QUOTES)."', '".htmlspecialchars($this->direccion, ENT_QUOTES)."', '".htmlspecialchars($this->ciudad, ENT_QUOTES)."', '".htmlspecialchars($this->postal, ENT_QUOTES)."', '".htmlspecialchars($this->telefono, ENT_QUOTES)."', '".htmlspecialchars($this->tipo, ENT_QUOTES)."')";
		$con -> ejecutar_sentencia($sql);
	}

	function modificarDatosUserend(){
		$con = new conexion();
		$sql = "UPDATE datosuserend SET nombre = ".htmlspecialchars($this->nombre, ENT_QUOTES)."', apellido = '".htmlspecialchars($this->apellido, ENT_QUOTES)."', company = '".htmlspecialchars($this->company, ENT_QUOTES)."', direccion = '".htmlspecialchars($this->direccion, ENT_QUOTES)."', ciudad = '".htmlspecialchars($this->ciudad, ENT_QUOTES)."', postal = '".htmlspecialchars($this->postal, ENT_QUOTES)."', telefono = '".htmlspecialchars($this->postal, ENT_QUOTES)."' where iduserend = ".$this->iduserend;
		$con -> ejecutar_sentencia($sql);
	}
	
	function eliminarDatosUserend(){
		$con = new conexion();
		$sql = "DELETE FROM datosuserend WHERE iduserend = '".$this->iduserend."';";
		$con -> ejecutar_sentencia($sql);
	}
	
	function obtenerDatosUserend(){
		$con = new conexion();
		$sql = "SELECT * FROM datosuserend WHERE iduserend = '".$this->iduserend."';";
		$registro = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($registro)){
			$this -> nombre = $fila['nombre'];	
			$this -> apellido = $fila['apellido'];		
			$this -> company = $fila['company'];
			$this -> direccion = $fila['direccion'];
			$this -> ciudad = $fila['ciudad'];
			$this -> postal = $fila['postal'];
			$this -> telefono = $fila['telefono'];
			$this -> tipo = $fila['tipo'];			
		}
		mysqli_free_result($registro);
	}
	
	function obtener_datos_userend_token($token){
		$con = new conexion();
		$sql="SELECT * FROM datosuserend WHERE token='".$token."';";
		$registro=$con->ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($registro)){
			$this->iduserend=$fila['iduserend'];
			$this->nombre=$fila['nombre'];				
			$this->email=$fila['email'];
			$this->telefono=$fila['telefono'];			
		}
		mysqli_free_result($registro);
		$this->activarUserendToken();
	}
	
	function activarUserendToken(){
		$con = new conexion();
		$sql = "UPDATE userend SET status = 1 WHERE iduserend = ".$this->iduserend."";
		$con->ejecutar_sentencia($sql);
	}
		
	}
?>