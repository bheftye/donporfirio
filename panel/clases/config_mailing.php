<?php
include_once('conexion.php');

class config_mailing
{
	  var $idconfig;
	  var $correo_noreply;
	  var $correo_standard;
	  var $facebook;
	  var $twitter;
	  var $instagram;
	  var $youtube;
	  
	  function config_mailing($idconfig = 0, $correo_noreply = '', $correo_standard = '', $facebook = "", $twitter = "", $instagram = "", $youtube = "")
	  {
		  $this -> idconfig = $idconfig;
		  $this -> correo_noreply = $correo_noreply;
		  $this -> correo_standard = $correo_standard;
		  $this -> facebook = $facebook;
		  $this -> twitter = $twitter;
		  $this -> instagram = $instagram;
		  $this -> youtube = $youtube;
	  }
	  
	  function modificar_config()
	  {
		  $sql="UPDATE config_mailing SET correo_noreply  = '".$this -> correo_noreply."',correo_standard = '".$this -> correo_standard."', facebook = '".$this -> facebook."', twitter = '".$this -> twitter."', instagram = '".$this -> instagram."', youtube = '".$this -> youtube."' WHERE idconfig = ".$this -> idconfig.";";
		  $con = new conexion();
		  $con -> ejecutar_sentencia($sql);
	  }

	function obtener_config()
	{
	  $sql = "SELECT * from config_mailing where idconfig = ".$this -> idconfig.";";
	  $con = new conexion();
	  $resultados = $con -> ejecutar_sentencia($sql);
	  while ($fila = mysqli_fetch_array($resultados))
	  {
		$this -> idconfig = $fila['idconfig'];
		$this -> correo_noreply = $fila['correo_noreply'];
		$this -> correo_standard = $fila['correo_standard'];
		$this -> facebook = $fila["facebook"];
		$this -> twitter = $fila["twitter"];
		$this -> instagram = $fila["instagram"];
		$this -> youtube = $fila["youtube"];
	  }
	  mysqli_free_result($resultados);
	}

}
?>