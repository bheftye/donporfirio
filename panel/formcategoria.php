<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
if(isset($_REQUEST['idboletin'])){
	$id=$_REQUEST['idboletin'];
	$operacion='modificarboletin';
	$palabra='Editar Boletín';
	$temporal = new boletin($id);
	$temporal -> obtenerBoletin();
}
else{
	$id=0;
	$operacion='agregarboletin';
	$palabra='Nuevo Boletín';
	$img='';
	$temporal = new boletin($id);
}

?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario De Boletines</title>
<?php
include'header.html';//contiene las barras de arriba y los menus.
include'menu.php';//Contiene a todo el menu.
?> 
   
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">
            
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->
                	 <div class='notifications bottom-right'></div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?=$palabra?></p>
                    </div>
                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" onsubmit="return validar_campos()" enctype="multipart/form-data">
                    		<input type="hidden" name="idboletin" value="<?=$temporal->idBoletin?>"/>
                    		<input type="hidden" name="status" value="<?=$temporal->status?>"/>	                    		
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar y Publicar</button>
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
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    	<div id="correo" class="input-group espacios">
                        	<span class="input-group-addon es">Correo</span>
                        	<input type="text"  name="correo" class="form-control" placeholder="Ingrese el correo aquí..." value="<?=$temporal->correo?>">
                        </div>
                        
                        <br>
                        <!--Aquí es donde se previsualiza la imagen-->
                                           
                    </div><!--Div de cierre col-lg-9-->
                    <!--------------------------------------------
                    	En esta sección es del subtitulo y la imagen principal
                    ---------------------------------------------->
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    		                     
                    </div><!--Div de cierre col-lg-5-->
                    
                    <div class="clearfix"></div>
                    <!--------------------------------------------
                    Aqui es la sección para subir las imágenes secundarias
                    ---------------------------------------------->
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    	
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    	
                    </div>
                    <!--Sección del lado izquierdo-->
                    
                    
                    <div class="clearfix"></div>
                    
                    <br>
                    
                    <!--Este div contiene la barra inferior-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <!--Este div contiene al boton inferior-->
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar y Publicar</button>
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
 <!--Scripts Especificos para los formularios
    ----------------------------------------------
    Script que inicia el summernote-->
	
   
	
 <!--Script que sirve para validar-->
	<script>
	function validar_campos(){
		var val = $("#files").val();
		
		if (form1.correo.value == ''){
			form1.correo.focus();
			$('#correo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del correo esta vacío, para poder continuar asigne un corre al boletín' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#correo').removeClass("form-group has-error").addClass("form-group has-success");
		}	
		<?=$validator?>
	}
	</script>


<script>
$(function() {
    $('#correo').tooltip(
	{
		placement: "top",
        title: "Este campo es requerido"
	});
});
</script>
</html>
