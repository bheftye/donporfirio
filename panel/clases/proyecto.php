<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se controlan todos los metodos de altas bajas y cambios de los noticias.
 * Copyright: Locker Agencia Creativa.
 */
include_once ('conexion.php');
require_once ('archivo.php');
include_once ('imgproyecto.php');
include_once('herramientas.php');

class proyecto extends Archivo {
	var $id_proyecto;
	var $img_principal;
	var $titulo;
	var $subtitulo;
	var $cliente;
	var $descripcion;
	var $link_video;
	var $tipo;
	var $principal;
	var $caso_exito;
	var $url_amigable;
	var $fecha_creacion;
	var $fecha_modificacion;
	var $mostrar;
	var $status;
	var $lista_imagenes_secundarias;
	var $directorio = '../imgProyectos/';
	var $ruta_final;
	var $ruta_temporal;
	var $tools;
	var $orden;
	var $meta_titulo;
	var $meta_descripcion;
	/*Variables para el paginador*/
	
	var $totalRegistros;		
	var $registrosPorPagina;
	
	function proyecto($id_proyecto = 0, $img_principal = '', $ruta_temporal = '', $titulo = '',$subtitulo = '',$cliente = '', $descripcion = '', $link_video = '',$tipo = '',$principal = 1,$caso_exito = 1,$url_amigable = '', $meta_titulo = "", $meta_descripcion = "", $mostrar = 0, $status = 1) {
		$this -> id_proyecto = $id_proyecto;
		if ($img_principal != '') {
			$this -> img_principal = $this -> obtenerExtensionArchivo($img_principal);
		} else {
			$this -> img_principal = '';
		}

		$this -> titulo = $titulo;
		$this -> subtitulo = $subtitulo;
		$this -> cliente = $cliente;
		$this -> descripcion = $descripcion;
		$this -> link_video = $link_video;
		$this -> tipo = $tipo;
		$this -> principal = $principal;
		$this -> caso_exito = $caso_exito;
		$this -> url_amigable = $url_amigable;

		$this -> meta_titulo = $meta_titulo;
		$this -> meta_descripcion = $meta_descripcion;

		$this -> mostrar = $mostrar;
		$this -> status = $status;
		$this -> lista_imagenes_secundarias = array();
		
		$this -> ruta_final = $this -> directorio . $this -> img_principal;
		$this -> ruta_temporal = $ruta_temporal;
	
		$this -> totalRegistros = 0;		
		$this -> registrosPorPagina = 8;
		$this->tools = new herramientas();
		
	}		
	function insertar_proyecto() {
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'"); 
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		$fechaCreacion = date("Y-m-d");
		$sql = "INSERT INTO proyectos (img_principal, titulo, subtitulo, cliente, descripcion, link_video, tipo, principal, caso_exito ,url_amigable, meta_titulo, meta_descripcion, fecha_creacion, fecha_modificacion, mostrar, status ) 
		values ('".$this -> img_principal."',
		'".htmlspecialchars($this -> titulo, ENT_QUOTES)."',
		'".htmlspecialchars($this -> subtitulo, ENT_QUOTES)."',
		'".htmlspecialchars($this -> cliente, ENT_QUOTES)."',
		'".htmlspecialchars($this -> descripcion, ENT_QUOTES)."',
		'".$this -> link_video."',
		'".$this -> tipo."',
		'".$this -> principal."',
		'".$this -> caso_exito."',
		'".htmlentities($this-> url_amigable)."',
		'".$this -> meta_titulo."',
		'".$this -> meta_descripcion."',
		'".$fechaCreacion."',
		'".$fechaCreacion."',
		0,
		1);";
		$con = new conexion();
		$this -> id_proyecto = $con -> ejecutar_sentencia($sql);
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
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'"); 
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		
		$fecha_modificacion = date("Y-m-d");
		$sql = "UPDATE proyectos set 
		".$sql."
		titulo ='".htmlspecialchars($this -> titulo, ENT_QUOTES)."',
		subtitulo = '".htmlspecialchars($this -> subtitulo, ENT_QUOTES)."',
		cliente = '".htmlspecialchars($this -> cliente, ENT_QUOTES)."',
		descripcion ='".htmlspecialchars($this -> descripcion, ENT_QUOTES)."',
		link_video ='".$this -> link_video."',
		tipo ='".$this -> tipo."',
		principal ='".$this -> principal."',
		caso_exito ='".$this -> caso_exito."',
		meta_titulo = '".$this -> meta_titulo."',
		meta_descripcion = '".$this -> meta_descripcion."',
		fecha_modificacion ='".$fecha_modificacion."',
		url_amigable='".$url."' 
		where id_proyecto =".$this -> id_proyecto.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}

	function eliminar_proyecto() {
		$sql = "UPDATE proyectos SET mostrar = 1 WHERE id_proyecto =" . $this -> id_proyecto . ";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function obtener_id_proyecto_principal(){
		$sql = "SELECT * FROM proyectos WHERE principal = 0 AND mostrar = 0 AND status = 0";
		$con = new conexion();
		$id_proyecto_principal = 0;
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$id_proyecto_principal = $fila['id_proyecto'];
		}
		mysqli_free_result($temporal);
		return $id_proyecto_principal;
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
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['cliente'] = htmlspecialchars_decode($fila['cliente']);
			$registro['subtitulo'] = htmlspecialchars_decode($fila['subtitulo']);
			$registro['link_video'] = $fila['link_video'];
			$registro['tipo'] = $fila['tipo'];
			$registro['principal'] = $fila['principal'];
			$registro['caso_exito'] = $fila['caso_exito'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
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
		$sql = "SELECT * FROM proyectos WHERE status = 0 and mostrar = 0 AND principal = 1 ORDER BY orden ASC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_proyecto'] = $fila['id_proyecto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['cliente'] = htmlspecialchars_decode($fila['cliente']);
			$registro['subtitulo'] = htmlspecialchars_decode($fila['subtitulo']);
			$registro['link_video'] = $fila['link_video'];
			$registro['tipo'] = $fila['tipo'];
			$registro['principal'] = $fila['principal'];
			$registro['caso_exito'] = $fila['caso_exito'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion']);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
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
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['cliente'] = htmlspecialchars_decode($fila['cliente']);
			$registro['subtitulo'] = htmlspecialchars_decode($fila['subtitulo']);
			$registro['link_video'] = $fila['link_video'];
			$registro['tipo'] = $fila['tipo'];
			$registro['principal'] = $fila['principal'];
			$registro['caso_exito'] = $fila['caso_exito'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion']);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
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
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['cliente'] = htmlspecialchars_decode($fila['cliente']);
			$registro['subtitulo'] = htmlspecialchars_decode($fila['subtitulo']);
			$registro['link_video'] = $fila['link_video'];
			$registro['tipo'] = $fila['tipo'];
			$registro['principal'] = $fila['principal'];
			$registro['caso_exito'] = $fila['caso_exito'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion'],ENT_QUOTES);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
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
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['cliente'] = htmlspecialchars_decode($fila['cliente']);
			$registro['subtitulo'] = htmlspecialchars_decode($fila['subtitulo']);
			$registro['link_video'] = $fila['link_video'];
			$registro['tipo'] = $fila['tipo'];
			$registro['principal'] = $fila['principal'];
			$registro['caso_exito'] = $fila['caso_exito'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion']);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
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
			$this -> titulo = htmlspecialchars_decode($fila['titulo']);
			$this -> subtitulo = htmlspecialchars_decode($fila['subtitulo']);
			$this -> cliente = htmlspecialchars_decode($fila['cliente']);
			$this -> descripcion = htmlspecialchars_decode($fila['descripcion']);
			$this -> link_video = $fila["link_video"];
			$this -> tipo = $fila["tipo"];
			$this -> principal = $fila["principal"];
			$this -> caso_exito = $fila["caso_exito"];
			$this -> url_amigable = $fila['url_amigable'];
			$this -> meta_titulo = $fila["meta_titulo"];
			$this -> meta_descripcion = $fila["meta_descripcion"];
			$this -> mostrar = $fila['mostrar'];
			$this -> orden = $fila['orden'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
			$this -> ruta_final = $this -> directorio . $fila['img_principal'];
		}
	}	
	function recuperar_proyecto() {
		$sql = "SELECT * FROM proyectos WHERE id_proyecto =" . $this -> id_proyecto . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_proyecto = $fila['id_proyecto'];
			$this -> img_principal = $fila['img_principal'];
			$this -> titulo = htmlspecialchars_decode($fila['titulo']);
			$this -> subtitulo = htmlspecialchars_decode($fila['subtitulo']);
			$this -> cliente = htmlspecialchars_decode($fila['cliente']);
			$this -> descripcion = htmlspecialchars_decode($fila['descripcion']);
			$this -> link_video = $fila["link_video"];
			$this -> tipo = $fila["tipo"];
			$this -> principal = $fila["principal"];
			$this -> caso_exito = $fila["caso_exito"];
			$this -> url_amigable = $fila['url_amigable'];
			$this -> meta_titulo = $fila["meta_titulo"];
			$this -> meta_descripcion = $fila["meta_descripcion"];
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
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['cliente'] = htmlspecialchars_decode($fila['cliente']);
			$registro['subtitulo'] = htmlspecialchars_decode($fila['subtitulo']);
			$registro['link_video'] = $fila['link_video'];
			$registro['tipo'] = $fila['tipo'];
			$registro['principal'] = $fila['principal'];
			$registro['caso_exito'] = $fila['caso_exito'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion']);
			$registro['url_amigable'] = $fila['url_amigable'];
			$registro['meta_titulo'] = $fila["meta_titulo"];
			$registro['meta_descripcion'] = $fila["meta_descripcion"];
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
}
?>