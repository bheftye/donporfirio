<?php
include_once('conexion.php');
require_once('archivo.php');

class marca extends Archivo

{
	var $id_marca;
	var $nombre;
	var $img_principal;
	var $descripcion;
	var $status;
	var $mostrar;
	var $directorio = '/home1/locker07/public_html/clientes/notmonday/imgMarcas/';
	var $ruta_final;
	var $ruta_temporal;
	
	function marca($id_marca = 0, $nombre = "", $descripcion = "",$img_principal = "", $ruta_temporal = '', $status = 0, $mostrar = 0)
	{
		if ($img_principal != '') {
			$this -> img_principal = $this -> obtenerExtensionArchivo($img_principal);
		} else {
			$this -> img_principal = '';
		}
		$this -> id_marca = $id_marca;
		$this -> nombre = $nombre;
		$this -> status = $status;
		$this -> mostrar = $mostrar;
		
		$this -> descripcion = $descripcion;
		
		$this -> ruta_final = $this -> directorio . $this -> img_principal;
		$this -> ruta_temporal = $ruta_temporal;
	}
		
	
	function insertar_marca()
	{
		$sql = "INSERT INTO marcas (nombre, descripcion, img_principal,status, mostrar) values ('".$this->nombre."','".$this->descripcion."','".$this -> img_principal."',1,0);"; 
		$con = new conexion();
		$this -> id_marca = $con->ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}
	
	
	function modificar_marca()
	{	
		if ($this -> img_principal != '') {
			$ruta_temporal = $this -> img_principal;
			$marca = new marca($this -> id_marca);
			$marca -> recuperar_marca();
			$marca -> borrar_archivo();
			$this -> img_principal = $ruta_temporal;
			$this -> ruta_final = $this -> directorio . $ruta_temporal;
			$sql = ' img_principal=\'' . $this -> img_principal . '\',';
		} else {
			$sql = '';
		}
		$sql="UPDATE marcas SET ".$sql." nombre = '".$this -> nombre."', descripcion = '".$this -> descripcion."' WHERE id_marca = ".$this -> id_marca.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
		$this->subir_archivo();
	}

	function desactivar_marca()
		{
			$con = new conexion();
			$sql = "UPDATE marcas SET status = 0 where id_marca = ".$this->id_marca;
			$con->ejecutar_sentencia($sql);	
		}
		
	function activar_marca()
		{
			$con = new conexion();
			$sql = "UPDATE marcas SET status = 1 where id_marca = ".$this->id_marca;
			//echo $sql;
			$con->ejecutar_sentencia($sql);	
		}
		
	function listar_marcas_activas($offset = 0)
	{
		$resultados=array();
		$sql="SELECT * FROM marcas WHERE status = 1 ORDER BY nombre ASC LIMIT ".$offset.",12";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_marca']=$fila['id_marca'];
			$registro['nombre']=$fila['nombre'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			$registro["mostrar"] = $fila["mostrar"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_marcas_no_activas()
	{
		$resultados=array();
		$sql="SELECT * FROM marcas WHERE status = 0 ORDER BY nombre ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_marca']=$fila['id_marca'];
			$registro['nombre']=$fila['nombre'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			$registro["mostrar"] = $fila["mostrar"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminar_marca()
	{
		$this->recuperar_marca();
		$this->borrar_archivo();
		
		$sql="UPDATE marcas SET mostrar = 1 WHERE id_marca = ".$this->id_marca.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtener_marca()
	{
		$sql="SELECT * FROM marcas WHERE id_marca = ".$this->id_marca.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_marca = $fila['id_marca'];
			$this -> nombre = $fila['nombre'];
			$this -> descripcion = $fila["descripcion"];
			$this -> img_principal = $fila["img_principal"];
			$this -> status = $fila["status"];
			$this -> mostrar = $fila["mostrar"];
		}
	}

	function recuperar_marca()
	{
		$sql="SELECT * FROM marcas WHERE id_marca = ".$this->id_marca.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_marca = $fila['id_marca'];
			$this -> nombre = $fila['nombre'];
			$this -> descripcion = $fila["descripcion"];
			$this -> img_principal = $fila["img_principal"];
			$this -> status = $fila["status"];
			$this -> mostrar = $fila["mostrar"];
		}
	}
	
	function listar_marcas()
	{
		$resultados=array();
		$sql="SELECT * FROM marcas WHERE mostrar = 0 ORDER BY nombre ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_marca']=$fila['id_marca'];
			$registro['nombre']=$fila['nombre'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			$registro["mostrar"] = $fila["mostrar"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function buscar_marca_por_ajax($pedazo)
	{
		$resultados=array();
		$sql="SELECT * FROM marcas WHERE mostrar = 0 nombre LIKE '%".$pedazo."%' group by id_marca";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_marca']=$fila['id_marca'];
			$registro['nombre']=$fila['nombre'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			$registro["mostrar"] = $fila["mostrar"];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
	function listar_marcas_por_ajax()
	{		
			$resultados=array();
			$sql="SELECT * FROM marcas WHERE mostrar = 0 ORDER BY nombre ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$registro=array();
				$registro['id_marca']=$fila['id_marca'];
				$registro['nombre']=$fila['nombre'];
				$registro["descripcion"] = $fila["descripcion"];
				$registro["img_principal"] = $fila["img_principal"];
				$registro["status"] = $fila["status"];
				$registro["mostrar"] = $fila["mostrar"];
				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}
}
?>