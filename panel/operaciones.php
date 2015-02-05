<?php
/*
 * @Author: Luis Josué Caamal Barbosa.
 * @Description: Este script controla todas las operaciones del sistema.
 * @Copyright: Locker Agencia Creativa.
*/
session_start();
function __autoload($nombre_clase) {
	//$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}

$operaciones=$_REQUEST['operaciones'];
switch($operaciones){
	case 'ordenar':
		if($_REQUEST['desde'] == 'slide'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$slide = new slide($val2[$i]);
				$slide -> ordenaSlide($i);
				
			}		
		}
		if($_REQUEST['desde'] == 'proyecto'){
			$val = ($_REQUEST['idorden']);
			for($i=0; $i < count($val); $i++)
			{
				$proyecto = new proyecto($val[$i]);
				$proyecto -> ordenar_proyecto($i);
				
			}
		}	
		if($_REQUEST['desde'] == 'video_slide'){
			$val = ($_REQUEST['idorden']);
			for($i=0; $i < count($val); $i++)
			{
				$video_slide = new video_slide($val[$i]);
				$video_slide -> ordenar_video_slide($i);
				
			}
		}	
		if($_REQUEST['desde'] == 'imgproyecto'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$proyecto = new proyecto();
				$proyecto -> ordenar_img_secundarias_proyecto($i,$val2[$i]);
								
				
			}			
		}
		if($_REQUEST['desde'] == 'secundarias'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$proyecto = new proyectos();
				$proyecto -> ordenarProyectoimg($val2[$i],$i);
				
			}			
		}
		if($_REQUEST['desde'] == 'categoria'){
			$val = ($_REQUEST['idorden']);
			for($i=0; $i < count($val); $i++)
			{
				$categoria = new categoria($val[$i]);
				$categoria -> ordenar_categoria($i);
				
			}
		}
		if($_REQUEST['desde'] == 'links_videos'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$proyecto = new proyecto();
				$proyecto -> ordenar_link_video($val2[$i],$i);
				
			}		
		}
	break;
	case 'listaprueba':
		$dr = new userend();
		$l = $dr->listaTodos();
		print_r($l);
	break;
	case 'modificarcontacto':
		$contacto = new contacto($_REQUEST['idcontacto'],$_REQUEST['correo'],$_REQUEST['emisor']);
		$contacto->modificar_contacto();
		header('location: formcontacto.php?success=2');
	break;
	
	/***********REDES SOCIALES***************/
	case 'modificar_redes_sociales':
		$facebook = (isset($_REQUEST['facebook']))? $_REQUEST['facebook'] : "";
		$twitter = (isset($_REQUEST['twitter']))? $_REQUEST['twitter'] : "";
		$vimeo = (isset($_REQUEST['vimeo']))? $_REQUEST['vimeo'] : "";
		$behance = (isset($_REQUEST['behance']))? $_REQUEST['behance'] : "";

		$redes_sociales = new redes_sociales(1, $facebook, $twitter, $vimeo, $behance);
		$redes_sociales -> modificar_redes_sociales();
		header('location: formredsocial.php?success=2');
	break;
	/***********REDES SOCIALES***************/

	/***********META TAGS***************/
	case 'modificar_meta_tags':
		$meta_titulo = (isset($_REQUEST['meta_titulo']))? $_REQUEST['meta_titulo'] : "";
		$meta_descripcion = (isset($_REQUEST['meta_descripcion']))? $_REQUEST['meta_descripcion'] : "";
		$meta_empresa = (isset($_REQUEST['meta_empresa']))? $_REQUEST['meta_empresa'] : "";

		$metas = new metas(1, $meta_titulo, $meta_descripcion, $meta_empresa);
		$metas -> modificar_metas();

		if (isset($_FILES['archivo2']['name'][0])) {
				if ($_FILES['archivo2']['name'][0]!=''){
			 		$tot3 = count($_FILES["archivo2"]["size"]);
	         		for ($i = 0; $i < $tot3; $i++){
	         			$extension=$_FILES['archivo2']['name'][$i];
	         			$name = $metas -> obtenerExtensionArchivo($extension); 
	            		$tmp_name = $_FILES["archivo2"]["tmp_name"][$i]; 
	            		$metas -> insertar_img_secundaria_metas("",$name,$tmp_name);       
	            	}
				}
			}

			if(isset($_FILES['archivo3']['name'])){
				$tot3 = count($_FILES['archivo3']['name']);
				for($i = 0; $i < $tot3; $i++){
					if ($_FILES['archivo3']['error'][$i] == 0 and $_FILES['archivo3']['name'][$i] != ''){
						$extension=$_FILES['archivo3']['name'][$i];
		         		$name = $metas->obtenerExtensionArchivo($extension); 
		            	$tmp_name = $_FILES["archivo3"]["tmp_name"][$i]; 
		            	$metas -> modificar_img_secundaria_metas($_REQUEST['id_imagen'][$i],"", $name, $tmp_name);  
					}			
				}	
			}    

		header('location: formmetas.php?success=2');
	break;
	/***********META TAGS***************/

	
	/**********************************************************
	* Procesos de Usuarios
	**********************************************************/
	case 'agregarusuario':
			$usuario= new usuario($_REQUEST['idusuario'], $_REQUEST['nomuser'], $_REQUEST['pass'],$_REQUEST['status'],$_REQUEST['tipo']);
			$usuario->inserta_usuario();
			$usuario->insertar_datos_usuario($_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['telefono']);
			header('Location: listusuarios.php');
	break;
	case 'modificarusuario':
			if($_REQUEST['nameuser'] == 'nameuser'){
				$nameuser=$_REQUEST['nomuser'];
			}
			else{
				$nameuser='';
			}
			if($_REQUEST['contra'] == 'pass'){
				$pass = $_REQUEST['pass'];
			}
			else{
				$pass='';
			}
			$usuario= new usuario($_REQUEST['idusuario'], $nameuser, $pass, $_REQUEST['status'],$_REQUEST['tipo']);
			$usuario->modifica_usuario();
			$usuario->modificar_datos_usuario($_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['telefono']);
			header('Location: listusuarios.php');
	break;
	case 'operausuario':
			if(isset($_REQUEST['idusuario'])){
				$select=$_REQUEST['operador'];
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario ->eliminar_datos_usuario();
						$usuario->elimina_usuario();
					}
					header('location: listusuarios.php');
				}
				if ($select == 'Mostrar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario -> ActivaUsuario();
					}
					header('location: listusuarios.php');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario->DesactivaUsuario();
					}
					header('location: listusuarios.php');
				}					
			}
			else {
				header('location: listusuarios.php');
			}	
	break;
	case 'activausuario':
			$usuario= new usuario($_REQUEST['id']);
			$usuario->ActivaUsuario();
	break;
	case 'desactivausuario':
			$usuario= new usuario($_REQUEST['id']);
			$usuario->DesactivaUsuario();
	break;
	case 'buscarusuario':
			$usuario= new usuario();
			$usuario->listaUsuarioBusqueda($_REQUEST['cadena']);
	break;
	case 'listausuario':
			$usuario= new usuario();
			$usuario->lista_usuario_Ajax();
	break;
	case 'agregartipousuario':
			$tipousuario= new tipousuario($_REQUEST['idtipousuario'],$_REQUEST['titulo'],$_REQUEST['status']);
			$tipousuario->insertar_tipousuario();
			$idtipousuario=$tipousuario->idtipousuario;
			if(isset($_REQUEST['idpermiso']))
			{
				$tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
				$tipousuarioxpermiso->idtipousuario=$idtipousuario;
				$tipousuarioxpermiso->desasigna_permiso_rol();

				foreach($_REQUEST['idpermiso'] as $elementoPermiso)
				{
					$tipousuarioxpermiso->idpermiso=$elementoPermiso;
					$tipousuarioxpermiso->asigna_permiso_rol();
				}	
			}
		header('location:listtipousuario.php');
	break;
	case 'modificartipousuario':
		$tipousuario=new tipousuario($_REQUEST['idtipousuario'],$_REQUEST['titulo'],$_REQUEST['status']);
		$tipousuario->modificar_tipousuario();
		if(isset($_REQUEST['idpermiso']))
		{
			$tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
			$tipousuarioxpermiso->idtipousuario=$_REQUEST['idtipousuario'];
			$tipousuarioxpermiso->desasigna_permiso_rol();
		
			foreach($_REQUEST['idpermiso'] as $elementoPermiso)
			{
				$tipousuarioxpermiso->idpermiso=$elementoPermiso;
				$tipousuarioxpermiso->asigna_permiso_rol();
			}	
		}
		else
		{
			$tipousuarioxpermiso = new tiposusuarioxpermiso();
			$tipousuarioxpermiso->idtipousuario=$_REQUEST['idtipousuario'];
			$tipousuarioxpermiso->desasigna_permiso_rol();
		
			foreach($_REQUEST['idpermiso'] as $elementoPermiso)
			{
				$tipousuarioxpermiso->idpermiso=$elementoPermiso;
				$tipousuarioxpermiso->asigna_permiso_rol();
			}	
		}
		header('location:listtipousuario.php');
	break;
	case 'operatipousuario':
			if(isset($_REQUEST['idtipousuario'])){
				$select=$_REQUEST['operador'];
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuarioxpermiso = new tiposusuarioxpermiso($elementoUsuario);
						$tipousuarioxpermiso->desasigna_permiso_rol();
						$tipousuario->elimina_Tipousuario();
					}
					header('location: listtipousuario.php');
				}
				
				if ($select == 'Mostrar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);						
						$tipousuario->ActivaTipousuario();
					}
					header('location: listtipousuario.php');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);						
						$tipousuario -> DesactivaTipousuario();
					}
					header('location: listtipousuario.php');
				}				
			}
			else {
				header('location: listtipousuario.php');
			}	
	break;
	case 'activatipoU':
			$tipousuario= new tipousuario($_REQUEST['id']);
			$tipousuario->ActivaTipousuario();
	break;
	case 'desactivatipoU':
			$tipousuario= new tipousuario($_REQUEST['id']);
			$tipousuario->DesactivaTipousuario();
	break;
	case 'buscartipousuario':
			$tipousuario= new tipousuario();
			$tipousuario->listaTipousuarioBusqueda($_REQUEST['cadena']);
	break;
	case 'listatipousuario':
			$tipousuario= new tipousuario();
			$tipousuario->listado_tipousuarioAjax();
	break;
 	case 'agregarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'],$_REQUEST['status']);
			$permiso->insertar_permiso();
			header('Location: listpermisos.php');
	break;
	case 'modificarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'],$_REQUEST['status']);
			$permiso->modificar_permiso();
			header('Location: listpermisos.php');
	break;  
	case 'verificarusuario':
			if($_REQUEST['username']!=''){
				$total=0;
				$username = $_REQUEST['username'];
				$usuario= new usuario(0,$username,'','','');
				$verificar=$usuario->VerficarDisponibilidadNomUsuario($username);
				$total=count($verificar);
		
				if($total != 0)
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Este usuario ya existe o es su actual nombre de usuario, para poder continuar intente con otro nombre.</div>';
				else
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Bien hecho!</strong> Nombre de usuario disponible.</div>';
			}
			else
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Se requiere de este campo para poder continuar.</div>';
	break;
	case 'ingresar':
			$user=new usuario(0,$_REQUEST['usuario'],$_REQUEST['pass'],0,0);
			$user->login();
			
			if($user->idusuario!=0){
				session_start();
				$_SESSION['idusuario']=$user->idusuario;
				header('Location:listproyecto.php');
			}
			
			else{
				session_start();
				if(isset($_SESSION['idusuario']));
				session_destroy();
				header('Location:index.php?success=0');
			}
	break;
	case 'recuperapass':
			if($_REQUEST['email']!='')
			{
				$usuario = new usuario();
				$usuario->datosusuario->email=$_REQUEST['email'];
				$lista = $usuario->datosusuario->buscaremail();
				$total = count($lista);
				if($total > 0)
				{
					foreach($lista as $elementoCliente)
					{
						$idusuario = $elementoCliente['idusuario']; 
						$correoRecu= new correoRecuperacion($idusuario);
						$correoRecu->enviar();
						echo 2;
					}
				}
				else
					echo 1;
			}
			else
				echo 0;
	break;
	case 'cerrarsesion':
			//session_start();
			if(isset($_SESSION['idusuario']));
			session_destroy();
			echo 1;
	break;
	/*------------------------------------------------------------------------
	SECCIÓN PARA LAS OPERACIONES DE PROYECTOS
	-------------------------------------------------------------------------*/	
	case 'agregar_proyecto':
		$titulo_esp = (isset($_REQUEST['titulo_esp']))? $_REQUEST['titulo_esp'] : "";
		$titulo_eng = (isset($_REQUEST['titulo_eng']))? $_REQUEST['titulo_eng'] : "";

		$descripcion_esp = (isset($_REQUEST['descripcion_esp']))? htmlspecialchars($_REQUEST['descripcion_esp'], ENT_QUOTES) : "";
		$descripcion_eng = (isset($_REQUEST['descripcion_eng']))? htmlspecialchars($_REQUEST['descripcion_eng'], ENT_QUOTES) : "";

		$subtitulo_esp = (isset($_REQUEST['subtitulo_esp']))? htmlspecialchars($_REQUEST['subtitulo_esp'], ENT_QUOTES) : "";
		$subtitulo_eng = (isset($_REQUEST['subtitulo_eng']))? htmlspecialchars($_REQUEST['subtitulo_eng'], ENT_QUOTES) : "";

		$behance =  (isset($_REQUEST['behance']))? htmlspecialchars($_REQUEST['behance'], ENT_QUOTES) : "";

		$meta_titulo_esp = (isset($_REQUEST['meta_titulo_esp']) && $_REQUEST['meta_titulo_esp'] != "")? $_REQUEST['meta_titulo_esp'] : $titulo_esp;
		$meta_descripcion_esp = (isset($_REQUEST['meta_descripcion_esp']) && $_REQUEST['meta_descripcion_esp'] != "")? htmlspecialchars($_REQUEST['meta_descripcion_esp'], ENT_QUOTES) : substr($descripcion_esp, 0,160);

		$meta_titulo_eng = (isset($_REQUEST['meta_titulo_eng']) && $_REQUEST['meta_titulo_eng'] != "")? $_REQUEST['meta_titulo_eng'] : $titulo_eng;
		$meta_descripcion_eng = (isset($_REQUEST['meta_descripcion_eng']) && $_REQUEST['meta_descripcion_eng'] != "")? htmlspecialchars($_REQUEST['meta_descripcion_eng'], ENT_QUOTES) : substr($descripcion_eng, 0,160);

		$categorias = (isset($_REQUEST['categorias']))? $_REQUEST['categorias'] : array();
		$links_videos = (isset($_REQUEST['links_videos']))? $_REQUEST['links_videos'] : array();


		if(isset($_FILES['archivo']['name']))
		{
			$img_principal = $_FILES['archivo']['name'];
			$img_principal_temporal = $_FILES['archivo']['tmp_name'];
		}
		else
		{
			$img_principal = '';
			$img_principal_temporal = '';
		}

		if(isset($_FILES['archivo_video']['name']))
		{
			$nombre_video = $_FILES['archivo_video']['name'];
			$nombre_video_temporal = $_FILES['archivo_video']['tmp_name'];
		}
		else
		{
			$nombre_video = '';
			$nombre_video_temporal = '';
		}

		if(isset($_FILES['archivo_preview']['name']))
		{
			$nombre_preview = $_FILES['archivo_preview']['name'];
			$nombre_preview_temporal = $_FILES['archivo_preview']['tmp_name'];
		}
		else
		{
			$nombre_preview = '';
			$nombre_preview_temporal = '';
		}
		$nombre_video_hd = (isset($_REQUEST['nombre_video_hd']))? $_REQUEST['nombre_video_hd'] : "";
		
	 				    
		//	function proyecto($id_proyecto = 0, $img_principal = '', $ruta_temporal = '',$nombre_video = "", $ruta_temporal2 = "", $nombre_preview = "", $ruta_temporal3 = "", $titulo_esp = '',$titulo_eng = '',$subtitulo_esp = '',$subtitulo_eng = '', $descripcion_esp = '', $descripcion_eng = '', $behance = "",$url_amigable = '', $meta_titulo_esp = "", $meta_descripcion_esp = "", $meta_titulo_eng = "", $meta_descripcion_eng = "", $mostrar = 0, $status = 1) 

		$proyecto = new proyecto(0, $img_principal, $img_principal_temporal, $nombre_video, $nombre_video_temporal, $nombre_preview, $nombre_preview_temporal, $nombre_video_hd, $titulo_esp, $titulo_eng ,$subtitulo_esp, $subtitulo_eng, $descripcion_esp, $descripcion_eng, $behance, $titulo_esp, $meta_titulo_esp, $meta_descripcion_esp, $meta_titulo_eng, $meta_descripcion_eng);
		$proyecto -> insertar_proyecto();
		if ($proyecto -> id_proyecto == 'error'){
			$success = 0;
		}
		else{
			$success = 1;
			if (isset($_FILES['archivo2']['name'][0])) {
				if ($_FILES['archivo2']['name'][0]!=''){
			 		$tot3 = count($_FILES["archivo2"]["size"]);
	         		for ($i = 0; $i < $tot3; $i++){
	         			$extension=$_FILES['archivo2']['name'][$i];
	         			$name = $proyecto -> obtenerExtensionArchivo($extension); 
	            		$tmp_name = $_FILES["archivo2"]["tmp_name"][$i]; 
	            		$proyecto -> insertar_img_secundaria_proyecto("",$name,$tmp_name);       
	            	} 
				}
			}

			foreach ($links_videos as $link_video) {
				$proyecto -> insertar_link_video($link_video);
			}

			foreach ($categorias as $id_categoria) {
				$proyecto -> asociar_proyecto_con_categoria($id_categoria);
			}
		}

		header('location: listproyecto.php?success='.$success);
	break;
	case 'modificar_proyecto':
		$id_proyecto = (isset($_REQUEST['id_proyecto']))? $_REQUEST['id_proyecto'] : 0;

		$titulo_esp = (isset($_REQUEST['titulo_esp']))? $_REQUEST['titulo_esp'] : "";
		$titulo_eng = (isset($_REQUEST['titulo_eng']))? $_REQUEST['titulo_eng'] : "";

		$descripcion_esp = (isset($_REQUEST['descripcion_esp']))? htmlspecialchars($_REQUEST['descripcion_esp'], ENT_QUOTES) : "";
		$descripcion_eng = (isset($_REQUEST['descripcion_eng']))? htmlspecialchars($_REQUEST['descripcion_eng'], ENT_QUOTES) : "";

		$subtitulo_esp = (isset($_REQUEST['subtitulo_esp']))? htmlspecialchars($_REQUEST['subtitulo_esp'], ENT_QUOTES) : "";
		$subtitulo_eng = (isset($_REQUEST['subtitulo_eng']))? htmlspecialchars($_REQUEST['subtitulo_eng'], ENT_QUOTES) : "";

		$behance =  (isset($_REQUEST['behance']))? htmlspecialchars($_REQUEST['behance'], ENT_QUOTES) : "";

		$meta_titulo_esp = (isset($_REQUEST['meta_titulo_esp']) && $_REQUEST['meta_titulo_esp'] != "")? $_REQUEST['meta_titulo_esp'] : $titulo_esp;
		$meta_descripcion_esp = (isset($_REQUEST['meta_descripcion_esp']) && $_REQUEST['meta_descripcion_esp'] != "")? htmlspecialchars($_REQUEST['meta_descripcion_esp'], ENT_QUOTES) : substr($descripcion_esp, 0,160);

		$meta_titulo_eng = (isset($_REQUEST['meta_titulo_eng']) && $_REQUEST['meta_titulo_eng'] != "")? $_REQUEST['meta_titulo_eng'] : $titulo_eng;
		$meta_descripcion_eng = (isset($_REQUEST['meta_descripcion_eng']) && $_REQUEST['meta_descripcion_eng'] != "")? htmlspecialchars($_REQUEST['meta_descripcion_eng'], ENT_QUOTES) : substr($descripcion_eng, 0,160);

		$categorias = (isset($_REQUEST['categorias']))? $_REQUEST['categorias'] : array();
		$links_videos = (isset($_REQUEST['links_videos']))? $_REQUEST['links_videos'] : array();


		if(isset($_FILES['archivo']['name']))
		{
			$img_principal = $_FILES['archivo']['name'];
			$img_principal_temporal = $_FILES['archivo']['tmp_name'];
		}
		else
		{
			$img_principal = '';
			$img_principal_temporal = '';
		}

		if(isset($_FILES['archivo_video']['name']))
		{
			$nombre_video = $_FILES['archivo_video']['name'];
			$nombre_video_temporal = $_FILES['archivo_video']['tmp_name'];
		}
		else
		{
			$nombre_video = '';
			$nombre_video_temporal = '';
		}

		if(isset($_FILES['archivo_preview']['name']))
		{
			$nombre_preview = $_FILES['archivo_preview']['name'];
			$nombre_preview_temporal = $_FILES['archivo_preview']['tmp_name'];
		}
		else
		{
			$nombre_preview = '';
			$nombre_preview_temporal = '';
		}

		$nombre_video_hd = (isset($_REQUEST['nombre_video_hd']))? $_REQUEST['nombre_video_hd'] : "";
		

		$proyecto = new proyecto($id_proyecto, $img_principal, $img_principal_temporal, $nombre_video, $nombre_video_temporal, $nombre_preview, $nombre_preview_temporal, $nombre_video_hd, $titulo_esp, $titulo_eng ,$subtitulo_esp, $subtitulo_eng, $descripcion_esp, $descripcion_eng, $behance, $titulo_esp, $meta_titulo_esp, $meta_descripcion_esp, $meta_titulo_eng, $meta_descripcion_eng);
		
		if($proyecto -> id_proyecto != 0){
			$proyecto -> modificar_proyecto();
		
			if (isset($_FILES['archivo2']['name'][0])) {
				if ($_FILES['archivo2']['name'][0]!=''){
			 		$tot3 = count($_FILES["archivo2"]["size"]);
	         		for ($i = 0; $i < $tot3; $i++){
	         			$extension=$_FILES['archivo2']['name'][$i];
	         			$name = $proyecto -> obtenerExtensionArchivo($extension); 
			 			$titulo=$_REQUEST['titulo'];
	            		$tmp_name = $_FILES["archivo2"]["tmp_name"][$i]; 
	            		$proyecto -> insertar_img_secundaria_proyecto("",$name,$tmp_name);       
	            	}
				}
			}

			if(isset($_FILES['archivo3']['name'])){
				$tot3 = count($_FILES['archivo3']['name']);
				for($i = 0; $i < $tot3; $i++){
					if ($_FILES['archivo3']['error'][$i] == 0 and $_FILES['archivo3']['name'][$i] != ''){
						$extension=$_FILES['archivo3']['name'][$i];
		         		$name = $proyecto->obtenerExtensionArchivo($extension); 
				 		$titulo = $_REQUEST['titulo'];
		            	$tmp_name = $_FILES["archivo3"]["tmp_name"][$i]; 
		            	$proyecto -> modificar_img_secundaria_proyecto($_REQUEST['id_img_proyecto'][$i], $titulo, $name, $tmp_name);  
					}			
				}	
			}

			foreach ($links_videos as $link_video) {
				$proyecto -> insertar_link_video($link_video);
			}

			$proyecto -> eliminar_asociasiones_proyecto_con_categoria();
			foreach ($categorias as $id_categoria) {
				$proyecto -> asociar_proyecto_con_categoria($id_categoria);
			}

			header('location: listproyecto.php?success=2');
		}
		else{
			header('location: listproyecto.php?success=0');
		}
		
		break;
		case 'eliminar_img_proyecto':
			$id_imagen = (isset($_REQUEST['idImg2']))? $_REQUEST["idImg2"]: 0;
			if($id_imagen != 0){
				$proyecto = new proyecto();
				$proyecto->eliminar_img_secundaria_proyecto($id_imagen);
				echo "true";
			}
			else{
				echo "false";
			}
			
		break;
		case 'eliminar_link_video':
			$id_link = (isset($_REQUEST['id']))? $_REQUEST["id"]: 0;
			if($id_link != 0){
				$proyecto = new proyecto();
				$proyecto->eliminar_link_video($id_link);
				echo "true";
			}
			else{
				echo "false";
			}
			
		break;

		case 'operaproyecto':
			if(isset($_REQUEST['id_proyecto'])){
				$select=$_REQUEST['operador'];
				$imgp=0;
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['id_proyecto'] as $elemento_proyecto) {
						$proyecto = new proyecto();
						$proyecto -> id_proyecto = $elemento_proyecto;
						$proyecto->listar_img_secundarias_proyecto();
						foreach ($proyecto -> lista_imagenes_secundarias as $elementoImgP) {
							$id_imagen = $elementoImgP['id_img_proyecto'];
							$proyecto -> eliminar_img_secundaria_proyecto($id_imagen);
							$imgp ++;
						}
						$proyecto->eliminar_proyecto();
					}
					header('location: listproyecto.php?success=3&imgp='.$imgp);
				}
				if ($select == 'Mostrar'){
					foreach ($_REQUEST['id_proyecto'] as $elemento) {
						$proyecto = new proyecto();
						$proyecto -> id_proyecto = $elemento;						
						$proyecto -> activar_proyecto();
					}
					header('location: listproyecto.php?success=4');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['id_proyecto'] as $elemento) {
						$proyecto = new proyecto();
						$proyecto -> id_proyecto = $elemento;						
						$proyecto -> desactivar_proyecto();
					}
					header('location: listproyecto.php?success=5');
				}			
			}
			else {
				header('location: listproyecto.php');
			}
		break;
		case 'activar_proyecto':
			 $proyecto = new proyecto();
			 $proyecto -> id_proyecto = $_REQUEST['id'];
			 $proyecto -> activar_proyecto();
		break;
		case 'desactivar_proyecto':
			 $proyecto = new proyecto();
			 $proyecto -> id_proyecto = $_REQUEST['id'];
			 $proyecto -> desactivar_proyecto();
		break;
		case 'buscar_producto':
			 $producto = new producto();
			 $producto -> buscar_producto($_REQUEST['cadena']);
		break;
		case 'listar_productos':
			 $producto = new producto();
			 $producto -> listar_productos();
		break;
		case 'listar_productos_por_pagina':
			$producto = new producto();
			$producto->listar_productos_por_ajax($_REQUEST['paginaactual']);
		break;
/**********TERMINAN LAS OPERACIONES DE PRODCUTOS***********/
/**********************************************************/
//COMIENZAN LAS OPERACIONES DE CATEGORIA
		case 'agregar_categoria':
			$nombre_esp = (isset($_REQUEST['nombre_esp']))? $_REQUEST['nombre_esp'] : "";
			$nombre_eng = (isset($_REQUEST['nombre_eng']))? $_REQUEST['nombre_eng'] : "";
	
			$categoria = new categoria(0, $nombre_esp, $nombre_eng);
			$categoria -> insertar_categoria();    
			header('location: listcategoria.php');
		break;
		case 'modificar_categoria':
			$id_categoria = (isset($_REQUEST['id_categoria']))? $_REQUEST['id_categoria'] : "";
			$nombre_esp = (isset($_REQUEST['nombre_esp']))? $_REQUEST['nombre_esp'] : "";
			$nombre_eng = (isset($_REQUEST['nombre_eng']))? $_REQUEST['nombre_eng'] : "";
	
			$categoria = new categoria($id_categoria, $nombre_esp, $nombre_eng);
			$categoria -> modificar_categoria();    
			header('location: listcategoria.php');
		break;
		case 'operacategoria':
			if(isset($_REQUEST['id_categoria'])){
				$select=$_REQUEST['operador'];
				$imgp=0;
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['id_categoria'] as $elemento_proyecto) {
						$categoria = new categoria();
						$categoria -> id_categoria = $elemento_proyecto;
						$categoria->eliminar_categoria();
					}
					header('location: listcategoria.php?success=3');
				}
				if ($select == 'Mostrar'){
					foreach ($_REQUEST['id_categoria'] as $elemento) {
						$categoria = new categoria();
						$categoria -> id_categoria = $elemento;						
						$categoria -> activar_categoria();
					}
					header('location: listcategoria.php?success=4');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['id_categoria'] as $elemento) {
						$categoria = new categoria();
						$categoria -> id_categoria = $elemento;						
						$categoria -> desactivar_categoria();
					}
					header('location: listcategoria.php?success=5');
				}			
			}
			else {
				header('location: listcategoria.php');
			}
		break;
		case 'activar_categoria':
			 $categoria = new categoria();
			 $categoria -> id_categoria = $_REQUEST['id'];
			 $categoria -> activar_categoria();
		break;
		case 'desactivar_categoria':
			 $categoria = new categoria();
			 $categoria -> id_categoria = $_REQUEST['id'];
			 $categoria -> desactivar_categoria();
		break;

//COMIENZAN LAS OPERACIONES DE CATEGORIA

//COMIENZAN LAS OPERACIONES DE SLIDE
		
		case 'modificar_video_slide':
			if(isset($_FILES['archivo']['name'])){
				$nameP = $_FILES['archivo']['name'];
				$tmpnameP = $_FILES['archivo']['tmp_name'];
			}
				
			else{
				$nameP = "";
				$tmpnameP = "";
			}

			if(isset($_FILES['archivo_hd']['name'])){
				$nameP_hd = $_FILES['archivo_hd']['name'];
				$tmpnameP_hd = $_FILES['archivo_hd']['tmp_name'];
			}
				
			else{
				$nameP_hd = "";
				$tmpnameP_hd = "";
			}

	
			$video_slide = new video_slide(1,$_REQUEST['link_vimeo'], $nameP, $tmpnameP, $nameP_hd, $tmpnameP_hd ,$_REQUEST['titulo_video']);
			$video_slide -> modificar_video_slide();

			if (isset($_FILES['archivo2']['name'][0])) {
				if ($_FILES['archivo2']['name'][0]!=''){
			 		$tot3 = count($_FILES["archivo2"]["size"]);
	         		for ($i = 0; $i < $tot3; $i++){
	         			$extension=$_FILES['archivo2']['name'][$i];
	         			$name = $video_slide -> obtenerExtensionArchivo($extension); 
	            		$tmp_name = $_FILES["archivo2"]["tmp_name"][$i]; 
	            		$video_slide -> insertar_img_secundaria_inicio($name,$tmp_name);       
	            	}
				}
			}

			if(isset($_FILES['archivo3']['name'])){
				$tot3 = count($_FILES['archivo3']['name']);
				for($i = 0; $i < $tot3; $i++){
					if ($_FILES['archivo3']['error'][$i] == 0 and $_FILES['archivo3']['name'][$i] != ''){
						$extension=$_FILES['archivo3']['name'][$i];
		         		$name = $video_slide->obtenerExtensionArchivo($extension); 
		            	$tmp_name = $_FILES["archivo3"]["tmp_name"][$i]; 
		            	$video_slide -> modificar_img_secundaria_inicio($_REQUEST['id_imagen'][$i], $name, $tmp_name);  
					}			
				}	
			}    
			header('location: formvideoslide.php');
			break;
			case 'eliminar_img_inicio':
				$id_imagen = (isset($_REQUEST['idImg2']))? $_REQUEST["idImg2"]: 0;
				if($id_imagen != 0){
					$video_slide = new video_slide();
					$video_slide->eliminar_img_secundaria_inicio($id_imagen);
					echo "true";
				}
				else{
					echo "false";
				}
			
			break;

			/******Operaciones de Boletin******/
			case "agregarboletin":
				if(isset($_REQUEST["correo"]) && $_REQUEST["correo"] != ""){
					$correo = $_REQUEST["correo"];
					$boletin = new boletin();
					$boletin -> correo = $correo;
					$boletin -> insertarBoletin();
					header('location: listboletin.php?success=1');
				}
				else{
					header('location: listboletin.php?success=0');
				}
			break;
			case "modificarboletin":
				if(isset($_REQUEST["idboletin"]) && $_REQUEST["idboletin"] != "" && $_REQUEST["idboletin"] != 0 && isset($_REQUEST["correo"]) && $_REQUEST["correo"] != ""){
					$idBoletin = $_REQUEST["idboletin"];
					$correo = $_REQUEST["correo"];
					$status = $_REQUEST["status"];
					$boletin = new boletin($idBoletin);
					$boletin -> correo = $correo;
					$boletin -> status = $status;
					$boletin -> modificarBoletin();
					header('location: listboletin.php?success=2');
				}
				else{
					header('location: listboletin.php?success=0');
				}
			break;
			case "eliminarboletin":
				if(isset($_REQUEST["idboletin"]) && $_REQUEST["idboletin"] != "" && $_REQUEST["idboletin"] != 0){
					$idBoletin = $_REQUEST["idboletin"];
					$boletin = new boletin($idBoletin);
					$boletin -> eliminarBoletin();
					header('location: listboletin.php?success=3');
				}
				else{
					header('location: listboletin.php?success=0');
				}
			break;
			case "activarboletin":
				if(isset($_REQUEST["id"]) && $_REQUEST["id"] != "" && $_REQUEST["id"] != 0){
					$idBoletin = $_REQUEST["id"];
					$boletin = new boletin($idBoletin);
					$boletin -> activarBoletin();
				}
			break;
			case "desactivarboletin":
				if(isset($_REQUEST["id"]) && $_REQUEST["id"] != "" && $_REQUEST["id"] != 0){
					$idBoletin = $_REQUEST["id"];
					$boletin = new boletin($idBoletin);
					$boletin -> desactivarBoletin();
				}
			break;
			case 'operaboletin':
				if(isset($_REQUEST['idboletin'])){
					$select=$_REQUEST['operador'];
					$imgp=0;
					if ($select == 'Eliminar'){
						foreach ($_REQUEST['idboletin'] as $elementoSlide) {
							$boletin = new boletin();
							$boletin -> idBoletin = $elementoSlide;
							$boletin->eliminarBoletin();
						}
						header('location: listboletin.php?success=3');
					}
					if ($select == 'Activar'){
						foreach ($_REQUEST['idboletin'] as $elemento) {
							$boletin = new boletin();
							$boletin -> idBoletin = $elemento;						
							$boletin -> activarBoletin();
						}
						header('location: listboletin.php?success=4');
					}
					if ($select == 'Desactivar'){
						foreach ($_REQUEST['idslide'] as $elemento) {
							$boletin = new boletin();
							$boletin -> idBoletin = $elemento;						
							$boletin -> desactivarBoletin();
						}
						header('location: listboletin.php?success=5');
					}			
				}
				else {
					header('location: listboletin.php?success=0');
				}
			break;
			/******Operaciones de Boletin******/
			/******Mailing*********/
			case "obtenerprogresomailing":
				if(isset($_REQUEST["idmailing"]) && $_REQUEST["idmailing"] != 0 ){
					$progresoMailing = new ProgresoMailing($_REQUEST["idmailing"]);
					$progresoMailing -> obtenerProgresoMailing();
					$porcentaje = $progresoMailing -> enviados / $progresoMailing -> numCorreos * 100;
					echo "porcentaje,".$porcentaje;
				}		
			break;
			case "obtenerenviados":
				if(isset($_REQUEST["idmailing"]) && $_REQUEST["idmailing"] != 0 ){
					$progresoMailing = new ProgresoMailing($_REQUEST["idmailing"]);
					$progresoMailing -> obtenerProgresoMailing();
					$enviados = $progresoMailing -> enviados;
					echo "enviados,".$enviados;
					
				}	
			break;

			case "enviarPlantilla1":
					if(isset($_REQUEST["idcorreo1"])){
						$numBoletinesActivos = 0;
						$idCorreo = $_REQUEST["idcorreo1"];
						$correo = new correo1($idCorreo);
						$correo -> obtenerCorreo1();
						$boletin = new boletin();
						$numBoletinesActivos = $boletin  -> contarBoletinesActivos();	
						
						if($numBoletinesActivos > 0){
							$progresoMailing = new ProgresoMailing();
							
							$tipoCorreo = 1;//correo1, tmpcorreo1;
							$fechaYHoraInicio = date("Y-m-d h:i:sa");

							$progresoMailing -> idCorreo = $idCorreo;
							$progresoMailing -> tipoCorreo = $tipoCorreo;
							$progresoMailing -> fechaYHoraInicio = $fechaYHoraInicio;
							$progresoMailing -> numCorreos = $numBoletinesActivos;
							$progresoMailing -> plantilla = 1;

							$progresoMailing -> insertarProgresoMailing();
							
							echo "true";
						}
						else{
							echo "error";
						}
						
					}

					else{
						echo "false";
					}
				break;
			case 'enviar':

				if(isset($_FILES['archivo']['name'])){
					if ($_FILES['archivo']['name']!=''){
						$nameP=$_FILES['archivo']['name'];
						$tmpnameP=$_FILES['archivo']['tmp_name'];
					}	
				}
				else{
					$nameP='';
					$tmpnameP='';
				}


				if(isset($_FILES['archivo_logo']['name'])){
					if ($_FILES['archivo_logo']['name']!=''){
						$nameP_logo=$_FILES['archivo_logo']['name'];
						$tmpnameP_logo=$_FILES['archivo_logo']['tmp_name'];
					}	
				}
				else{
					$nameP_logo='';
					$tmpnameP_logo='';
				}

				$idcorreo = 0;

				if(isset($_REQUEST["idcorreo1"])){
					if($_REQUEST["idcorreo1"] != 0 && $_REQUEST["idcorreo1"] != ""){
						$idcorreo = $_REQUEST["idcorreo1"];
					}
				}

				
				$titulo = (isset($_REQUEST['titulo']) && $_REQUEST['titulo'] != "")? $_REQUEST['titulo']: "";
				$subtitulo = (isset($_REQUEST['subtitulo']) && $_REQUEST['subtitulo'] != "")? $_REQUEST['subtitulo']: "";
				$desc1 = (isset($_REQUEST['desc1']) && $_REQUEST['desc1'] != "")? $_REQUEST['desc1']: "";
				$desc2 = (isset($_REQUEST['desc2']) && $_REQUEST['desc2'] != "")? $_REQUEST['desc2']: "";
				$desc3 = (isset($_REQUEST['desc3']) && $_REQUEST['desc3'] != "")? $_REQUEST['desc3']: "";
				$linklogo = (isset($_REQUEST['linklogo']) && $_REQUEST['linklogo'] != "")? $_REQUEST['linklogo']: "";
				$nomemp = (isset($_REQUEST['nomemp']) && $_REQUEST['nomemp'] != "")? $_REQUEST['nomemp']: "";
				$color = (isset($_REQUEST['color']) && $_REQUEST['color'] != "")? $_REQUEST['color']: "";
				$from = (isset($_REQUEST['from']) && $_REQUEST['from'] != "")? $_REQUEST['from']: "";
				$fromname = (isset($_REQUEST['fromname']) && $_REQUEST['fromname'] != "")? $_REQUEST['fromname']: "";
				$facebook = (isset($_REQUEST['facebook']) && $_REQUEST['facebook'] != "")? $_REQUEST['facebook']: "";
				$twitter = (isset($_REQUEST['twitter']) && $_REQUEST['twitter'] != "")? $_REQUEST['twitter']: "";
				$youtube = (isset($_REQUEST['youtube']) && $_REQUEST['youtube'] != "")? $_REQUEST['youtube']: "";
				$instagram = (isset($_REQUEST['instagram']) && $_REQUEST['instagram'] != "")? $_REQUEST['instagram']: "";

				//	function correo1 ($idc1= 0,$rut = '',$tit = '',$subt = '',$desc1 = '',$desc2 = '',$desc3 = '',$temporal='',$logo = "", $logo_temporal = "", /*$footer = "", $footer_temporal = "",*/ $from = "", $fromname = "", $facebook = "", $twitter = "", $instagram = "", $youtube = "", $idlista = "")
				$correo1 = new correo1($idcorreo,$nameP,$titulo, $subtitulo,$desc1,$desc2, $desc3, $tmpnameP, $nameP_logo, $tmpnameP_logo, $linklogo, $nomemp, $color ,$from, $fromname, $facebook, $twitter, $instagram, $youtube);


				if($idcorreo != 0){
					$correo1 -> idcorreo1 = $_REQUEST["idcorreo1"];
					$correo1 -> modificaCorreo1();
				}
				else{
					$correo1->insertaCorreo1();
				}

				$idcorreo = $correo1->idcorreo1;
				
				if(isset($_FILES['archivo2']['name'])){
					$tot3 = count($_FILES['archivo2']['name']);
					for($i = 0; $i < $tot3; $i++){
						if ($_FILES['archivo2']['error'][$i] == 0 and $_FILES['archivo2']['name'][$i] != ''){
							$extension=$_FILES['archivo2']['name'][$i];
			         		$name = $correo1->obtenerExtensionArchivo($extension); 
					 		$titulo=$_REQUEST['titulo'];
			            	$tmp_name = $_FILES["archivo2"]["tmp_name"][$i]; 
			            	$correo1->insertarCorreo1img($titulo, $name, $tmp_name);  
						}			
					}
				}

				if(isset($_REQUEST["idcorreo1"])){
					if(isset($_FILES['archivo23']['name'])){
						$tot3 = count($_FILES['archivo23']['name']);
						for($i = 0; $i < $tot3; $i++){
							if ($_FILES['archivo23']['error'][$i] == 0 and $_FILES['archivo23']['name'][$i] != ''){
								$extension=$_FILES['archivo23']['name'][$i];
				         		$name = $correo1->obtenerExtensionArchivo($extension);
				         		$titulo=$_REQUEST['titulo'];
				            	$tmp_name = $_FILES["archivo23"]["tmp_name"][$i]; 
				            	$correo1->modificarCorreo1img($_REQUEST['correo1img'][$i],$titulo,$name, $tmp_name);
							}			
						}	
					}
				}


				if(isset($_FILES['archivo3']['name']) and $_FILES['archivo3']['name'][$i] != ''){
					$titulo3=$correo1->obtenerExtensionArchivo($_FILES['archivo3']['name']);
					$ruta3=$_FILES['archivo3']['name'];
					$temporal3=$_FILES['archivo3']['tmp_name'];
					if(isset($_REQUEST["idcorreo1img2"])){
						$correo1 -> modificarCorreo1img2($_REQUEST["idcorreo1img2"],$titulo3,$ruta3,$temporal3);
					}
					else{
						$correo1->insertarCorreo1img2($ruta3, $titulo3, $temporal3);
					}
					
				}

				
				$contador = 0;
				$success = 0;
				if(isset($_REQUEST["correo_prueba"])){
					$correosPrueba = $_REQUEST["correo_prueba"];
					$correoPrueba = "";
					foreach ($correosPrueba as $correo) {
						if($correo != ""){
							$correoPrueba = $correo;
							break;
						}
					}
					if($correoPrueba != ""){
						$tempcorreo1= new tempcorreo1($idcorreo,"","#",$correoPrueba);
						$tempcorreo1->enviar();
						header("Location:mailing.php?c=".$idcorreo."&p=1");
						break;
						exit();
					}

				}

				/*$listboletin = array();
				$boletin= new Boletin();
				$listboletin= $boletin->listarBoletinActivados();
				foreach($listboletin as $elementoboletin)
				{

					$tempcorreo1= new tempcorreo1($idcorreo,0,$elementoboletin -> idBoletin);
					$tempcorreo1->enviar();
					usleep(1000000);
					$contador++;
				}*/
				//header('Location: mailing.php?success=2&cont='.$contador);
				header("Location:mailing.php?c=".$idcorreo."&p=1&opr=ep1");
					
		break;

		case 'eliminarImagenSecundariaCorreo1':
				if(isset($_REQUEST["idcorreo1"]) && isset($_REQUEST["idcorreoimg1"]))
				{
					$correo1 = new correo1($_REQUEST["idcorreo1"]);
					$correo1 -> eliminarCorreo1img($_REQUEST["idcorreoimg1"]);
					echo "true";
				}
				else{
					echo "false";
				}
		break;

		case "modificarconfigmailing":
				if(isset($_REQUEST["idconfig"]) && $_REQUEST["idconfig"] != 0){
					$correo_noreply = $_REQUEST["correo_noreply"];
					$correo_standard = $_REQUEST["correo_standard"];
					$facebook = $_REQUEST["facebook"];
					$twitter = $_REQUEST["twitter"];
					$instagram = $_REQUEST["instagram"];
					$youtube = $_REQUEST["youtube"];
					$idconfig  = $_REQUEST["idconfig"];

					$config_mailing = new config_mailing($idconfig, $correo_noreply, $correo_standard, $facebook, $twitter, $instagram, $youtube);
					$config_mailing -> modificar_config();
					header("Location:configmailing.php?s=1");
				}
				else{
					header("Location:configmailing.php?s=2");
				}
		break;
		//––––––––––––––––––––MODIFICACIONES CAAMAL–––––––––––––––––––––––––
		case 'correoPedidoEnviado':
			$correoEnvioProductos = new correoEnvioProductos($_POST['idorden']);
			$send = $correoEnvioProductos->enviar();
			$orden = new orden($_POST['idorden']);
			$orden->estatus = 4;
			$orden->updateStatus();
			if($send){
				echo 1;
			}else{
				echo 0;
			}
		break;
}
?>