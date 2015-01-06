<?php
include_once('conexion.php');

class redes_sociales
{
var $id_redes_sociales;
var $facebook;
var $youtube;
var $vimeo;


	function redes_sociales($id_redes_sociales = 0, $facebook='', $youtube = '', $vimeo = "")
	{
		$this -> id_redes_sociales=$id_redes_sociales;
		$this -> facebook = $facebook;
		$this -> youtube = $youtube;
		$this -> vimeo = $vimeo;
	}
	
	function modificar_redes_sociales()
	{
		$conexion = new conexion();
		$sql = "UPDATE redes_sociales SET facebook = '".htmlspecialchars($this -> facebook, ENT_QUOTES)."', youtube = '".htmlspecialchars($this -> youtube, ENT_QUOTES)."', vimeo = '".htmlspecialchars($this -> vimeo, ENT_QUOTES)."'  WHERE id_redes_sociales = ". $this -> id_redes_sociales;
		return $conexion -> ejecutar_sentencia($sql);
	}
	
	function obtener_redes_sociales()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM redes_sociales WHERE id_redes_sociales=".$this->id_redes_sociales;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this -> id_redes_sociales = $row['id_redes_sociales'];
				$this -> facebook =$row['facebook'];
				$this -> youtube =$row['youtube'];
				$this -> vimeo =$row['vimeo'];
			}
		mysqli_free_result($result);
	}
}
?>