<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
	
	$operacion='modificar_meta_tags';
	$palabra='Editar Meta Tags';
	$temporal = new metas(1);
	$temporal -> obtener_metas();
  $clave = 'ModMetTag';
  $id = 1;
?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario de Meta Tags</title>
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
                    		<input type="hidden" name="id_metas" value="1"/>        
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
                    	 <div id="meta_titulo" class="input-group espacios col-xs-6">
                        	<span class="input-group-addon es">Meta título</span>
                        	<input type="text"  name="meta_titulo" class="form-control" placeholder="Ingrese el meta título..." value="<?=$temporal->meta_titulo?>">
                        </div>
                        <div id="meta_empresa" class="input-group espacios col-xs-6">
                            <span class="input-group-addon es">Meta empresa</span>
                            <input type="text"  name="meta_empresa" class="form-control" placeholder="Ingrese el meta empresa...." value="<?=$temporal->meta_empresa?>">
                        </div>
                        <div id="meta_descripcion" class="input-group espacios">
                            <span class="textHelper">Meta descripción</span>
                            <div id="node" class="nada">
                              <textarea name="meta_descripcion" id="summernote"><?=$temporal->meta_descripcion?></textarea>
                            </div>
                        </div>

                        <p>Selecciona las imágenes para los metas y compartir en redes sociales.</p>
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
                        <div class="col-lg-12 col-md-12" id="list2">
                                        
                        </div>
                        
                        <div id="sortableImg">
                        <?php
                            if($id != 0){
                                    $temporal->listar_img_secundarias_metas();
                                    foreach ($temporal->lista_imagenes_secundarias as $elementoImgS) {  
                        ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="img2<?=$elementoImgS['id_img_metas']?>">
                                <div class="image-wrapper">
                                    <span class="image-options">
                                        <ul class="ulmenuoptions">
                                            <li onclick="deleteIMG2(<?=$elementoImgS['id_img_metas']?>)"  class="limenuoptions manita">
                                                <span class="inputUploadFont fontOptionsImg">Eliminar <i class="fa fa-times"></i></span>
                                            </li>   
                                            <li class="limenuoptions manita">
                                                <div class="fileUpload" style="width:100%; border-color: none important!">
                                                    <input type="hidden" name="id_imagen[]" value="<?=$elementoImgS['id_img_metas']?>"/>
                                                    <input type="hidden" class="idorden" name="idorden[]" value="<?=$elementoImgS['id_img_metas']?>"/>
                                                    <span class="inputUploadFont fontOptionsImg manita">Editar <i class="fa fa-pencil"></i></span>
                                                    <input name="archivo3[]" type="file" onchange="showMyImage('imgedit<?=$elementoImgS['id_img_metas']?>',this)" class="upload manita"/>
                                                </div>
                                            </li>   
                                        </ul>
                                    </span>
                                  
                                    <div id="imgedit<?=$elementoImgS['id_img_metas']?>" class="<?=$handle?>" >
                                        <img style="margin: 0 0 20px 0" widht="100%" height="250px" src="../imgMetas/secundarias/<?=$elementoImgS['ruta']?>"/>
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
	<script>
	function validar_campos(){
        var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;

		if(form1.facebook.value != ""){
            if (form1.facebook.value.length < 2 || !myRegExp.test(form1.facebook.value)){
           form1.facebook.focus();
           $('#facebook').removeClass("form-group").addClass("form-group has-error");
           $('.top-right').notify({
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.facebook.com/DonPorfirioTV)' },
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

        if(form1.twitter.value != ""){
            if (form1.twitter.value.length < 2 || !myRegExp.test(form1.twitter.value)){
           form1.youtube.focus();
           $('#twitter').removeClass("form-group").addClass("form-group has-error");
           $('.top-right').notify({
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.twitter.com/donporfirio)' },
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
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.vimeo.com/donporfirio)' },
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

        if(form1.behance.value != ""){
            if (form1.behance.value.length < 2 || !myRegExp.test(form1.behance.value)){
           form1.behance.focus();
           $('#behance').removeClass("form-group").addClass("form-group has-error");
           $('.top-right').notify({
               message: { text: 'Esta no es una link válida (Ej. de link válida https://www.behance.com/donporfirio)' },
               type:'blackgloss',
             }).show();
           return false;
           }
          else{
           $('#behance').removeClass("form-group has-error").addClass("form-group has-success");
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
    jQuery(document).ready(function() {
        jQuery('#summernote').summernote({
          height: 200,
        toolbar: [
                //[groupname, [button list]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
              ['Misc', ['fullscreen']],
            ],
        onpaste: function(e) {
          //alert('entre');
          var thisNote = $(this);
          //alert(thisNote);
          var updatePastedText = function(someNote){
            var original = someNote.code();
            //alert(original);
            var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
            someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
          };
          setTimeout(function () {
            //this kinda sucks, but if you don't do a setTimeout, 
            //the function is called before the text is really pasted.
            updatePastedText(thisNote);
          }, 10);
    
    
        }
        });
        $('#form-validation').on('submit', function (e) {
             var content = $('textarea[name="texto"]').html($('#summernote').code());
         });
    });
    
    /*DESCRIPCION DE USO:
     #summernote: es el id que tenga tu textarea
     #form-validation: es el id que como se llame tu form
     textarea[name="descripcion"]: es el nombre del textarea
     estos datos los cambias por como llamaste a los tuyos*/
     function CleanPastedHTML(input) {
        // 1. remove line breaks / Mso classes
        var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
        var output = input.replace(stringStripper, ' ');
        // 2. strip Word generated HTML comments
        var commentSripper = new RegExp('<!--(.*?)-->','g');
        var output = output.replace(commentSripper, '');
        var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>','gi');
        // 3. remove tags leave content if any
        output = output.replace(tagStripper, '');
        // 4. Remove everything in between and including tags '<style(.)style(.)>'
        var badTags = ['style', 'script','applet','embed','noframes','noscript'];
      
        for (var i=0; i< badTags.length; i++) {
        tagStripper = new RegExp('<'+badTags[i]+'.*?'+badTags[i]+'(.*?)>', 'gi');
        output = output.replace(tagStripper, '');
        }
        // 5. remove attributes ' style="..."'
        var badAttributes = ['style', 'start'];
        for (var i=0; i< badAttributes.length; i++) {
        var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"','gi');
        output = output.replace(attributeStripper, '');
        }
        return output;
    }
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
