<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se hacen las altas, bajas y cambios de las imagenes secundarias.
 * Copyright: Locker Agencia Creativa.
 */
include_once('conexion.php');
require_once('archivo.php');

class img_inicio extends Archivo
{
	var $id_imagen;
	var $nombre_imagen;
	var $directorio = '../imgInicio/';
	var $orden;
	
	function img_inicio ($id_imagen =0, $nombre_imagen = '', $temporal = '')
	{
		$this -> id_imagen = $id_imagen;
		$this -> nombre_imagen = $nombre_imagen;
		
		$this -> ruta_final = $this -> directorio.$nombre_imagen;
		$this -> ruta_temporal = $temporal;
	}
	
	
	
	function insertar_img_secundaria_inicio()
	{
		$sql="INSERT INTO slide_inicio (nombre_imagen) values ('".$this -> nombre_imagen."');";
		$con = new conexion();
		$this -> id_imagen = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "UPDATE slide_inicio SET orden = ".$this->id_imagen." WHERE id_imagen = ".$this->id_imagen."";
		$con -> ejecutar_sentencia($s);
	}
	
	
	function modificar_img_secundaria_inicio()
	{
	
		if ($this -> nombre_imagen != '')
		{
		
			$ruta_temporal = $this -> nombre_imagen;
			
			$this -> recupera_img_inicio();
			$this -> borrar_archivo();
			
			$this -> nombre_imagen = $ruta_temporal;
			
			$this -> ruta_final = $this -> directorio.$ruta_temporal;
			$sql = ' ,nombre_imagen=\''.$this -> nombre_imagen.'\'';
		}
		else
		{
			$sql = '';
		}
			
		$sql = "UPDATE slide_inicio SET ".$sql." WHERE id_imagen = ".$this -> id_imagen.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}
	
	function ordenar_img_secundarias_inicio($orden)
	{
		$con = new conexion();
		$sql= "UPDATE slide_inicio SET orden ='".$orden."' WHERE  id_imagen=".$this -> id_imagen." ORDER BY orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_img_inicio()
	{
	
		$this -> recupera_img_inicio();
		$this -> borrar_archivo();
		
		$sql = "DELETE FROM slide_inicio WHERE id_imagen =".$this -> id_imagen.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}
	
	function obtener_img_inicio()
	{
		$sql = "SELECT * FROM slide_inicio WHERE id_imagen =".$this -> id_imagen;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_imagen = $fila['id_imagen'];
			$this -> nombre_imagen = $fila['nombre_imagen'];
			$this -> ruta_final = $this -> directorio.$fila['nombre_imagen'];
		}
	}
	
	function obtener_img_inicio_final()
	{
		$sql = "SELECT nombre_imagen FROM slide_inicio ORDER BY orden";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> nombre_imagen = $fila['nombre_imagen'];
			$this -> ruta_final = $this -> directorio.$fila['nombre_imagen'];
		}
	}
	
	function recupera_img_inicio()
	{
		$sql = "SELECT * FROM slide_inicio WHERE id_imagen=".$this->id_imagen;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_imagen= $fila['id_imagen'];
			$this -> nombre_imagen = $fila['nombre_imagen'];
			$this -> ruta_final = $this -> directorio.$fila['nombre_imagen'];
		
		}
	}
	
	function listar_img_secundarias_inicio()
	{
		$resultados = array();
		$sql = "SELECT * FROM slide_inicio ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro = array();
			$registro['id_imagen'] = $fila['id_imagen'];
			$registro['nombre_imagen'] = $fila['nombre_imagen'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>