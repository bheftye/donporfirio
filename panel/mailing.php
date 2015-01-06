<?php
	function __autoload($ClassName){
		$ClassName = strtolower($ClassName);
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();

$idCorreo = 0;
$plantilla = 0;
$correo = null;
if(isset($_REQUEST["c"])){
	$idCorreo = $_REQUEST["c"];
}
if(isset($_REQUEST["p"])){
	$plantilla = $_REQUEST["p"];
}

switch ($plantilla) {
	case '1':
		$correo = new correo1($idCorreo);
		$correo -> obtenerCorreo1();
		$correo -> listarCorreo1img();
		$correo -> listarCorreo1img2();
		break;
	
	default:
		break;
}


	$clave = 'EnvNew';
	$palabra = 'Correos';
	$operacion = 'enviar';

	$progresoMailing = new ProgresoMailing();
	$progresosMailing = $progresoMailing -> listarProgresosMailingNoTerminados();

?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Newsletter</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>    

   <link rel="stylesheet" href="js/pickcolor/1.1.8/css/pick-a-color-1.1.8.min.css">

        <!-- Page content Sección del contenido de la pagina-->
     
        <div id="page-content-wrapper">
            
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
            	<div class="row rowedit" style="display:<?php if(count($progresosMailing) == 0) echo "none";?>">
            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="titulo">Progreso Mailing:</p>
                        <div class="text-center textHelper">
	                        A continuación se muestra el progreso del envío de correos.<br>
	                        El horario de envío de correos es de 7 PM a 10 AM del día siguiente. Realiza tu envio antes de las 6:50 PM para que empiece a enviarse ese mismo día. <br>
	                        
	                    </div>
                	</div>
                	<div id="progresos_mailing" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<?php
                			$numProgresos = 1;
                			foreach ($progresosMailing as $progresoMailingNoTerminado) {
                				$porcentaProgreso = $progresoMailingNoTerminado -> enviados / $progresoMailingNoTerminado -> numCorreos * 100;
                				$correoMailing;
                				switch ($progresoMailingNoTerminado -> tipoCorreo) {
                					case '1':
            							$correo2 = new correo1($progresoMailingNoTerminado -> idCorreo);
										$correo2 -> obtenerCorreo1();
                						break;
            						case '2':
		        						$correo2 = new correo2($progresoMailingNoTerminado -> idCorreo);
										$correo2 -> obtenerCorreo2();
		        						break;
            						case '3':
	            						$correo2 = new correo3($progresoMailingNoTerminado -> idCorreo);
										$correo2 -> obtenerCorreo3();
	            						break;
            						case '4':
	            						$correo2 = new correo1($progresoMailingNoTerminado -> idCorreo);
										$correo2 -> obtenerCorreo1();
	            						break;
            					
                					default:
                						# code...
                						break;
                				}
                				echo "<p class='col-xs-12'><p>".$correo2 -> titulo."</p></p>".
                					 "<p>Enviados:<span id='enviadosProgreso".$numProgresos."'>".$progresoMailingNoTerminado -> enviados."</span> De: ".$progresoMailingNoTerminado -> numCorreos."</p><br>".
                						"<div class=\"progress\">".
  										"<div id=\"progreso".$numProgresos."\" class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%;\">".
    										"<span class=\"sr-only\"></span>".
  										"</div>".
									"</div>";
                				$numProgresos++;
                			}
                		?>
                	</div>
            	</div>
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->  
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                   	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		            	<div class='notifications top-right'></div>
		            </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<ul class="nav nav-tabs">
						  <li id="plant1" class="<?php if($plantilla == 1 || $plantilla == 0 ) echo ' active';?>"><a href="#p01" data-toggle="tab"><img src="img/plantillas-01.png" width="50" height="50" /></a></li>

						</ul>
                    </div>
                    <div class="tab-content">
					  <div class="tab-pane fade <?php if($plantilla == 1 || $plantilla == 0 ) echo 'in active';?>" id="p01">
					  	 <form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()" enctype="multipart/form-data">
	                		<input type="hidden" name="MAX_FILE_SIZE" value="600000000"/>
	                    	<input type="hidden" name="idcorreo1" value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> idcorreo1: '' ;?>"/>  
	                    	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin: 25px 0 0 0">
                    			<p class="titulo">Plantilla Personalizable</p>
                    		</div>
		                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
		                    	<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
		                    </div>
		                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
	                    		<div class="text-center textHelper">
	                        		Puedes enviar un correo de prueba, antes de enviarselo a todos tus contactos.
	                        	</div>
	                    		<input type="text" class="form-control" name="correo_prueba[]" placeholder="Introduce la dirección del correo para enviar la prueba...">
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> onclick="validar_campo_prueba1()"  class="buttonguardar">Enviar Prueba</button>
		                    </div>  
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    
		                    <div class="clearfix"></div>
		                    <!--Seccion de los forms
		                    ---------------------------------------------------------------------------------
		                    	En esta sección esta para editar el titulo y la descripcion
		                    -------------------------------------------------------------------------------->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 espacios">
		                    	<div class="row">
		                    	<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
		                    			<div class="row">
		                    				<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		                    					<div class="row">
		                    						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        	          							<input name="from" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el correo del remitente aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> from: '' ;?>">
		        	          							<input name="fromname" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el nombre del remitente aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> fromname: '' ;?>">
		                    							<br>
		                    						</div>
		                    					</div>		                    						                    			
		                    				</div>
		                    			</div>
		                    		</div>

		                    		<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
		                    			<div class="row">
		                    				<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		                    					<div class="row">
		                    						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
		                    							<!--<img width="auto" height="auto" src="http://clientes.locker.com.mx/plataforma/img/logoplatforma.png" title="Imagen Logo"/>-->
							                    			<div id="imgprin" class="fileUpload btn btn-default col-xs-12" style="background:none;border:hidden;">
							                            		<!--<input id="files_logo" name="archivo_logo" type="file" class="upload"/>-->
							                            		<div id="imgsecu" class="fileUpload btn btn-default" style="width:100%; ">
				                            						<span class="inputUploadFont"><i class="fa fa-camera"></i> Seleccionar Logo</span>
	                            									<input id="files_logo" name="archivo_logo" type="file" class="upload"/>
	                        									</div>
							                        		</div>
		                    							<output align="center" id="list_logo">
							                        		<?php
							                        		if($idCorreo != 0 && $plantilla == 1 ){
							                        			echo '<img width="100%" height="auto" src="./correos/correo1/'.$correo -> logo.'" title="Imagen Logo"/>';
							                        		}
							                        		?>
														</output>


		                    						</div>
		                    						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		            									<div id="titulo" class="form-group espacios">
		        	          								<input name="titulo" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el titulo aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> titulo: '' ;?>">
		        	          								<input name="linklogo" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el link del sitio web aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> linklogo: '' ;?>">
															<input name="nomemp" type="text" style="margin: 30px 0 0 0" class="form-control " placeholder="Ingrese el nombre del sitio web/empresa aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> nomemp: '' ;?>">
															<br>
															<input id="color1" name="color" placeholder="ffffff" style="width:100px;" class="form-control pick-a-color" value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> color: '' ;?>" type="text">
		                     							</div>
	            								</div>
		                    					</div>		                    						                    			
		                    				</div>
		                    			</div>
		                    		</div>		               
		                    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 10px 0 0 0">
		                    			<hr class="hrmenu">
		                    		</div>
		                    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    			<div class="row">
		                    				
		                    				<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		                    					<span class="textHelper">Previsualizar:</span>
					                       		<br>
					                        	<output align="center" id="list">
					                        		<?php
					                        		if($idCorreo != 0 && $plantilla == 1 ){
					                        			echo '<img width="100%" height="auto" src="./correos/correo1/'.$correo -> ruta.'" title="Imagen Portada"/>';
					                        		}
					                        		?>
												</output>
					                        	<br>
		                    				</div>		                
		                    			</div>
		                    		</div>
		                    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                        		<div align="center">
			                    			<center>
			                            		<input id="files" name="archivo" type="file" class="upload"/>
			                        		</center>
		                        		</div>
		                        		<br>
		                        		<div class="text-center textHelper">
		                        			Tipo de archivos permitidos: jpg, jpeg, png, gif.
		                            		<br>
		                            		Tamaño máximo de archivo: 4MB.
		                        		</div>
		                    		</div>
		                    		<div class="col-lg-4 col-lg-offset-3 col-md-4 col-md-offset-3 col-sm-12 col-xs-12" style="margin-top: 10px">
		                    			<div id="subtitulo" class="form-group espacios">
		                        			<input name="subtitulo" type="text" class="form-control" placeholder="Ingrese el subtitulo aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> subtitulo: '' ;?>">
		                       			</div>
		                    		</div>
		                    		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-top: 10px"></div>
		                    		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" style="margin-top: 10px">
		                    			<span class="textHelper">Ingrese la descripción 1 aquí:</span>
		                        		<textarea name="desc1" id="summernote"><?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> desc1: '' ;?></textarea>
		                    		</div>
		                    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 20px 0 0 0">
		                    			<hr class="hrmenu">
		                    		</div>
		                    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		                    			<span class="textHelper">Ingrese la descripción 2 aquí:</span>
		                        		<textarea name="desc2" id="summernote2"><?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> desc2: '' ;?></textarea>
		                    		</div>
		                    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		                    			<span class="textHelper">Ingrese la descripción 3 aquí:</span>
		                        		<textarea name="desc3" id="summernote3"><?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> desc3: '' ;?></textarea>
		                    		</div>
		                    		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" style="margin-top: 10px;">
				                            <div id="imgsecu2" class="fileUpload btn btn-default" style="width:100%; ">
				                            	<span class="inputUploadFont"><i class="fa fa-camera"></i> Seleccionar Imágenes Secundarias</span>
	                            				<input id="files3" name="archivo2[]" type="file" class="upload" multiple/>
				                        </div>
				                        <br>
		                        		<div class="text-center textHelper">
		                        			Tipo de archivos permitidos: jpg, jpeg, png, gif.
		                            		<br>
		                            		Tamaño máximo de archivo: 4MB.
		                        		</div>
				                        <div class="espacios">
				                        	<span class="textHelper">Previsualizar:</span>
				                        </div>
				                    </div><!--Div de cierre col-lg-7-->
				                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" style="margin-top: 10px">
				                    	<div class="row">
				                    		<output align="center" id="list2"></output>
				                    	</div>
				                    	<div class="row">
				                    		<output align="center" id="list2_2">
						                    	<?php
						     						if($idCorreo != 0 && $plantilla == 1 ){
														foreach ($correo->correo1img as $elementoImgS) {
														  echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="correo1img'.$elementoImgS["idcorreoimg1"].'">
														  			<div class="image-wrapper">
														  				<span class="image-options">
														  					<ul class="ulmenuoptions">
														  						<li onclick="deleteCorreo1Img('.$elementoImgS["idcorreoimg1"].', '.$correo -> idcorreo1.')"  class="limenuoptions manita">
						                        									<span class="inputUploadFont fontOptionsImg">Eliminar <i class="fa fa-times"></i></span>
						                        								</li>	
															  					<li class="limenuoptions manita">
																  					<div class="fileUpload" style="width:100%; border-color: none important!">
																  						<input type="hidden" name="correo1img[]" value="'.$elementoImgS["idcorreoimg1"].'"/>
								                            							<span class="inputUploadFont fontOptionsImg manita">Editar <i class="fa fa-pencil"></i></span>
								                            							<input name="archivo23[]" type="file" class="upload manita"/>
								                        							</div>
								                        						</li>	
						                        							</ul>	
						                        						</span>
														  				<img style="margin: 0 0 20px 0" class="img-responsive" src="./correos/correo1/correo1img/'.$elementoImgS["ruta"].'"/>
																	</div>												
																</div>';
														}
						     						}
													else {
														echo '';
													}
		     									?>
		     								</output>
		     							</div>
				                    </div>				                   
		                    	</div>
		                    </div>		                
		                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		                    	<span class="textHelper">Previsualizar:</span>
		                       	<br>
		                        <output align="center" id="list3">
		                        	<?php
				     						if($idCorreo != 0 && $plantilla == 1){
												foreach ($correo->correo2img as $elementoImgS) {
												  echo '
												  		<img style="margin: 0 0 20px 0; height:221px; width:100%;" class="img-responsive" src="./correos/correo1/correo2img/'.$elementoImgS["ruta"].'"/>
														';
													break;
												}
				     						}
											else {
												echo '';
											}
     									?>
		                        	
     							</output>
     							<?php
				     						if($idCorreo != 0 && $plantilla == 1){
												foreach ($correo->correo2img as $elementoImgS) {
												  echo '
												  		<input type="hidden" name="idcorreo1img2" value="'.$elementoImgS["idcorreo1img2"].'" />
														';
													break;
												}
				     						}
											else {
												echo '';
											}
     									?>
		                        	
		                        <br>
		                        <div>
			                    	<div id="imgter" class="fileUpload btn btn-default form-group" style="width:100%">
			                        	<span class="inputUploadFont"><i class="fa fa-camera"></i> Seleccionar Footer | Firma Digital</span>
			                            <input id="files4" name="archivo3" type="file" class="upload"/>
			                        </div>
		                        </div>
		                        <br>
		                        <div class="text-center textHelper">
		                        	Tipo de archivos permitidos: jpg, jpeg, png, gif.
		                        	<br>
		                        	Tamaño máximo de archivo: 4MB.
		                        </div>
		                     	<hr class="hrmenu" style="margin-top: 10px; margin-bottom: 10px">
		                     	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" style="margin-top: 10px">
		                    		<span class="textHelper">Ingrese las redes sociales:</span>
		        	          		<input name="facebook" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el link de facebook aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> facebook: '' ;?>">
		        	          		<input name="twitter" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el link de twitter aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> twitter: '' ;?>">
		        	          		<input name="instagram" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el link de instagram aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> instagram: '' ;?>">
		        	          		<input name="youtube" type="text" style="margin: 30px 0 0 0" class="form-control" placeholder="Ingrese el link de youtube aquí..." value="<?php echo ($idCorreo != 0 && $plantilla == 1)? $correo -> youtube: '' ;?>">
		                    	</div>
		                    </div>               
		                    <div class="clearfix"></div>                    
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 15px 0 0 0">
		                    	<hr class="hrmenu">
		                    </div>
		                    <!--Este div contiene al boton inferior-->
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-left">
		                    		<div class="text-center textHelper">
		                        		Puedes enviar un correo de prueba, antes de enviarselo a todos tus contactos.
		                        	</div>
		                    		<input type="text" class="form-control" name="correo_prueba[]" placeholder="Introduce la dirección del correo de prueba...">
		                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> onclick="validar_campo_prueba1()" class="buttonguardar">Enviar Prueba</button>
		                    	</div>
		                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
		                        
		                    </div>
	                    </form>
					  </div>
					  
					  
					</div>
                    <!--Sección del pie de pagina-->
                    <footer id="footer">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        	Derechos Reservados a Locker Agencia Creativa S.A. de C.V.
                            <br>
                            soporte@locker.com.mx
                            <br>
                            www.locker.com.mx
                    	</div>
                    </footer>
                </div><!--Div de cierre del row-->
            </div><!--Div de cierre de page-content inset-->
        </div><!--Div de cierre de page-content-wrapper-->
    </div><!--Div de cierre de id Wrapper-->
    <div id="loading" style="display:none;"  align="center">
    	<p id="correos_enviados">Enviado... <span id="enviados">0</span> de <span id="por_enviar"></span></p>
    	<img id="" src="img/loading.gif"/>
	</div>

<?php
include 'javascripts.html';
?> 
<script src="js/jquery-ui.min.js"></script>
<script src="js/multi-select/js/jquery.multi-select.js"></script>
<script src="js/correos.js"></script>
<!--<script src="js/jquery.quicksearch.js"></script>-->
<script src="js/jquery.blockUI.js"></script>
<script src="js/pickcolor/dependencies/tinycolor-0.9.15.min.js"></script>
<script src="js/pickcolor/1.1.8/js/pick-a-color.js"></script>

<script>

$(".pick-a-color").pickAColor({});

	var operacion = "ninguna_operacion";
	var idCorreo = "0";
	var progresosMailingId = new Array();
<?php
	if((isset($_REQUEST["opr"]) && $_REQUEST["opr"] != "") && (isset($_REQUEST["c"]) && $_REQUEST["c"] != 0)){

		$listboletin = array();
				

		echo "operacion = ".json_encode($_REQUEST['opr']).";";
		echo "\n";
		echo "idCorreo = ".json_encode($_REQUEST['c']).";";
		echo "\n";
	}

	foreach ($progresosMailing as $progresoMailingNoTerminado) {
		echo "progresosMailingId.push(".json_encode($progresoMailingNoTerminado -> idMailing).");";
	}
?>
	realizaOperacion();

	 setInterval(inicializarActualizadoresDeProgresoMailing, 3000);

	 function inicializarActualizadoresDeProgresoMailing(){
	 	for (var i = 0; i < progresosMailingId.length; i++) {
	 		actualizadorDeProgresoMailing(progresosMailingId[i], i + 1);
	 	}
	 }
	
	function actualizadorDeProgresoMailing(mailing, posicion){
		$.ajaxSetup({cache: false});
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"operaciones.php",
			data:"idmailing="+mailing+"&operaciones=obtenerprogresomailing",
			success:function(data){
				var datos = new Array();
				datos = data.split(",");
				if(datos[0] == "porcentaje"){
					$("#progreso"+posicion).attr("aria-valuenow",Math.floor(datos[1])+"");
					$("#progreso"+posicion).css({width:Math.floor(datos[1])+"%"});
					$("#progreso"+posicion).find("span").html(Math.floor(datos[1])+"% Completado");
				}
				
			},
			cache:false
		});

		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"operaciones.php",
			data:"idmailing="+mailing+"&operaciones=obtenerenviados",
			success:function(data){
				console.log(data);
				var datos = new Array();
				datos = data.split(",");
				if(datos[0] == "enviados"){
					$("#enviadosProgreso"+posicion).html(datos[1]);
				}
				
			},
			cache:false
		});

	}

	function realizaOperacion(){
		
		switch(operacion){
			case "ep1":
				$.blockUI({ 
		            message: $('#loading'),
		            css:{
		              backgroundColor: 'none',
		              border: 'hidden'
		            }
            	});
				setTimeout(enviarPlantilla1, 3000);
				break;
			default:

				break;
		}
	}

		function enviarPlantilla1(){
				var mensaje = "";
				$.ajaxSetup({cache: false});
				$.ajax({
					async:false,
					type: "POST",
					dataType: "html",
					contentType: "application/x-www-form-urlencoded",
					url:"operaciones.php",
					data:"idcorreo1="+idCorreo+"&operaciones=enviarPlantilla1",
					success:function(data){
						console.log(data);
						if(data == "true"){
							mensaje = "Se están enviando los correos, se te notificará cuando se hayan terminado de enviar exitosamente";
						}
						else{
							mensaje = "Ocurrio un error, intentalo de nuevo, si vuelve a mostrarse esta mensaje comunícate a soporte@locker.com.mx";
						}	
					},
					cache:false
				});
			$.unblockUI();
			alert(mensaje);
			///window.location.replace("mailing.php");
			return;
		}
</script>
</body>
</html>
