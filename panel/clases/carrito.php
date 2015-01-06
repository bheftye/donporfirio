<?php
class carrito
{
	var $productos;
	var $num_productos=0;
	var $total_productos=0;
	var $status=0;

	function carrito(){
		if(isset($_SESSION['carrito'])){
			$this->productos=$_SESSION['carrito'];
		}else{
			$this->productos=array();
			$_SESSION['carrito']=array();
		}
	}
	
	function guardar_carro(){
		$_SESSION['carrito']=$this->productos;
	}

	function agregar_producto($idProducto,$cantidad,$precio,$status,$combinacion){
		$bandera=0;
		foreach($this->productos as $elemento){
			if($elemento[0]==$idProducto and $elemento[4] == $combinacion)
			$bandera=1;
		}
		if($bandera==0){
			array_push($this->productos,array($idProducto,$cantidad,$precio,$status,$combinacion));
			$this->guardar_carro();
		}
	}

	function modificar_producto($idProducto,$cantidad,$precio,$status,$combinacion){
		for($i=0;$i<count($this->productos);$i++){
			if($this->productos[$i][0]==$idProducto and $this->productos[$i][4] == $combinacion){
				$this->productos[$i][1]=$cantidad;
				$this->productos[$i][2]=$precio;
				$this->productos[$i][3]=$status;
				$this->productos[$i][4]=$combinacion;
				$this->guardar_carro();
				break;
			}
		}
	}

	function eliminar_producto($idProducto){
		$bandera = -1;
		$i = 0;
		foreach($this->productos as $elemento){
			if($elemento[0]==$idProducto)
				$bandera = $i;
			$i++;			
		}
		if($bandera!=-1){
			array_splice($this->productos,$bandera,1);
	    }
	    $this->guardar_carro();
	}
		
	function obtener_totales(){
		$num=0;
		$importe=0;
		for ($i=0;$i<count($this->productos);$i++){
			$num=$num + $this->productos[$i][1];
			$importe = $importe + ($this->productos[$i][1]*$this->productos[$i][2]);
			$this->num_productos=$num;
			$this->total_productos=$importe;
		}
					
	}
}
?>