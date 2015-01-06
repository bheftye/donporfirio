<?php
include_once('conexion.php');
require_once('archivo.php');

class slide extends Archivo

{
	var $idslide;
	var $titulo;
	var $ruta;
	var $urlvideo;
	var $texto;
	var $status;
	var $directorio='../slide/';
	var $orden;
	
	function slide ($idslide = 0,$rut = '',$tit = '',$url = '', $txt = '',$stat = 0,$temporal = '')
	{
		$this->idslide=$idslide;
		if ($rut != '') {
			$this -> ruta = $this -> obtenerExtensionArchivo($rut);
		} else {
			$this -> ruta = '';
		}
		$this->titulo=$tit;
		$this->urlvideo=$url;
		$this->status=$stat;
		$this->texto = $txt;
		
		$this->ruta_final=$this->directorio.$this -> ruta;
		$this->ruta_temporal=$temporal;
	}
	
	
	
	function insertaslide()
	{
		$sql = "insert into slide (ruta, titulo,urlvideo,status,texto) values ('".$this->ruta."','".$this->titulo."','".$this->urlvideo."',1,'".htmlspecialchars($this->texto,ENT_QUOTES)."');"; 
		$con = new conexion();
		$this -> idslide = $con->ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "update slide set orden = ".$this -> idslide." where idslide = ".$this -> idslide."";
		$con->ejecutar_sentencia($s); 
	}
	
	
	function modificaslide()
	{
		if ($this->ruta!='')
		{
			$titulo_temporal=$this->titulo;
			$ruta_temporal=$this->ruta;
			
			$this->recuperaslide();
			$this->borrar_archivo();
			
			$this->titulo=$titulo_temporal;
			$this->ruta=$ruta_temporal;
			
			$this->ruta_final=$this->directorio.$ruta_temporal;
			$sql=' ruta=\''.$this->ruta.'\',';
		}
		else
		{
			
		}
		
		// ruta='".$this->ruta."'
		$sql="update slide set ".$sql."titulo='".$this->titulo."', urlvideo='".$this->urlvideo."', status=".$this->status.", texto = '".htmlspecialchars($this->texto, ENT_QUOTES)."' where idslide=".$this->idslide.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
		$this->subir_archivo();
	}
	
	function ordenaSlide($orden)
	{
		$con = new conexion();
		$sql= "update slide set orden ='".$orden."' where  idslide=".$this -> idslide." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function Desactivaslide()
		{
			$con=new conexion();
			$sql="update slide set status=0 where idslide=".$this->idslide;
			//echo $sql;
			$con->ejecutar_sentencia($sql);	
		}
		
	function activaslide()
		{
			$con=new conexion();
			$sql="update slide set status=1 where idslide=".$this->idslide;
			//echo $sql;
			$con->ejecutar_sentencia($sql);	
		}
		
	function listarslideActivas()
	{
		$resultados=array();
		$sql="select * from slide where status=1 order by orden DESC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idslide']=$fila['idslide'];
			$registro['ruta']=$fila['ruta'];
			$registro['titulo']=$fila['titulo'];
			$registro['urlvideo']=$fila['urlvideo'];
			$registro['status']=$fila['status'];
			$txt = htmlspecialchars_decode($fila['texto']);
			$registro['texto'] = strip_tags($txt);
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listarslideDesactivadas()
	{
		$resultados=array();
		$sql="select idslide, ruta, titulo, urlvideo, status from slide where status=0";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idslide']=$fila['idslide'];
			$registro['ruta']=$fila['ruta'];
			$registro['titulo']=$fila['titulo'];
			$registro['urlvideo']=$fila['urlvideo'];
			$registro['status']=$fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminaslide()
	{
		$this->recuperaslide();
		$this->borrar_archivo();
		
		$sql="delete from slide where idslide=".$this->idslide.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtenerslide()
	{
		$sql="select * from slide where idslide=".$this->idslide.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idslide=$fila['idslide'];
			$this->ruta=$fila['ruta'];
			$this->titulo=$fila['titulo'];
			$this->urlvideo=$fila['urlvideo'];
			$this->status=$fila['status'];
			$this->texto = htmlspecialchars_decode($fila['texto']);
			$this->ruta_final=$this->directorio.$fila['ruta'];
		}
	}
	
	function recuperaslide()
	{
		$sql="select idslide, ruta,titulo,urlvideo from slide where idslide=".$this->idslide.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idslide=$fila['idslide'];
			$this->ruta=$fila['ruta'];
			$this->titulo=$fila['titulo'];
			//$this->urlvideo=$fila['urlvideo'];
			$this->ruta_final=$this->directorio.$fila['ruta'];
		}
	}
	
	function listarslide()
	{
		$resultados=array();
		$sql="select idslide, ruta, titulo, urlvideo, status from slide order by orden DESC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idslide']=$fila['idslide'];
			$registro['ruta']=$fila['ruta'];
			$registro['titulo']=$fila['titulo'];
			$registro['urlvideo']=$fila['urlvideo'];
			$registro['status']=$fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function buscarslideAjax($pedazo)
	{
		$resultados=array();
		$sql="select idslide, ruta, titulo, urlvideo, status from slide where titulo like '%".$pedazo."%' group by idslide";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idslide']=$fila['idslide'];
			$registro['ruta']=$fila['ruta'];
			$registro['titulo']=$fila['titulo'];
			$registro['urlvideo']=$fila['urlvideo'];
			$registro['status']=$fila['status'];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
	function listaslideAjax()
	{		
			$resultados=array();
			$sql="select idslide, ruta, titulo, urlvideo, status from slide";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$registro=array();
				$registro['idslide']=$fila['idslide'];
				$registro['ruta']=$fila['ruta'];
				$registro['titulo']=$fila['titulo'];
				$registro['urlvideo']=$fila['urlvideo'];
				$registro['status']=$fila['status'];
				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}
}
?>