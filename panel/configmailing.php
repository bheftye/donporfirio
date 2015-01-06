<?php
	include_once('clases/config_mailing.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();
	
	$operacion = 'modificarconfigmailing';
	$palabra = 'Editar Configuración Mailing';
	$temporal = new config_mailing(9);
	$temporal->obtener_config();
	$clave='ModConfigMail';

    if(isset($_REQUEST['s'])){
    $success = $_REQUEST['s'];
        switch($success){
            case '2':
                $alert = '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡UPS!</strong> Ha ocurrido un error vuelva a intentarlo.
                          </div>';
            break;
            case '1':
                $alert = '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡MUY BIEN!</strong> Se ha modificado correctamente la configuración.
                          </div>';  
            break;
        }
    }
    else{
        $success = '';
        $alert = '';
    }
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Configuración Mailing</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>    
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">
            
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?=$alert?>
                    </div>
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()">
                    		<input type="hidden" name="idconfig" value="<?php echo $temporal->idconfig ?>"/>
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    
                    <div class="clearfix"></div>
                    <!--Seccion de los forms
                    ---------------------------------------------------------------------------------
                    	En esta sección esta para editar el titulo y la descripcion
                    -------------------------------------------------------------------------------->
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<div class='notifications top-right'></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 espacios">
                        <h5>Correos Electrónicos</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 espacios">
                    	<span class="textHelper">Ingrese el correo "no-reply@tudominio":</span>
                    	<br />
                    	<div id="correo_no_reply" class="form-group">
                        	<input name="correo_noreply" type="text" class="form-control" placeholder="Ej. no-reply@locker.com.mx" value="<?php echo $temporal -> correo_noreply; ?>">
                       	</div>
                        <br>
                    </div><!--Div de cierre col-lg-7-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 espacios">
                    	<span class="textHelper">Ingrese el correo estándar para mailing:</span>
                    	<br />
                    	<div id="correo_standard" class="form-group">
                        	<input name="correo_standard" type="text" class="form-control" placeholder="Ej. ventas@ejemplo.com" value="<?php echo $temporal -> correo_standard; ?>">
                       	</div>
                   	</div>                   
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 espacios">
                        <h5>Redes Sociales</h5>
                    </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 espacios">
                                    <span class="textHelper">Link de Facebook:</span>
                                    <br />
                                    <div id="fb" class="form-group">
                                        <input name="facebook" type="text" class="form-control" placeholder="Ej. https://www.facebook.com/LockerAC?ref=ts&fref=ts" value="<?php echo $temporal -> facebook; ?>">
                                    </div>
                                    <br>
                                </div><!--Div de cierre col-lg-7-->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 espacios">
                                    <span class="textHelper">Link de Twitter:</span>
                                    <br />
                                    <div id="twt" class="form-group">
                                        <input name="twitter" type="text" class="form-control" placeholder="Ej. https://twitter.com/lopezdoriga" value="<?php echo $temporal -> twitter; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 espacios">
                                    <span class="textHelper">Link de Instagram:</span>
                                    <br />
                                    <div id="instagram" class="form-group">
                                        <input name="instagram" type="text" class="form-control" placeholder="Ej. http://instagram.com/kristalehany" value="<?php echo $temporal -> instagram; ?>">
                                    </div>
                                    <br>
                                </div><!--Div de cierre col-lg-7-->
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 espacios">
                                    <span class="textHelper">Link de Youtube:</span>
                                    <br />
                                    <div id="youtube" class="form-group">
                                        <input name="youtube" type="text" class="form-control" placeholder="Ej. https://www.youtube.com/channel/UCEBb1b_L6zDS3xTUrIALZOw" value="<?php echo $temporal -> youtube; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>               
                    <div class="clearfix"></div>                    
                    <!--Este div contiene la barra inferior-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <!--Este div contiene al boton inferior-->
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                        </form>
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

<?php
include 'javascripts.html';
?> 
<script>  
	function validar_campos(){
		var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		
		if(!filter.test(form1.correo.value || form1.correo.value == '')){
			form1.correo.focus();
			$('#correo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'Este no es correo valido o el campo esta vacío' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#correo').removeClass("form-group has-error").addClass("form-group has-success");
		}	
		if(!filter.test(form1.emisor.value) || form1.emisor.value == ''){
			form1.emisor.focus();
			$('#emisor').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'Este no es correo valido o el campo esta vacío' },
    			type:'blackgloss',
  			}).show();
			return false;	
		}
		else{
			$('#emisor').removeClass("form-group has-error").addClass("form-group has-success");
		}
	}
	</script>
</body>
</html>
