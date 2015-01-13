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
	default:
	break;
}
