<?php
include_once('conexion.php');

class atributo

{
	var $id_atributo;
	var $nombre_esp;
	var $nombre_eng;
	var $status;
	
	function atributo($id_atributo = 0, $nombre_esp = "", $nombre_eng = "", $status = 0)
	{
		$this -> id_atributo = $id_atributo;
		$this -> nombre_esp = $nombre_esp;
		$this -> nombre_eng = $nombre_eng;
		$this -> status = $status;
	}
		
	
	function insertar_atributo()
	{
		$sql = "INSERT INTO atributos (nombre_esp, nombre_eng, status) values ('".$this->nombre_esp."', '".$this->nombre_eng."' , 1);"; 
		$con = new conexion();
		$this -> id_atributo = $con->ejecutar_sentencia($sql);
	}
	
	
	function modificar_atributo()
	{	
		$sql="UPDATE atributos SET nombre_esp = '".$this -> nombre_esp."', nombre_eng = '".$this -> nombre_eng."'  ,status = '".$this -> status."' WHERE id_atributo = ".$this -> id_atributo.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function desactivar_atributo()
		{
			$con = new conexion();
			$sql = "UPDATE atributos SET status = 0 where id_atributo = ".$this->id_atributo;
			$con->ejecutar_sentencia($sql);	
		}
		
	function activar_atributo()
		{
			$con = new conexion();
			$sql = "UPDATE atributos SET status = 1 where id_atributo = ".$this->id_atributo;
			$con->ejecutar_sentencia($sql);	
		}

		
	function listar_atributos_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM atributos WHERE status = 1 ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_atributos_no_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM atributos WHERE status = 0 ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminar_atributo()
	{	
		$sql="DELETE FROM atributos WHERE id_atributo = ".$this->id_atributo.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtener_atributo()
	{
		$sql="SELECT * FROM atributos WHERE id_atributo = ".$this->id_atributo.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_atributo = $fila['id_atributo'];
			$this -> nombre_esp = $fila['nombre_esp'];
			$this -> nombre_eng = $fila['nombre_eng'];
			$this -> status = $fila["status"];
		}
	}
	
	function recuperar_atributo()
	{
		$sql="SELECT * FROM atributos where id_atributo = ".$this->id_atributo.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_atributo = $fila['id_atributo'];
			$this -> nombre_esp = $fila['nombre_esp'];
			$this -> nombre_eng = $fila['nombre_eng'];
			$this -> status = $fila["status"];
		}
	}
	
	function listar_atributos()
	{
		$resultados=array();
		$sql="SELECT * FROM atributos ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function buscar_atributo_por_ajax($pedazo)
	{
		$resultados=array();
		$sql="SELECT * FROM atributos WHERE nombre_esp LIKE '%".$pedazo."%' OR nombre_eng LIKE '%".$pedazo."%'   group by id_atributo";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
	function listar_atributos_por_ajax()
	{		
			$resultados=array();
			$sql="SELECT * FROM atributos ORDER BY nombre_esp ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$registro=array();
				$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}
}
?>