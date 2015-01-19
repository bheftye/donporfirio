<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}

	$seguridad = new seguridad();
	$seguridad->candado();
	
if(isset($_REQUEST['id_proyecto'])){
	$id=$_REQUEST['id_proyecto'];
	$operacion='modificar_proyecto';
	$palabra='Editar Proyecto';
	$temporal = new proyecto($id);
	$temporal -> obtener_proyecto();
	
	if($temporal->img_principal != '')
		$img_principal = '<img src="../imgProyectos/'.$temporal->img_principal.'" width="auto" height="221"/>';
	else 
		$img_principal='';
	if($temporal->img_principal != ''){
		$validator='';
	}
	else{
		$validator='if (!val.match(/(?:gif|jpg|png)$/)) {
    		$("#imgprin").removeClass("form-group").addClass("form-group has-error"); 
			$(".top-right").notify({
    			message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .jpg .png .gif. Verifique que haya seleccionado una imagen principal." },
    			type:"blackgloss",
    			delay: 6000,
  			}).show(); 
			return false; 
		}';
	}
	$validator2='';
}
else{
	$id=0;
	$operacion='agregar_proyecto';
	$palabra='Nuevo Proyecto';
	$img_principal='';
	$temporal = new proyecto($id);
	$validator='if (!val.match(/(?:gif|jpg|png)$/)) {
    		$("#imgprin").removeClass("btn-default").addClass("btn-danger"); 
			$(".top-right").notify({
    			message: { text: "Agregue la imagen principal para poder continuar y solo se aceptan imágenes con formato .jpg .png .gif" },
    			type:"blackgloss",
    			delay: 10000,
  			}).show(); 
			return false; 
		}
		else{
			$("#imgprin").removeClass("btn-danger").addClass("btn-success"); 
		}';
    $lista_categorias_asociadas = array();
}
$clave = 'ModProy';
$clave2='SortImgProy';
$sort='imgproyecto';
$handle = "";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0){
  $handle = "";
}else{
  $handle = 'handle sortimg';
} 

$categoria = new categoria();
$categorias_proyectos = $categoria -> listar_categorias_activas();


$ids_categorias_asocidas = array();

if($id != 0){
    $ids_categorias_asocidas = $temporal -> listar_ids_categorias_asociadas();
}

?>

<?php
include 'head.html';//contiene los estilos y los metas
?>
	<title>Formulario De Proyectos</title>
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
                    		<input type="hidden" name="MAX_FILE_SIZE" value="600000000"/>
                    		<input type="hidden" name="id_proyecto" value="<?=$temporal->id_proyecto?>"/>                		
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
                    <p class="col-lg-12" style="color:red;">Los campos con * son obligatorios. </p>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#esp" role="tab" data-toggle="tab">Español</a></li>
                                <li><a href="#eng" role="tab" data-toggle="tab">English</a></li>
                                <li><a href="#cat" role="tab" data-toggle="tab">Categorías</a></li>
                                <li><a href="#beh" role="tab" data-toggle="tab">Behance</a></li>
                                <li><a href="#img" role="tab" data-toggle="tab">Imágenes</a></li>
                                <li><a href="#vid" role="tab" data-toggle="tab">Video</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="esp">
                                    <div id="titulo_esp" class="input-group espacios">
                                        <span class="input-group-addon es">Título del Proyecto*</span>
                                        <input type="text"  name="titulo_esp" class="form-control" placeholder="Ingrese el título aquí..." value="<?=$temporal->titulo_esp;?>">
                                    </div>
                                    <div id="subtitulo_esp" class="input-group espacios">
                                        <span class="input-group-addon es">Subtítulo del Proyecto*</span>
                                        <input type="text"  name="subtitulo_esp" class="form-control" placeholder="Ingrese el subtítulo aquí..." value="<?=$temporal->subtitulo_esp;?>">
                                    </div>
                                    <span class="textHelper">Ingrese la descripción del proyecto aquí*:</span>
                                    <textarea name="descripcion_esp" id="summernote2"><?=$temporal->descripcion_esp;?></textarea>
                                    <br>
                                    <div id="meta_titulo_esp" class="input-group espacios">
                                        <span class="input-group-addon es">Meta Título (70 caracteres máximo.)*</span>
                                        <input type="text" name="meta_titulo_esp" id="meta_titulo_input" maxlength="70" value="<?=$temporal -> meta_titulo_esp;?>"/>
                                    </div>
                                    <div id="meta_descripcion_esp" class="input-group espacios">
                                        <span class="input-group-addon es">Meta Descripción (160 caracteres máximo.)*</span>
                                    <textarea name="meta_descripcion_esp" class="col-lg-12" rows="5" maxlength="160" style="resize:none;"><?=$temporal -> meta_descripcion_esp;?></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="eng">
                                    <div id="titulo_eng" class="input-group espacios">
                                        <span class="input-group-addon es">Proyect's Title*</span>
                                        <input type="text"  name="titulo_eng" class="form-control" placeholder="Set title here..." value="<?=$temporal->titulo_eng?>">
                                    </div>
                                    <div id="subtitulo_eng" class="input-group espacios">
                                        <span class="input-group-addon es">Proyect's Subtitle*</span>
                                        <input type="text"  name="subtitulo_eng" class="form-control" placeholder="Set the subtitle here..." value="<?=$temporal->subtitulo_eng?>">
                                    </div>
                                    <span class="textHelper">Set the proyect's description*:</span>
                                    <textarea name="descripcion_eng" id="summernote3"><?=$temporal->descripcion_eng;?></textarea>
                                    <br>
                                    <div id="meta_titulo_eng" class="input-group espacios">
                                        <span class="input-group-addon es">Meta title (70 caracteres máximo.)*</span>
                                        <input type="text" name="meta_titulo_eng" id="meta_titulo_input" maxlength="70" value="<?=$temporal -> meta_titulo_eng;?>"/>
                                    </div>
                                    <div id="meta_descripcion_eng" class="input-group espacios">
                                        <span class="input-group-addon es">Meta description (160 caracteres máximo.)*</span>
                                    <textarea name="meta_descripcion_eng" class="col-lg-12" rows="5" maxlength="160" style="resize:none;"><?=$temporal -> meta_descripcion_eng;?></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane" id="cat">
                                    <p style="margin-top: 25px;">Selecciona las categorías a las que pertenece el proyecto</p>
                                    <select id="categorias_proyectos" name="categorias[]" class="select-picker col-lg-12" multiple title='Seleccione las categorías del proyecto' >
                                        <?php
                                            foreach ($categorias_proyectos as $una_categoria) {
                                                if(in_array($una_categoria["id_categoria"], $ids_categorias_asocidas)){
                                                    echo " <option selected value=\"".$una_categoria["id_categoria"]."\">".$una_categoria["nombre_esp"]."</option>";
                                                }
                                                else{
                                                    echo " <option value=\"".$una_categoria["id_categoria"]."\">".$una_categoria["nombre_esp"]."</option>";
                                                }
                                                
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="tab-pane" id="beh">
                                    <div id="behance" class="input-group espacios">
                                        <span class="input-group-addon es">Link de Behance del proyecto*</span>
                                        <input type="text"  name="behance" class="form-control" placeholder="Ingrese el link de behance..." value="<?=$temporal->behance?>">
                                    </div>
                                </div>
                                <div class="tab-pane" id="img">
                                    <div class="espacios">
                                        <span class="textHelper">Previsualizar:</span>
                                        <br>
                                        <output align="center" id="list"><?=$img_principal?></output>
                                        <br>
                                        <center>
                                           
                                            <input id="files" name="archivo" type="file" class="upload"/>
                                        </center>
                                        <br>
                                        <div class="text-center textHelper">
                                            Tipo de archivos permitidos: jpg, jpeg, png, gif.
                                            <br>
                                            Tamaño máximo de archivo: 4MB.
                                        </div>
                                        <br>
                                    </div>

                                    <br>
                                    <br>
                                    <center>
                                        
                                        <input id="files2" name="archivo2[]" type="file" class="upload" multiple/>
                                    </center>
                                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 textHelper">
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
                                                $temporal->listar_img_secundarias_proyecto();
                                                foreach ($temporal->lista_imagenes_secundarias as $elementoImgS) {  
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" id="img2<?=$elementoImgS['id_img_proyecto']?>">
                                            <div class="image-wrapper">
                                                <span class="image-options">
                                                    <ul class="ulmenuoptions">
                                                        <li onclick="deleteIMG2(<?=$elementoImgS['id_img_proyecto']?>)"  class="limenuoptions manita">
                                                            <span class="inputUploadFont fontOptionsImg">Eliminar <i class="fa fa-times"></i></span>
                                                        </li>   
                                                        <li class="limenuoptions manita">
                                                            <div class="fileUpload" style="width:100%; border-color: none important!">
                                                                <input type="hidden" name="idimgproyecto[]" value="<?=$elementoImgS['id_img_proyecto']?>"/>
                                                                <input type="hidden" class="idorden" name="idorden[]" value="<?=$elementoImgS['id_img_proyecto']?>"/>
                                                                <span class="inputUploadFont fontOptionsImg manita">Editar <i class="fa fa-pencil"></i></span>
                                                                <input name="archivo3[]" type="file" onchange="showMyImage('imgedit<?=$elementoImgS['id_img_proyecto']?>',this)" class="upload manita"/>
                                                            </div>
                                                        </li>   
                                                    </ul>
                                                </span>
                                              
                                                <div id="imgedit<?=$elementoImgS['id_img_proyecto']?>" class="<?=$handle?>" >
                                                    <img style="margin: 0 0 20px 0" widht="100%" height="250px" src="../imgProyectos/secundarias/<?=$elementoImgS['ruta']?>"/>
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
                                <div class="tab-pane" id="vid">
                                    
                                    <br>
                                    <div class="col-lg-6">
                                    <div class="espacios">
                                        <span class="textHelper">Previsualizar Video de Fondo:</span>
                                    </div>
                                        <?php 
                                            if($temporal -> nombre_video != ""){
                                                echo '<video id="video" muted controls style="height:auto;width:100%;display:table;maring:0 auto;">
                                                        <source src="../vidProyectos/'.$temporal -> nombre_video.'" id="mp4Source"  type="video/mp4">
                                                      </video>';
                                            }
                                            else{
                                                echo '<video id="video" muted controls style="display:none;height:auto;width:500px;" >
                                                      </video>';
                                            }
                                        ?>
                                        
                                        <br>
                                        <center>
                                            <input id="files6" name="archivo_video" type="file" class="upload"/>
                                        <center>
                                        <br>
                                        <div class="text-center textHelper">
                                        Tipo de archivos permitidos: mp4.
                                        <br>
                                        Tamaño máximo de archivo: 30MB.
                                        </div>
                                        <br>  
                                    </div>
                                    
                                   
                                    <div class="col-lg-6">
                                         <div class="espacios">
                                            <span class="textHelper">Previsualizar Video de Vista Previa:</span>
                                        </div>
                                            <?php 
                                                if($temporal -> nombre_preview != ""){
                                                    echo '<video id="video2" muted controls style="height:auto;width:100%;display:table;margin:0 auto;">
                                                            <source src="../vidProyectos/'.$temporal -> nombre_preview.'" id="mp4Source"  type="video/mp4">
                                                          </video>';
                                                }
                                                else{
                                                    echo '<video id="video2" muted controls style="display:none;height:auto;width:100%;">
                                                          </video>';
                                                }
                                            ?>
                                            <br>
                                            <center>
                                                <input id="files4" name="archivo_preview" type="file" class="upload"/>
                                            </center>
                                            <br>
                                            <div class="text-center textHelper">
                                                Tipo de archivos permitidos: mp4.
                                                <br>
                                                Tamaño máximo de archivo: 30MB.
                                            </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <hr class="hrmenu">
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="button" name="operaciones" style="float:left;" data-toggle="modal" data-target="#myModal" class="buttonguardar">Agregar Video Vimeo</button>
                                        <div id="videos" class="col-lg-12"></div>
                                        <div class="clearfix"></div>
                                        <div id="sortableVid">
                                        <?php
                                            if($id != 0){
                                                    $temporal->listar_links_videos();
                                                    foreach ($temporal->lista_links_videos as $link_video) {  
                                                        $video_url_exploded = explode(".com/",$link_video['link_video']);
                                                        $video_id = $video_url_exploded[1];
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" id="link_video_<?=$link_video['id_link']?>">
                                            <div class="image-wrapper">
                                                <span class="image-options">
                                                    <ul class="ulmenuoptions">
                                                        <li onclick="deleteLinkVideo(<?=$link_video['id_link'];?>)"  class="limenuoptions manita">
                                                            <span class="inputUploadFont fontOptionsImg">Eliminar <i class="fa fa-times"></i></span>
                                                        </li>   
                                                        <li class="limenuoptions manita">
                                                            <div class="fileUpload" style="width:100%; border-color: none important!">
                                                                <input type="hidden" name="ids_links_videos[]" value="<?=$link_video['id_link'];?>"/>
                                                                <input type="hidden" class="idorden" name="idorden_vid[]" value="<?=$link_video['id_link'];?>"/>
                                                            </div>
                                                        </li>   
                                                    </ul>
                                                </span> 
                                              
                                                <div id="vid_edit<?=$link_video['id_link'];?>" class="<?=$handle?>" >
                                                    <iframe id="player<?=$link_video['id_link'];?>" src="//player.vimeo.com/video/<?=$video_id;?>?api=1&player_id=player<?=$link_video['id_link'];?>&color=ee396a" style="height:100%;width:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
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
                        <br>
                        <div class="modal fade" id="myModal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Agregar Link Video de Vimeo</h4>
                              </div>
                              <div class="modal-body">
                                <div id="link_video_nuevo" class="input-group espacios">
                                    <span class="input-group-addon es">Link Video Vimeo*</span>
                                    <input type="text" id="input_link_video" class="form-control" placeholder="Introduce el link aqui.... " >
                                </div>
                                <br>
                                <p id="mensaje_modal"></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" onclick="guardarVideo()" class="btn btn-primary">Guardar</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    	
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
	<script>
		jQuery(document).ready(function() {
  			jQuery('#summernote2').summernote({
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
            jQuery('#summernote3').summernote({
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
       			 var content = $('textarea[name="descripcion_esp"]').html($('#summernote2').code());
                 var content = $('textarea[name="descripcion_eng"]').html($('#summernote3').code());
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

        var videos = 0;
        function guardarVideo(){
            var link_video = $("#input_link_video").val();

            if(link_video != ""){
                $("#input_link_video").css("border", "solid 1px green");
                var regVimeo = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
                if(regVimeo.test(link_video)){
                    var splitted_link = link_video.split(".com/");
                    var video_id = splitted_link[1];
                    var html = '<div id="vid_edit'+videos+'"  class="col-lg-4" style="height:300px;" >'+
                                    '<iframe id="player'+videos+'" src="//player.vimeo.com/video/'+video_id+'?api=1&player_id=player'+videos+'" style="height:100%;width:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'+
                                    '<input type="hidden" value="'+link_video+'">'+
                                '</div>';
                    $("#videos").append(html);
                    $("#mensaje_modal").html("").css("color","green");
                    $('#myModal').modal('toggle')
                }
            }
            else{
                $("#input_link_video").css("border", "solid 1px red");
                $("#mensaje_modal").html("El campo esta vacío.").css("color","red");
            }
        }
	</script>
    <!--Script que permite previsualizar la imagen primaria-->
    <script>
	  function handleFileSelect(evt) {
		var files = evt.target.files; // FileList object
	
		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) {
	
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
			  $("#list").empty();
			  document.getElementById('list').insertBefore(span, null);
			};
		  })(f);
	
		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}
	  }
	
	  document.getElementById('files').addEventListener('change', handleFileSelect, false);

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
      var input2 = document.getElementById('files4');
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

      var video3 = document.getElementById('video3');
      var input3 = document.getElementById('files5');
      input3.addEventListener('change', function (evt) {
        var reader = new window.FileReader(),
            file = evt.target.files[0],
            url;

            reader = window.URL || window.webKitURL;

        if (reader && reader.createObjectURL) {
            url = window.URL.createObjectURL(file);
            video3.src = url;
            //reader.revokeObjectURL(url);  //free up memory
            $(video3).fadeIn();
            $(video3).css({display:"table", margin:"0 auto"});
            return;
        }

        if (!window.FileReader) {
            console.log('Sorry, not so much');
            return;
        }

        reader = new window.FileReader();
        reader.onload = function(evt) {
           video3.src = evt.target.result;
        };
        reader.readAsDataURL(file);
    }, false);
	</script>
    <!--Previsualizar imagenes 2-->
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
	
 <!--Script que sirve para validar-->
	<script>

    $('#categorias_productos').selectpicker();

    $('.select-picker').selectpicker();

	function validar_campos(){
		var val = $("#files").val();
        
        var titulo = $('input[name="titulo"]').val();
        var subtitulo = $('input[name="subtitulo"]').val();
        var descripcion = $('textarea[name="descripcion"]').html($('#summernote2').code()).val();
        var meta_titulo = $('input[name="meta_titulo"]').val();
        var meta_descripcion = $('textarea[name="meta_descripcion"]').val();
		
		if (titulo == ''){
			$('input[name="titulo"]').focus();
			$('#titulo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El campo de título en Español esta vacío, para poder continuar asigne un título.' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#titulo').removeClass("form-group has-error").addClass("form-group has-success");
		}
        if (subtitulo == ''){
            $('input[name="subtitulo"]').focus();
            $('#subtitulo').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El campo de subtítulo esta vacío, para poder continuar asigne un subtítulo.' },
                type:'blackgloss',
            }).show();
            return false;
            }
        else{
            $('#subtitulo').removeClass("form-group has-error").addClass("form-group has-success");
        }

        if(descripcion == '' ){
            $('#summernote2').focus();
            $('#summernote2').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El campo de descripción esta vacío, para poder continuar llene la descripción.' },
                type:'blackgloss',
            }).show();
            return false;
            }
        else{
            $('#summernote2').removeClass("form-group has-error").addClass("form-group has-success");
        }

        if(meta_titulo == '' ){
            $('input[name="meta_titulo"]').focus();
            $('#meta_titulo').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El campo de meta-título en Español esta vacío, para poder continuar llene el meta-título.' },
                type:'blackgloss',
            }).show();
            return false;
            }
        else{
            $('#meta_titulo').removeClass("form-group has-error").addClass("form-group has-success");
        }
        
        if(meta_descripcion == '' ){
            $('textarea[name="meta_descripcion"]').focus();
            $('#meta_descripcion').removeClass("form-group").addClass("form-group has-error");
            $('.top-right').notify({
                message: { text: 'El campo de meta-descripción en Español esta vacío, para poder continuar llene el meta-descripción.' },
                type:'blackgloss',
            }).show();
            return false;
            }
        else{
            $('#meta_descripcion').removeClass("form-group has-error").addClass("form-group has-success");
        }

		<?=$validator?>
	}
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
			data:"idImg2="+id+"&operaciones=eliminar_img_proyecto",
			success:function(data){	
				// console.log(data)			
				$("#img2"+id).fadeOut('slow');			
			},
			cache:false
		});		
	}
    $('#link_video_select').selectpicker();

    //$( "#sortableImg" ).sortable({tolerance:"pointer", cancel:".manita,.limenuoptions, img", cursor:"move",  placeholder: "fa-bars"});
    
</script>
<script>
$(function() {
    $('#titulo').tooltip(
	{
		placement: "top",
        title: "Este campo es requerido"
	});
	$('#subtitulo').tooltip(
	{
		placement: "top",
        title: "Ingrese el subtitulo de la noticia aquí."
	});
	
	$('#imgprin').tooltip(
	{
		placement: "top",
        title: "Campo Requerido. Agregue la imagen principal de esta noticia, solo se aceptan imágenes con formato .jpg, .png y .gif ."
	});
	$('#imgsecu').tooltip(
	{
		placement: "top",
        title: "Agregue las imagenes secundarias de esta noticia, solo se aceptan imágenes con formato .jpg, .png y .gif ."
	});
});
</script>
</html>
