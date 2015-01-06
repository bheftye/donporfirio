<?php
/*
 * @author: Luis Josué Caamal Barbosa
 * @description: Clase donde se controlan todos los metodos de altas bajas y cambios de los noticias.
 * Copyright: Locker Agencia Creativa.
 */
include_once ('conexion.php');
require_once ('archivo.php');
include_once ('imgproducto.php');
include_once('herramientas.php');

class producto extends Archivo {
	var $id_producto;
	var $img_principal;
	var $titulo_esp;
	var $titulo_eng;
	var $descripcion_esp;
	var $descripcion_eng;
	var $url_amigable_esp;
	var $url_amigable_eng;
	var $peso;
	var $fecha_creacion;
	var $fecha_modificacion;
	var $mostrar;
	var $status;
	var $lista_imagenes_secundarias;
	var $directorio = '../imgProductos/';
	var $directorio2 = '../pdfProductos/';
	var $ruta_final;
	var $ruta_temporal;
	var $tools;
	var $orden;
	var $precio_mxn;
	var $precio_usd;
	var $impuesto;
	var $clave;
	var $stock_general;
	var $meta_titulo_esp;
	var $meta_descripcion_esp;
	var $meta_titulo_eng;
	var $meta_descripcion_eng;
	var $tags_esp;
	var $tags_eng;
	var $pdf_adjunto;
	var $id_combinacion;
	var $id_marca;
	/*Variables para el paginador*/
	
	var $totalRegistros;		
	var $registrosPorPagina;
	
	function producto($id_producto = 0, $img_principal = '', $ruta_temporal = '', $pdf_adjunto = "", $titulo_esp = '',$titulo_eng = '', $clave = "",$descripcion_esp = '', $descripcion_eng = '', $tags_esp = "", $tags_eng = "" ,$url_amigable_esp = '', $url_amigable_eng = '', $precio_mxn = "", $precio_usd = "", $impuesto = 0 ,$peso = "", $stock_general = "", $meta_titulo_esp = "", $meta_titulo_eng = "" , $meta_descripcion_esp = "", $meta_descripcion_eng = "", $id_marca = 0 ,$mostrar = 1, $status = 1) {
		$this -> id_producto = $id_producto;
		if ($img_principal != '') {
			$this -> img_principal = $this -> obtenerExtensionArchivo($img_principal);
		} else {
			$this -> img_principal = '';
		}

		$this -> titulo_esp = $titulo_esp;
		$this -> titulo_eng = $titulo_eng;

		$this -> clave = $clave;

		$this -> descripcion_esp = $descripcion_esp;
		$this -> descripcion_eng = $descripcion_eng;

		$this -> tags_esp = $tags_esp;
		$this -> tags_eng = $tags_eng;

		$this -> url_amigable_esp = $url_amigable_esp;
		$this -> url_amigable_eng = $url_amigable_eng;

		$this -> precio_mxn = $precio_mxn;
		$this -> precio_usd = $precio_usd;
		$this -> peso = $peso;
		$this -> impuesto = $impuesto;

		$this -> pdf_adjunto = $pdf_adjunto;

		$this -> stock_general = $stock_general;

		$this -> meta_titulo_esp = $meta_titulo_esp;
		$this -> meta_descripcion_esp = $meta_descripcion_esp;
		$this -> meta_titulo_eng = $meta_titulo_eng;
		$this -> meta_descripcion_eng = $meta_descripcion_eng;

		$this -> id_marca = $id_marca;

		$this -> mostrar = $mostrar;
		$this -> status = $status;
		$this -> lista_imagenes_secundarias = array();
		
		$this -> ruta_final = $this -> directorio . $this -> img_principal;
		$this -> ruta_temporal = $ruta_temporal;
	
		$this -> totalRegistros = 0;		
		$this -> registrosPorPagina = 8;
		$this->tools = new herramientas();
		
	}		
	function insertar_producto() {
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'"); 
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo_esp)));
		$s2 = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo_eng)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		$url2 = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s2)));
		$fechaCreacion = date("Y-m-d");
		$sql = "INSERT INTO productos (img_principal, titulo_esp, titulo_eng, clave, descripcion_esp, descripcion_eng, tags_esp, tags_eng, url_amigable_esp, url_amigable_eng, precio_mxn, precio_usd, peso, impuesto, stock_general, meta_titulo_esp, meta_descripcion_esp, meta_titulo_eng, meta_descripcion_eng, id_marca, fecha_creacion, fecha_modificacion, mostrar,status) 
		values ('".$this -> img_principal."',
		'".htmlspecialchars($this -> titulo_esp, ENT_QUOTES)."',
		'".htmlspecialchars($this -> titulo_eng, ENT_QUOTES)."',
		'".htmlspecialchars($this -> clave, ENT_QUOTES)."',
		'".htmlspecialchars($this -> descripcion_esp, ENT_QUOTES)."',
		'".htmlspecialchars($this -> descripcion_eng, ENT_QUOTES)."',
		'".$this -> tags_esp."',
		'".$this -> tags_eng."',
		'".htmlentities($this-> url_amigable_esp)."',
		'".htmlentities($this-> url_amigable_eng)."',
		'".$this -> precio_mxn."',
		'".$this -> precio_usd."',
		'".$this -> peso."',
		".$this -> impuesto.",
		'".$this -> stock_general."',
		'".$this -> meta_titulo_esp."',
		'".$this -> meta_descripcion_esp."',
		'".$this -> meta_titulo_eng."',
		'".$this -> meta_descripcion_eng."',
		".$this -> id_marca.",
		'".$fechaCreacion."',
		'".$fechaCreacion."',
		0,
		1);";
		$con = new conexion();
		$this -> id_producto = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "UPDATE productos set orden = ".$this -> id_producto." where id_producto = ".$this -> id_producto."";
		$con -> ejecutar_sentencia($s);
	}

	function modificar_producto() {
		if ($this -> img_principal != '') {
			$producto = new producto($this -> id_producto);
			$producto -> recuperar_producto();
			$producto -> borrar_archivo();
			$this -> ruta_final = $this -> directorio . $this -> img_principal;
			$sql = ' img_principal=\'' . $this -> img_principal . '\',';
		} else {
			$sql = '';
		}
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'"); 
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo_esp)));
		$s2 = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo_eng)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		$url2 = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s2)));
		
		$fecha_modificacion = date("Y-m-d");
		$sql = "UPDATE productos set 
		".$sql."
		titulo_esp ='".htmlspecialchars($this -> titulo_esp, ENT_QUOTES)."',
		titulo_eng ='".htmlspecialchars($this -> titulo_eng, ENT_QUOTES)."',
		clave ='".htmlspecialchars($this -> clave, ENT_QUOTES)."',
		descripcion_esp ='".htmlspecialchars($this -> descripcion_esp, ENT_QUOTES)."',
		descripcion_eng ='".htmlspecialchars($this -> descripcion_eng, ENT_QUOTES)."',
		tags_esp = '".$this -> tags_esp."',
		tags_eng = '".$this -> tags_eng."',
		precio_mxn = '".$this -> precio_mxn."',
		precio_usd = '".$this -> precio_mxn."',
		peso = '".$this -> peso."',
		impuesto = ".$this -> impuesto.",
		stock_general = '".$this -> stock_general."',
		meta_titulo_esp = '".$this -> meta_titulo_esp."',
		meta_titulo_eng = '".$this -> meta_titulo_eng."',
		meta_descripcion_esp = '".$this -> meta_descripcion_esp."',
		meta_descripcion_eng = '".$this -> meta_descripcion_eng."',
		id_marca = '".$this -> id_marca."',
		fecha_modificacion ='".$fecha_modificacion."',
		url_amigable_esp='".$url."', 
		url_amigable_eng='".$url2."' 
		where id_producto =".$this -> id_producto.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}

	function eliminar_producto() {
		//$this -> recuperar_producto();
		//$this -> borrar_archivo();
		$sql = "UPDATE productos SET mostrar = 1 WHERE id_producto =" . $this -> id_producto . ";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function asociar_transporte_con_producto($id_transporte){
		$sql = "INSERT INTO `productos_transportes`(`id_producto`, `id_transporte`) VALUES (".$this -> id_producto.", ".$id_transporte.")";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_asociaciones_con_transportes(){
		$sql = "DELETE FROM `productos_transportes` WHERE id_producto = ".$this -> id_producto;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function listar_ids_transportes_asociados(){
		$resultados = array();
		$sql = "SELECT id_transporte FROM `productos_transportes` WHERE id_producto = ".$this -> id_producto;
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			array_push($resultados, $fila['id_transporte']);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function asociar_categoria_con_producto($id_categoria){
		$sql = "INSERT INTO `productos_categorias`(`id_producto`, `id_categoria`) VALUES (".$this -> id_producto.", ".$id_categoria.")";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function eliminar_asociaciones_con_categorias(){
		$sql = "DELETE FROM `productos_categorias` WHERE id_producto = ".$this -> id_producto;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function listar_ids_categorias_asociadas(){
		$resultados = array();
		$sql = "SELECT id_categoria FROM `productos_categorias` WHERE id_producto = ".$this -> id_producto;
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			array_push($resultados, $fila['id_categoria']);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function modificar_pdf($pdf_adjunto_name, $pdf_adjunto_name_tmp){
		if($this -> pdf_adjunto == "")
		{
			if (is_file($this -> directorio2 . $this -> pdf_adjunto))
			{
				unlink($this -> directorio2 . $this -> pdf_adjunto);
			}
		}
		$this -> pdf_adjunto  = uniqid($this -> id_producto).".pdf";
		move_uploaded_file($pdf_adjunto_name_tmp, $this -> directorio2 . $this -> pdf_adjunto);

		$sql = "UPDATE `productos` SET pdf_adjunto = '".$this -> pdf_adjunto."' WHERE id_producto =".$this -> id_producto;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function ordenar_producto($orden)
	{
		$con = new conexion();
		$sql= "UPDATE producto SET orden ='".$orden."' where  id_producto=".$this -> id_producto." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function desactivar_producto() {
		$con = new conexion();
		$sql = "UPDATE productos SET status = 0 WHERE id_producto =" . $this -> id_producto;
		$con -> ejecutar_sentencia($sql);
	}	
	function activar_producto() {
		$con = new conexion();
		$sql = "UPDATE productos SET status = 1 WHERE id_producto =" . $this -> id_producto;
		$con -> ejecutar_sentencia($sql);
	}
	function mostrar_producto() {
		$con = new conexion();
		$sql = "UPDATE productos SET mostrar = 0 WHERE id_producto =" . $this -> id_producto;
		$con -> ejecutar_sentencia($sql);
	}
	function ocultar_producto() {
		$con = new conexion();
		$sql = "UPDATE productos SET mostrar = 1 WHERE id_producto =" . $this -> id_producto;
		$con -> ejecutar_sentencia($sql);
	}
	function listar_productos_mostrados() {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE mostrar = 1 ORDER BY orden DESC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];

			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function listar_productos_activos($offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE status = 1 and mostrar = 0 ORDER BY fecha_creacion DESC LIMIT ".$offset.",Proyecto";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_productos_activos_por_busqueda($search_string, $offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE status = 1 AND mostrar = 0 AND ((titulo_esp LIKE '%" . $search_string . "%') OR (titulo_eng LIKE '%" . $search_string . "%') OR (clave LIKE '%" . $search_string . "%') OR (tags_eng LIKE '%" . $search_string . "%') OR (tags_esp LIKE '%" . $search_string . "%')) ORDER BY fecha_creacion DESC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}


	function listar_productos_no_activos() {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE status = 0";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function get_producto_es(){
		$con = new conexion();
		$sql = "SELECT * FROM productos where id_producto=".$this->id_producto."";
		$result = $con->ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($result)){
			$this->id_producto = $row['id_producto'];
			$this->img_principal = $row['img_principal'];
			$this->titulo_esp = htmlspecialchars_decode($row['titulo_esp']);
			$this->clave = $row['clave'];
			$this-> impuesto = $row["impuesto"];
			$this->descripcion_esp = htmlspecialchars_decode($row['descripcion_esp']);
			$this->precio_mxn = $row['precio_mxn'];
		}
	}	
	function get_producto_en(){
		$con = new conexion();
		$sql = "SELECT * FROM productos where id_producto=".$this->id_producto."";
		$result = $con->ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($result)){
			$this->id_producto = $row['id_producto'];
			$this->img_principal = $row['img_principal'];
			$this-> impuesto = $row["impuesto"];
			$this->titulo_eng = htmlspecialchars_decode($row['titulo_eng']);
			$this->clave = $row['clave'];
			$this->descripcion_eng = htmlspecialchars_decode($row['descripcion_eng']);
			$this->precio_mxn = $row['precio_mxn'];
		}
	}	
	function obtener_producto() {
		$sql = "SELECT * FROM productos WHERE id_producto =".$this -> id_producto.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_producto = $fila['id_producto'];
			$this -> img_principal = $fila['img_principal'];
			$this -> titulo_esp = htmlspecialchars_decode($fila['titulo_esp']);
			$this -> titulo_eng = htmlspecialchars_decode($fila['titulo_eng']);
			$this -> clave =  htmlspecialchars_decode($fila['clave']);
			$this -> descripcion_esp = htmlspecialchars_decode($fila['descripcion_esp']);
			$this -> descripcion_eng = htmlspecialchars_decode($fila['descripcion_eng']);
			$this -> precio_mxn = $fila['precio_mxn'];
			$this -> precio_usd = $fila['precio_usd'];
			$this -> peso = $fila['peso'];
			$this -> impuesto = $fila["impuesto"];
			$this -> stock_general = $fila["stock_general"];
			$this -> url_amigable_esp = $fila['url_amigable_esp'];
			$this -> url_amigable_esp = $fila['url_amigable_eng'];
			$this -> meta_titulo_esp = $fila["meta_titulo_esp"];
			$this -> meta_descripcion_esp = $fila["meta_descripcion_esp"];
			$this -> meta_titulo_eng = $fila["meta_titulo_eng"];
			$this -> meta_descripcion_eng = $fila["meta_descripcion_eng"];
			$this -> id_marca = $fila["id_marca"];
			$this -> tags_esp = $fila["tags_esp"];
			$this -> tags_eng = $fila["tags_eng"];
			$this -> pdf_adjunto = $fila["pdf_adjunto"];
			$this -> mostrar = $fila['mostrar'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
			$this -> ruta_final = $this -> directorio . $fila['img_principal'];
		}
	}	
	function recuperar_producto() {
		$sql = "SELECT * FROM productos WHERE id_producto =" . $this -> id_producto . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_producto = $fila['id_producto'];
			$this -> img_principal = $fila['img_principal'];
			$this -> titulo_esp = htmlspecialchars_decode($fila['titulo_esp']);
			$this -> titulo_eng = htmlspecialchars_decode($fila['titulo_eng']);
			$this -> clave =  htmlspecialchars_decode($fila['clave']);
			$this -> descripcion_esp = htmlspecialchars_decode($fila['descripcion_esp']);
			$this -> descripcion_eng = htmlspecialchars_decode($fila['descripcion_eng']);
			$this -> precio_mxn = $fila['precio_mxn'];
			$this -> precio_usd = $fila['precio_usd'];
			$this -> peso = $fila['peso'];
			$this -> impuesto = $fila["impuesto"];
			$this -> stock_general = $fila["stock_general"];
			$this -> url_amigable_esp = $fila['url_amigable_esp'];
			$this -> url_amigable_esp = $fila['url_amigable_eng'];
			$this -> meta_titulo_esp = $fila["meta_titulo_esp"];
			$this -> meta_descripcion_esp = $fila["meta_descripcion_esp"];
			$this -> meta_titulo_eng = $fila["meta_titulo_eng"];
			$this -> meta_descripcion_eng = $fila["meta_descripcion_eng"];
			$this -> id_marca = $fila["id_marca"];
			$this -> tags_esp = $fila["tags_esp"];
			$this -> tags_eng = $fila["tags_eng"];
			$this -> pdf_adjunto = $fila["pdf_adjunto"];
			$this -> mostrar = $fila['mostrar'];
			$this -> status = $fila['status'];
			$this -> fecha_creacion=$fila['fecha_creacion'];
			$this -> fecha_modificacion=$fila['fecha_modificacion'];
			$this -> ruta_final = $this -> directorio . $fila['img_principal'];
		}
	}	
	function listar_productos() {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE mostrar = 0 ORDER BY orden DESC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_productos_activos_por_marca($id_marca, $offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE mostrar = 0 AND id_marca = ".$id_marca." AND status = 1 ORDER BY id_producto DESC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listar_productos_por_id_categoria($id_categoria, $offset = 0){
		$resultados = array();
		$sql = "SELECT * FROM ( SELECT * FROM productos INNER JOIN productos_categorias USING ( id_producto )) AS T WHERE T.id_categoria = ".$id_categoria." AND status = 1 AND mostrar = 0 ORDER BY fecha_creacion DESC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_productos_nuevos($offset = 0) {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE status = 1 AND mostrar = 0 ORDER BY fecha_creacion DESC LIMIT ".$offset.",9";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			$now = time(); // or your date as well
		    $your_date = strtotime($fila['fecha_creacion']);
		    $datediff = $now - $your_date;
		    $num_days = floor($datediff/(60*60*24));
		    if($num_days <= 20){
		    	array_push($resultados, $registro);
		    }
			
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_productos_buscados($pedazo) {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE status = 1 AND mostrar = 0 (titulo_esp LIKE '%" . $pedazo . "%') or (titulo_eng LIKE '%" . $pedazo . "%') group by id_producto";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	/*********************************************************
	 * PAGINACION
	 **********************************************************/
	function listar_productos_por_ajax($pagina){
		$resultados = array();
		$con = new conexion();
		//$sql = "select * from noticia where status = 1 order by id_producto DESC";
		$sql = "SELECT * FROM productos WHERE status = 1 AND mostrar = 0 ORDER BY orden DESC";
		$temporal = $con -> ejecutar_sentencia($sql);
		
		$pagina_actual = $pagina;	
		
		$this -> totalRegistros = mysqli_num_rows($temporal);
		$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);			
			
		$sql .= ' LIMIT '.($pagina - 1) * $this->registrosPorPagina.','.$this->registrosPorPagina;		
							
		$temporal2 = $con -> ejecutar_sentencia($sql);
		
		while ($fila = mysqli_fetch_array($temporal2)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			
			$registro['ultimapagina']=$ultimaPagina;
			$registro['paginaanterior']=$pagina-1;
			$registro['paginasiguiente']=$pagina+1;
			$registro['pagina']=$pagina;
			
			array_push($resultados, $registro);						
		}
		
		echo json_encode($resultados);
	}

	function listar_productos_por_ajax_siguiente() {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE id_producto != ".$this->id_producto." and status = 1 AND mostrar = 0 and id_producto >= ".$this->id_producto." order by orden asc limit 1";		
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
			$registro['fecha_creacion'] = $fila['fecha_creacion'];
			$registro['fecha_modificacion'] = $fila['fecha_modificacion'];
			$registro['status'] = $fila['status'];
			$registro['mostrar'] = $fila['mostrar'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
				
		return $resultados;
	}

	function listar_productos_por_ajax_anterior() {
		$resultados = array();
		$sql = "SELECT * FROM productos WHERE id_producto != ".$this->id_producto." and status = 1 and mostrar = 0 and id_producto <= ".$this->id_producto." order by orden desc limit 1";		
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo_esp'] = htmlspecialchars_decode($fila['titulo_esp']);
			$registro['titulo_eng'] = htmlspecialchars_decode($fila['titulo_eng']);
			$registro['clave'] = htmlspecialchars_decode($fila['clave']);
			$registro['descripcion_esp'] = htmlspecialchars_decode($fila['descripcion_esp']);
			$registro['descripcion_eng'] = htmlspecialchars_decode($fila['descripcion_eng']);
			$registro['tags'] = $fila['tags'];
			$registro['url_amigable_esp'] = $fila['url_amigable_esp'];
			$registro['url_amigable_eng'] = $fila['url_amigable_eng'];
			$registro['precio_mxn'] = $fila["precio_mxn"];
			$registro['precio_usd'] = $fila["precio_usd"];
			$registro['peso'] = $fila["peso"];
			$registro['impuesto'] = $fila["impuesto"];
			$registro['stock_general'] = $fila["stock_general"];
			$registro['meta_titulo_esp'] = $fila["meta_titulo_esp"];
			$registro['meta_descripcion_esp'] = $fila["meta_descripcion_esp"];
			$registro['meta_titulo_eng'] = $fila["meta_titulo_eng"];
			$registro['meta_descripcion_eng'] = $fila["meta_descripcion_eng"];
			$registro['id_marca'] = $fila["id_marca"];
			$registro['tags_esp'] = $fila["tags_esp"];
			$registro['tags_eng'] = $fila["tags_eng"];
			$registro['pdf_adjunto'] = $fila["pdf_adjunto"];
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
 * @author:Rodrigo Salas
 * @description: Funciones para el FRONT-END de agronegocios 
 */
/*
 	function getLastNews() {
		$sql = "select * from noticia where status = 1 order by orden DESC limit 1;";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> id_producto = $fila['id_producto'];
			$this -> img_principal = $fila['img_principal'];
			$this -> titulo = $fila['titulo'];
			$this -> subtitulo = $fila['subtitulo'];
			$this -> descripcion = htmlspecialchars_decode($fila['descripcion']);
			$this -> urlamigable = $fila['urlamigable'];
			$this -> status = $fila['status'];
			$this -> ruta_final = $this -> directorio . $fila['img_principal'];
		}
	}
	
	function listNewsRecientes() {
		$resultados = array();
		$sql = "select * from noticia where id_producto != ".$this->id_producto." and status = 1 order by orden DESC limit 4";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['titulo'] = $fila['titulo'];
			$registro['fecha'] = $fila['fechaCreacion'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['urlamigable'] = $fila['urlamigable'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listNewsRandom() {
		$resultados = array();
		$sql = "select * from noticia where id_producto != ".$this->id_producto." order by RAND() limit 4";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['urlamigable'] = $fila['urlamigable'];
			$registro['titulo'] = $fila['titulo'];
			$registro['fechaCreacion'] = $fila['fechaCreacion'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function getNewsAjax() {
		$resultados=array();	
		$sql = "select * from noticia where id_producto =".$this -> id_producto." order by orden DESC;";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo'] = $fila['titulo'];
			$registro['subtitulo'] = $fila['subtitulo'];
			$registro['descripcion'] = htmlspecialchars_decode($fila['descripcion']);
			$registro['urlaudio'] = $fila['urlaudio'];
			$registro['urlvideo'] = $fila['urlvideo'];
			$registro['urlamigable'] = $fila['urlamigable'];
			$registro['fechaCreacion']=$this->tools->getFormatedDate($$fila['fechaCreacion']);
			$registro['fechaModificacion'] = $fila['fechaModificacion'];
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		
		echo json_encode($resultados);
		
	}	
*/
/*
 * terminan funciones realizadas por Rodrigo Salas
 */ 
 /*
	function Buscarnoticia($pedazo) {
		$resultados = array();
		$sql = "select * from noticia where (titulo like '%" . $pedazo . "%') or (subtitulo like '%" . $pedazo . "%') group by id_producto";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo'] = $fila['titulo'];
			$registro['subtitulo'] = $fila['subtitulo'];
			$registro['descripcion'] = $fila['descripcion'];
			$registro['urlamigable'] = $fila['urlamigable'];
			$registro['fechaCreacion'] = $fila['fechaCreacion'];
			$registro['fechaModificacion'] = $fila['fechaModificacion'];
			$registro['mostrar'] = $fila['mostrar'];
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}	
	function limitnoticia() {
			$resultados = array();
			$sql = "select * from noticia";
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['id_producto'] = $fila['id_producto'];
			$registro['img_principal'] = $fila['img_principal'];
			$registro['titulo'] = $fila['titulo'];
			$registro['subtitulo'] = $fila['subtitulo'];
			$registro['descripcion'] = $fila['descripcion'];
			$registro['urlamigable'] = $fila['urlamigable'];
			$registro['fechaCreacion'] = $fila['fechaCreacion'];
			$registro['fechaModificacion'] = $fila['fechaModificacion'];
			$registro['mostrar'] = $fila['mostrar'];
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}*/
	//=============MAESTRO DETALLE DE LAS IMAGENES SECUNDARIAS===============
	function ordenar_img_secundarias_producto($orden,$id){
		$img_producto_temp = new imgproducto($id);
		$img_producto_temp -> ordenar_img_secundarias_producto($orden);
	}
	function listar_img_secundarias_producto() {
		$img_producto_temp = new imgproducto(0, $this -> id_producto, '', '', '');
		$this -> lista_imagenes_secundarias = $img_producto_temp -> listar_img_secundarias_producto();
	}
	//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	function insertar_img_secundaria_producto($tit, $rut, $temporal) {
		$img_producto_temp = new imgproducto(0, $this -> id_producto, $rut, $tit, $temporal);
		$img_producto_temp -> insertar_img_secundaria_producto();
	}	//$noticia_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	
	function modificar_img_secundaria_producto($id, $tit, $rut, $temporal) {
		$img_producto_temp = new imgproducto($id, $this -> id_producto, $rut, $tit, $temporal);
		$img_producto_temp -> modificar_img_secundaria_producto();
	}	
	function eliminar_img_secundaria_producto($id) {
		$img_producto_temp = new imgproducto($id, $this -> id_producto, '', '', '');
		$img_producto_temp -> eliminar_img_producto();
	}
	/*<|––––––––––––––––––––––––––––––CAAMAL METODOS CHECKOUT––––––––––––––––––––––––––––––––––––––|>*/
	function verificarTransporteProducto(){
		$bandera = 0;
		$con = new conexion();
		$sql = "select count(id_transporte) as total from productos_transportes where id_producto=".$this->id_producto;
		$result = $con->ejecutar_sentencia($sql);
		while($row=mysqli_fetch_array($result)){
			if($row['total'] > 0){
				$bandera  = 1;
			}
		}
		return $bandera;
	}
	function obtenerPesoProducto($idproducto){
		$con = new conexion();
		$sql = "select peso from productos where id_producto = ".$idproducto;
		$result = $con->ejecutar_sentencia($sql);
		$registro = mysqli_fetch_object($result);
		$this->peso = $registro->peso;
	}
	function obtenerPrecioxPeso($peso, $id_transporte){
		$resultados = array();
		$con = new conexion();
		$sql = "select id_rango_transporte, peso_minimo, peso_maximo, cargo_por_envio from rangos_transporte where id_transporte = ".$id_transporte;
		$result = $con->ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($result)){
			$registro = array();
			$registro['peso_minimo'] = $row['peso_minimo'];
			$registro['peso_maximo'] = $row['peso_maximo'];
			$registro['cargo_por_envio'] = $row['cargo_por_envio'];
			$registro['id_rango_transporte'] = $row['id_rango_transporte'];
			array_push($resultados, $registro);
		}
		foreach ($resultados as $keyRango) {
			//echo 'peso'.$peso.' minimo'.$keyRango['peso_minimo'].'maximo'.$keyRango['peso_maximo'];
			if($peso >= $keyRango['peso_minimo'] and $peso < $keyRango['peso_maximo']){
				//echo 'peso'.$peso.' rango'.$keyRango['id_rango_transporte'];
				$totalPrecio = $keyRango['id_rango_transporte'];
			break;	
			}else{
				$totalPrecio = 0;
			}
		}
		mysqli_free_result($result);
		return $totalPrecio;
	}
	function obtenerPrecioxPesoMuchos($peso, $id_transporte){
		$resultados = array();
		$con = new conexion();
		echo $sql = "select id_transporte, id_rango_transporte peso_minimo, peso_maximo, cargo_por_envio from rangos_transporte where id_transporte = ".$id_transporte;
		$result = $con->ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($result)){
			$registro = array();
			$registro['peso_minimo'] = $row['peso_minimo'];
			$registro['peso_maximo'] = $row['peso_maximo'];
			$registro['cargo_por_envio'] = $row['cargo_por_envio'];
			$registro['id_transporte'] = $row['id_transporte'];
			$registro['id_rango_transporte'] = $row['id_rango_transporte'];
			array_push($resultados, $registro);
		}
		$resultados2 = array();
		foreach ($resultados as $keyRango) {
			if($peso >= $keyRango['peso_minimo'] and $peso < $keyRango['peso_maximo']){
				$registro2 = array();
				$registro2['cargo_por_envio'] = $keyRango['cargo_por_envio'];
				$registro2['id_transporte'] = $keyRango['id_transporte'];
				$registro2['id_rango_transporte'] = $keyRango['id_rango_transporte'];
				//$totalPrecio = $keyRango['cargo_por_envio'];
				array_push($resultados2, $registro2);
			break;	
			}else{
				$totalPrecio = 'no se ha podido determinar el rango';
			}
		}
		return $resultados2;
	}
	/*<|––––––––––––––––––––––––––––––CAAMAL METODOS CARRITO––––––––––––––––––––––––––––––––––––––|>*/
	function valida_existencia($cantidad_verificar){
		$bandera=0;
		$sql='select stock_general from productos where id_producto='.$this->id_producto;
		$con=new conexion();
		$resultados=$con->ejecutar_sentencia($sql);
		while($fila=mysqli_fetch_array($resultados))
		{
			if($fila['stock_general']>$cantidad_verificar)
				$bandera=1;
		}
		return $bandera;
	}
	function valida_existencia_orden($cantidad_verificar){
		$bandera=0;
		$sql='select stock_general from productos where id_producto='.$this->id_producto;
		$con=new conexion();
		$resultados=$con->ejecutar_sentencia($sql);
		while($fila=mysqli_fetch_array($resultados))
		{
			if($fila['stock_general']>=$cantidad_verificar)
				$bandera=1;
		}
		return $bandera;
	}
	function valida_existencia_combinacion($cantidad_verificar, $id_combinacion){
		$bandera=0;

		$sql='select stock from combinaciones_productos where id_combinacion='.$id_combinacion;
		$con=new conexion();
		$resultados=$con->ejecutar_sentencia($sql);
		while($fila=mysqli_fetch_array($resultados))
		{
			//echo'aqui esta el stock bd'.$fila['stock'].' y aqui esta el de comparacion'.$cantidad_verificar;
			if($fila['stock']>$cantidad_verificar)
				$bandera=1;
		}
		return $bandera;
	}
	function valida_existencia_combinacion_orden($cantidad_verificar, $id_combinacion){
		$bandera=0;

		$sql='select stock from combinaciones_productos where id_combinacion='.$id_combinacion;
		$con=new conexion();
		$resultados=$con->ejecutar_sentencia($sql);
		while($fila=mysqli_fetch_array($resultados))
		{
			if($fila['stock']>=$cantidad_verificar)
				$bandera=1;
		}
		return $bandera;
	}
	function disminuir_inventario ($cantidad){
	 	$conexion=new conexion();
	 	$sql='update productos set stock_general = stock_general-'.$cantidad.' where id_producto='.$this->id_producto;
	 	$resultados=$conexion->ejecutar_sentencia($sql);
	}
	function disminuir_inventario_combinacion ($cantidad,$id_combinacion){
	 	$conexion=new conexion();
	 	$sql='update combinaciones_productos set stock = stock-'.$cantidad.' where id_combinacion='.$id_combinacion;
	 	$resultados=$conexion->ejecutar_sentencia($sql);
	}

	function aumentar_inventario($cantidad)
	{
	 $conexion=new conexion();
	 $sql='update productos set stock_general = stock_general+'.$cantidad.' where id_producto='.$this->id_producto;
	 $resultados=$conexion->ejecutar_sentencia($sql);
	}
	function aumentar_inventario_combinacion($cantidad,$id_combinacion)
	{
	 $conexion=new conexion();
	 $sql='update combinaciones_productos set stock = stock+'.$cantidad.' where id_combinacion='.$id_combinacion;
	 $resultados=$conexion->ejecutar_sentencia($sql);
	}
}
?>