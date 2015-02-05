<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se controlan todos los metodos de altas bajas y cambios de los noticias.
 * Copyright: Locker Agencia Creativa.
 */
include_once ('conexion.php');
require_once ('archivo.php');
include_once ('imgmetas.php');

class metas extends Archivo {
	var $id_metas;
	var $mostrar;
	var $status;
	var $lista_imagenes_secundarias;
	var $orden;
	var $meta_titulo;
	var $meta_descripcion;
	var $meta_empresa;
	/*Variables para el paginador*/

	
	function metas($id_metas = 0, $meta_titulo = "", $meta_descripcion = "", $meta_empresa = "", $mostrar = 0, $status = 1) 
	{
		$this -> id_metas = $id_metas;

		$this -> meta_titulo = $meta_titulo;
		$this -> meta_descripcion = $meta_descripcion;
		$this -> meta_empresa = $meta_empresa;

		$this -> mostrar = $mostrar;
		$this -> status = $status;
		$this -> lista_imagenes_secundarias = array();
		
	}		
	function insertar_metas() {
		$sql = "INSERT INTO metas (meta_titulo, meta_descripcion, meta_empresa, mostrar, status ) 
		values ('".$this -> meta_titulo."',
		'".$this -> meta_descripcion."',
		'".$this -> meta_empresa."',
		0,
		1);";
		$con = new conexion();
		$this -> id_metas = $con -> ejecutar_sentencia($sql);

		$s = "UPDATE metas set orden = ".$this -> id_metas." where id_metas = ".$this -> id_metas."";
		$con -> ejecutar_sentencia($s);
	}

	function modificar_metas() {
		$sql = "UPDATE metas set 
		meta_titulo = '".$this -> meta_titulo."',
		meta_descripcion = '".$this -> meta_descripcion."',
		meta_empresa = '".$this -> meta_empresa."'
		where id_metas =".$this -> id_metas.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);

	}

	function eliminar_metas() {
		$sql = "UPDATE metas SET mostrar = 1 AND orden = -1 WHERE id_metas =" . $this -> id_metas . ";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function ordenar_metas($orden)
	{
		$con = new conexion();
		$sql= "UPDATE metas SET orden ='".$orden."' where  id_metas=".$this -> id_metas."";
		$con -> ejecutar_sentencia($sql);
	}

	function desactivar_metas() {
		$con = new conexion();
		$sql = "UPDATE metas SET status = 1 WHERE id_metas =" . $this -> id_metas;
		$con -> ejecutar_sentencia($sql);
	}	
	function activar_metas() {
		$con = new conexion();
		$sql = "UPDATE metas SET status = 0 WHERE id_metas =" . $this -> id_metas;
		$con -> ejecutar_sentencia($sql);
	}
	function mostrar_metas() {
		$con = new conexion();
		$sql = "UPDATE metas SET mostrar = 0 WHERE id_metas =" . $this -> id_metas;
		$con -> ejecutar_sentencia($sql);
	}
	function ocultar_metas() {
		$con = new conexion();
		$sql = "UPDATE metas SET mostrar = 1 WHERE id_metas =" . $this -> id_metas;
		$con -> ejecutar_sentencia($sql);
	}
	function listar_metas_mostrados() {
		$resultados = array();
		$sql = "SELECT * FROM metas WHERE mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_metas'] = $fila['id_metas'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
			$registro['meta_empresa'] = $fila["meta_empresa"];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function listar_metas_activos($offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM metas WHERE status = 0 and mostrar = 0  ORDER BY orden ASC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_metas'] = $fila['id_metas'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
			$registro['meta_empresa'] = $fila["meta_empresa"];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_metas_no_activos() {
		$resultados = array();
		$sql = "SELECT * FROM metas WHERE status = 1 AND mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_metas'] = $fila['id_metas'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
			$registro['meta_empresa'] = $fila["meta_empresa"];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function obtener_metas() {
		$sql = "SELECT * FROM metas WHERE id_metas =".$this -> id_metas.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_metas = $fila['id_metas'];
			$this -> meta_titulo = $fila["meta_titulo"];
			$this -> meta_descripcion = $fila["meta_descripcion"];
			$this -> meta_empresa = $fila["meta_empresa"];
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
		}
	}

	function obtener_metas_ajax(){
		$resultados = array();
		$sql = "SELECT * FROM metas WHERE id_metas =".$this -> id_metas.";";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_metas'] = $fila['id_metas'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
			$registro['meta_empresa'] = $fila["meta_empresa"];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			$this -> listar_img_secundarias_metas();
			$registro["img_secundarias"] = $this -> lista_imagenes_secundarias;
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		echo json_encode($resultados);
	}

	function recuperar_metas() {
		$sql = "SELECT * FROM metas WHERE id_metas =" . $this -> id_metas . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_metas = $fila['id_metas'];
			$this -> meta_titulo = $fila["meta_titulo"];
			$this -> meta_descripcion = $fila["meta_descripcion"];
			$this -> meta_empresa = $fila["meta_empresa"];
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
		}
	}	
	function listar_metas() {
		$resultados = array();
		$sql = "SELECT * FROM metas WHERE mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_metas'] = $fila['id_metas'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
			$registro['meta_empresa'] = $fila["meta_empresa"];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function modificar_principal(){
		$sql = "UPDATE metas SET principal = 1;";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
	}
	
	//=============MAESTRO DETALLE DE LAS IMAGENES SECUNDARIAS===============
	function ordenar_img_secundarias_metas($orden,$id){
		$img_metas_temp = new imgmetas($id);
		$img_metas_temp -> ordenar_img_secundarias_metas($orden);
	}
	function listar_img_secundarias_metas() {
		$img_metas_temp = new imgmetas(0, $this -> id_metas, '', '', '');
		$this -> lista_imagenes_secundarias = $img_metas_temp -> listar_img_secundarias_metas();
	}
	//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	function insertar_img_secundaria_metas($tit, $rut, $temporal) {
		$img_metas_temp = new imgmetas(0, $this -> id_metas, $rut, $tit, $temporal);
		$img_metas_temp -> insertar_img_secundaria_metas();
	}	//$noticia_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	
	function modificar_img_secundaria_metas($id, $tit, $rut, $temporal) {
		$img_metas_temp = new imgmetas($id, $this -> id_metas, $rut, $tit, $temporal);
		$img_metas_temp -> modificar_img_secundaria_metas();
	}	
	function eliminar_img_secundaria_metas($id) {
		$img_metas_temp = new imgmetas($id, $this -> id_metas, '', '', '');
		$img_metas_temp -> eliminar_img_metas();
	}

}
?>