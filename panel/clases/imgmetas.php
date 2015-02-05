<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se hacen las altas, bajas y cambios de las imagenes secundarias.
 * Copyright: Locker Agencia Creativa.
 */
include_once('conexion.php');
require_once('archivo.php');
require_once('metas.php');

class imgmetas extends Archivo
{
	var $id_img_metas;
	var $titulo;
	var $ruta;
	var $id_metas;
	var $directorio = '../imgMetas/secundarias/';
	var $orden;
	
	function imgmetas ($id_img_metas =0 , $id_metas = 0, $ruta = '', $tit = '', $temporal = '')
	{
		$this -> id_img_metas = $id_img_metas;
		$this -> id_metas = $id_metas;
		$this -> ruta = $ruta;
		$this -> titulo = $tit;
		
		$this -> ruta_final = $this -> directorio.$ruta;
		$this -> ruta_temporal = $temporal;
	}
	
	
	
	function insertar_img_secundaria_metas()
	{
		$sql="INSERT INTO img_metas(id_metas, ruta, titulo) values (".$this -> id_metas.", '".$this -> ruta."', '".$this -> titulo."');";
		$con = new conexion();
		$this -> id_img_metas = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "UPDATE img_metas SET orden = ".$this->id_img_metas." WHERE id_img_metas = ".$this->id_img_metas."";
		$con -> ejecutar_sentencia($s);
	}
	
	
	function modificar_img_secundaria_metas()
	{
	
		if ($this -> ruta != '')
		{
		
			$titulo_temporal = $this -> titulo;
			$ruta_temporal = $this -> ruta;
			
			$this -> recupera_img_metas();
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
			
		$sql = "UPDATE img_metas SET id_metas = ".$this -> id_metas." ".$sql." , titulo = '".$this -> titulo."' WHERE id_img_metas = ".$this -> id_img_metas.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}
	
	function ordenar_img_secundarias_metas($orden)
	{
		$con = new conexion();
		$sql= "UPDATE img_metas SET orden ='".$orden."' WHERE  id_img_metas=".$this -> id_img_metas." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_img_metas()
	{
	
		$this -> recupera_img_metas();
		$this -> borrar_archivo();
		
		$sql = "DELETE FROM img_metas WHERE id_img_metas =".$this -> id_img_metas.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}
	
	function obtener_img_metas()
	{
		$sql = "SELECT * FROM img_metas WHERE id_img_metas =".$this -> id_img_metas;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_img_metas = $fila['id_img_metas'];
			$this -> id_metas = $fila['id_metas'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}
	
	function obtener_img_metas_final()
	{
		$sql = "SELECT ruta FROM img_metas WHERE id_metas =".$this -> id_metas;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> ruta = $fila['ruta'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}
	
	function recupera_img_metas()
	{
		$sql = "SELECT * FROM img_metas WHERE id_img_metas=".$this->id_img_metas;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_img_metas= $fila['id_img_metas'];
			$this -> id_metas = $fila['id_metas'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		
		}
	}
	
	function listar_img_secundarias_metas()
	{
		$resultados = array();
		$sql = "SELECT * FROM img_metas WHERE id_metas =".$this -> id_metas." order by orden desc";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro = array();
			$registro['id_img_metas'] = $fila['id_img_metas'];
			$registro['id_metas'] = $fila['id_metas'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = $fila['titulo'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>