<?php
include_once('conexion.php');

class faq
{
var $id_faq;
var $contenido_esp;
var $contenido_eng;

	function faq($id_faq = 0,$contenido_esp = '', $contenido_eng = "")
	{
		$this->id_faq=$id_faq;
		$this->contenido_esp = $contenido_esp;
		$this -> contenido_eng = $contenido_eng;
	}
	function insertar_faq()
	{
		$conexion = new conexion();
		$sql="INSERT INTO faq (contenido_esp, contenido_eng) values('".$this->contenido_esp."', '".$this->contenido_eng."' )";
		$this->id_faq = $conexion->ejecutar_sentencia($sql);
	}
	
	function modificar_faq()
	{
		$conexion= new conexion();
		$sql="UPDATE faq set contenido_esp = '".$this->contenido_esp."',contenido_eng = '".$this->contenido_eng."' where id_faq=".$this->id_faq;
		return $conexion->ejecutar_sentencia($sql);
	}
	
	function obtener_faq()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM faq WHERE id_faq=".$this->id_faq;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this->id_faq=$row['id_faq'];
				$this->contenido_esp = htmlspecialchars_decode($row['contenido_esp']);
				$this->contenido_eng = htmlspecialchars_decode($row['contenido_eng']);
			}
		mysqli_free_result($result);
	}
}
?>