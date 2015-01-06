<?php
include_once('conexion.php');

class contenidom
{
var $id_contenidom;
var $link_video;
var $tipo;


	function contenidom($id_contenidom = 0, $link_video='', $tipo = '')
	{
		$this -> id_contenidom=$id_contenidom;
		$this -> link_video = $link_video;
		$this -> tipo = $tipo;
	}
	
	function modificar_contenidom()
	{
		$conexion = new conexion();
		$sql = "UPDATE contenido_marca SET link_video = '".htmlspecialchars($this -> link_video, ENT_QUOTES)."',  tipo = '".$this -> tipo."'  WHERE id_contenidom = ". $this -> id_contenidom;
		return $conexion -> ejecutar_sentencia($sql);
	}
	
	function obtener_contenidom()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM contenido_marca WHERE id_contenidom=".$this->id_contenidom;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this -> id_contenidom = $row['id_contenidom'];
				$this -> link_video =$row['link_video'];
				$this -> tipo =$row['tipo'];
			}
		mysqli_free_result($result);
	}
}
?>