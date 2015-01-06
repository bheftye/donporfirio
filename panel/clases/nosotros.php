<?php
include_once('conexion.php');

class nosotros
{
var $id_nosotros;
var $link_video;
var $tipo;


	function nosotros($id_nosotros = 0, $link_video='', $tipo = '')
	{
		$this -> id_nosotros=$id_nosotros;
		$this -> link_video = $link_video;
		$this -> tipo = $tipo;
	}
	
	function modificar_nosotros()
	{
		$conexion = new conexion();
		$sql = "UPDATE nosotros SET link_video = '".htmlspecialchars($this -> link_video, ENT_QUOTES)."',  tipo = '".$this -> tipo."'  WHERE id_nosotros = ". $this -> id_nosotros;
		return $conexion -> ejecutar_sentencia($sql);
	}
	
	function obtener_nosotros()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM nosotros WHERE id_nosotros=".$this->id_nosotros;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this -> id_nosotros = $row['id_nosotros'];
				$this -> link_video =$row['link_video'];
				$this -> tipo =$row['tipo'];
			}
		mysqli_free_result($result);
	}
}
?>