<?php
include_once('conexion.php');
include_once('datosuserend.php');
include_once('userenddireccion.php');

class userend
{
	var $iduserend;
	var $correo;
	var $password;
	var $status;
	var $token;
	var $datosuserend;
	var $direcciones;
	var $userendDireccion;

	function userend($a = 0, $b = '', $c = '', $stat = 0)
	{
		$this -> iduserend = $a;
		$this -> correo = $b;
		$this -> password = $c;
		$this -> status = $stat;
		$this -> datosuserend = new datosuserend($a);
		$this -> direcciones = array();
	}
	
	function inserta_userend()
	{
		$conexion = new conexion();
		$sql = "insert into userend (correo,password,status,token) values('".$this->correo."',MD5('".$this->password."'),".$this->status.",MD5('".$this->correo."'))";
		$this -> iduserend = $conexion -> ejecutar_sentencia($sql);
	}
	
	function modifica_userend()
	{
		$conexion= new conexion();
		$pedazo="";
		$pedazo2='';
		if($this->correo != '')
			$pedazo2="correo='".$this->correo."',";
		if ($this->password!='')   
			$pedazo="password=MD5('".$this->password."')";
		$sql="update userend set ".$pedazo2." ".$pedazo."  where iduserend=".$this->iduserend;
		$conexion->ejecutar_sentencia($sql);
	}
	function modifica_userend_pass()
	{
		$conexion= new conexion();
		$sql="update userend set password=MD5('".$this->password."') where iduserend=".$this->iduserend;
		$conexion->ejecutar_sentencia($sql);
	}
	function elimina_userend()
	{
		$conexion=new conexion();
		$sql="delete from userend where iduserend=".$this->iduserend;
		return $conexion->ejecutar_sentencia($sql);
	}
	
	function Desactivauserend()
	{
		$con=new conexion();
		$sql="update userend set status=0 where iduserend=".$this->iduserend;
		$con->ejecutar_sentencia($sql);	
	}
	
	function Activauserend()
	{
		$con=new conexion();
		$sql="update userend set status=1 where iduserend=".$this->iduserend;
		$con->ejecutar_sentencia($sql);	
	}

	function ActivaUserendToken($token)
	{
		$con=new conexion();
		$sql="update userend set status=1 where token='".$token."' ";
		$con->ejecutar_sentencia($sql);	
	}
	
	function listauserendActivas()
	{
		$conexion=new conexion();
		$sql="select * from userend where status=1 order by iduserend desc";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['token']=$row['token'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listauserendDesactivadas()
	{
		$conexion=new conexion();
		$sql="select iduserend,correo,password,status,tipouserend from userend where status=0";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['tipouserend']=$row['tipouserend'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function listauserendBusqueda($pedazo)
	{
		$conexion=new conexion();
		$sql="select iduserend,correo,password,status,tipouserend from userend where correo like '%".$pedazo."%' order by status";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['tipouserend']=$row['tipouserend'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	function lista_userend_Ajax()
	{
		$conexion=new conexion();
		$sql="select iduserend,correo,password,status,tipouserend from userend";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['tipouserend']=$row['tipouserend'];
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	function lista_userend()
	{
		$conexion=new conexion();
		$sql="select * from userend order by iduserend desc";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['iduserend']=$row['iduserend'];
			$registro['correo']=$row['correo'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['token']=$row['token'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	
	function obten_userend()
	{
		$conexion=new conexion();
		$sql="select * from userend where iduserend='".$this->iduserend."'";
		$result=$conexion->ejecutar_sentencia($sql);
		while($row=mysqli_fetch_array($result))
		{
			$this->iduserend=$row['iduserend'];
			$this->correo=$row['correo'];
			$this->password=$row['password'];
			$this->status=$row['status'];
			$this->token=$row['token'];
		}
		mysqli_free_result($result);
	}
	
	function disponibilidadCorreo($correo)
	{
		$conexion=new conexion();
		$sql="SELECT correo FROM userend where correo='".$correo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return false;
		}
		else{
			return true;
		}
	}
	function rescueCorreo($correo){
		$con = new conexion();
		$sql = "SELECT iduserend FROM userend WHERE correo='".$correo."' and status=1 ";
		$result = $con->ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($result)){
			$this->iduserend = $fila['iduserend'];
		}
	}
	function errorLogin(){
		$conexion=new conexion();
		$sql="select * from userend where correo='".$this->correo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		while($fila =mysqli_fetch_array($result))
		{
			$this->iduserend=$fila['iduserend'];
			$this->password = $fila['password'];
			$this->status = $fila['status'];
			$this->correo = $fila['correo'];
		}	
	}
	function disponibilidadToken($token){
		$conexion=new conexion();
		$sql="SELECT iduserend FROM userend where token='".$token."' and status = 0";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return true;
		}
		else{
			return false;
		}
	}
	function disponibilidadTokenRepass($token){
		$conexion=new conexion();
		$sql="SELECT iduserend FROM userend where token='".$token."' and status = 1";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			while($row = mysqli_fetch_array($result)){
				$this->iduserend = $row['iduserend'];	
			}
			return true;
		}
		else{
			$this->iduserend = 0;
			return false;
		}
	}

	function login()
	{
		$conexion=new conexion();
		$sql="select * from userend where correo='".$this->correo."'and password = MD5('".$this->password."') and status=1";
		$resultado=$conexion->ejecutar_sentencia($sql);
		while($fila =mysqli_fetch_array($resultado))
		{
			$this->iduserend=$fila['iduserend'];
			$this->correo=$fila['correo'];
		}
	}

/*========================================================================
		SECCION DE LAS OPERACIONES PARA INSERTAR EN DATOSUSEREND.PHP
========================================================================*/
	function insertaDatosUserend($nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo){
		$this -> datosuserend = new datosuserend($this -> iduserend, $nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo);		
		$this -> datosuserend -> insertarDatosUserend();
	}
		
	function modificaDatosUserend($nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo){
		$this -> datosuserend = new datosuserend($this -> iduserend, $nombre, $apellido, $company, $direccion, $ciudad, $postal, $telefono, $tipo);	
		$this -> datosuserend -> modificarDatosUserend();
	}
		
	function eliminaDatosUserend(){
		$this -> datosuserend -> eliminarDatosUserend();
	}
		
	function obteneDatosUserend(){
		$this -> datosuserend -> obtenerDatosUserend();
	}
/*========================================================================
		SECCION DE LAS OPERACIONES PARA INSERTAR EN USERENDDIRECCION.PHP
========================================================================*/
	function insertarDireccion($nombreDireccion,$nombre, $apellido, $telefono, $company, $direccion, $city, $zip, $status){
		$direccionTemporal = new userenddireccion(0,$this->iduserend,$nombreDireccion,$nombre, $apellido, $telefono, $company, $direccion, $city, $zip, $status);
		$direccionTemporal -> agregarDireccion();
	}
	function modificarDireccion($iddireccion, $nombreDireccion,$nombre, $apellido, $telefono, $company, $direccion, $city, $zip, $status){
		$direccionTemporal = new userenddireccion($iddireccion, 0,$nombreDireccion,$nombre, $apellido, $telefono, $company, $direccion, $city, $zip, $status);
		$direccionTemporal -> modificarDireccion();
	}
	function modificarDefault($iddireccion){
		$direccionTemporal = new userenddireccion($iddirecion);
		$direccionTemporal -> defaultDireccion();
	}
	function eliminarDireccion($iddireccion){
		$direccionTemporal = new userenddireccion($iddireccion);
		$direccionTemporal->eliminarDireccion();
	}
	function listarDireccion(){
		$direccionTemporal = new userenddireccion(0,$this->iduserend);
		$this->direcciones = $direccionTemporal->listarDirecciones();
	}
	function obtenerDireccion($iddireccion){
		$this->userendDireccion = new userenddireccion($iddireccion);
		$this->userendDireccion->obtenerDireccion();
	}
}
?>