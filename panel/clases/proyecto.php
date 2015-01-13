<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se controlan todos los metodos de altas bajas y cambios de los noticias.
 * Copyright: Locker Agencia Creativa.
 */
include_once ('conexion.php');
require_once ('archivo.php');
include_once ('imgproyecto.php');

class proyecto extends Archivo {
	var $id_proyecto;
	var $img_principal;
	var $nombre_video;
	var $nombre_preview;
	var $nombre_video_hd;
	var $titulo_esp;
	var $titulo_eng;
	var $subtitulo_esp;
	var $subtitulo_eng;
	var $descripcion_esp;
	var $descripcion_eng;
	var $behance;
	var $url_amigable;
	var $fecha_creacion;
	var $fecha_modificacion;
	var $mostrar;
	var $status;
	var $lista_imagenes_secundarias;
	var $directorio = '../imgProyectos/';
	var $directorio2 = '../vidProyectos/';
	var $ruta_final;
	var $ruta_temporal;
	var $ruta_temporal2;
	var $ruta_temporal3;
	var $ruta_temporal4;
	var $orden;
	var $meta_titulo_esp;
	var $meta_titulo_eng;
	var $meta_descripcion_esp;
	var $meta_descripcion_eng;
	/*Variables para el paginador*/

	
	function proyecto($id_proyecto = 0, $img_principal = '', $ruta_temporal = '',$nombre_video = "", $ruta_temporal2 = "", $nombre_preview = "", $ruta_temporal3 = "", $nombre_video_hd = "", $ruta_temporal4 = "", $titulo_esp = '',$titulo_eng = '',$subtitulo_esp = '',$subtitulo_eng = '', $descripcion_esp = '', $descripcion_eng = '', $behance = "",$url_amigable = '', $meta_titulo_esp = "", $meta_descripcion_esp = "", $meta_titulo_eng = "", $meta_descripcion_eng = "", $mostrar = 0, $status = 1) 
	{
		$this -> id_proyecto = $id_proyecto;

		if ($img_principal != '') 
		{
			$this -> img_principal = $this -> obtenerExtensionArchivo($img_principal);
		} 
		else 
		{
			$this -> img_principal = '';
		}

		if ($nombre_video != '') 
		{
			$this -> nombre_video = $this -> obtenerExtensionArchivo($nombre_video);
		} 
		else 
		{
			$this -> nombre_video = '';
		}

		if ($nombre_preview != '') 
		{
			$this -> nombre_preview = $this -> obtenerExtensionArchivo($nombre_preview);
		} 
		else 
		{
			$this -> nombre_preview = '';
		}

		if ($nombre_video_hd != '') 
		{
			$this -> nombre_video_hd = $this -> obtenerExtensionArchivo($nombre_video_hd);
		} 
		else 
		{
			$this -> nombre_video_hd = '';
		}

		$this -> titulo_esp = $titulo_esp;
		$this -> titulo_eng = $titulo_eng;

		$this -> subtitulo_esp = $subtitulo_esp;
		$this -> subtitulo_eng = $subtitulo_eng;

		$this -> descripcion_esp = $descripcion_esp;
		$this -> descripcion_eng = $descripcion_eng;

		$this -> behance = $behance;
		$this -> url_amigable = $url_amigable;

		$this -> meta_titulo_esp = $meta_titulo_esp;
		$this -> meta_descripcion_esp = $meta_descripcion_esp;

		$this -> meta_titulo_eng = $meta_titulo_eng;
		$this -> meta_descripcion_eng = $meta_descripcion_eng;		

		$this -> mostrar = $mostrar;
		$this -> status = $status;
		$this -> lista_imagenes_secundarias = array();
		
		$this -> ruta_final = $this -> directorio . $this -> img_principal;
		$this -> ruta_temporal = $ruta_temporal;
		$this -> ruta_temporal2 = $ruta_temporal2;
		$this -> ruta_temporal3 = $ruta_temporal3;
		$this -> ruta_temporal4 = $ruta_temporal4;
		
	}		
	function insertar_proyecto() {
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'"); 
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo_eng)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		$fechaCreacion = date("Y-m-d");
		$sql = "INSERT INTO proyectos (img_principal, nombre_video, nombre_preview, nombre_video_hd, titulo_esp, titulo_eng, subtitulo_esp, subtitulo_eng, descripcion_esp, descripcion_eng, behance, url_amigable, meta_titulo_esp, meta_descripcion_esp, meta_titulo_eng, meta_descripcion_eng, fecha_creacion, fecha_modificacion, mostrar, status ) 
		values ('".$this -> img_principal."',
		'".$this -> nombre_video."',
		'".$this -> nombre_preview."',
		'".$this -> nombre_video_hd."',
		'".htmlspecialchars($this -> titulo_esp, ENT_QUOTES)."',
		'".htmlspecialchars($this -> titulo_eng, ENT_QUOTES)."',
		'".htmlspecialchars($this -> subtitulo_esp, ENT_QUOTES)."',
		'".htmlspecialchars($this -> subtitulo_eng, ENT_QUOTES)."',
		'".$this -> descripcion_esp."',
		'".$this -> descripcion_eng."',
		'".$this -> behance."',
		'".htmlentities($url)."',
		'".$this -> meta_titulo_esp."',
		'".$this -> meta_descripcion_esp."',
		'".$this -> meta_titulo_eng."',
		'".$this -> meta_descripcion_eng."',
		'".$fechaCreacion."',
		'".$fechaCreacion."',
		0,
		1);";
		$con = new conexion();
		$this -> id_proyecto = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();

		$this -> ruta_final = $this -> directorio2 . $this -> nombre_video;
		$this -> ruta_temporal = $this -> ruta_temporal2;
		$this -> subir_archivo();

		$this -> ruta_final = $this -> directorio2 . $this -> nombre_preview;
		$this -> ruta_temporal = $this -> ruta_temporal3;
		$this -> subir_archivo();

		$this -> ruta_final = $this -> directorio2 . $this -> nombre_video_hd;
		$this -> ruta_temporal = $this -> ruta_temporal4;
		$this -> subir_archivo();

		$s = "UPDATE proyectos set orden = ".$this -> id_proyecto." where id_proyecto = ".$this -> id_proyecto."";
		$con -> ejecutar_sentencia($s);
	}

	function modificar_proyecto() {
		if ($this -> img_principal != '') {
			$proyecto = new proyecto($this -> id_proyecto);
			$proyecto -> recuperar_proyecto();
			$proyecto -> borrar_archivo();
			$this -> ruta_final = $this -> directorio . $this -> img_principal;
			$sql = ' img_principal=\'' . $this -> img_principal . '\',';
		} else {
			$sql = '';
		}
		if ($this -> nombre_video != '') {
			$proyecto = new proyecto($this -> id_proyecto);
			$proyecto -> recuperar_proyecto();
			$proyecto -> borrar_video();
			$sql2 = ' nombre_video=\'' . $this -> nombre_video . '\',';
		} else {
			$sql2 = '';
		}

		if ($this -> nombre_preview != '') {
			$proyecto = new proyecto($this -> id_proyecto);
			$proyecto -> recuperar_proyecto();
			$proyecto -> borrar_video_preview();
			$sql3 = ' nombre_preview=\'' . $this -> nombre_preview . '\',';
		} else {
			$sql3 = '';
		}	

		if ($this -> nombre_video_hd != '') {
			$proyecto = new proyecto($this -> id_proyecto);
			$proyecto -> recuperar_proyecto();
			$proyecto -> borrar_video_hd();
			$sql4 = ' nombre_video_hd=\'' . $this -> nombre_video_hd . '\',';
		} else {
			$sql4 = '';
		}	

		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'"); 
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo_eng)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		
		$fecha_modificacion = date("Y-m-d");
		$sql = "UPDATE proyectos set 
		".$sql.$sql2.$sql3.$sql4."
		titulo_esp ='".htmlspecialchars($this -> titulo_esp, ENT_QUOTES)."',
		titulo_eng ='".htmlspecialchars($this -> titulo_eng, ENT_QUOTES)."',
		subtitulo_esp = '".htmlspecialchars($this -> subtitulo_esp, ENT_QUOTES)."',
		subtitulo_eng = '".htmlspecialchars($this -> subtitulo_eng, ENT_QUOTES)."',
		descripcion_esp ='".$this -> descripcion_esp."',
		descripcion_eng ='".$this -> descripcion_eng."',
		behance ='".$this -> behance."',
		meta_titulo_esp = '".$this -> meta_titulo_esp."',
		meta_descripcion_esp = '".$this -> meta_descripcion_esp."',
		meta_titulo_eng = '".$this -> meta_titulo_eng."',
		meta_descripcion_eng = '".$this -> meta_descripcion_eng."',
		fecha_modificacion ='".$fecha_modificacion."',
		url_amigable='".$url."' 
		where id_proyecto =".$this -> id_proyecto.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();

		if($this -> nombre_video != ""){
			$this -> ruta_final = $this -> directorio2 . $this -> nombre_video;
			$this -> ruta_temporal = $this -> ruta_temporal2;
			$this -> subir_archivo();
		}

		if($this -> nombre_preview != ""){
			$this -> ruta_final = $this -> directorio2 . $this -> nombre_preview;
			$this -> ruta_temporal = $this -> ruta_temporal3;
			$this -> subir_archivo();
		}

		if($this -> nombre_video_hd != ""){
			$this -> ruta_final = $this -> directorio2 . $this -> nombre_video_hd;
			$this -> ruta_temporal = $this -> ruta_temporal4;
			$this -> subir_archivo();
		}

	}

	function borrar_video(){
		if (is_file($this -> directorio2 . $this -> nombre_video))
		{
			unlink($this -> directorio2 . $this -> nombre_video);
		}
	}

	function borrar_video_preview(){
		if (is_file($this -> directorio2 . $this -> nombre_preview))
		{
			unlink($this -> directorio2 . $this -> nombre_preview);
		}
	}

	function borrar_video_hd(){
		if (is_file($this -> directorio2 . $this -> nombre_video_hd))
		{
			unlink($this -> directorio2 . $this -> nombre_video_hd);
		}
	}

	function eliminar_proyecto() {
		$sql = "UPDATE proyectos SET mostrar = 1 WHERE id_proyecto =" . $this -> id_proyecto . ";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function listar_proyectos_por_categoria($id_categoria){
		$resultados = array();
		$sql = "SELECT A.* FROM proyectos A JOIN proyectos_categorias B ON (A.id_proyecto = B.id_proyecto) ORDER BY A.orden";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_ids_categorias_asociadas(){
		$resultados = array();
		$sql = "SELECT id_categoria FROM `proyectos_categorias` WHERE id_proyecto = ".$this -> id_proyecto."";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			array_push($resultados, $fila['id_categoria']);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function asociar_proyecto_con_categoria($id_categoria){
		$sql = "INSERT INTO proyectos_categorias (id_proyecto, id_categoria) VALUES (".$this -> id_proyecto.", ".$id_categoria.") ";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_asociasiones_proyecto_con_categoria(){
		$sql = "DELETE FROM proyectos_categorias WHERE id_proyecto = ".$this -> id_proyecto;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function obtener_id_proyecto_siguiente(){
		$sql = "SELECT * FROM proyectos WHERE orden = ".($this -> orden + 1)." AND mostrar = 0 AND status = 0 ORDER BY orden ASC";
		$con = new conexion();
		$id_proyecto_siguiente = 0;
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$id_proyecto_siguiente = $fila['id_proyecto'];
		}
		mysqli_free_result($temporal);
		return $id_proyecto_siguiente;
	}

	function obtener_id_proyecto_anterior(){
		$sql = "SELECT * FROM proyectos WHERE orden = ".($this -> orden - 1)." AND mostrar = 0 AND status = 0 ORDER BY orden ASC";
		$con = new conexion();
		$id_proyecto_anterior = 0;
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$id_proyecto_anterior = $fila['id_proyecto'];
		}
		mysqli_free_result($temporal);
		return $id_proyecto_anterior;
	}

	function ordenar_proyecto($orden)
	{
		$con = new conexion();
		$sql= "UPDATE proyectos SET orden ='".$orden."' where  id_proyecto=".$this -> id_proyecto."";
		$con -> ejecutar_sentencia($sql);
	}

	function desactivar_proyecto() {
		$con = new conexion();
		$sql = "UPDATE proyectos SET status = 1 WHERE id_proyecto =" . $this -> id_proyecto;
		$con -> ejecutar_sentencia($sql);
	}	
	function activar_proyecto() {
		$con = new conexion();
		$sql = "UPDATE proyectos SET status = 0 WHERE id_proyecto =" . $this -> id_proyecto;
		$con -> ejecutar_sentencia($sql);
	}
	function mostrar_proyecto() {
		$con = new conexion();
		$sql = "UPDATE proyectos SET mostrar = 0 WHERE id_proyecto =" . $this -> id_proyecto;
		$con -> ejecutar_sentencia($sql);
	}
	function ocultar_proyecto() {
		$con = new conexion();
		$sql = "UPDATE proyectos SET mostrar = 1 WHERE id_proyecto =" . $this -> id_proyecto;
		$con -> ejecutar_sentencia($sql);
	}
	function listar_proyectos_mostrados() {
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function listar_proyectos_activos($offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE status = 0 and mostrar = 0  ORDER BY orden ASC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_casos_de_exito_activos($offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE caso_exito = 0 AND status = 0 AND mostrar = 0 ORDER BY orden ASC LIMIT ".$offset.",4";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_proyectos_activos_por_busqueda($search_string, $offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE status = 0 AND mostrar = 0 AND (titulo LIKE '%" . $search_string . "%') ORDER BY orden ASC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function listar_proyectos_no_activos() {
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE status = 1 AND mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function obtener_proyecto() {
		$sql = "SELECT * FROM proyectos WHERE id_proyecto =".$this -> id_proyecto.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_proyecto = $fila['id_proyecto'];
			$this -> img_principal = $fila['img_principal'];
			$this -> nombre_video = $fila["nombre_video"];
			$this -> nombre_preview = $fila["nombre_preview"];
			$this -> nombre_video_hd = $fila["nombre_video_hd"];
			$this -> titulo_esp = htmlspecialchars_decode($fila['titulo_esp']);
			$this -> titulo_eng = htmlspecialchars_decode($fila['titulo_eng']);
			$this -> subtitulo_esp = htmlspecialchars_decode($fila['subtitulo_esp']);
			$this -> subtitulo_eng = htmlspecialchars_decode($fila['subtitulo_eng']);
			$this -> behance = $fila['behance'];
			$this -> descripcion_esp = htmlspecialchars_decode($fila['descripcion_esp']);
			$this -> descripcion_eng = htmlspecialchars_decode($fila['descripcion_eng']);
			$this -> url_amigable = $fila['url_amigable'];
			$this -> meta_titulo_esp = $fila["meta_titulo_esp"];
			$this -> meta_descripcion_esp = $fila["meta_descripcion_esp"];
			$this -> meta_titulo_eng = $fila["meta_titulo_eng"];
			$this -> meta_descripcion_eng = $fila["meta_descripcion_eng"];
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
			$this -> ruta_final = $this -> directorio . $fila['img_principal'];
		}
	}

	function obtener_proyecto_ajax(){
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE id_proyecto =".$this -> id_proyecto.";";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			$this -> listar_img_secundarias_proyecto();
			$registro["img_secundarias"] = $this -> lista_imagenes_secundarias;
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		echo json_encode($resultados);
	}

	function recuperar_proyecto() {
		$sql = "SELECT * FROM proyectos WHERE id_proyecto =" . $this -> id_proyecto . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_proyecto = $fila['id_proyecto'];
			$this -> img_principal = $fila['img_principal'];
			$this -> nombre_video = $fila["nombre_video"];
			$this -> nombre_preview = $fila["nombre_preview"];
			$this -> nombre_video_hd = $fila["nombre_video_hd"];
			$this -> titulo_esp = htmlspecialchars_decode($fila['titulo_esp']);
			$this -> titulo_eng = htmlspecialchars_decode($fila['titulo_eng']);
			$this -> subtitulo_esp = htmlspecialchars_decode($fila['subtitulo_esp']);
			$this -> subtitulo_eng = htmlspecialchars_decode($fila['subtitulo_eng']);
			$this -> behance = $fila['behance'];
			$this -> descripcion_esp = htmlspecialchars_decode($fila['descripcion_esp']);
			$this -> descripcion_eng = htmlspecialchars_decode($fila['descripcion_eng']);
			$this -> url_amigable = $fila['url_amigable'];
			$this -> meta_titulo_esp = $fila["meta_titulo_esp"];
			$this -> meta_descripcion_esp = $fila["meta_descripcion_esp"];
			$this -> meta_titulo_eng = $fila["meta_titulo_eng"];
			$this -> meta_descripcion_eng = $fila["meta_descripcion_eng"];
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
			$this -> ruta_final = $this -> directorio . $fila['img_principal'];
		}
	}	
	function listar_proyectos() {
		$resultados = array();
		$sql = "SELECT * FROM proyectos WHERE mostrar = 0 ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function modificar_principal(){
		$sql = "UPDATE proyectos SET principal = 1;";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
	}
	
	//=============MAESTRO DETALLE DE LAS IMAGENES SECUNDARIAS===============
	function ordenar_img_secundarias_proyecto($orden,$id){
		$img_proyecto_temp = new imgproyecto($id);
		$img_proyecto_temp -> ordenar_img_secundarias_proyecto($orden);
	}
	function listar_img_secundarias_proyecto() {
		$img_proyecto_temp = new imgproyecto(0, $this -> id_proyecto, '', '', '');
		$this -> lista_imagenes_secundarias = $img_proyecto_temp -> listar_img_secundarias_proyecto();
	}
	//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	function insertar_img_secundaria_proyecto($tit, $rut, $temporal) {
		$img_proyecto_temp = new imgproyecto(0, $this -> id_proyecto, $rut, $tit, $temporal);
		$img_proyecto_temp -> insertar_img_secundaria_proyecto();
	}	//$noticia_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	
	function modificar_img_secundaria_proyecto($id, $tit, $rut, $temporal) {
		$img_proyecto_temp = new imgproyecto($id, $this -> id_proyecto, $rut, $tit, $temporal);
		$img_proyecto_temp -> modificar_img_secundaria_proyecto();
	}	
	function eliminar_img_secundaria_proyecto($id) {
		$img_proyecto_temp = new imgproyecto($id, $this -> id_proyecto, '', '', '');
		$img_proyecto_temp -> eliminar_img_proyecto();
	}
	
	/***********************************************MODIFICACIONES ISRAEL********************************************/
	function listar_proyecto_categoria_ajax($id_categoria){
		$resultados = array();
		if($id_categoria!=0){
			$cat="B.id_categoria=".$id_categoria." AND ";
		}
		else{
			$cat="";
		}
		$sql = "SELECT A.* FROM proyectos A 
		JOIN proyectos_categorias B ON (A.id_proyecto = B.id_proyecto) 
		WHERE ".$cat."status = 0 AND mostrar = 0
		GROUP BY A.id_proyecto
		ORDER BY A.orden";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['nombre_video'] = $fila['nombre_video'];
			$registro['nombre_preview'] = $fila['nombre_preview'];
			$registro['nombre_video_hd'] = $fila['nombre_video_hd'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['subtitulo_esp'] = htmlspecialchars_decode($fila['subtitulo_esp']);
			$registro['subtitulo_eng'] = htmlspecialchars_decode($fila['subtitulo_eng']);
			$registro['behance'] = $fila['behance'];
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp'],ENT_QUOTES);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		echo json_encode($resultados);
	}
	function obtener_id_proyecto_siguiente(){
		$sql = "SELECT * FROM proyectos WHERE orden = ".($this -> orden + 1)." AND mostrar = 0 AND status = 0 ORDER BY orden ASC";
		$con = new conexion();
		$id_proyecto_siguiente = 0;
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$id_proyecto_siguiente = $fila['id_proyecto'];
		}
		mysqli_free_result($temporal);
		echo json_encode($id_proyecto_siguiente);
	}

	function obtener_id_proyecto_anterior(){
		$sql = "SELECT * FROM proyectos WHERE orden = ".($this -> orden - 1)." AND mostrar = 0 AND status = 0 ORDER BY orden ASC";
		$con = new conexion();
		$id_proyecto_anterior = 0;
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$id_proyecto_anterior = $fila['id_proyecto'];
		}
		mysqli_free_result($temporal);
		echo json_encode($id_proyecto_anterior);
	}
}
?>