<?php
	include_once('conexion.php');
	class userenddireccion{

		var $iddireccion;
		var $nombreDireccion;
		var $nombre;
		var $apellido;
		var $telefono;
		var $company;
		var $direccion;
		var $ciudad;
		var $zip;
		var $iduserend;
		var $status;

		function userenddireccion($iddireccion = 0, $iduserend = 0,$nombreDireccion = '', $nombre = '', $apellido = '', $telefono = '', $company = '', $direccion = '', $ciudad = '', $zip = '', $status = 0 ){
			$this->iddireccion = $iddireccion;
			$this->nombreDireccion = $nombreDireccion;
			$this->nombre = $nombre;
			$this->apellido = $apellido;
			$this->telefono = $telefono;
			$this->company = $company;
			$this->direccion = $direccion;
			$this->ciudad = $ciudad;
			$this->zip = $zip;
			$this->iduserend = $iduserend;
			$this->status = $status;	
		}

		function agregarDireccion(){
			$con = new conexion();
			if($this->status != 0){
				$sql1 = "UPDATE direcciones set status = 0";
				$con->ejecutar_sentencia($sql1);
			}
			$sql = "INSERT INTO direcciones (iduserend,nombreDireccion, nombre, apellido, telefono, company, direccion, ciudad, zip, status) VALUES (".$this->iduserend.",'".htmlspecialchars($this->nombreDireccion, ENT_QUOTES)."', '".htmlspecialchars($this->nombre, ENT_QUOTES)."', '".htmlspecialchars($this->apellido, ENT_QUOTES)."', '".htmlspecialchars($this->telefono, ENT_QUOTES)."', '".htmlspecialchars($this->company)."', '".htmlspecialchars($this->direccion, ENT_QUOTES)."', '".htmlspecialchars($this->ciudad, ENT_QUOTES)."', '".htmlspecialchars($this->zip, ENT_QUOTES)."', ".$this->status.")";
			$con->ejecutar_sentencia($sql);
		}
		function modificarDireccion(){
			$con = new conexion();
			$sql1 = "UPDATE direcciones set status = 0";
			$con->ejecutar_sentencia($sql1);
			$sql = "UPDATE direcciones SET 
			nombreDireccion = '".htmlspecialchars($this->nombreDireccion, ENT_QUOTES)."',
			nombre = '".htmlspecialchars($this->nombre, ENT_QUOTES)."',
			apellido = '".htmlspecialchars($this->apellido, ENT_QUOTES)."',
			telefono = '".htmlspecialchars($this->telefono, ENT_QUOTES)."',
			company = '".htmlspecialchars($this->company, ENT_QUOTES)."',
			direccion = '".htmlspecialchars($this->direccion, ENT_QUOTES)."',
			ciudad = '".htmlspecialchars($this->ciudad, ENT_QUOTES)."',
			zip = '".htmlspecialchars($this->zip, ENT_QUOTES)."',
			status = ".$this->status." 
			WHERE iddireccion = ".$this->iddireccion." ";
			$con->ejecutar_sentencia($sql);
		}
		function defaultDireccion(){
			$con = new conexion();
			$sql1 = "UPDATE direcciones set status = 0";
			$con->ejecutar_sentencia($sql1);
			$sql = "UPDATE direcciones set status = 1 WHERE iddireccion = ".$this->iddireccion."";
			$con->ejecutar_sentencia($sql);
		}
		function eliminarDireccion(){
			$con = new conexion();
			$sql = "DELETE FROM direcciones WHERE iddireccion = ".$this->iddireccion."";
			$con->ejecutar_sentencia($sql);
		}
		function listarDirecciones(){
			$resultados = array();
			$con = new conexion();
			$sql = "SELECT * FROM direcciones where iduserend = ".$this->iduserend."";
			$temporal = $con->ejecutar_sentencia($sql);
			while($row = mysqli_fetch_array($temporal)){
				$result = array();
				$result['iddireccion'] = $row['iddireccion'];
				$result['nombreDireccion'] = $row['nombreDireccion'];
				$result['nombre'] = $row['nombre'];
				$result['apellido'] = $row['apellido'];
				$result['telefono'] = $row['telefono'];
				$result['company'] = $row['company'];
				$result['direccion'] = $row['direccion'];
				$result['ciudad'] = $row['ciudad'];
				$result['zip'] = $row['zip'];
				$result['iduserend'] = $row['idusrend'];
				$result['status'] = $row['status'];
				array_push($resultados, $result);
			}
			//mysqli_free_result($resultados);
			return $resultados;
		}
		function obtenerDireccion(){
			$con = new conexion();
			$sql = "select * from direcciones where iddireccion=".$this->iddireccion."";
			$result = $con->ejecutar_sentencia($sql);
			while($row = mysqli_fetch_array($result)){
				$this->iddireccion = $row['iddireccion'];
				$this->nombreDireccion = $row['nombreDireccion'];
				$this->nombre= $row['nombre'];
				$this->apellido = $row['apellido'];
				$this->telefono = $row['telefono'];
				$this->company = $row['company'];
				$this->direccion= $row['direccion'];
				$this->ciudad = $row['ciudad'];
				$this->zip = $row['zip'];
			}
		}
	}
?>