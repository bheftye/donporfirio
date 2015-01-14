<?php 
include("includes/path.php");
function __autoload($nombre_clase) {
	$nombre_clase = strtolower($nombre_clase);
    include 'panel/clases/'.$nombre_clase .'.php';
}

$operaciones = $_REQUEST['operaciones'];
session_start();

switch ($operaciones) {
	case "obtener_proyecto":
		$id_proyecto = $_REQUEST["id_proyecto"];
		$proyecto = new proyecto($id_proyecto);
		$proyecto -> obtener_proyecto_ajax();
	break;
	case "listar_proyecto_categoria":
		$id_categoria = $_REQUEST["id_categoria"];
		$proyecto = new proyecto();
		$proyecto -> listar_proyecto_categoria_ajax($id_categoria);
	break;
	case "obtener_proyecto_siguiente":
		$id_proyecto = $_REQUEST["id_proyecto"];
		$proyecto = new proyecto($id_proyecto);
		$proyecto -> obtener_proyecto();
		$proyecto -> obtener_id_proyecto_siguiente();
	break;
	case "obtener_proyecto_anterior":
		$id_proyecto = $_REQUEST["id_proyecto"];
		$proyecto = new proyecto($id_proyecto);
		$proyecto -> obtener_proyecto();
		$proyecto -> obtener_id_proyecto_anterior();
	break;
	case "obtener_proyecto_por_urlamigable":
		$url_amigable = $_REQUEST["url_amigable"];
		$proyecto = new proyecto();
		$proyecto -> url_amigable = $url_amigable;
		echo $proyecto -> obtener_id_proyecto_por_urlamigable();
	break;
	case "cambiar_idioma":
			$lang = $_REQUEST["lang"];
            session_start();
            $_SESSION['lang'] = $lang;
    break;
	default:
	break;
}
