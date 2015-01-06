<?php
session_start();
include_once('detalle_orden.php');
include_once('orden.php');
include_once('carrito.php');
include_once('producto.php');

$c = new carrito();
$c -> obtener_totales();

$o = new orden(0,0,'',1,$c->num_productos,$c->total_productos);

$bandera=0;

for($i=0;$i<count($c->productos);$i++){
	$p=new producto($c->productos[$i][0],'','','','','');

	if($p->valida_existencia($c->productos[$i][1])==0){
		$bandera=1;
		$c->productos[$i][3]=0;
		$c->guardar_carro();
	}else{
		$c->productos[$i][3]=1;
		$c->guardar_carro();
	}
}

if($bandera==0){
	$o->inserta_orden();
	$_SESSION['Idorden']=$o->Idorden;
	unset($_SESSION['carrito']);
	foreach($c->productos as $elemento){
		$detalle_o= new detalle_orden($o->Idorden,$elemento[0],$elemento[1],$elemento[2],$elemento[3]);
		$detalle_o->asigna_productos_orden();
		/*–––––––––––––Inventario––––––––––––––––*/
		$prod=new producto($elemento[0],'','','','','','','',0);
		$prod->disminuir_inventario($elemento[1]);
	}
	header('Location:  ../confirmacion_compra.php ');
}else{
	header('Location: ../ajuste.php');
}
?>