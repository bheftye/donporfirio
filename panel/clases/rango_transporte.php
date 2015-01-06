<?php
include_once('conexion.php');
require_once('archivo.php');

class rango_transporte

{
	var $id_rango_transporte;
	var $peso_maximo;
	var $peso_minimo;
	var $cargo_por_envio;
	var $id_transporte;
	var $status;
	var $nombre;
	var $tiempo_transito;
	var $img_principal;
	
	function rango_transporte($id_rango_transporte = 0, $peso_maximo = "", $peso_minimo = "", $cargo_por_envio = "",$id_transporte = 0, $status = 0)
	{
		$this -> id_rango_transporte = $id_rango_transporte;
		$this -> peso_maximo = $peso_maximo;
		$this -> peso_minimo = $peso_minimo;
		$this -> id_transporte = $id_transporte;
		$this -> cargo_por_envio = $cargo_por_envio;	
	}
	
	
	
	function insertar_rango_transporte()
	{
		$sql = "INSERT INTO rangos_transporte (peso_maximo, peso_minimo, cargo_por_envio, id_transporte, status) values ('".$this->peso_maximo."','".$this->peso_minimo."','".$this -> cargo_por_envio."','".$this -> id_transporte."', 1);"; 
		$con = new conexion();
		$this -> id_rango_transporte = $con->ejecutar_sentencia($sql);
	}
	
	
	function modificar_rango_transporte()
	{	
		$sql="UPDATE rangos_transporte SET peso_minimo = '".$this -> peso_minimo."', peso_maximo = '".$this -> peso_maximo."',cargo_por_envio = '".$this -> cargo_por_envio."' ,id_transporte = '".$this -> id_transporte."', status = ".$this -> status." WHERE id_rango_transporte = ".$this -> id_rango_transporte.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function desactivar_rango_transporte()
	{
		$con = new conexion();
		$sql = "UPDATE rangos_transporte SET status = 0 where id_rango_transporte = ".$this->id_rango_transporte;
		$con->ejecutar_sentencia($sql);	
	}
		
	function activar_rango_transporte()
	{
		$con = new conexion();
		$sql = "UPDATE rangos_transporte SET status = 1 where id_rango_transporte = ".$this->id_rango_transporte;
		//echo $sql;
		$con->ejecutar_sentencia($sql);	
	}
		
	function listar_rangos_transporte_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM rangos_transporte WHERE status = 1 ORDER BY id_rango_transporte ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_rango_transporte']=$fila['id_rango_transporte'];
			$registro['peso_maximo']=$fila['peso_maximo'];
			$registro['peso_minimo']=$fila['peso_minimo'];
			$registro['cargo_por_envio']=$fila['cargo_por_envio'];
			$registro['id_transporte']=$fila['id_transporte'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_rangos_transporte_no_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM rangos_transporte WHERE status = 0 ORDER BY id_rango_transporte ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_rango_transporte']=$fila['id_rango_transporte'];
			$registro['peso_maximo']=$fila['peso_maximo'];
			$registro['peso_minimo']=$fila['peso_minimo'];
			$registro['cargo_por_envio']=$fila['cargo_por_envio'];
			$registro['id_transporte']=$fila['id_transporte'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminar_rango_transporte()
	{	
		$sql="DELETE FROM rangos_transporte WHERE id_rango_transporte = ".$this->id_rango_transporte.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtener_rango_transporte()
	{
		$sql="SELECT * FROM rangos_transporte WHERE id_rango_transporte = ".$this->id_rango_transporte.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_rango_transporte = $fila['id_rango_transporte'];
			$this -> id_transporte = $fila['id_transporte'];
			$this -> peso_minimo = $fila['peso_minimo'];
			$this -> peso_maximo = $fila['peso_maximo'];
			$this -> cargo_por_envio = $fila["cargo_por_envio"];
			$this -> status = $fila["status"];
		}
	}
	function obtener_rango_transporte_final(){
		$con = new conexion();
		$sql = "select transportes.id_transporte, nombre, tiempo_transito, img_principal, id_rango_transporte, cargo_por_envio
				from transportes, rangos_transporte
				where transportes.id_transporte = rangos_transporte.id_transporte
				and id_rango_transporte=".$this->id_rango_transporte;
		$resultados= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($resultados)){
			$this -> id_rango_transporte = $fila['id_rango_transporte'];
			$this -> id_transporte = $fila['id_transporte'];
			$this -> nombre = $fila['nombre'];
			$this -> tiempo_transito = $fila['tiempo_transito'];
			$this -> img_principal = $fila['img_principal'];
			$this -> cargo_por_envio = $fila["cargo_por_envio"];
			$this -> status = $fila["status"];
		}		
	}
	function recuperar_rango_transporte()
	{
		$sql="SELECT * FROM rangos_transporte where id_rango_transporte = ".$this->id_rango_transporte.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_rango_transporte = $fila['id_rango_transporte'];
			$this -> id_transporte = $fila['id_transporte'];
			$this -> peso_minimo = $fila['peso_minimo'];
			$this -> peso_maximo = $fila['peso_maximo'];
			$this -> cargo_por_envio = $fila["cargo_por_envio"];
			$this -> status = $fila["status"];
		}
	}
	
	function listar_rangos_transporte()
	{
		$resultados=array();
		$sql="SELECT * FROM rangos_transporte WHERE id_transporte = ".$this -> id_transporte." ORDER BY peso_minimo ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_rango_transporte']=$fila['id_rango_transporte'];
			$registro['peso_maximo']=$fila['peso_maximo'];
			$registro['peso_minimo']=$fila['peso_minimo'];
			$registro['cargo_por_envio']=$fila['cargo_por_envio'];
			$registro['id_transporte']=$fila['id_transporte'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	
	function listar_rangos_transporte_por_ajax()
	{		
			$resultados=array();
			$sql="SELECT * FROM rangos_transporte ORDER BY id_rango_transporte ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$registro=array();
				$registro['id_rango_transporte']=$fila['id_rango_transporte'];
				$registro['peso_maximo']=$fila['peso_maximo'];
				$registro['peso_minimo']=$fila['peso_minimo'];
				$registro['cargo_por_envio']=$fila['cargo_por_envio'];
				$registro['id_transporte']=$fila['id_transporte'];
				$registro["status"] = $fila["status"];
				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}
}
?>