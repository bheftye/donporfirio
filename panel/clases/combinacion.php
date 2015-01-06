 <?php
include_once('conexion.php');
include_once('imgcombinacion.php');
class combinacion
{
	var $id_combinacion;
	var $id_producto;
	var $nombre;
	var $imagenes_combinacion;
	var $stock;
	var $status;
	
	function combinacion($id_combinacion = 0, $id_producto = 0, $nombre = "", $stock = 0,$status = 0)
	{
		$this -> id_combinacion = $id_combinacion;
		$this -> id_producto = $id_producto;
		$this -> nombre = $nombre;
		$this -> stock = $stock;
		$this -> status = $status;
	}
		
	
	function insertar_combinacion()
	{
		$sql = "INSERT INTO combinaciones_productos (id_producto, nombre, stock, status) VALUES ('".$this->id_producto."', '".$this->nombre."', '".$this->stock."' , 1);"; 
		$con = new conexion();
		$this -> id_combinacion = $con->ejecutar_sentencia($sql);
	}
	
	function asociar_combinacion_con_atributo_y_valor($id_atributo, $id_valor){
		$sql = "INSERT INTO combinaciones_atributos_valores (id_combinacion, id_atributo, id_valor) VALUES ('".$this->id_combinacion."', '".$id_atributo."', '".$id_valor."');"; 
		$con = new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function eliminar_asociaciones_combinacion_con_atributo_y_valor(){
		$sql = "DELETE FROM combinaciones_atributos_valores WHERE id_combinacion = ".$this -> id_combinacion; 
		$con = new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function modificar_combinacion()
	{	
		$sql="UPDATE combinaciones_productos SET nombre = '".$this -> nombre."', stock = '".$this -> stock."'  ,status = '".$this -> status."' WHERE id_combinacion = ".$this -> id_combinacion.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function desactivar_combinacion()
		{
			$con = new conexion();
			$sql = "UPDATE combinaciones_productos SET status = 0 where id_combinacion = ".$this->id_combinacion;
			$con->ejecutar_sentencia($sql);	
		}
		
	function activar_combinacion()
		{
			$con = new conexion();
			$sql = "UPDATE combinaciones_productos SET status = 1 where id_combinacion = ".$this->id_combinacion;
			$con->ejecutar_sentencia($sql);	
		}

	function listar_combinaciones_por_producto(){
		{
		$resultados=array();
		$sql = "SELECT * FROM combinaciones_productos WHERE id_producto = ".$this -> id_producto." ORDER BY nombre ASC";
		$con = new conexion();
		$temporal = $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_combinacion']=$fila['id_combinacion'];
			$registro['id_producto']=$fila['id_producto'];
			$registro['nombre']=$fila['nombre'];
			$registro['stock']=$fila['stock'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	}
		
	function listar_combinaciones_activas_por_producto()
	{
		$resultados=array();
		$sql = "SELECT * FROM combinaciones_productos WHERE id_producto = ".$this -> id_producto." AND status = 1 ORDER BY nombre ASC";
		$con = new conexion();
		$temporal = $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_combinacion']=$fila['id_combinacion'];
			$registro['id_producto']=$fila['id_producto'];
			$registro['nombre']=$fila['nombre'];
			$registro['stock']=$fila['stock'];
			$registro["status"] = $fila["status"];
			$combinacion = new combinacion($fila['id_combinacion']);
			$registro["atributos_valores"] = $combinacion -> listar_asociaciones_combinacion_con_atributo_y_valor();
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	function listar_combinaciones_no_activas()
	{
		$resultados=array();
		$sql = "SELECT * FROM combinaciones_productos WHERE status = 0 ORDER BY nombre ASC";
		$con = new conexion();
		$temporal = $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_combinacion']=$fila['id_combinacion'];
			$registro['id_producto']=$fila['id_producto'];
			$registro['nombre']=$fila['nombre'];
			$registro['stock']=$fila['stock'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}		
	
	function eliminar_combinacion()
	{	
		$this -> eliminar_asociaciones_combinacion_con_imagenes();
		$this -> eliminar_asociaciones_combinacion_con_atributo_y_valor();
		$sql="DELETE FROM combinaciones_productos WHERE id_combinacion = ".$this->id_combinacion.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtener_combinacion()
	{
		$sql="SELECT * FROM combinaciones_productos WHERE id_combinacion = ".$this->id_combinacion.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_combinacion = $fila['id_combinacion'];
			$this -> id_producto = $fila['id_producto'];
			$this -> nombre = $fila['nombre'];
			$this -> stock = $fila['stock'];
			$this -> status = $fila["status"];
		}
	}
	
	function recuperar_combinacion()
	{
		$sql="SELECT * FROM combinaciones_productos where id_combinacion = ".$this->id_combinacion.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this -> id_combinacion = $fila['id_combinacion'];
			$this -> id_producto = $fila['id_producto'];
			$this -> nombre = $fila['nombre'];
			$this -> stock = $fila['stock'];
			$this -> status = $fila["status"];
		}
	}
	
	function listar_combinaciones()
	{
		$resultados=array();
		$sql="SELECT * FROM combinaciones_productos ORDER BY nombre ASC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_combinacion']=$fila['id_combinacion'];
			$registro['id_producto']=$fila['id_producto'];
			$registro['nombre']=$fila['nombre'];
			$registro['stock']=$fila['stock'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function obtener_combinaciones_con_lista_valores($atributos_valores){
		$resultados = array();
		$combinacion = new combinacion(0,$this -> id_producto);
		$combinaciones = $combinacion -> listar_combinaciones_activas_por_producto();
		$ids_combinaciones_coincidentes = array();
		
		$con=new conexion();
		for($i = 0; $i < count($atributos_valores); $i++){
			$resultados_tmp = array();
			$string_valores = "";
			$id_valor = $atributos_valores[$i + 1];
			$id_atributo = $atributos_valores[$i];
			$string_valores.=" AND id_atributo = ".$id_atributo." AND id_valor = ".$id_valor;

			$sql="SELECT id_combinacion FROM ((SELECT id_combinacion, id_producto FROM combinaciones_productos) AS T LEFT JOIN combinaciones_atributos_valores USING ( id_combinacion )) WHERE id_producto =".$this -> id_producto.$string_valores;
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal))
			{
				array_push($resultados_tmp, $fila['id_combinacion']);
			}
			mysqli_free_result($temporal);
			array_push($resultados, $resultados_tmp);
			$i++;
		}
		foreach ($combinaciones as $combinacion_tmp) {
			$id_combinacion = $combinacion_tmp["id_combinacion"];
			$en_todos = false;
			foreach ($resultados as $resultado) {
				$en_todos = in_array($id_combinacion, $resultado);
				if($en_todos){
					//array_push($ids_combinaciones_coincidentes, $id_combinacion);
					continue;
				}
				else{
					break;
				}
			}
			if($en_todos){
				array_push($ids_combinaciones_coincidentes, $id_combinacion);
			}
			

		}
		return $ids_combinaciones_coincidentes;
	}
	
	function buscar_combinacion_por_ajax($pedazo)
	{
		$resultados=array();
		$sql="SELECT * FROM combinaciones_productos WHERE nombre LIKE '%".$pedazo."%'   group by id_combinacion";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_combinacion']=$fila['id_combinacion'];
			$registro['id_producto']=$fila['id_producto'];
			$registro['nombre']=$fila['nombre'];
			$registro['stock']=$fila['stock'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
	function listar_combinaciones_por_ajax()
	{		
			$resultados=array();
			$sql="SELECT * FROM combinaciones_productos ORDER BY nombre ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$registro=array();
				$registro['id_combinacion']=$fila['id_combinacion'];
				$registro['id_producto']=$fila['id_producto'];
				$registro['nombre']=$fila['nombre'];
				$registro['stock']=$fila['stock'];
				$registro["status"] = $fila["status"];
				$registro["imagenes"] = $this -> listar_asociaciones_combinacion_con_imagenes();
				$registro["atributos_valores"] = $this -> listar_asociaciones_combinacion_con_atributo_y_valor();
				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}

	function obtener_combinacion_por_ajax(){
		$resultados=array();
		$sql="SELECT * FROM combinaciones_productos WHERE id_combinacion =".$this -> id_combinacion;
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['id_combinacion']=$fila['id_combinacion'];
			$registro['id_producto']=$fila['id_producto'];
			$registro['nombre']=$fila['nombre'];
			$registro['stock']=$fila['stock'];
			$registro["status"] = $fila["status"];
			$registro["imagenes"] = $this -> listar_asociaciones_combinacion_con_imagenes();
			$registro["atributos_valores"] = $this -> listar_asociaciones_combinacion_con_atributo_y_valor();
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}

	function obtener_combinacion_estilo_ajax(){
		$resultados=array();
		$sql="SELECT * FROM combinaciones_productos WHERE id_combinacion =".$this -> id_combinacion;
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$resultados['id_combinacion']=$fila['id_combinacion'];
			$resultados['id_producto']=$fila['id_producto'];
			$resultados['nombre']=$fila['nombre'];
			$resultados['stock']=$fila['stock'];
			$resultados["status"] = $fila["status"];
			$resultados["imagenes"] = $this -> listar_asociaciones_combinacion_con_imagenes();
			$resultados["atributos_valores"] = $this -> listar_asociaciones_combinacion_con_atributo_y_valor();
		}
		return $resultados;
	}

	function asociar_combinacion_con_imagen($id_imagen){
		$sql="INSERT INTO combinaciones_imagenes (id_combinacion, id_imagen) VALUES('".$this -> id_combinacion."','".$id_imagen."')";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);	
	}

	function listar_asociaciones_combinacion_con_imagenes(){
		$resultados=array();
			$sql="SELECT * FROM combinaciones_imagenes WHERE id_combinacion = ".$this -> id_combinacion." ORDER BY id_combinacion ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$id_imagen = $fila["id_imagen"];
				array_push($resultados, $id_imagen);
			}
			return $resultados;
	}

	function listar_asociaciones_combinacion_con_atributo_y_valor(){
		$resultados=array();
			$sql="SELECT * FROM combinaciones_atributos_valores WHERE id_combinacion = ".$this -> id_combinacion." ORDER BY id_combinacion ASC";
			$con=new conexion();
			$temporal= $con->ejecutar_sentencia($sql);
			while ($fila=mysqli_fetch_array($temporal))
			{
				$id_atributo = $fila["id_atributo"];
				$id_valor = $fila["id_valor"];
				array_push($resultados, $id_atributo);
				array_push($resultados, $id_valor);
			}
			return $resultados;
	}

	function eliminar_asociaciones_combinacion_con_imagenes(){
		$sql = "DELETE FROM combinaciones_imagenes WHERE id_combinacion = ".$this -> id_combinacion; 
		$con = new conexion();
		$con->ejecutar_sentencia($sql);
	}
}
?>