<?php
include_once('conexion.php');

class pantallas
{
var $id_pantallas;
var $link_video1;
var $tipo1;
var $link_video2;
var $tipo2;
var $link_video3;
var $tipo3;



	function pantallas($id_pantallas = 0, $link_video1 ='', $tipo1 = '', $link_video2 ='', $tipo2 = '', $link_video3 ='', $tipo3 = '')
	{
		$this -> id_pantallas = $id_pantallas;
		$this -> link_video1 = $link_video1;
		$this -> tipo1 = $tipo1;
		$this -> link_video2 = $link_video2;
		$this -> tipo2 = $tipo2;
		$this -> link_video3 = $link_video3;
		$this -> tipo3 = $tipo3;
	}
	
	function modificar_pantallas()
	{
		$conexion = new conexion();
		$sql = "UPDATE pantallas SET 
		link_video1 = '".htmlspecialchars($this -> link_video1, ENT_QUOTES)."',  
		tipo1 = '".$this -> tipo1."',
		link_video2 = '".htmlspecialchars($this -> link_video2, ENT_QUOTES)."',  
		tipo2 = '".$this -> tipo2."',
		link_video3 = '".htmlspecialchars($this -> link_video3, ENT_QUOTES)."',  
		tipo3 = '".$this -> tipo3."'  
		WHERE id_pantallas = ". $this -> id_pantallas;
		return $conexion -> ejecutar_sentencia($sql);
	}
	
	function obtener_pantallas()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM pantallas WHERE id_pantallas=".$this->id_pantallas;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this -> id_pantallas = $row['id_pantallas'];
				$this -> link_video1 =$row['link_video1'];
				$this -> tipo1 =$row['tipo1'];
				$this -> link_video2 =$row['link_video2'];
				$this -> tipo2 =$row['tipo2'];
				$this -> link_video3 =$row['link_video3'];
				$this -> tipo3 =$row['tipo3'];
			}
		mysqli_free_result($result);
	}
}
?>