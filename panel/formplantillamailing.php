<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
if(isset($_REQUEST['idplantilla'])){
	$id=$_REQUEST['idplantilla'];
	$operacion='modificarplantilla';
	$palabra='Editar Plantilla Mailing';
	$temporal = new plantilla_mailing($id);
	$temporal -> obtenerPlantilla();
}
else{
	$id=0;
	$operacion='agregarplantilla';
	$palabra='Nueva Plantilla Mailing';
	$img='';
	$temporal = new plantilla_mailing($id);
}

?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario De Plantilla Para Mailing</title>
<?php
include'header.html';//contiene las barras de arriba y los menus.
include'menu.php';//Contiene a todo el menu.
?> 
   <style>
        tr{
                cursor: move;
            }
            .note-editable{
                cursor: auto;
            }

            iframe{
                display: table-cell;
                vertical-align: middle; /*Vertically centered*/
                text-align: center;
                margin:0 auto;

            }

            div.upload
            {
                position:relative;
                width: 52px;
                height: 28px;
                overflow:hidden;
                display: inline;
                margin-right: 104px;
                cursor: pointer;
            }

            div.upload2
            {
                position:relative;
                width: 52px;
                height: 38px;
                overflow:hidden;
                display: inline-block;
                margin-right: 104px;
                cursor: pointer;
            }

            div.upload button
            {
                position: absolute;
                width: 52px;
                height: 28px;
                display: inline;
                cursor: pointer;
            }

            div.upload2 button
            {
                position: absolute;
                width: 52px;
                height: 38px;
                display: inline-block;
                cursor: pointer;
            }

            div.upload input
            {
                font: 0px monospace; /* make the input's button HUGE */
                opacity:0; /* this will make it transparent */
                filter: alpha(opacity=0); /* transparency for Internet Explorer */
                position: absolute;  /* making it absolute with z-index:1 will place it on top of the button */
                z-index: 1;
                top:0;
                right:0;
                padding:0;
                margin: 0;
                display: inline;
                width:52px;
                cursor: pointer;
                left:3px;
                height:28px;
            }

            div.upload2 input
            {
                font: 0px monospace; /* make the input's button HUGE */
                opacity:0; /* this will make it transparent */
                filter: alpha(opacity=0); /* transparency for Internet Explorer */
                position: absolute;  /* making it absolute with z-index:1 will place it on top of the button */
                z-index: 1;
                top:0;
                right:0;
                padding:0;
                margin: 0;
                display: inline;
                width:52px;
                cursor: pointer;
                left:3px;
                height:28px;
            }

            div.tagsinput span.tag{
                background-color:#de5a51;
                border:hidden;
            }

            div.tagsinput span.tag a{
                color:#fff;
            }

            #tags_tagsinput, #colabs_tagsinput{
                border:hidden;
                background-color:#e6e7e8;
            }

            #files3{
                margin-top:0px;
                left:25px;
            }
            #modalancho{width:60%}
            #novisible{display:block}
            
            .fileWrapper {
                float: left;
                width: 50px;
                height: 24px;
                margin: 0;
            }
            #div_upload_big {float: inherit;}

            #contents ul{
                display: inline;
            }
   </style>

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
                    		<input type="hidden" name="idplantilla" value="<?=$temporal->idplantilla?>"/>
                    		<!--<input type="hidden" name="status" value="<? //=$temporal->status?>"/>	-->                   		
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar</button>
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
                    <div class="col-lg-12 col-md-9 col-sm-12 col-xs-12">
                    	<div id="nombre_plantilla" class="input-group espacios col-lg-9">
                        	<span class="input-group-addon es">Nombre de la Plantilla</span>
                        	<input type="text"  name="nombre_plantilla" class="form-control" placeholder="Ingrese el nombre de la plantilla aquí..." value="<?=$temporal->nombre_plantilla?>">
                        </div>
                        <br>
                        <h4>Arma tu plantilla con los siguientes elementos:</h4>
                        <br>
                        <div class="insert-content col-xs-12" id="contents">
                            <div class="col-lg-6 col-lg-offset-3">
                                <ul class="col-lg-12">
                                    <li style="height:25px;">
                                        <span class="edit-button insert-button insert-img">
                                            <div class="upload">
                                                <button onclick="addImageToTemplate()" type="button" class="btn"><i class="fa fa-picture-o"></i></button>
                                                <!--<input id="files3" class="files" type="file" name="upload"/>-->
                                            </div>
                                            <br>
                                            <label class="img">Imagen</label>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <span class="edit-button insert-button insert-text">
                                            <button class="btn" type="button" onclick="addTextAreaTemplate()"><i class="fa fa-file-text-o"></i></button>
                                            <br>
                                            <label>Texto</label>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            

                        </div>
                        <br>
                        <div class="col-lg-6 col-lg-offset-3">
                            <table id="myTable" class="table table-hover tablesorter">
                                        <tbody id="project-modules">
                                            <?php 
                                                if($idportafolio != 0){
                                                    foreach($xmlNodes as $key => $xmlNode) {
                                                        
                                                        switch ($key) {
                                                            case 'title':
                                                                break;
                                                                default:
                                                                    if(strrpos($key, "img") !== false){
                                                                        $images++;
                                                                        $xmlNode = str_replace("'", "", $xmlNode);
                                                                        $fileName = basename($xmlNode);
                                                                        if(file_exists(realpath(trim("./portafolio/secundarias/".$fileName)))){
                                                                            echo '<tr class="img node" data-id="'.$images.'">
                                                                                <td>
                                                                                <div style="width:100%;height:auto;overflow:auto;">
                                                                                            <div class="image-wrapper">
                                                                                                <span class="image-options">
                                                                                                    <ul class="ulmenuoptions">
                                                                                                        <li  class="pull-left">
                                                                                                            <span class="inputUploadFont fontOptionsImg"><i class="fa fa-2x fa-bars"></i></span>
                                                                                                        </li>
                                                                                                        <li class="pull-right" style="margin-rigth:20px;" onclick="deleteElement(\'img\', \''.$images.'\')"  class="limenuoptions manita">
                                                                                                            <span class="inputUploadFont fontOptionsImg"><i style="margin-right:20px;" class="fa fa-2x fa-times manita"></i></span>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </span>
                                                                                                <img width="100%" class="img" data-id="'.$images.'" height="auto" id="img'.$images.'" src="'.$xmlNode.'" title="Imagen">
                                                                                            </div>                                    
                                                                                        </div>
                                                                                </td>
                                                                                </tr>';
                                                                        }
                                                                        
                                                                    }
                                                                    else if(strrpos($key, "text") !== false){
                                                                            $txts++;
                                                                            echo '<tr class="txt" data-id="'.$txts.'"><td>
                                                                                        <div class="col-xs-12 txt-container">
                                                                                            <span style="width:25px;"   class="pull-left  "><i style="float:left;" class="fa fa-2x fa-bars"></i></span>
                                                                                            <span style="width:25px;" onclick="deleteElement(\'txt\', \''.$txts.'\')"   class="pull-right limenuoptions manita"><i style="float:right;" class="fa fa-2x fa-times"></i></span>
                                                                                        </div>
                                                                                        <div id="txt'.$txts.'" data-id="'.$txts.'" >'.html_entity_decode($xmlNode).'</div>
                                                                                  </td></tr>';
                                                                            
                                                                                    $arrayTiny[] = "$('#txt".$txts."').summernote({
                                                                                                            height: 150,
                                                                                      
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
                                                                                                        });";
                                                                                    
                                                                    }
                                                                    else if(strrpos($key, "video") !== false){
                                                                            $videos++;
                                                                            echo '<tr class="video" data-id="'.$videos.'"><td>

                                                                                    <div class="module-video">
                                                                                        <span  style="width:25px;"  class="pull-left"><i style="float:left;" class="fa fa-2x fa-bars"></i></span>
                                                                                        <span onclick="deleteElement(\'video\', \''.$videos.'\')"  style="width:25px;"  class="pull-right manita"><i style="float:right;" class="fa fa-2x fa-times"></i></span>
                                                                                        <div class="edit-block">
                                                                                            <div class="video-module-content">
                                                                                                <div class="form-edit-video">
                                                                                                    <textarea id="video'.$videos.'" data-id="'.$videos.'" rows="9" data-type="txt" name="editvideo" style="width:100%;">'.html_entity_decode($xmlNode).'</textarea>
                                                                                                    <span class="error">Codigo invalido</span>
                                                                                                </div>
                                                                                                <p><strong>Agregar:</strong> Vimeo, YouTube,  SoundCloud</p>
                                                                                            </div>
                                                                                            <input type="hidden" name="videopreview" class="videoprev" value="'.$videos.'"/>                                            
                                                                                            <button type="button" class="aceptar btn transparent" onclick="previewMedia(\''.$videos.'\')">Aceptar <i class="fa fa-1x fa-chevron-right" style="margin-left:10px;margin-top:5px;"></i></button>
                                                                                        </div>                                  
                                                                                </div></td></tr>';
                                                                    }
                                                                break;
                                                            
                                                        }
                                                    }
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                        </div>
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
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar</button>
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
     var ID_PORTAFOLIO = <?php echo json_encode($portafolio -> idportafolio);?>;
     var IMAGES = <?php echo json_encode($images);?>;
     var TXTS = <?php echo json_encode($txts);?>;
</script>
<script>
      $(function() {
        $( "#myTable" ).sortable({
            cursor: "move",
            cursorAt: { right: 500 },
            delay: 150,
            distance: 5,
            forceHelperSize: true,
            handle: ".handle",
            opacity: 0.5,
            revert: true,
            update : function(e, ui) {
                guardarOrden('<?= $sort ?>');
            }
        });
        $( "#myTable" ).disableSelection();
      });
    </script>
<script src="js/funciones_plantilla.js"></script>
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
