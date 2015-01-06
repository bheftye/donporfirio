<?php
include_once('conexion.php');
include_once('datosorden.php');
include_once('userend.php');
include_once('producto.php');
include_once('productoxuserend.php');
include_once('herramientas.php');
include_once('rango_transporte.php');


class orden
{
	var $idorden;
	var $fecha;
	var $iduserend;
	var $num_productos;
	var $total_productos;
	var $estatus;	
	var $orden;
	var $iddireccion;
	var $id_transporte;
	var $id_rango_transporte;
	var $peso;
	var $herramientas;
	var $transportes;
	var $precioTransporte;
	
	function orden($id=0,$fech='',$user='',$canti='',$import='',$esta='',$iddireccion=''){
		$this->idorden=$id;
		$this->fecha=$fech;
		$this->iduserend=$user;
		$this->num_productos=$canti;
		$this->total_productos=$import;
		$this->estatus=$esta;
		$this->iddireccion = $iddireccion;		
		$this->orden=array();
		$this->datosOrden = new datosorden($this->idorden,0,0,0);
		$this->herramientas = new herramientas();
	}
	function insertar_orden(){
		$con= new conexion();
		$sql="insert into orden (fecha,iduserend,num_productos,total_productos,estatus,iddireccion) values (now(),'".$this->iduserend."','".$this->num_productos."','".$this->total_productos."','".$this->estatus."', 0)";
		$this->idorden=$con->ejecutar_sentencia($sql);
	
	}
	function modificar_orden(){
		$con= new conexion();
		$sql="update orden set fecha='".$this->fecha."',iduserend='".$this->iduserend."',num_productos='".$this->num_productos."',total_productos='".$this->total_productos."',estatus='".$this->estatus."', iddireccion = ".$this->iddireccion." where idorden=".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function modificarOrdenTotales(){
		$con = new conexion();
		$sql = "UPDATE orden SET num_productos='".$this->num_productos."', total_productos = '".$this->total_productos."' where idorden = ".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function modificarDireccion(){
		$con = new conexion();
		$sql = "update orden set iddireccion=".$this->iddireccion." where idorden = ".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function modificarTransporte(){
		$con = new conexion();
		$sql = "update orden set id_transporte=".$this->id_transporte.", id_rango_transporte = ".$this->id_rango_transporte." where idorden = ".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function modificarPrecio(){
		$con = new conexion();
		$sql = "update orden set total_productos=".$this->total_productos." where idorden = ".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function updateStatus(){
		$con= new conexion();
		$sql="update orden set estatus='".$this->estatus."' where idorden=".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function cancelarOrden(){
		$con= new conexion();
		$sql="update orden set estatus = 1 where idorden=".$this->idorden;	
		$con->ejecutar_sentencia($sql);
	}
	function eliminar_orden(){
		$con= new conexion();
		$sql="delete from orden where idorden=".$this->idorden;
		$con->ejecutar_sentencia($sql);
	}
	function listar_orden(){
		$con= new conexion();
		$sql="select * from orden";
		$temporal=$con->ejecutar_sentencia($sql);
		$resultados=array();
		while($fila = mysqli_fetch_array($temporal)){
			$registro=array();
			$registro['idorden']=$fila['idorden'];
			$registro['fecha']=date("m/d/Y", strtotime($fila['fecha']));
			$registro['iduserend']=$fila['iduserend'];
			$clientes = new userend($registro['iduserend']);
			$clientes->obteneDatosUserend();
			$registro['nombre'] = $clientes->datosuserend->nombre;
			$registro['apellido'] = $clientes->datosuserend->apellido;		
			$registro['num_productos']=$fila['num_productos'];
			$registro['total_productos']=$fila['total_productos'];
			$registro['estatus']=$fila['estatus'];
			$registro['iddireccion'] = $fila['iddireccion'];
			$registro['peso'] = $fila['peso'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function obtener_orden(){
		$con= new conexion();
		$sql="select * from orden where idorden=".$this->idorden;
		$temporal=$con->ejecutar_sentencia($sql);		
		while ($fila = mysqli_fetch_array($temporal)){
			$this->idorden=$fila['idorden'];
			$this->fecha=date('d/m/Y', strtotime($fila['fecha']));
			$this->iduserend=$fila['iduserend'];			
			$this->num_productos= $fila['num_productos'];
			$this->total_productos=$this->herramientas->numformat($fila['total_productos']);
			$this->estatus=$fila['estatus'];
			$this->id_transporte=$fila['id_transporte'];
			$this->id_rango_transporte=$fila['id_rango_transporte'];
			$this->transportes = new rango_transporte($this->id_rango_transporte);
			$this->transportes->obtener_rango_transporte();
			$this->precioTransporte = $this->transportes->cargo_por_envio;
			$this->peso=$fila['peso'];
			$this->iddireccion = $fila['iddireccion'];
		}
		mysqli_free_result($temporal);
	}
	function obtenerTransporteOrden(){
		$con = new conexion();
		$sql = "SELECT transportes.id_transporte, nombre, tiempo_transito, peso_maximo,cargo_por_envio
				FROM transportes, rangos_transporte
				WHERE transportes.id_transporte = rangos_transporte.id_transporte
				AND rangos_transporte.id_rango_transporte = ".$this->id_rango_transporte."";
		$result = $con->ejecutar_sentencia($sql);
		$row = mysqli_fetch_object($result);
		return $row;
	}
	function valida_orden(){
		$bandera=0;
		$this->obtener_orden();
		if($this->iduserend != 0){
			$bandera=1;
		}
		else{
			$bandera=2;		
		}
		return $bandera;
	}
		
	function recuperar_datos_orden(){
			$this->datosOrden->obtener_datos_Orden();
	}
	/** Metodos para Catalogo de Datos orden **/
	function asocia_usuario_orden($iduserend,$orden){
		$con= new conexion();
		$sql="update orden set iduserend='".$iduserend."' where idorden=".$orden;
		return $con->ejecutar_sentencia($sql);
	}
	function agregar_datos_orden($nombre,$email,$telefono,$direccion){
		$datos_temp=new datosorden($this->idorden,'','',0,'');
		$datos_temp->insertar_datos_Orden($idorden);
	}
	function obtener_datosorden($id){
		 $con= new conexion();
		 $sql="select orden.idorden, datosorden.nombre,email,telefono,direccion from orden, datosorden where orden.idorden=datosorden.idorden and orden.idorden=".$id;
		 $resultados=$con->ejecutar_sentencia($sql);
		 while($row=mysqli_fetch_array($resultados)){
		  $this->idorden=$row['idorden'];
		  $this->nombre=$row['nombre'];
		  $this->email=$row['email'];
		  $this->telefono=$row['telefono'];
		  $this->direccion=$row['direccion'];
		}
		mysqli_free_result($resultados);
	}
	function insertar_Datos_Orden($nombre,$email,$telefono,$direccion){	
		$this->datosOrden->nombre=$nombre;
		$this->datosOrden->email=$email;
		$this->datosOrden->telefono=$telefono;
		$this->datosOrden->direccion=$direccion;
		$this->datosOrden->insertar_datos_Orden();
	}
	function  modificar_Datos_Orden($nombre,$email,$telefono,$direccion){
		$this->datosOrden->nombre=$nombre;
		$this->datosOrden->email=$email;
		$this->datosOrden->telefono=$telefono;
		$this->datosOrden->direccion=$direccion;
		$this->datosOrden->modificar_datos_Orden();
	}
	function eliminar_Datos_Orden($idorden){
		$datos= new datosorden($idorden,'','',0,'');
		$datos->eliminar_datos_Orden();
	}
	function update_status(){
		$con=new conexion();
		$sql="UPDATE orden SET estatus=".$this->estatus." WHERE idorden=".$this->idorden.";";
		$result=$con->ejecutar_sentencia($sql);
	}	
		
	/*===================================================
	 * Inicia Modificaciones de Luis
	 * =================================================*/
	 
	 function listarclientesorden(){
	 	$con= new conexion();
		$sql="select idorden,iduserend from orden group by iduserend";
		$temporal=$con->ejecutar_sentencia($sql);
		$resultados=array();
		while($fila = mysqli_fetch_array($temporal)){
			$registro=array();
			$registro['idorden']=$fila['idorden'];
			$registro['iduserend']=$fila['iduserend'];
			$clientes = new userend($registro['iduserend']);
			$clientes->obtener_userend();
			$registro['nombre'] = $clientes->nombre;
			$registro['apellido'] = $clientes->apellido;
			$registro['mail'] = $clientes->email;
			$registro['status'] = $fila['status'];			
			array_push($resultados,$registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	 }
	 
	 function listarHistorial($idcliente)
	 {
		$con = new conexion();
		$sql="SELECT * 
			FROM orden, detalleorden
			WHERE orden.idorden = detalleorden.idorden
			AND iduserend =".$idcliente."
			AND estatus = 3";
		$result=$con->ejecutar_sentencia($sql);	
		$resultados= array();
		while($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idproducto']=$row['idproducto'];
			$productos = new producto($registro['idproducto']);
			$productos->obtenerProducto();
			$registro['titulo'] = $productos->titulo;
			$registro['ruta'] = $productos->ruta;
			$registro['limite'] = $productos->limite;
			$registro['fecha'] = $row['fecha'];	
			array_push($resultados, $registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listarDescargas()
	{
		$con = new conexion();
		$sql="SELECT * 
			FROM orden, detalleorden
			WHERE orden.idorden = detalleorden.idorden
			group by idproducto";
		$result=$con->ejecutar_sentencia($sql);	
		$resultados= array();
		while($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idproducto']=$row['idproducto'];
			$productos = new producto($registro['idproducto']);
			$productos->obtenerProducto();
			$registro['titulo'] = $productos->titulo;
			$registro['ruta'] = $productos->ruta;
			$registro['limite'] = $productos->limite;
			$registro['fecha'] = $row['fecha'];
			$registro['precio'] = $productos->precio;
			$PxC = new productoxcliente();
			$listaPxC = $PxC->listarProductosTodos($registro['idproducto']);
			$registro['totalproductos'] = count($listaPxC);
			array_push($resultados, $registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listarRecientes($idcliente){
		$con = new conexion();
		$sql="SELECT * 
			FROM orden, detalleorden
			WHERE orden.idorden = detalleorden.idorden
			AND iduserend=".$idcliente."
			AND estatus = 3
			ORDER BY iddetalleorden DESC 
			LIMIT 2";
		$result=$con->ejecutar_sentencia($sql);	
		$resultados= array();
		while($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idproducto']=$row['idproducto'];
			$productos = new producto($registro['idproducto']);
			$productos->obtenerProducto();
			$registro['titulo'] = $productos->titulo;
			$registro['ruta'] = $productos->ruta;
			$registro['limite'] = $productos->limite;
			$registro['fecha'] = $row['fecha'];
			$registro['precio'] = $row['precio'];	
			array_push($resultados, $registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}

	function listarTrasnportexProducto($idproducto){
		$resultados = array();
		$con = new conexion();
		$sql = "select productos_transportes.id_transporte, nombre, tiempo_transito, id_rango_transporte
				from productos_transportes, transportes, rangos_transporte
				where productos_transportes.id_transporte = transportes.id_transporte
				and productos_transportes.id_transporte = rangos_transporte.id_transporte
				and transportes.status = 1
				and id_producto = ".$idproducto." group by rangos_transporte.id_transporte";
		$result = $con->ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($result)){
			$registro = array();
			$registro['id_transporte'] = $row['id_transporte'];
			$registro['id_rango_transporte'] = $row['id_rango_transporte'];
			$registro['nombre'] = $row['nombre'];
			$registro['tiempo_transito'] = $row['tiempo_transito'];
			array_push($resultados, $registro);
		}
		return $resultados;			
	}

	function obtenerTotalPesoOrden($idorden,$pesoTotal){
		$con = new conexion();
		$sql2 = "update orden set peso =".$pesoTotal." where idorden =".$idorden;
		$con->ejecutar_sentencia($sql2);
	}
				
	
}

?>