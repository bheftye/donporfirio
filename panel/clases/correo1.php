<?php
include_once('conexion.php');
require_once('archivo.php');
include_once('correo1img.php');
include_once('correo1img2.php');

class correo1 extends Archivo
{
	var $idcorreo1;
	var $ruta;
	var $titulo;
	var $subtitulo;
	var $desc1;
	var $desc2;
	var $desc3;
	var $correo1img;
	var $correo2img;
	var $directorio ='/home1/locker07/public_html/clientes/panelTemplate/panel/correos/correo1/';
	var $logo;
	var $logo_temporal;
	var $footer = "";
	var $footer_temporal;
	var $from;
	var $fromname;
	var $facebook;
	var $twitter;
	var $instagram;
	var $youtube;
	var $idlista;
	var $linklogo;
	var $nomemp;
	var $color;
	
	function correo1 ($idc1= 0,$rut = '',$tit = '',$subt = '',$desc1 = '',$desc2 = '',$desc3 = '',$temporal='',$logo = "",$logo_temporal = "",$linklogo = "", $nomemp = "" , $color = "", /*$footer = "", $footer_temporal = "",*/ $from = "", $fromname = "", $facebook = "", $twitter = "", $instagram = "", $youtube = "", $idlista = "")
	{
		$this -> idcorreo1 = $idc1;
		if ($rut != '') {
			$this -> ruta = $this -> obtenerExtensionArchivo($rut);
		} else {
			$this -> ruta = '';
		}
		$this -> titulo = $tit;
		$this -> subtitulo = $subt;
		$this -> desc1 = $desc1;
		$this -> desc2 = $desc2;
		$this -> desc3 = $desc3;
		$this -> correo1img = array();
		$this -> correo2img = array();
		$this -> ruta_final = $this -> directorio.$this->ruta;
		$this -> ruta_temporal = $temporal;

		if ($logo != '') {
			$this -> logo = $this -> obtenerExtensionArchivo($logo);
		} else {
			$this -> logo = '';
		}
		$this -> logo_temporal = $logo_temporal;


		/*if ($footer != '') {
			$this -> footer = $this -> obtenerExtensionArchivo($footer);
		} else {
			$this -> footer = '';
		}
		$this -> footer_temporal = $footer_temporal;*/

		$this -> from = $from;
		$this -> fromname = $fromname;
		$this -> facebook = $facebook;
		$this -> twitter = $twitter;
		$this -> instagram = $instagram;
		$this -> youtube = $youtube;
		$this -> idlista = 0;
		if($linklogo == ""){
			$linklogo = "#";
		}
		$this -> linklogo = $linklogo;
		$this -> nomemp = $nomemp;
		if($color == ""){
			$color = "#ffffff";
		}
		$this -> color = $color;

	}
	
	
	
	function insertaCorreo1()
	{
		$sql="insert into correo1 (ruta, titulo, subtitulo, desc1, desc2, desc3, logo, from_email, fromname, facebook , twitter , instagram, youtube, idlista, linklogo, nomemp, color) values 
		('".$this -> ruta."',
		'".$this -> titulo."',
		'".$this -> subtitulo."',
		'".htmlspecialchars($this -> desc1)."',
		'".htmlspecialchars($this -> desc2)."',
		'".htmlspecialchars($this -> desc3)."',
		'".$this -> logo."',
		'".$this -> from."',
		'".$this -> fromname."',
		'".$this -> facebook."',
		'".$this -> twitter."',
		'".$this -> instagram."',
		'".$this -> youtube."',
		'".$this -> idlista."',
		'".$this -> linklogo."',
		'".$this -> nomemp."',
		'".$this -> color."'
		);"; 
		$con= new conexion();
		$this->idcorreo1=$con->ejecutar_sentencia($sql);
		$this->subir_archivo();
		$this -> subir_logo();
	}

	function subir_logo()
	{
		move_uploaded_file($this->logo_temporal,$this->directorio.$this->logo);
	}
	
	function borrar_logo()
	{
		if (is_file($this->directorio.$this->logo))
		{
			unlink($this->directorio.$this->logo);
		}
	}
	
	
	function modificaCorreo1()
	{
		if ($this->ruta!='')
		{
			$titulo_temporal=$this->titulo;
			$ruta_temporal=$this->ruta;
			
			$this->recuperaCorreo1();
			$this->borrar_archivo();
			
			$this->titulo=$titulo_temporal;
			$this->ruta=$ruta_temporal;
			
			$this->ruta_final=$this->directorio.$ruta_temporal;
			$sql=' ruta=\''.$this->ruta.'\',';
		}
		else
		{
			$sql='';
		}

		if($this -> logo != ""){
			$titulo_temporal=$this->titulo;
			$logo_temporal=$this->logo;
			
			$this->recuperaCorreo1();
			$this->borrar_logo();
			
			$this->titulo = $titulo_temporal;
			$this->logo = $logo_temporal;
			
			$sql2=' logo=\''.$this->logo.'\',';
		}
		else
		{
			$sql2='';
		}

		/*if($this -> footer != ""){
			$titulo_temporal=$this->titulo;
			$footer_temporal=$this->footer;
			
			$this->recuperaCorreo1();
			$this->borrar_footer();
			
			$this->titulo = $titulo_temporal;
			$this->footer = $footer_temporal;
			
			$sql3=' footer=\''.$this->footer.'\',';
		}
		else
		{
			$sql3='';
		}*/
		
		// ruta='".$this->ruta."'
		$sql="update correo1 set 
		".$sql."
		".$sql2."
		".$sql3."
		titulo='".$this->titulo."', 
		subtitulo='".$this->subtitulo."', 
		desc1='".htmlspecialchars($this->desc1)."',
		desc2='".htmlspecialchars($this->desc2)."',
		desc3='".htmlspecialchars($this->desc3)."',
		from_email = '".$this -> from."',
		fromname = '".$this -> fromname."',
		facebook = '".$this -> facebook."',
		twitter = '".$this -> twitter."',
		instagram = '".$this -> instagram."',
		youtube = '".$this -> youtube."',
		idlista = '".$this -> idlista."',
		linklogo = '".$this -> linklogo."',
		nomemp = '".$this -> nomemp."',
		color = '".$this -> color."'
		 where idcorreo1=".$this->idcorreo1.";";
		$con= new conexion();
		
		$con->ejecutar_sentencia($sql);
		$this->subir_archivo();
	}
	
	function eliminaCorreo1()
	{
		$this->obtenerCorreo1();
		$this->borrar_archivo();
		$this->borrar_logo();
		
		$sql="delete from correo1 where idcorreo1=".$this->idcorreo1.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}
	
	function obtenerCorreo1()
	{
		$sql="select * from correo1 where idcorreo1=".$this->idcorreo1.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idcorreo1=$fila['idcorreo1'];
			$this->ruta=$fila['ruta'];
			$this->titulo=$fila['titulo'];
			$this->subtitulo=$fila['subtitulo'];
			$this->desc1=htmlspecialchars_decode($fila['desc1']);
			$this->desc2=htmlspecialchars_decode($fila['desc2']);
			$this->desc3=htmlspecialchars_decode($fila['desc3']);
			$this->ruta_final=$this->directorio.$fila['ruta'];
			$this->logo = $fila["logo"];
			$this->footer = $fila["footer"];
			$this -> facebook = $fila["facebook"];
			$this -> twitter = $fila["twitter"];
			$this -> instagram = $fila["instagram"];
			$this -> youtube = $fila["youtube"];
			$this -> fromname = $fila["fromname"];
			$this -> from = $fila["from_email"];
			$this -> idlista = $fila["idlista"];
			$this -> linklogo = $fila["linklogo"];
			$this -> nomemp = $fila["nomemp"];
			$this -> color = $fila["color"];
		}
	}
	
	function recuperaCorreo1()
	{
		$sql="select * from correo1 where idcorreo1=".$this->idcorreo1.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);
		
		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idcorreo1=$fila['idcorreo1'];
			$this->ruta=$fila['ruta'];
			$this->titulo=$fila['titulo'];
			$this->subtitulo=$fila['subtitulo'];
			$this->desc1=htmlspecialchars_decode($fila['desc1']);
			$this->desc2=htmlspecialchars_decode($fila['desc2']);
			$this->desc3=htmlspecialchars_decode($fila['desc3']);
			$this->ruta_final=$this->directorio.$fila['ruta'];
			$this->logo = $fila["logo"];
			$this->footer = $fila["footer"];
			$this -> facebook = $fila["facebook"];
			$this -> twitter = $fila["twitter"];
			$this -> instagram = $fila["instagram"];
			$this -> youtube = $fila["youtube"];
			$this -> fromname = $fila["fromname"];
			$this -> from = $fila["from_email"];
			$this -> idlista = $fila["idlista"];
			$this->ruta_final=$this->directorio.$fila['ruta'];
			$this -> linklogo = $fila["linklogo"];
			$this -> nomemp = $fila["nomemp"];
			$this -> color = $fila["color"];
		}
	}
	
	function listarCorreo1()
	{
		$resultados=array();
		$sql="select * from correo1";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idcorreo1']=$fila['idcorreo1'];
			$registro['ruta']=$fila['ruta'];
			$registro['titulo']=$fila['titulo'];
			$registro['subtitulo']=$fila['subtitulo'];
			$registro['desc1']=htmlspecialchars_decode($fila['desc1']);
			$registro['desc2']=htmlspecialchars_decode($fila['desc2']);
			$registro['desc3']=htmlspecialchars_decode($fila['desc3']);
			$registro['logo'] = $fila["logo"];
			$registro['footer'] = $fila["footer"];
			$registro['facebook'] = $fila["facebook"];
			$registro['twitter'] = $fila["twitter"];
			$registro['instagram'] = $fila["instagram"];
			$registro['youtube'] = $fila["youtube"];
			$registro['fromname'] = $fila["fromname"];
			$registro['from'] = $fila["from_email"];
			$registro['idlista'] = $fila["idlista"];
			$registro["linklogo"] = $fila["linklogo"];
			$registro["nomemp"] = $fila["nomemp"];
			$registro["color"] = $fila["color"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	
	//---------->COMIENZA MAESTRO DETALLE DE IMAGEN2<---------------
		
		function listarCorreo1img()
		{
			$imagencorreo1=new correo1img(0,$this->idcorreo1,'','','');
			$this->correo1img=$imagencorreo1->listarCorreo1img();
		}
	
		//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);	
		function insertarCorreo1img($tit,$rut,$temporal)
		{
			$imagencorreo1=new correo1img(0,$this->idcorreo1,$rut,$tit,$temporal);
			$imagencorreo1->insertaCorreo1img();
		}
		//$producto_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
		function modificarCorreo1img($id,$tit,$rut,$temporal)
		{
			$imagencorreo1=new correo1img($id,$this->idcorreo1,$rut,$tit,$temporal);
			$imagencorreo1->modificaCorreo1img();
		}
		
		function eliminarCorreo1img($id)
		{
			$imagencorreo1=new correo1img($id,$this->idcorreo1,'','','');
			$imagencorreo1->eliminaCorreo1img();
		}
		
		function obtenerCorreo1img($id)
		{
			$imagencorreo1=new correo1img($id,$this->idcorreo1,'','','');
			$imagencorreo1->obtenerCorreo1img();
			return $imagencorreo1;
		}
		
		//---------->COMIENZA MAESTRO DETALLE DE IMAGEN3<---------------
		
		function listarCorreo1img2()
		{
			$imagencorreo2=new correo1img2(0,$this->idcorreo1,'','','');
			$this->correo2img=$imagencorreo2->listarCorreo1img2();
		}
	
		//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);	
		function insertarCorreo1img2($tit,$rut,$temporal)
		{
			$imagencorreo2=new correo1img2(0,$this->idcorreo1,$rut,$tit,$temporal);
			$imagencorreo2->insertaCorreo1img2();
		}
		//$producto_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
		function modificarCorreo1img2($id,$tit,$rut,$temporal)
		{
			$imagencorreo2=new correo1img2($id,$this->idcorreo1,$rut,$tit,$temporal);
			$imagencorreo2->modificaCorreo1img2();
		}
		
		function eliminarCorreo1img2($id)
		{
			$imagencorreo2=new correo1img2($id,$this->idcorreo1,'','','');
			$imagencorreo2->eliminaCorreo1img2();
		}
	
}
?>