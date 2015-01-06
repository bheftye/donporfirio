<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se hacen las altas, bajas y cambios de las imagenes secundarias.
 * Copyright: Locker Agencia Creativa.
 */
include_once('conexion.php');
require_once('archivo.php');
require_once('proyecto.php');

class imgproyecto extends Archivo
{
	var $id_img_proyecto;
	var $titulo;
	var $ruta;
	var $id_proyecto;
	var $directorio = '../imgProyectos/secundarias/';
	var $orden;
	
	function imgproyecto ($id_img_proyecto =0 , $id_proyecto = 0, $ruta = '', $tit = '', $temporal = '')
	{
		$this -> id_img_proyecto = $id_img_proyecto;
		$this -> id_proyecto = $id_proyecto;
		$this -> ruta = $ruta;
		$this -> titulo = $tit;
		
		$this -> ruta_final = $this -> directorio.$ruta;
		$this -> ruta_temporal = $temporal;
	}
	
	
	
	function insertar_img_secundaria_proyecto()
	{
		$sql="INSERT INTO img_proyecto(id_proyecto, ruta, titulo) values (".$this -> id_proyecto.", '".$this -> ruta."', '".$this -> titulo."');";
		$con = new conexion();
		$this -> id_img_proyecto = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "UPDATE img_proyecto SET orden = ".$this->id_img_proyecto." WHERE id_img_proyecto = ".$this->id_img_proyecto."";
		$con -> ejecutar_sentencia($s);
	}
	
	
	function modificar_img_secundaria_proyecto()
	{
	
		if ($this -> ruta != '')
		{
		
			$titulo_temporal = $this -> titulo;
			$ruta_temporal = $this -> ruta;
			
			$this -> recupera_img_proyecto();
			$this -> borrar_archivo();
			
			$this -> titulo = $titulo_temporal;
			$this -> ruta = $ruta_temporal;
			
			$this -> ruta_final = $this -> directorio.$ruta_temporal;
			$sql = ' ,ruta=\''.$this -> ruta.'\'';
		}
		else
		{
			$sql = '';
		}
			
		$sql = "UPDATE img_proyecto SET id_proyecto = ".$this -> id_proyecto." ".$sql." , titulo = '".$this -> titulo."' WHERE id_img_proyecto = ".$this -> id_img_proyecto.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}
	
	function ordenar_img_secundarias_proyecto($orden)
	{
		$con = new conexion();
		$sql= "UPDATE img_proyecto SET orden ='".$orden."' WHERE  id_img_proyecto=".$this -> id_img_proyecto." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_img_proyecto()
	{
	
		$this -> recupera_img_proyecto();
		$this -> borrar_archivo();
		
		$sql = "DELETE FROM img_proyecto WHERE id_img_proyecto =".$this -> id_img_proyecto.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}
	
	function obtener_img_proyecto()
	{
		$sql = "SELECT * FROM img_proyecto WHERE id_img_proyecto =".$this -> id_img_proyecto;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_img_proyecto = $fila['id_img_proyecto'];
			$this -> id_proyecto = $fila['id_proyecto'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}
	
	function obtener_img_proyecto_final()
	{
		$sql = "SELECT ruta FROM img_proyecto WHERE id_proyecto =".$this -> id_proyecto;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> ruta = $fila['ruta'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}
	
	function recupera_img_proyecto()
	{
		$sql = "SELECT * FROM img_proyecto WHERE id_img_proyecto=".$this->id_img_proyecto;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_img_proyecto= $fila['id_img_proyecto'];
			$this -> id_proyecto = $fila['id_proyecto'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		
		}
	}
	
	function listar_img_secundarias_proyecto()
	{
		$resultados = array();
		$sql = "SELECT * FROM img_proyecto WHERE id_proyecto =".$this -> id_proyecto." order by orden desc";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro = array();
			$registro['id_img_proyecto'] = $fila['id_img_proyecto'];
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = $fila['titulo'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>