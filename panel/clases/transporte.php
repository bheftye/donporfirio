<?php
include_once('conexion.php');
require_once('archivo.php');

class transporte extends Archivo

{
	var $id_transporte;
	var $nombre;
	var $tiempo_transito;
	var $img_principal;
	var $descripcion;
	var $status;
	var $directorio = '/home1/locker07/public_html/clientes/notmonday/imgTransportes/';
	var $ruta_final;
	var $ruta_temporal;
	
	function transporte($id_transporte = 0, $nombre = "", $tiempo_transito = "", $descripcion = "",$img_principal = "", $ruta_temporal = '', $status = 0)
	{
		if ($img_principal != '') {
			$this -> img_principal = $this -> obtenerExtensionArchivo($img_principal);
		} else {
			$this -> img_principal = '';
		}
		$this -> id_transporte = $id_transporte;
		$this -> nombre = $nombre;
		$this -> tiempo_transito = $tiempo_transito;
		$this -> status = $status;
		
		$this -> descripcion = $descripcion;
		
		$this -> ruta_final = $this -> directorio . $this -> img_principal;
		$this -> ruta_temporal = $ruta_temporal;
	}
		
	
	function insertar_transporte()
	{
		$sql = "INSERT INTO transportes (nombre, tiempo_transito, descripcion ,img_principal,status) values ('".$this->nombre."',".$this->tiempo_transito.", '".$this -> descripcion."','".$this -> img_principal."',1);"; 
		$con = new conexion();
		$this -> id_transporte = $con->ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}
	
	
	function modificar_transporte()
	{	
		if ($this -> img_principal != '') {
			$ruta_temporal = $this -> img_principal;
			$transporte = new transporte($this -> id_transporte);
			$transporte -> recuperar_transporte();
			$transporte -> borrar_archivo();
			$this -> img_principal = $ruta_temporal;
			$this -> ruta_final = $this -> directorio . $ruta_temporal;
			$sql = ' img_principal=\'' . $this -> img_principal . '\',';
		} else {
			$sql = '';
		}
		$sql="UPDATE transportes SET ".$sql." nombre = '".$this -> nombre."', tiempo_transito = '".$this -> tiempo_transito."', descripcion = '".$this -> descripcion."' ,status = '".$this -> status."' WHERE id_transporte = ".$this -> id_transporte.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
		$this->subir_archivo();
	}

	function desactivar_transporte()
		{
			$con = new conexion();
			$sql = "UPDATE transportes SET status = 0 where id_transporte = ".$this->id_transporte;
			$con->ejecutar_sentencia($sql);	
		}
		
	function activar_transporte()
		{
			$con = new conexion();
			$sql = "UPDATE transportes SET status = 1 where id_transporte = ".$this->id_transporte;
			//echo $sql;
			$con->ejecutar_sentencia($sql);	
		}
		
	function listar_transportes_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM transportes WHERE status = 1 ORDER BY nombre ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_transporte']=$fila['id_transporte'];
			$registro['nombre']=$fila['nombre'];
			$registro['tiempo_transito']=$fila['tiempo_transito'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listarTransportes(){
		$resultados = array();
		$con=new conexion();
		$sql = "SELECT transportes.id_transporte, nombre, tiempo_transito, id_rango_transporte, cargo_por_envio
				FROM transportes, rangos_transporte
				WHERE transportes.id_transporte = rangos_transporte.id_transporte
				AND transportes.status = 1
				AND rangos_transporte.status = 1
				GROUP BY transportes.id_transporte";
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_transporte']=$fila['id_transporte'];
			$registro['nombre']=$fila['nombre'];
			$registro['tiempo_transito']=$fila['tiempo_transito'];
			$registro["id_rango_transporte"] = $fila["id_rango_transporte"];
			$registro["cargo_por_envio"] = $fila["cargo_por_envio"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;		
	}
	
	function listar_transportes_no_activos()
	{
		$resultados=array();
		$sql="SELECT * FROM transportes WHERE status = 0 ORDER BY nombre ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_transporte']=$fila['id_transporte'];
			$registro['nombre']=$fila['nombre'];
			$registro['tiempo_transito']=$fila['tiempo_transito'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminar_transporte()
	{
		$this->recuperar_transporte();
		$this->borrar_archivo();
		
		$sql="DELETE FROM transportes WHERE id_transporte = ".$this->id_transporte.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtener_transporte()
	{
		$sql="SELECT * FROM transportes WHERE id_transporte = ".$this->id_transporte.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_transporte = $fila['id_transporte'];
			$this -> nombre = $fila['nombre'];
			$this -> tiempo_transito = $fila['tiempo_transito'];
			$this -> descripcion = $fila["descripcion"];
			$this -> img_principal = $fila["img_principal"];
			$this -> status = $fila["status"];
		}
	}
	function obtenerMaxTransporte($id_transporte){
		$con = new conexion();
		$sql = "SELECT transportes.id_transporte, nombre, tiempo_transito, peso_maximo,cargo_por_envio, id_rango_transporte
				FROM transportes, rangos_transporte
				WHERE transportes.id_transporte = rangos_transporte.id_transporte
				AND peso_maximo = ( 
				SELECT MAX( peso_maximo ) 
				FROM rangos_transporte
				WHERE rangos_transporte.id_transporte = ".$id_transporte." ) 
				AND transportes.id_transporte =".$id_transporte;
		$result = $con->ejecutar_sentencia($sql);
		$row = mysqli_fetch_object($result);
		return $row;
	}

	function recuperar_transporte()
	{
		$sql="SELECT * FROM transportes where id_transporte = ".$this->id_transporte.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_transporte = $fila['id_transporte'];
			$this -> nombre = $fila['nombre'];
			$this -> tiempo_transito = $fila['tiempo_transito'];
			$this -> descripcion = $fila["descripcion"];
			$this -> img_principal = $fila["img_principal"];
			$this -> status = $fila["status"];
		}
	}
	
	function listar_transportes()
	{
		$resultados=array();
		$sql="SELECT * FROM transportes ORDER BY nombre ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_transporte']=$fila['id_transporte'];
			$registro['nombre']=$fila['nombre'];
			$registro['tiempo_transito']=$fila['tiempo_transito'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function buscar_transporte_por_ajax($pedazo)
	{
		$resultados=array();
		$sql="SELECT * FROM transportes WHERE nombre LIKE '%".$pedazo."%' group by id_transporte";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_transporte']=$fila['id_transporte'];
			$registro['nombre']=$fila['nombre'];
			$registro['tiempo_transito']=$fila['tiempo_transito'];
			$registro["descripcion"] = $fila["descripcion"];
			$registro["img_principal"] = $fila["img_principal"];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
	function listar_transportes_por_ajax()
	{		
			$resultados=array();
			$sql="SELECT * FROM transportes ORDER BY nombre ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$registro=array();
				$registro['id_transporte']=$fila['id_transporte'];
				$registro['nombre']=$fila['nombre'];
				$registro['tiempo_transito']=$fila['tiempo_transito'];
				$registro["descripcion"] = $fila["descripcion"];
				$registro["img_principal"] = $fila["img_principal"];
				$registro["status"] = $fila["status"];
				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}
}
?>