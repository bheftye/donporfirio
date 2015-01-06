<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
	
	$operacion='modificar_redes_sociales';
	$palabra='Editar Redes Sociales';
	$temporal = new redes_sociales(1);
	$temporal -> obtener_redes_sociales();
$clave = 'ModRedS';
?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario de Redes Sociales</title>
<?php
include'header.html';//contiene las barras de arriba y los menus.
include'menu.php';//Contiene a todo el menu.
?> 
   		<style>
			.note-editor-error {
				border: 1px solid #F00;
				width: 100% !important;
				}
			.note-editor-success {
				border: 1px solid #6C0;
				width: 100% !important;
				}	
        </style>
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">
            
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?=$palabra?></p>
                    </div>
                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" onsubmit="return validar_campos()" enctype="multipart/form-data">
                    		<input type="hidden" name="id_redes_socialess" value="1"/>        
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
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                    	<div id="facebook" class="input-group espacios">
                        	<span class="input-group-addon es">Perfil de Facebook</span>
                        	<input type="text"  name="facebook" class="form-control" placeholder="Ingrese el link aquí..." value="<?=$temporal->facebook?>">
                        </div>
                        <div id="youtube" class="input-group espacios">
                            <span class="input-group-addon es">Canal de Youtube</span>
                            <input type="text"  name="youtube" class="form-control" placeholder="Ingrese el link aquí..." value="<?=$temporal->youtube?>">
                        </div>
                        <div id="vimeo" class="input-group espacios">
                            <span class="input-group-addon es">Canal de Vimeo</span>
                            <input type="text"  name="vimeo" class="form-control" placeholder="Ingrese el link aquí..." value="<?=$temporal->vimeo?>">
                        </div>
                       
                    </div><!--Div de cierre col-lg-9-->
                    <div class="clearfix"></div>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
  	<div class="modal-content">
  	  <div class="modal-body">	
    	<div class="progress progress-striped active" style="margin-top: 50px">
			<div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				<span class="sr-only">45% Complete</span>
			</div>
		</div>
	</div>
	<div class="modal-footer">
        	Esto puede tomar unos minutos, porfavor no cierres la ventana..
   	</div>
   </div>
  </div>
</div>
<?php
include 'javascripts.html';
?>
 <!--Scripts Especificos para los formularios
    ----------------------------------------------
    Script que inicia el summernote-->
	
    <!--Script que permite previsualizar la imagen primaria-->
    
 <!--Script que permite previsualizar la imagen Secundaria-->
	
 <!--Script que sirve para validar-->
	<script>
	function validar_campos(){
        var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;

		if(form1.facebook.value != ""){
            if (form1.facebook.value.length < 2 || !myRegExp.test(form1.facebook.value)){
           form1.facebook.focus();
           $('#facebook').removeClass("form-group").addClass("form-group has-error");
           $('.top-right').notify({
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.youtube.com/watch?v=_zR6ROjoOX0&spfreload=10)' },
               type:'blackgloss',
             }).show();
           return false;
           }
          else{
           $('#facebook').removeClass("form-group has-error").addClass("form-group has-success");
          }
        }
        else{
            return false;
        }

        if(form1.youtube.value != ""){
            if (form1.youtube.value.length < 2 || !myRegExp.test(form1.youtube.value)){
           form1.youtube.focus();
           $('#youtube').removeClass("form-group").addClass("form-group has-error");
           $('.top-right').notify({
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.youtube.com/watch?v=_zR6ROjoOX0&spfreload=10)' },
               type:'blackgloss',
             }).show();
           return false;
           }
          else{
           $('#youtube').removeClass("form-group has-error").addClass("form-group has-success");
          }
        }
        else{
            return false;
        }

        if(form1.vimeo.value != ""){
            if (form1.vimeo.value.length < 2 || !myRegExp.test(form1.vimeo.value)){
           form1.vimeo.focus();
           $('#vimeo').removeClass("form-group").addClass("form-group has-error");
           $('.top-right').notify({
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.youtube.com/watch?v=_zR6ROjoOX0&spfreload=10)' },
               type:'blackgloss',
             }).show();
           return false;
           }
          else{
           $('#vimeo').removeClass("form-group has-error").addClass("form-group has-success");
          }
        }
        else{
            return false;
        }
		
	}
	$(document).ready(function () {
	    $(".buttonguardar").click(function () {
	        if (validar_campos()!= false){
	        	$("#myModal").modal("show");
	        }
	    });
	});
	</script>


<script>
$(function() {
    $('#nombre').tooltip(
	{
		placement: "top",
        title: "Este campo es requerido"
	});
	$('#porcentaje').tooltip(
	{
		placement: "top",
        title: "Ingrese un porcentaje en número entero. Ejemplo: 16, 18, 21."
	});
});
</script>
</html>
