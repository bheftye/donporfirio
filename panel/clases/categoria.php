<?php
include_once('conexion.php');

class categoria
{
var $id_categoria;
var $nombre;

	function categoria($id_categoria = 0,$nombre='')
	{
		$this -> id_categoria=$id_categoria;
		$this -> nombre=$nombre;
	}
	function insertar_categoria()
	{
		$conexion = new conexion();
		$sql = "INSERT INTO categorias_productos (nombre) values('". $this -> nombre ."')";
		$this -> id_categoria = $conexion -> ejecutar_sentencia($sql);
	}
	
	function modificar_categoria()
	{
		$conexion = new conexion();
		$sql = "UPDATE categorias_productos SET nombre = '".$this -> nombre."' WHERE id_categoria = ". $this -> id_categoria;
		return $conexion -> ejecutar_sentencia($sql);
	}
	
	function buscar_categoria($pedazo)
	{
		$conexion=new conexion();
		$sql="SELECT * FROM categorias_productos WHERE nombre like '%".$pedazo."%' group by id_categoria limit 0, 30";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['id_categoria']=$row['id_categoria'];
			$registro['nombre']=$row['nombre'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
		
	}

	function listar_categorias_para_ajax()
	{
			$conexion=new conexion();
			$sql="SELECT * FROM categorias_productos limit 0, 30";
			$result=$conexion->ejecutar_sentencia($sql);
			$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro=array();
				$registro['id_categoria']=$row['id_categoria'];
				$registro['nombre']=$row['nombre'];
				array_push($resultados,$registro);
			}
			echo json_encode($resultados);
	}
	function  eliminar_categoria()
	{
		$conexion=new conexion();
		$sql="DELETE FROM categorias_productos WHERE id_categoria=".$this->id_categoria;
		return $conexion->ejecutar_sentencia($sql);
	}
	function listar_categorias()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM categorias_productos ORDER BY nombre ASC";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro = array();
				$registro["id_categoria"] = $row['id_categoria'];
				$registro["nombre"] = $row['nombre'];
				array_push($resultados,$registro);
			}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function obtener_categoria()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM categorias_productos WHERE id_categoria=".$this->id_categoria;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this->id_categoria=$row['id_categoria'];
				$this->nombre=$row['nombre'];
			}
		mysqli_free_result($result);
	}
}
?>