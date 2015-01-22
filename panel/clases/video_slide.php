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
	var $nombre_video_hd;
	var $directorio = '../videosSlide/';
	var $ruta_final;
	var $ruta_temporal;
	var $ruta_temporal_2;
	var $imagenes_slide;
	
	function video_slide($id_video_slide = 0, $nombre_video = '', $ruta_temporal = '',$nombre_video_hd = '', $ruta_temporal_hd = '', $titulo_video = '') 
	{
		$this -> id_video_slide = $id_video_slide;
		if ($nombre_video != '') {
			$this -> nombre_video = $this -> obtenerExtensionArchivo($nombre_video);
		} else {
			$this -> nombre_video = '';
		}

		if ($nombre_video_hd != '') {
			$this -> nombre_video_hd = $this -> obtenerExtensionArchivo($nombre_video_hd);
		} else {
			$this -> nombre_video_hd = '';
		}

		$this -> titulo_video = $titulo_video;
		
		$this -> ruta_final = $this -> directorio . $this -> nombre_video;
		$this -> ruta_temporal = $ruta_temporal;
		$this -> ruta_temporal_2 = $ruta_temporal_hd;
		
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

		if ($this -> nombre_video_hd != '') {
			$video_slide = new video_slide($this -> id_video_slide);
			$video_slide -> recuperar_video_slide();
			$video_slide -> borrar_archivo_hd();
			$sql2 = ' nombre_video_hd=\'' . $this -> nombre_video_hd . '\',';
		} else {
			$sql2 = '';
		}
		
		$fecha_modificacion = date("Y-m-d");
		$sql = "UPDATE videos_slide set 
		".$sql.$sql2."
		titulo_video ='".htmlspecialchars($this -> titulo_video, ENT_QUOTES)."'
		where id_video_slide =".$this -> id_video_slide.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();

		if($this -> nombre_video_hd != ""){
			$this -> ruta_final = $this -> directorio . $this -> nombre_video_hd;
			$this -> ruta_temporal = $this -> ruta_temporal_2;
			$this -> subir_archivo();
		}
	}

	function borrar_archivo_hd(){
		if (is_file($this -> directorio . $this -> nombre_video_hd))
		{
			unlink($this -> directorio . $this -> nombre_video_hd);
		}
	}

	function obtener_video_slide() {
		$sql = "SELECT * FROM videos_slide WHERE id_video_slide =".$this -> id_video_slide.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_video_slide = $fila['id_video_slide'];
			$this -> nombre_video = $fila['nombre_video'];
			$this -> nombre_video_hd = $fila['nombre_video_hd'];
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
			$this -> nombre_video_hd = $fila['nombre_video_hd'];
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
			$registro['nombre_video_hd']=$fila['nombre_video_hd'];
			$registro['titulo_video']=$fila['titulo_video'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	//=============MAESTRO DETALLE DE LAS IMAGENES SECUNDARIAS===============
	function ordenar_img_secundarias_inicio($orden,$id){
		$img_proyecto_temp = new img_inicio($id);
		$img_proyecto_temp -> ordenar_img_secundarias_inicio($orden);
	}
	function listar_img_secundarias_inicio() {
		$img_proyecto_temp = new img_inicio();
		$this -> lista_imagenes_secundarias = $img_proyecto_temp -> listar_img_secundarias_inicio();
	}
	//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	function insertar_img_secundaria_inicio($rut, $temporal) {
		$img_proyecto_temp = new img_inicio(0,$rut, $temporal);
		$img_proyecto_temp -> insertar_img_secundaria_inicio();
	}	//$noticia_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	
	function modificar_img_secundaria_inicio($id, $rut, $temporal) {
		$img_proyecto_temp = new img_inicio($id, $rut, $temporal);
		$img_proyecto_temp -> modificar_img_secundaria_inicio();
	}	
	function eliminar_img_secundaria_inicio($id) {
		$img_proyecto_temp = new img_inicio($id);
		$img_proyecto_temp -> eliminar_img_inicio();
	}
}
?>