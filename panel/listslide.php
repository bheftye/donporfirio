<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$seguridad = new seguridad();
$seguridad->candado();
if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
	switch($success){
		case '0':
			$alert = '<div class="alert alert-danger alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡UPS!</strong> No selecciono ningún elemento.
					  </div>';
		break;
		case '1':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha creado correctamente este slide.
					  </div>';	
		break;
		case '2':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha modificado correctamente este slide.
					  </div>';	
		break;
		case '3':
			$alert = '<div class="alert alert-info alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha eliminado correctamente este(os) slide(s).
					  </div>';	
		break;
		case '4':
			$alert = '<div class="alert alert-info alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha activado correctamente este(os) slide(s).
					  </div>';	
		break;
		case '5':
			$alert = '<div class="alert alert-warning alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡MUY BIEN!</strong> Se ha desactivado correctamente este(os) slide(s), cuando desactiva elementos estos no se muestran en la parte principal de la página.
					  </div>';	
		break;				
	}
}
else{
	$success = '';
	$alert = '';
}
$temporal = new slide();
$listaTemporal = $temporal -> listarslide();
$clave='AgrSlide';
$clave2='ElimSlide';
$clave3='AcDcSlide';
$clave4='SortTableSlide';
$sort="slide";
$handle="";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0){
  $handle = "";
}else{
  $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
} 

?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Listado De Los Slides</title>
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
                  <div class='notifications bottom-right'></div>
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p class="titulo">Slides</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<form action="formslide.php" method="post">
                    		<button <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
                        </form>   
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <div class="clearfix"></div>
                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    <form method="post" action="operaciones.php">
                    <div class="styled-large">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="ulfiltros">
                                <li class="lifiltros">
                                    <div class="styled-select">
                                        <select name="operador">
                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Mostrar</option>
                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>No Mostrar</option>
                                       </select>
                                    </div>
                                </li>
                                <li class="lifiltros">    
                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operaslide">Aplicar</button>
                                </li>
                                <li class="lifiltros" style="display: none">
                                    <div class="styled-select">
                                        <select>
                                          <option class="styled" >Ver Por</option>
                                          <option class="styled" >Por mes</option>
                                          <option class="styled" >Por nombre</option>
                                       </select>
                                    </div>
                                </li>
                                <li class="lifiltros" style="display: none">    
                                    <button class="buttonaplicar">Aplicar</button>
                                </li>
                            </ul>
                            <div class="busqueda espacios"><input type="search" data-column="all" class="form-control searchSlide" placeholder="Buscar..." id="searchSlide"/></div>                           
                        </div>
                    </div><!--Cierra el div class styled-large-->
     				<div class="clearfix"></div>
                    <!--Esta sección es para la version movil-->
                    <div class="styled-small">
                    	<div class="col-sm-12 col-xs-12">
                        	<div class="busqueda"><input type="search" data-column="all" class="form-control searchSlide" placeholder="Buscar..." /></div> 
                        </div>
                    	<div class="col-sm-12 col-xs-12">
                            <ul class="ulfiltros">
                                <li class="lifiltros">
                                    <div class="styled-select">
                                        <select>
                                          <option class="styled" >Eliminar</option>
                                          <option class="styled" >Mostrar</option>
                                          <option class="styled" >No Mostrar</option>
                                       </select>
                                    </div>
                                </li>
                                <li class="lifiltros">    
                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operaboletin">Aplicar</button>
                                </li>
                            </ul>                       
                        </div>
                    </div><!--Cierra el div class styled-small-->
                    <div class="clearfix"></div>
                    <!--Seccion de la tabla-->
                    <div class="col-lg-12">
                        <div class="table-responsive">
                          <table id="tableSlide" class="table table-hover table-striped tablesorter">
                            <thead class="styled-thead">
                              <tr>
                              	<th width="50">
                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
									<label for="marcar"><span></span></label>
                                </th>
                                <th>Imagen</th>
                                <th>Título<i class="fa fa-sort"></i></th>
                                <th>Link</th>                               
                                <th class="text-center visible-lg visible-md">Mostrar</th>
                              </tr>
                            </thead>
                            <tbody class="styled-tbody" id="sortable">
                        <?php
						foreach($listaTemporal as $elementoTemporal)
						{
							if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0){
								if($elementoTemporal['status']!=0){
									$img='img/visible.png';
									$funcion='';
									$class = 'nover';
								}
								else{
							  		$img='img/invisible.png';
									$funcion='';
									$class = 'ver';
							   }	
							}
							else{
								if($elementoTemporal['status']!=0){
									$img='img/visible.png';
									$funcion='Desactivar('.$elementoTemporal['idslide'].')';
									$class = 'nover';
								}
								else{
							  		$img='img/invisible.png';
									$funcion='Activar('.$elementoTemporal['idslide'].')';
									$class = 'ver';
							   }
							}
						 echo'<tr>
                              	<td>
                                  <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idslide'].'">
                                	<input type="checkbox" id="'.$elementoTemporal['idslide'].'" name="idslide[]" value="'.$elementoTemporal['idslide'].'">
									<label for="'.$elementoTemporal['idslide'].'"><span></span></label>
                                </td>
                                <td><a href="formslide.php?idslide='.$elementoTemporal['idslide'].'"><img width="100" height="100" class="img-responsive" src="../slide/'.$elementoTemporal['ruta'].'"/></a></td>
                                <td>'.$elementoTemporal['titulo'].'</td>
                                <td>'.$elementoTemporal['urlvideo'].'</td>                                               
                                <td class="text-center visible-lg visible-md">'.$handle.'<img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idslide'].'" src="'.$img.'"></td>
                              </tr>';
						}
                        ?>
                        	</form>
                            </tbody>
                            <tfoot class="styled-tfoot">
                              <tr>
                              	<th>
                                	<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
									<label for="marcar2"><span></span></label>
                                </th>
                                <th>Imagen</th>
                                <th>Título<i class="fa fa-sort"></i></th>
                                <th>Link</th>                                  
                                <th class="text-center visible-lg visible-md">Mostrar</th>
                              </tr>
                            </tfoot>
                          </table>
                          <div>
                        	 <!-- pager -->
                            <div id="pager" class="pager">
                              <form>
                                <img src="img/first.png" class="first"/>
                                <img src="img/prev.png" class="prev"/>
                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                                <img src="img/next.png" class="next"/>
                                <img src="img/last.png" class="last"/>
                                <select class="pagesize">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="20">20</option>
                                  <option value="50">50</option>
                                </select>
                              </form>
                            </div>
                        </div>
                        </div><!--Div de cierre de la clase table-responsive-->
                    </div><!--Div de cierre que contiene las tablas-->
                    <!--Sección del pie de pagina-->
                    <footer id="footer">
                    	<div class="col-lg-12 text-center">
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
include('javascripts.html');
?>
<script>
	function Activar(id){
		$.ajaxSetup({ cache: false });
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"operaciones.php",
			data:"id="+id+"&operaciones=activaslide",
			success:function(data){
					$("#temp"+id).attr("src", "img/visible.png");
					$("#temp"+id).attr("onclick", "Desactivar("+id+")");	
					$("#temp"+id).tooltip('hide');		
					$("#temp"+id).data('bs.tooltip').options.title = 'Ocultar';
					$("#temp"+id).tooltip('show');											
			},
			cache:false
		});			
	}
	
	function Desactivar(id){
		$.ajaxSetup({ cache: false });
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"operaciones.php",
			data:"id="+id+"&operaciones=desactivaslide",
			success:function(data){				
				$("#temp"+id).attr("src", "img/invisible.png");
				$("#temp"+id).attr("onclick", "Activar("+id+")");	
				$("#temp"+id).tooltip('hide');
				$("#temp"+id).data('bs.tooltip').options.title = 'Mostrar';
				$("#temp"+id).tooltip('show');		
			},
			cache:false
		});			
	}	
</script> 
<script>
$(function() {
    $('.ver').tooltip(
	{
		placement: "top",
        title: "Mostrar"
	});
	$('.nover').tooltip(
	{
		placement: "top",
        title: "Ocultar"
	});
});
</script>   
</body>
</html>
