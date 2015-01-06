<?php

include_once('conexion.php');
include_once('producto.php');

class detalle_orden
{

var $ordenes;
var $productos;
var $idorden;
var $iduserend;
var $precio;
var $cantidad;
var $id_combinacion;

function detalle_orden($idorden=0, $id_producto=0, $precio=0, $cantidad=0, $id_combinacion=0)
{
$this->ordenes=array();
$this->productos=array();
$this->idorden=$idorden;
$this->id_producto=$id_producto;
$this->precio=$precio;
$this->cantidad=$cantidad;
$this->id_combinacion = $id_combinacion;
}

function asigna_productos_orden()
{
$con=new conexion();
$sql='insert into detalle_orden (idorden,id_producto,precio,cantidad,id_combinacion) values('.$this->idorden.','.$this->id_producto.','.$this->cantidad.','.$this->precio.','.$this->id_combinacion.')';
$con->ejecutar_sentencia($sql);

}

function obtener_producto_detalle($idorden)
{
$con= new Conexion();
$sql="select id_producto, cantidad from detalle_orden where idorden=".$this->idorden;
$result=$conexion->ejecutar_sentencia($sql);
		
$resultados= array();
		
while($row=mysqli_fetch_array($result))
{
$registro=array();
$registro['id_producto']=$row['id_producto'];
$registro['cantidad']=$row['cantidad'];
array_push($resultados, $registro);
}
mysqli_free_result($result);
return $resultados;
}


function obtener_productos_orden()
{
$con= new conexion();
$sql='select productos.id_producto,detalle_orden.precio,detalle_orden.cantidad,idorden,titulo_esp,id_combinacion 
	  from detalle_orden,productos 
	  where idorden='.$this->idorden.' 
	  and productos.id_producto=detalle_orden.id_producto';

$resultado=$con->ejecutar_sentencia($sql); 

while($fila=mysqli_fetch_array($resultado))
{
$temporal=new producto();
$temporal->id_producto = $fila['id_producto'];
$temporal->titulo_esp = $fila['titulo_esp'];
$temporal->precio_mxn = $fila['precio'];
$temporal->stock_general = $fila['cantidad'];
$temporal->id_combinacion = $fila['id_combinacion'];
array_push($this->productos,$temporal);
}
}

}
?>