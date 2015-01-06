<?php
include_once('conexion.php');

class valor

{
	var $id_valor;
	var $id_atributo;
	var $nombre_esp;
	var $nombre_eng;
	var $status;
	
	function valor($id_valor = 0, $id_atributo = 0, $nombre_esp = "", $nombre_eng = "", $status = 0)
	{
		$this -> id_valor = $id_valor;
		$this -> id_atributo = $id_atributo;
		$this -> nombre_esp = $nombre_esp;
		$this -> nombre_eng = $nombre_eng;
		$this -> status = $status;
	}
		
	
	function insertar_valor()
	{
		$sql = "INSERT INTO atributos_valores (id_atributo, nombre_esp, nombre_eng, status) values ('".$this -> id_atributo."','".$this -> nombre_esp."', '".$this -> nombre_eng."' , 1);"; 
		$con = new conexion();
		$this -> id_valor = $con->ejecutar_sentencia($sql);
	}
	
	
	function modificar_valor()
	{	
		$sql="UPDATE atributos_valores SET nombre_esp = '".$this -> nombre_esp."', nombre_eng = '".$this -> nombre_eng."', status = '".$this -> status."' WHERE id_valor = ".$this -> id_valor.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function desactivar_valor()
	{
		$con = new conexion();
		$sql = "UPDATE atributos_valores SET status = 0 where id_valor = ".$this->id_valor;
		$con->ejecutar_sentencia($sql);	
	}
		
	function activar_valor()
	{
		$con = new conexion();
		$sql = "UPDATE atributos_valores SET status = 1 where id_valor = ".$this->id_valor;
		$con->ejecutar_sentencia($sql);	
	}

	function listar_valores_por_atributo(){
		$resultados=array();
		$sql="SELECT * FROM atributos_valores WHERE id_atributo = ".$this -> id_atributo." AND status = 1 ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_valor']=$fila['id_valor'];
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
		
	function listar_valores_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM atributos_valores WHERE id_atributo = ".$this -> id_atributo." AND status = 1 ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_valor']=$fila['id_valor'];
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_valores_no_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM atributos_valores WHERE id_atributo = ".$this -> id_atributo." status = 0 ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_valor']=$fila['id_valor'];
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminar_valor()
	{	
		$sql="DELETE FROM atributos_valores WHERE id_valor = ".$this->id_valor."AND id_atributo = ".$this -> id_atributo." ;";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
		$sql="DELETE FROM combinaciones_atributos_valores WHERE id_valor = ".$this->id_valor." AND id_atributo = ".$this -> id_atributo.";";
		$con->ejecutar_sentencia($sql);
	}
	
	function obtener_valor()
	{
		$sql="SELECT * FROM atributos_valores WHERE id_valor = ".$this->id_valor." AND id_atributo = ".$this -> id_atributo;
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_valor = $fila['id_valor'];
			$this -> id_atributo = $fila['id_atributo'];
			$this -> nombre_esp = $fila['nombre_esp'];
			$this -> nombre_eng = $fila["nombre_eng"];
			$this -> status = $fila["status"];
		}
	}
	
	function recuperar_valor()
	{
		$sql="SELECT * FROM atributos_valores where id_valor = ".$this -> id_valor.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_valor = $fila['id_valor'];
			$this -> id_atributo = $fila['id_atributo'];
			$this -> nombre_esp = $fila['nombre_esp'];
			$this -> nombre_eng = $fila["nombre_eng"];
			$this -> status = $fila["status"];
		}
	}
	
	function listar_valores()
	{
		$resultados=array();
		$sql="SELECT * FROM atributos_valores WHERE id_atributo = ".$this -> id_atributo." ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_valor']=$fila['id_valor'];
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function buscar_valor_por_ajax($pedazo)
	{
		$resultados=array();
		$sql="SELECT * FROM atributos_valores WHERE id_atributo = ".$this -> id_atributo." AND nombre_esp LIKE '%".$pedazo."%' OR nombre_eng LIKE '%".$pedazo."%'  group by id_valor";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_valor']=$fila['id_valor'];
			$registro['id_atributo']=$fila['id_atributo'];
			$registro['nombre_esp']=$fila['nombre_esp'];
			$registro['nombre_eng']=$fila['nombre_eng'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
	function listar_valores_por_ajax()
	{		
		$resultados=array();
		$sql="SELECT * FROM atributos_valores WHERE id_atributo = ".$this -> id_atributo." ORDER BY nombre_esp ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_valor']=$fila['id_valor'];
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