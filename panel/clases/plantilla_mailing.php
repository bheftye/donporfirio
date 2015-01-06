<?php
include_once('conexion.php');

class plantilla_mailing
{
var $idplantilla;
var $nombre_plantilla;
var $xml;
var $num_usadas;

	function plantilla_mailing($idplantilla = 0, $nombre_plantilla = "", $xml = "", $num_usadas = "")
	{
		$this -> idplantilla = $idplantilla;
		$this -> nombre_plantilla = $nombre_plantilla;
		$this -> xml = $xml;
		$this -> num_usadas = $num_usadas;

	}
	function insertarPlantilla()
	{
		$conexion= new conexion();
		$sql="INSERT INTO plantilla_mailing (nombre_plantilla,xml,num_usadas) VALUES('".$this -> nombre_plantilla."','".$this -> xml."','0')";
		$this -> idplantilla = $conexion->ejecutar_sentencia($sql);
	}
	
	function modificarPlantilla()
	{
		$conexion= new conexion();
		$sql="UPDATE plantilla_mailing SET nombre_plantilla ='".$this->nombre_plantilla."' WHERE idplantilla = ".$this -> idplantilla;
		$conexion->ejecutar_sentencia($sql);
	}
	
	function buscarPlantilla($pedazo)
	{
		$conexion = new conexion();
		$sql = "SELECT * FROM plantilla_mailing where nombre_plantilla like '%".$pedazo."%' group by num_usadas limit 0, 30";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idplantilla']=$row['idplantilla'];
			$registro['nombre_plantilla']=$row['nombre_plantilla'];
			$registro['xml']=$row['xml'];
			$registro["num_usadas"] = $row['num_usadas'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
		
	}

	function limitPlantilla()
	{
		$conexion = new conexion();
		$sql = "SELECT * FROM plantilla_mailing group by num_usadas limit 0, 30";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idplantilla']=$row['idplantilla'];
			$registro['nombre_plantilla']=$row['nombre_plantilla'];
			$registro['xml']=$row['xml'];
			$registro["num_usadas"] = $row['num_usadas'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
		
	}

	
	function listarPlantillaAjax()
	{
			$conexion=new conexion();
			$sql = "SELECT * FROM plantilla_mailing LIMIT 0, 30 ORDER BY num_usadas";
			$result=$conexion->ejecutar_sentencia($sql);
			$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro=array();
				$registro['idplantilla']=$row['idplantilla'];
				$registro['nombre_plantilla']=$row['nombre_plantilla'];
				$registro['xml']=$row['xml'];
				$registro["num_usadas"] = $row['num_usadas'];
				array_push($resultados,$registro);
			}
			echo json_encode($resultados);
	}
	function  eliminarPlantilla()
	{
		$conexion=new conexion();
		$sql="DELETE FROM plantilla_mailing WHERE idplantilla=".$this->idplantilla;
		return $conexion->ejecutar_sentencia($sql);
	}

	function listarPlantillas()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM plantilla_mailing";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
			while ($row=mysqli_fetch_array($result))
			{
				$registro=array();
				$registro['idplantilla']=$row['idplantilla'];
				$registro['nombre_plantilla']=$row['nombre_plantilla'];
				$registro['xml']=$row['xml'];
				$registro["num_usadas"] = $row['num_usadas'];
				array_push($resultados,$registro);
			}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function obtenerPlantilla()
	{
		$conexion=new conexion();
		$sql="SELECT * FROM plantilla_mailing where idplantilla=".$this->idplantilla;
		$result=$conexion->ejecutar_sentencia($sql);
			
			while($row=mysqli_fetch_array($result))
			{
				$this->idplantilla=$row['idplantilla'];
				$this->nombre_plantilla=$row['nombre_plantilla'];
				$this->xml=$row['xml'];
				$this->num_usadas=$row['num_usadas'];
			}
		mysqli_free_result($result);
	}

	function obtenerPlantillasParaPaginador($offset){
		$resultados = array();
		$conexion=new conexion();
		$sql="SELECT * FROM `plantilla_mailing` ORDER BY `idplantilla` ASC LIMIT ".$offset." , 30";
		$result=$conexion->ejecutar_sentencia($sql);
		while($row=mysqli_fetch_array($result))
			{
				$registro=array();
				$registro['idplantilla']=$row['idplantilla'];
				$registro['nombre_plantilla']=$row['nombre_plantilla'];
				$registro['xml']=$row['xml'];
				$registro["num_usadas"] = $row['num_usadas'];
				array_push($resultados,$registro);
			}
		mysqli_free_result($result);
		return $resultados;
	}
}
?>