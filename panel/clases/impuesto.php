<?php
include_once('conexion.php');

class impuesto
{
var $id_impuesto;
var $nombre;
var $porcentaje;

	function impuesto($id_impuesto = 0,$nombre='', $porcentaje = '')
	{
		$this -> id_impuesto=$id_impuesto;
		$this -> nombre=$nombre;
		$this -> porcentaje = $porcentaje;
	}
	function insertar_impuesto()
	{
		$conexion = new conexion();
		$sql = "INSERT INTO impuestos (nombre, porcentaje) values('". $this -> nombre ."', ".$this -> porcentaje.")";
		$this -> id_impuesto = $conexion -> ejecutar_sentencia($sql);
	}
	
	function modificar_impuesto()
	{
		$conexion = new conexion();
		$sql = "UPDATE impuestos SET nombre = '".$this -> nombre."', porcentaje = ".$this -> porcentaje." WHERE id_impuesto = ". $this -> id_impuesto;
		return $conexion -> ejecutar_sentencia($sql);
	}
	
	function buscar_impuesto($pedazo)
	{
		$conexion=new conexion();
		$sql = "SELECT * FROM impuestos WHERE nombre like '%".$pedazo."%' group by id_impuesto limit 0, 30";
		$result = $conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['id_impuesto']=$row['id_impuesto'];
			$registro['nombre']=$row['nombre'];
			$registro['porcentaje']=$row['porcentaje'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
		
	}

	function listar_impuestos_para_ajax()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM impuestos limit 0, 30";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$$registro['id_impuesto']=$row['id_impuesto'];
			$registro['nombre']=$row['nombre'];
			$registro['porcentaje']=$row['porcentaje'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	function  eliminar_impuesto()
	{
		$conexion=new conexion();
		$sql="DELETE FROM impuestos WHERE id_impuesto=".$this->id_impuesto;
		return $conexion->ejecutar_sentencia($sql);
	}
	function listar_impuestos()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM impuestos ORDER BY nombre ASC";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro = array();
				$registro['id_impuesto']=$row['id_impuesto'];
				$registro['nombre']=$row['nombre'];
				$registro['porcentaje']=$row['porcentaje'];
				array_push($resultados,$registro);
			}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function obtener_impuesto()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM impuestos WHERE id_impuesto=".$this->id_impuesto;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this -> id_impuesto = $row['id_impuesto'];
				$this -> nombre = $row['nombre'];
				$this -> porcentaje = $row['porcentaje'];
			}
		mysqli_free_result($result);
	}
}
?>