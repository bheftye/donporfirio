<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se controlan todos los metodos de altas bajas y cambios de los noticias.
 * Copyright: Locker Agencia Creativa.
 */
include_once ('conexion.php');
require_once ('archivo.php');
//include_once ('imgvideo_slide.php');
//include_once('herramientas.php');

class video_slide extends Archivo {
	var $id_video_slide;
	var $titulo_video;
	var $nombre_video;
	var $directorio = '../videosSlide/';
	var $ruta_final;
	var $ruta_temporal;
	
	function video_slide($id_video_slide = 0, $nombre_video = '', $ruta_temporal = '', $titulo_video = '') 
	{
		$this -> id_video_slide = $id_video_slide;
		if ($nombre_video != '') {
			$this -> nombre_video = $this -> obtenerExtensionArchivo($nombre_video);
		} else {
			$this -> nombre_video = '';
		}

		$this -> titulo_video = $titulo_video;
		
		$this -> ruta_final = $this -> directorio . $this -> nombre_video;
		$this -> ruta_temporal = $ruta_temporal;
		
	}


	function modificar_video_slide() {
		if ($this -> nombre_video != '') {
			$video_slide = new video_slide($this -> id_video_slide);
			$video_slide -> recuperar_video_slide();
			$video_slide -> borrar_archivo();
			$this -> ruta_final = $this -> directorio . $this -> nombre_video;
			$sql = ' nombre_video=\'' . $this -> nombre_video . '\',';
		} else {
			$sql = '';
		}
		
		$fecha_modificacion = date("Y-m-d");
		$sql = "UPDATE videos_slide set 
		".$sql."
		titulo_video ='".htmlspecialchars($this -> titulo_video, ENT_QUOTES)."'
		where id_video_slide =".$this -> id_video_slide.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}

	

	function obtener_video_slide() {
		$sql = "SELECT * FROM videos_slide WHERE id_video_slide =".$this -> id_video_slide.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_video_slide = $fila['id_video_slide'];
			$this -> nombre_video = $fila['nombre_video'];
			$this -> titulo_video = htmlspecialchars_decode($fila['titulo_video']);
			$this -> ruta_final = $this -> directorio . $fila['nombre_video'];
		}
	}	
	function recuperar_video_slide() {
		$sql = "SELECT * FROM videos_slide WHERE id_video_slide =" . $this -> id_video_slide . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_video_slide = $fila['id_video_slide'];
			$this -> nombre_video = $fila['nombre_video'];
			$this -> titulo_video = htmlspecialchars_decode($fila['titulo_video']);
			$this -> ruta_final = $this -> directorio . $fila['nombre_video'];
		}
	}

	function listar_videos_slide_activos(){
		$resultados=array();
		$sql="SELECT * FROM videos_slide";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_video_slide']=$fila['id_video_slide'];
			$registro['nombre_video']=$fila['nombre_video'];
			$registro['titulo_video']=$fila['titulo_video'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>