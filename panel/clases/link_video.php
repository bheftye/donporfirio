<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se hacen las altas, bajas y cambios de las imagenes secundarias.
 * Copyright: Locker Agencia Creativa.
 */
include_once('conexion.php');
require_once('proyecto.php');

class link_video
{
	var $id_link;
	var $link_video;
	var $id_proyecto;
	var $orden;
	
	function link_video ($id_link =0 , $id_proyecto = 0, $link_video = '')
	{
		$this -> id_link = $id_link;
		$this -> id_proyecto = $id_proyecto;
		$this -> link_video = $link_video;
	}
	
	
	
	function insertar_link_video()
	{
		$sql="INSERT INTO links_videos (id_proyecto, link_video) values (".$this -> id_proyecto.", '".$this -> link_video."');";
		$con = new conexion();
		$this -> id_link = $con -> ejecutar_sentencia($sql);
		$s = "UPDATE links_videos SET orden = ".$this->id_link." WHERE id_link = ".$this->id_link."";
		$con -> ejecutar_sentencia($s);
	}
	
	
	function modificar_link_video()
	{
			
		$sql = "UPDATE links_videos SET link_video = '".$this -> link_video."' WHERE id_link = ".$this -> id_link.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}
	
	function ordenar_link_video($orden)
	{
		$con = new conexion();
		$sql= "UPDATE links_videos SET orden ='".$orden."' WHERE  id_link=".$this -> id_link." ";
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_link_video()
	{
		$sql = "DELETE FROM links_videos WHERE id_link =".$this -> id_link.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}
	
	function obtener_link_video()
	{
		$sql = "SELECT * FROM links_videos WHERE id_link =".$this -> id_link;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> id_link = $fila['id_link'];
			$this -> id_proyecto = $fila['id_proyecto'];
			$this -> link_video = $fila['link_video'];
		}
	}
	
	function listar_links_videos()
	{
		$resultados = array();
		$sql = "SELECT * FROM links_videos WHERE id_proyecto =".$this -> id_proyecto." ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro = array();
			$registro['id_link'] = $fila['id_link'];
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['link_video'] = $fila['link_video'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>