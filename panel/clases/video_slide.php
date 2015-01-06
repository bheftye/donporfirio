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
	var $mostrar;
	var $status;
	var $ruta_final;
	var $ruta_temporal;
	
	function video_slide($id_video_slide = 0, $nombre_video = '', $ruta_temporal = '', $titulo_video = '', $mostrar = 0, $status = 0) 
	{
		$this -> id_video_slide = $id_video_slide;
		if ($nombre_video != '') {
			$this -> nombre_video = $this -> obtenerExtensionArchivo($nombre_video);
		} else {
			$this -> nombre_video = '';
		}

		$this -> titulo_video = $titulo_video;
		$this -> mostrar = $mostrar;
		$this -> status = $status;
		
		$this -> ruta_final = $this -> directorio . $this -> nombre_video;
		$this -> ruta_temporal = $ruta_temporal;
		
	}

	function insertar_video_slide() 
	{
		$fechaCreacion = date("Y-m-d");
		$sql = "INSERT INTO videos_slide (nombre_video, titulo_video, fecha_creacion, fecha_modificacion, mostrar, status ) 
		values ('".$this -> nombre_video."',
		'".htmlspecialchars($this -> titulo_video, ENT_QUOTES)."',
		'".$fechaCreacion."',
		'".$fechaCreacion."',
		0,
		1);";
		$con = new conexion();
		$this -> id_video_slide = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "UPDATE videos_slide set orden = ".$this -> id_video_slide." where id_video_slide = ".$this -> id_video_slide."";
		$con -> ejecutar_sentencia($s);
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
		titulo_video ='".htmlspecialchars($this -> titulo_video, ENT_QUOTES)."',
		fecha_modificacion ='".$fecha_modificacion."'
		where id_video_slide =".$this -> id_video_slide.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}

	function eliminar_video_slide() {
		$sql = "UPDATE videos_slide SET mostrar = 1 WHERE id_video_slide =" . $this -> id_video_slide . ";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function ordenar_video_slide($orden)
	{
		$con = new conexion();
		$sql= "UPDATE videos_slide SET orden ='".$orden."' where  id_video_slide=".$this -> id_video_slide."";
		$con -> ejecutar_sentencia($sql);
	}

	function desactivar_video_slide() {
		$con = new conexion();
		$sql = "UPDATE videos_slide SET status = 1 WHERE id_video_slide =" . $this -> id_video_slide;
		$con -> ejecutar_sentencia($sql);
	}	
	function activar_video_slide() {
		$con = new conexion();
		$sql = "UPDATE videos_slide SET status = 0 WHERE id_video_slide =" . $this -> id_video_slide;
		$con -> ejecutar_sentencia($sql);
	}
	function mostrar_video_slide() {
		$con = new conexion();
		$sql = "UPDATE videos_slide SET mostrar = 0 WHERE id_video_slide =" . $this -> id_video_slide;
		$con -> ejecutar_sentencia($sql);
	}
	function ocultar_video_slide() {
		$con = new conexion();
		$sql = "UPDATE videos_slide SET mostrar = 1 WHERE id_video_slide =" . $this -> id_video_slide;
		$con -> ejecutar_sentencia($sql);
	}
	function listar_videos_slide_mostrados() {
		$resultados = array();
		$sql = "SELECT * FROM videos_slide WHERE mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_video_slide'] = $fila['id_video_slide'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['titulo_video'] = htmlspecialchars_decode($fila['titulo_video']);
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function listar_videos_slide_activos($offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM videos_slide WHERE status = 0 and mostrar = 0 ORDER BY orden ASC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_video_slide'] = $fila['id_video_slide'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['titulo_video'] = htmlspecialchars_decode($fila['titulo_video']);
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_videos_slide_activos_por_busqueda($search_string, $offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM videos_slide WHERE status = 0 AND mostrar = 0 AND (titulo_video LIKE '%" . $search_string . "%') ORDER BY orden ASC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_video_slide'] = $fila['id_video_slide'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['titulo_video'] = htmlspecialchars_decode($fila['titulo_video']);
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function listar_videos_slide_no_activos() {
		$resultados = array();
		$sql = "SELECT * FROM videos_slide WHERE status = 1 AND mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_video_slide'] = $fila['id_video_slide'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['titulo_video'] = htmlspecialchars_decode($fila['titulo_video']);
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function obtener_video_slide() {
		$sql = "SELECT * FROM videos_slide WHERE id_video_slide =".$this -> id_video_slide.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_video_slide = $fila['id_video_slide'];
			$this -> nombre_video = $fila['nombre_video'];
			$this -> titulo_video = htmlspecialchars_decode($fila['titulo_video']);
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
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
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
			$this -> ruta_final = $this -> directorio . $fila['nombre_video'];
		}
	}	
	function listar_videos_slide() {
		$resultados = array();
		$sql = "SELECT * FROM videos_slide WHERE mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_video_slide'] = $fila['id_video_slide'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['titulo_video'] = htmlspecialchars_decode($fila['titulo_video']);
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
/*	
	//=============MAESTRO DETALLE DE LAS IMAGENES SECUNDARIAS===============
	function ordenar_img_secundarias_video_slide($orden,$id){
		$img_video_slide_temp = new imgvideo_slide($id);
		$img_video_slide_temp -> ordenar_img_secundarias_video_slide($orden);
	}
	function listar_img_secundarias_video_slide() {
		$img_video_slide_temp = new imgvideo_slide(0, $this -> id_video_slide, '', '', '');
		$this -> lista_imagenes_secundarias = $img_video_slide_temp -> listar_img_secundarias_video_slide();
	}
	//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	function insertar_img_secundaria_video_slide($tit, $rut, $temporal) {
		$img_video_slide_temp = new imgvideo_slide(0, $this -> id_video_slide, $rut, $tit, $temporal);
		$img_video_slide_temp -> insertar_img_secundaria_video_slide();
	}	//$noticia_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	
	function modificar_img_secundaria_video_slide($id, $tit, $rut, $temporal) {
		$img_video_slide_temp = new imgvideo_slide($id, $this -> id_video_slide, $rut, $tit, $temporal);
		$img_video_slide_temp -> modificar_img_secundaria_video_slide();
	}	
	function eliminar_img_secundaria_video_slide($id) {
		$img_video_slide_temp = new imgvideo_slide($id, $this -> id_video_slide, '', '', '');
		$img_video_slide_temp -> eliminar_img_video_slide();
	}
*/
}
?>