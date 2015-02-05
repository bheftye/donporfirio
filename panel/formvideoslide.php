<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
	$id=1;
	$operacion='modificar_video_slide';
	$palabra='Editar Videoslide';
	$temporal = new video_slide($id);
	$temporal -> obtener_video_slide();
	
	if($temporal->nombre_video != '')
		$video = '<video src="../videosSlide/'.$temporal->nombre_video.'" controls muted width="auto" height="221"></video>';
	else 
		$video='';
	if($temporal->nombre_video != ''){
		$validator='';
	}
	else{
		$validator='if (!val.match(/(?:mp4)$/)) {
    		$("#check").removeClass("form-group").addClass("form-group has-error"); 
			$(".top-right").notify({
    			message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan videos con formato .mp4" },
    			type:"blackgloss",
    			delay: 6000,
  			}).show(); 
			return false; 
		}';
	}
$clave = 'ModSlide';
?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario Del Videoslide</title>
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
            <div class="page-content inset col-lg-12">
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?=$palabra?></p>
                    </div>
                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" onsubmit="return validar_campos()" enctype="multipart/form-data">
                    		<input type="hidden" name="MAX_FILE_SIZE" value="600000000"/>
                    		<input type="hidden" name="idslide" value="<?=$temporal->id_video_slide?>"/>        
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    	<ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#vid" role="tab" data-toggle="tab">Videos</a></li>
                            <li><a href="#img" role="tab" data-toggle="tab">Imágenes</a></li>
                        </ul>

                        <div class="tab-content">
                                <div class="tab-pane active" id="vid">
                                	<div id="titulo_video" class="input-group espacios">
			                        	<span class="input-group-addon es">Título del video*</span>
			                        	<input type="text"  name="titulo_video" class="form-control" placeholder="Ingrese el titulo aquí..." value="<?=$temporal->titulo_video?>">
		                        	</div>
		                        	<div id="link_vimeo" class="input-group espacios">
	                                    <span class="input-group-addon es">Link Video Vimeo*</span>
	                                    <input type="text" name="link_vimeo" id="input_link_video" value="<?=$temporal->link_vimeo?>" class="form-control" placeholder="Introduce el link aqui.... " >
	                                </div>

		                        <br>
		                        <div class="col-lg-6">
			                        <div class="espacios">
			                    		<span class="textHelper">Previsualizar el video de fondo de baja calidad:</span>
			                    	</div>
			                        <?php 
			                            if($temporal -> nombre_video != ""){
			                                echo '<video id="video" muted controls style="height:350px;width:100%;display:table;margin:0 auto;">
			                                        <source src="../videosSlide/'.$temporal -> nombre_video.'" id="mp4Source"  type="video/mp4">
			                                      </video>';
			                            }
			                            else{
			                                echo '<video id="video" muted controls style="display:none;height:350px;width:100%;margin:0 auto;" >
			                                      </video>';
			                            }
			                        ?>
			                        <br>
			                    	<center>
			                            <input id="files6" name="archivo" type="file" class="upload"/>
			                        </center>
			                        <br>
			                        <div class="text-center textHelper">
			                        	Tipo de archivos permitidos: mp4.
			                            <br>
			                            Tamaño máximo de archivo: 8MB.
			                        </div>
		                        </div>
		                        <div class="col-lg-6">
			                         <div class="espacios">
				                    	<span class="textHelper">Previsualizar el video en HD:</span>
				                     </div>
			                         <?php 
			                            if($temporal -> nombre_video_hd != ""){
			                                echo '<video id="video2" muted controls style="height:350px;width:100%;display:table;margin:0 auto;">
			                                        <source src="../videosSlide/'.$temporal -> nombre_video_hd.'" id="mp4Source"  type="video/mp4">
			                                      </video>';
			                            }
			                            else{
			                                echo '<video id="video2" muted controls style="display:none;height:350px;width:100%;margin:0 auto;" >
			                                      </video>';
			                            }
			                        ?>
			                        <br>
			                    	<center>
			                            <input id="files5" name="archivo_hd" type="file" class="upload"/>
			                        </center>
			                        <br>
			                        <div class="text-center textHelper">
			                        	Tipo de archivos permitidos: mp4.
			                            <br>
			                            Tamaño máximo de archivo: 15MB.
			                        </div>         
                                </div>
                                </div>
                                <div class="tab-pane" id="img">
                                	<p>Selecciona las imágenes del slide de inicio para dispositivos móviles.</p>
                                    <br>
                                    <br>
                                    <center>
                                        <input id="files2" name="archivo2[]" type="file" class="upload" multiple/>
                                    </center>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 textHelper">
                                        Tipo de archivos permitidos: jpg, jpeg, png, gif.
                                        <br>
                                        Tamaño máximo de archivo: 10MB.
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="textHelper">Previsualizar:</span>
                                    </div>
                                    <br>
                                    <!--Aquí es donde se previsualiza las imágenes secundarias-->
                                    <div class="col-lg-12 col-md-12" id="list2">
                                        
                                    </div>
                                    
                                    <div id="sortableImg">
                                    <?php
                                        if($id != 0){
                                                $temporal->listar_img_secundarias_inicio();
                                                foreach ($temporal->lista_imagenes_secundarias as $elementoImgS) {  
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" id="img2<?=$elementoImgS['id_imagen']?>">
                                            <div class="image-wrapper">
                                                <span class="image-options">
                                                    <ul class="ulmenuoptions">
                                                        <li onclick="deleteIMG2(<?=$elementoImgS['id_imagen']?>)"  class="limenuoptions manita">
                                                            <span class="inputUploadFont fontOptionsImg">Eliminar <i class="fa fa-times"></i></span>
                                                        </li>   
                                                        <li class="limenuoptions manita">
                                                            <div class="fileUpload" style="width:100%; border-color: none important!">
                                                                <input type="hidden" name="id_imagen[]" value="<?=$elementoImgS['id_imagen']?>"/>
                                                                <input type="hidden" class="idorden" name="idorden[]" value="<?=$elementoImgS['id_imagen']?>"/>
                                                                <span class="inputUploadFont fontOptionsImg manita">Editar <i class="fa fa-pencil"></i></span>
                                                                <input name="archivo3[]" type="file" onchange="showMyImage('imgedit<?=$elementoImgS['id_imagen']?>',this)" class="upload manita"/>
                                                            </div>
                                                        </li>   
                                                    </ul>
                                                </span>
                                              
                                                <div id="imgedit<?=$elementoImgS['id_imagen']?>" class="<?=$handle?>" >
                                                    <img style="margin: 0 0 20px 0" widht="100%" height="250px" src="../imgInicio/<?=$elementoImgS['nombre_imagen']?>"/>
                                                </div>
                                            </div>                                              
                                        </div>          
                                    <?php
                                                }
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                    </div>

                                </div>
                        </div>


                    	
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
    <script>
    /*
	  function handleFileSelect(evt) {
		var file3 = evt.target.file3; // FileList object
	
		// Loop through the FileList and render image file3 as thumbnails.
		for (var i = 0, f; f = file3[i]; i++) {
	
		  // Only process image file3.
		  if (!f.type.match('video.*')) {
			continue;
		  }
	
		  var reader = new FileReader();
	
		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
			  // Render thumbnail.
			  var span = document.createElement('span');
			  span.innerHTML = ['<video width="auto" height="221" src="', e.target.result,
								'" title="', escape(theFile.name), '"/>'].join('');
			  $("#list").empty();
			  document.getElementById('list').insertBefore(span, null);
			};
		  })(f);
	
		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}
	  }
	
	  document.getElementById('file3').addEventListener('change', handleFileSelect, false);*/
	  var video = document.getElementById('video');
	  var input = document.getElementById('files6');
	  input.addEventListener('change', function (evt) {
	    var reader = new window.FileReader(),
	        file = evt.target.files[0],
	        url;

	        reader = window.URL || window.webKitURL;

	    if (reader && reader.createObjectURL) {
	        url = window.URL.createObjectURL(file);
	        video.src = url;
	        //reader.revokeObjectURL(url);  //free up memory
	        $(video).fadeIn();
	        $(video).css({display:"table", margin:"0 auto"});
	        return;
	    }

	    if (!window.FileReader) {
	        console.log('Sorry, not so much');
	        return;
	    }

	    reader = new window.FileReader();
	    reader.onload = function(evt) {
	       video.src = evt.target.result;
	    };
	    reader.readAsDataURL(file);
	}, false);

	  var video2 = document.getElementById('video2');
	  var input2 = document.getElementById('files5');
	  input2.addEventListener('change', function (evt) {
	    var reader = new window.FileReader(),
	        file = evt.target.files[0],
	        url;

	        reader = window.URL || window.webKitURL;

	    if (reader && reader.createObjectURL) {
	        url = window.URL.createObjectURL(file);
	        video2.src = url;
	        //reader.revokeObjectURL(url);  //free up memory
	        $(video2).fadeIn();
	        $(video2).css({display:"table", margin:"0 auto"});
	        return;
	    }

	    if (!window.FileReader) {
	        console.log('Sorry, not so much');
	        return;
	    }

	    reader = new window.FileReader();
	    reader.onload = function(evt) {
	       video2.src = evt.target.result;
	    };
	    reader.readAsDataURL(file);
	}, false);
	</script>
 <!--Script que permite previsualizar la imagen Secundaria-->
	<script>
    	function showMyImage(id,fileInput) {
		//var files = evt.target.files; // FileList object 
        var files = fileInput.files;
		// Loop through the FileList and render image files as thumbnails.
		for (var x = 0, f; f = files[x]; x++) {
		  // Only process image files.
		  if (!f.type.match('image.*')) {
			continue;
		  }
		  var reader = new FileReader();
		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
			  // Render thumbnail.
			  var span = document.createElement('span');
			  span.innerHTML = ['<img width="auto" height="221" src="', e.target.result,
								'" title="', escape(theFile.name), '"/>'].join('');
			  $("#"+id).empty();
			  document.getElementById(id).insertBefore(span, null);
			};
		  })(f);
		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}    
    }
    </script>
    <!--Script que permite previsualizar la imagen Secundaria-->
    <script>
	  function handleFileSelect(evt) {
		var files2 = evt.target.files; // FileList object
		$("#list2").empty();
		 var div = document.createElement('div');
        div.className = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
        div.innerHTML = ['<p class="titulo">Imágenes Nuevas</p><br/>'].join('');
        document.getElementById('list2').insertBefore(div, null);  
		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files2[i]; i++) {
	
		  // Only process image files.
		  if (!f.type.match('image.*')) {
			continue;
		  }
	
		  var reader = new FileReader();
	
		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
			  // Render thumbnail.
			  var span = document.createElement('div');
			  span.className = "col-lg-3 col-md-4 col-sm-12 col-xs-12";
			  span.innerHTML = ['<img style="margin: 0 0 20px 0" class="img-responsive" src="', e.target.result,
								'" title="', escape(theFile.name), '"/>'].join('');
			  document.getElementById('list2').insertBefore(span, null);
			};
		  })(f);
	
		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}
	  }
	
	  document.getElementById('files2').addEventListener('change', handleFileSelect, false);
	</script>
	<script>
	function deleteIMG2(id){
		$.ajaxSetup({ cache: false });
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"operaciones.php",
			data:"idImg2="+id+"&operaciones=eliminar_img_inicio",
			success:function(data){	
				// console.log(data)			
				$("#img2"+id).fadeOut('slow');			
			},
			cache:false
		});		
	}    
</script>
 <!--Script que sirve para validar-->
	<script>
	function validar_campos(){
		var val = $("#files3").val();
		
		if (form1.titulo_video.value == ''){
			form1.titulo_video.focus();
			$('#titulo_video').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del titulo esta vacío, para poder continuar asigne un titulo al videoslide' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#titulo_video').removeClass("form-group has-error").addClass("form-group has-success");
		}
		
		<?=$validator?>
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
    $('#titulo_video').tooltip(
	{
		placement: "top",
        title: "Este campo es requerido"
	});
	$('#imgprin').tooltip(
	{
		placement: "top",
        title: "Campo Requerido. Agregue la imagen principal de este slide, solo se aceptan imágenes con formato .jpg, .png y .gif ."
	});
});
</script>
</html>
