<?php
include_once('conexion.php');

class categoria
{
	var $id_categoria;
	var $nombre_esp;
	var $nombre_eng
	var $mostrar;
	var $status;
	var $orden;

	function categoria($id_categoria = 0,$nombre_esp='', $nombre_eng)
	{
		$this -> id_categoria = $id_categoria;
		$this -> nombre_esp = $nombre_esp;
		$this -> nombre_eng = $nombre_eng;
		$this -> status = $status;
		$this -> mostrar = $mostrar;
	}
	function insertar_categoria()
	{
		$conexion = new conexion();
		$sql = "INSERT INTO categorias_proyectos (nombre_esp, nombre_eng, status, mostrar) values('". $this -> nombre_esp ."', '". $this -> nombre_eng ."', 0 , 0)";
		$this -> id_categoria = $conexion -> ejecutar_sentencia($sql);
		$sql = "UPDATE categorias_proyectos (orden) values('". $this -> id_categoria ."')";
		$conexion -> ejecutar_sentencia($sql);
	}
	
	function modificar_categoria()
	{
		$conexion = new conexion();
		$sql = "UPDATE categorias_proyectos SET nombre_esp = '".$this -> nombre_esp."', nombre_eng = '".$this -> nombre_eng."'  WHERE id_categoria = ". $this -> id_categoria;
		return $conexion -> ejecutar_sentencia($sql);
	}

	function desactivar_categoria(){
		$conexion = new conexion();
		$sql = "UPDATE categorias_proyectos SET status = 1  WHERE id_categoria = ". $this -> id_categoria;
		return $conexion -> ejecutar_sentencia($sql);
	}

	function activar_categoria(){
		$conexion = new conexion();
		$sql = "UPDATE categorias_proyectos SET status = 0  WHERE id_categoria = ". $this -> id_categoria;
		return $conexion -> ejecutar_sentencia($sql);
	}

	function listar_categorias_para_ajax()
	{
			$conexion=new conexion();
			$sql="SELECT * FROM categorias_proyectos limit 0, 30";
			$result=$conexion->ejecutar_sentencia($sql);
			$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro=array();
				$registro['id_categoria']=$row['id_categoria'];
				$registro['nombre_esp']=$row['nombre_esp'];
				$registro["nombre_eng"] = $row["nombre_eng"];
				$registro["status"] = $row["status"];
				array_push($resultados,$registro);
			}
			echo json_encode($resultados);
	}

	function  eliminar_categoria()
	{
		$conexion=new conexion();
		$sql="UPDATE categorias_proyectos SET mostrar = 1 WHERE id_categoria=".$this->id_categoria;
		return $conexion->ejecutar_sentencia($sql);
	}

	function ordenar_categoria(){
		$conexion=new conexion();
		$sql="UPDATE categorias_proyectos SET mostrar = 1 WHERE id_categoria=".$this->id_categoria;
		return $conexion->ejecutar_sentencia($sql);
	}

	function listar_categorias()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM categorias_proyectos ORDER BY orden ASC";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro = array();
				$registro['id_categoria']=$row['id_categoria'];
				$registro['nombre_esp']=$row['nombre_esp'];
				$registro["nombre_eng"] = $row["nombre_eng"];
				$registro["status"] = $row["status"];
				array_push($resultados,$registro);
			}
		mysqli_free_result($result);
		return $resultados;
	}

	function listar_categorias_activas(){
		$conexion=new conexion();
		$sql="SELECT * FROM categorias_proyectos ORDER BY nombre ASC";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro = array();
				$registro['id_categoria']=$row['id_categoria'];
				$registro['nombre_esp']=$row['nombre_esp'];
				$registro["nombre_eng"] = $row["nombre_eng"];
				$registro["status"] = $row["status"];
				array_push($resultados,$registro);
			}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function obtener_categoria()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM categorias_proyectos WHERE id_categoria=".$this->id_categoria;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this -> id_categoria=$row['id_categoria'];
				$this -> nombre_esp = $row['nombre_esp'];
				$this -> nombre_eng = $row['nombre_eng'];
				$this -> status = $row["status"];
			}
		mysqli_free_result($result);
	}
}
?>