<?php
include_once('conexion.php');
class productoxuserend
{
	var $producto;
	var $userend;
	var $idproducto;
	var $iduserend;
	
	function productoxuserend ($idproducto=0, $iduserend=0)
	{
		$this->revista=array();
		$this->producto=array();
		$this->idproducto=$idproducto;
		$this->iduserend=$iduserend;
	}
	function obtenProductoxCliente()
	{
		$con=new conexion();
		$sql='select idproducto from productoxuserend where iduserend='.$this->iduserend;
		$resultados=$con->ejecutar_sentencia($sql);
		//$resultados_tipousuario=array();
		while($fila=mysqli_fetch_array($resultados))
		{
			array_push($this->idrevista,$fila['idproducto' ]);
		}
	}
	
	function obtenClientexProducto()
	{
		$con=new conexion();
		$sql='select iduserend from productoxuserend where idproducto='.$this->idproducto;
		$resultados=$con->ejecutar_sentencia($sql);
		while($fila=mysqli_fetch_array($resultados))
		{
			array_push($this->iduserend,$fila['iduserend']);
		}
	}
	
	function existeProductoxCliente()
	{
		$bandera=0;
		$con=new conexion();
		$sql='select idproducto, iduserend from prodcutoxuserend where idproducto='.$this->idproducto.' and iduserend='.$this->iduserend;
		$resultados=$con->ejecutar_sentencia($sql);
		while($fila=mysqli_fetch_array($resultados))
		{
			$bandera=1;
		}
		return $bandera;
	}
	
	function desasignaProductoxCliente()
	{
		$con= new conexion();
		$sql='delete from productoxuserend where iduserend='.$this->iduserend;
		//echo $sql;
		$con->ejecutar_sentencia($sql);
	}
	
	function desasignaClientexProducto()
	{
		$con=new conexion();
		$sql='delete from productoxuserend where idproducto='.$this->idproducto;
		//echo $sql;
		$con->ejecutar_sentencia($sql);
	}
	
	function insertaProductoxCliente()
	{
		$con=new conexion();
		$sql='insert into productoxuserend(idproducto, iduserend) values('.$this->idproducto.','.$this->iduserend.')';
		$con->ejecutar_sentencia($sql);
	}
	
	function listarProductoxCliente($iduserend,$idproducto)
	{
		$resultados=array();
		$sql="select idproducto from productoxuserend where iduserend=".$iduserend." and idproducto=".$idproducto;
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idproducto']=$fila['idproducto'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function listarProductosTodos($idproducto)
	{
		$resultados=array();
		$sql="select idproducto from productoxuserend where idproducto=".$idproducto;
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idproducto']=$fila['idproducto'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>