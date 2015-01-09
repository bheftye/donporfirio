<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
if(isset($_REQUEST['id_categoria'])){
	$id=$_REQUEST['id_categoria'];
	$operacion='modificar_categoria';
	$palabra='Editar Categoría';
	$temporal = new categoria($id);
	$temporal -> obtener_categoria();
}
else{
	$id=0;
	$operacion='agregar_categoria';
	$palabra='Nueva Categoría';
	$img='';
	$temporal = new categoria($id);
}

?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario De Categorías</title>
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
                    		<input type="hidden" name="idboletin" value="<?=$temporal->id_categoria?>"/>
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
                    	<div id="nombre_esp" class="input-group espacios">
                        	<span class="input-group-addon es">Nombre de la cateogoría</span>
                        	<input type="text"  name="nombre_esp" class="form-control" placeholder="Ingrese el nombre aquí..." value="<?=$temporal->nombre_esp?>">
                        </div>
                        <div id="nombre_eng" class="input-group espacios">
                            <span class="input-group-addon es">Category's name</span>
                            <input type="text"  name="nombre_eng" class="form-control" placeholder="Set name here..." value="<?=$temporal->nombre_eng?>">
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
		
		if (form1.nombre_esp.value == '')
        {
			form1.nombre_esp.focus();
			$('#nombre_esp').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El campo del nombre esta vacío, para poder continuar asigne un nombre a la categoría' },
    			type:'blackgloss',
  			}).show();
			return false;
		}
		else{
			$('#nombre_esp').removeClass("form-group has-error").addClass("form-group has-success");
		}	

        if (form1.nombre_eng.value == '')
        {
            form1.nombre_eng.focus();
            $('#nombre_eng').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El campo del nombre esta vacío, para poder continuar asigne un nombre a la categoría' },
                type:'blackgloss',
            }).show();
            return false;
        }
        else{
            $('#nombre_eng').removeClass("form-group has-error").addClass("form-group has-success");
        }   
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
