<?php
include_once('conexion.php');
class datosorden
{
	var $idorden;
	var $nombre;
	var $email;
	var $telefono;
	var $direccion;
	
	function datosorden($idorden=0,$nombre='',$direccion='',$telefono='',$email=''){
		$this->idorden=$idorden;
		$this->nombre=$nombre;
		$this->email=$email;
		$this->telefono=$telefono;
		$this->direccion=$direccion;
	}
	function insertar_datos_Orden(){	
		$con= new conexion();
		$sql="insert into datosorden(idorden,nombre,direccion,telefono,email) values('".$this->idorden."','".htmlspecialchars($this->nombre, ENT_QUOTES)."','".htmlspecialchars($this->direccion, ENT_QUOTES)."','".htmlspecialchars($this->telefono, ENT_QUOTES)."','".$this->email."')";
		return $con->ejecutar_sentencia($sql);
	}
	
	function modificar_datos_Orden(){
		$con= new conexion();
		$sql="update datosorden set nombre='".htmlspecialchars($this->nombre, ENT_QUOTES)."',email='".$this->email."',telefono='".htmlspecialchars($this->telefono, ENT_QUOTES)."',direccion='".htmlspecialchars($this->direccion, ENT_QUOTES)."' where idorden=".$this->idorden;
		return $con->ejecutar_sentencia($sql);
	}
	
	function eliminar_datos_Orden(){
		$con= new conexion();
		$sql="delete from datosorden where idorden='".$this->idorden."'";			
		return $con->ejecutar_sentencia($sql);
	}
	
	function listar_datos_Orden(){
		$con= new conexion();
		$sql="select nombre,email,telefono,direccion,idorden from datosorden";
		$result=$con->ejecutar_sentencia($sql);
		$resultados=array();
		while($row=mysqli_fetch_array($result)){
			$registro['idorden']=$row['idorden'];
			$registro['nombre']=$row['nombre'];
			$registro['email']=$row['email'];
			$registro['telefono']=$row['telefono'];
			$registro['direccion']=$row['direccion'];
			array_push($resultados,$registro); 
		}
		mysqli_free_result($result);
		return $resultados;	 
	 }
		
	function obtener_datos_Orden(){
		$con= new conexion();
		$sql="select idorden,nombre,telefono,direccion,email from datosorden where idorden='".$this->idorden."'";
		$result=$con->ejecutar_sentencia($sql);	
		while($row=mysqli_fetch_array($result)){
			$this->idorden=$row['idorden'];
			$this->nombre=$row['nombre'];
			$this->telefono=$row['telefono'];
			$this->direccion=$row['direccion'];
			$this->email=$row['email'];
		}
		mysqli_free_result($result);
	}
	
}

?>