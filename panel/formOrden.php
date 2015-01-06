<?php
if(isset($_REQUEST['idusuario'])){
	header('Location: listOrden.php');
}
	function __autoload($nombre_clase) {
    	include 'clases/'.$nombre_clase .'.php';
	}
	$seguridad = new seguridad();
	$seguridad->candado();
	
	
	if(isset($_REQUEST['idorden'])){
		$id = $_REQUEST['idorden'];
	}
	else{
		$id = 0;
	}
	
	$orden = new orden($id);
	$orden -> obtener_orden();
	$userend = new userend($orden->iduserend);
	$userend->obten_userend();
	$userend->obteneDatosUserend();
	$userend->obtenerDireccion($orden->iddireccion);
	$transporte = new transporte($orden->id_transporte);
	$transporte->obtener_transporte();
	$detalleOrden = new detalle_orden($id);
	$detalleOrden->obtener_productos_orden();
?>

<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Detalle De La Orden</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>
<style type="text/css">

.suggest-element{
margin-left:5px;
margin-top:0px;
width:350px;
height: 15px;
cursor:pointer;
font-size: 0px;
line-height: 2;
}
.suggest-element a{
	font-size: 12px;
	color: #000;
	text-decoration: none;
}
#suggestions {
width: 87%;
height: 150px;
overflow: auto;
overflow-x: hidden; 
position: absolute;
background-color: #fff;
top: 32px;
z-index: 10;
}  
</style>  
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">
            
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo">Detalle de la orden</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<div class="buttonguardar manita buttonSend" onclick="enviarCorreo(<?=$id?>)">Enviar Confirmación</div>
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

                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
		                
		                <div id="msgnombre" class="input-group espacios">
                    		<span class="input-group-addon es">Folio</span>
                        	<input id="nombre1" disabled  name="nombre1" type="text" class="form-control dis" placeholder="Ingresa tu primer nombre aquí" value="<?=$orden->idorden?>">
                       	</div>
                       	<div id="msgnombre" class="input-group espacios">
                    		<span class="input-group-addon es">Fecha</span>
                        	<input id="nombre1" disabled  name="nombre1" type="text" class="form-control dis" placeholder="Ingresa tu primer nombre aquí" value="<?=$orden->fecha?>">
                       	</div>
                       	<div id="msgnombre" class="input-group espacios">
                    		<span class="input-group-addon es">Total</span>
                        	<input id="nombre1" disabled  name="nombre1" type="text" class="form-control dis" placeholder="Ingresa tu primer nombre aquí" value="$<?=$orden->total_productos?>">
                       	</div>
				
                    	
                       	<p class="subtitulo">Datos del usuario</p>
                       	<div id="msgnombre" class="input-group espacios">
                    		<span class="input-group-addon es"><i class="fa fa-user"></i></span>
                        	<input id="nombre1" disabled  name="nombre1" type="text" class="form-control dis" placeholder="Ingresa tu primer nombre aquí" value="<?=$userend->datosuserend->nombre?> <?=$userend->datosuserend->apellido?>">
                       	</div>
                       	<div class="input-group espacios">
                    		<span class="input-group-addon es"><i class="fa fa-envelope"></i></span>
                        	<input id="nombre2" disabled  name="nombre2" type="text" class="form-control dis" placeholder="Ingresa tu segundo nombre aquí" value="<?=$userend->correo?>">
                       	</div>
                       	<p class="subtitulo">Datos de la dirección</p>
                       	  <span class="txt"><?=$userend->userendDireccion->nombre?> <?=$userend->userendDireccion->apellido?></span></br>
		                  <span class="txt"><?=$userend->userendDireccion->telefono?></span></br>
		                  <span class="txt"><?=$userend->userendDireccion->company?></span></br>
		                  <span class="txt"><?=$userend->userendDireccion->direccion?></span></br>
		                  <span class="txt"><?=$userend->userendDireccion->ciudad?></span></br>
		                  <span class="txt">C.P: <?=$userend->userendDireccion->zip?></span></br>
						
						<p class="subtitulo">Datos Del Metodo De Envío</p>


                       	<div id="msgtransporte" class="input-group espacios">
                    		<span class="input-group-addon es"><i class="fa fa-truck"></i></span>
                        	<input id="apellido2" disabled  name="apellido2" type="text" class="form-control dis" placeholder="Ingresa tu apellido materno aquí" value="<?=$transporte->nombre?>">
                       	</div>
                       	<div id="msgtransporte" class="input-group espacios">
                    		<span class="input-group-addon es"><i class="fa fa-tachometer"></i></span>
                        	<input id="apellido2" disabled  name="apellido2" type="text" class="form-control dis" placeholder="Ingresa tu apellido materno aquí" value="<?=$transporte->tiempo_transito?> Día(s)">
                       	</div>
                       	<div id="msgtransporte" class="input-group espacios">
                    		<span class="input-group-addon es"><i class="fa fa-money"></i></span>
                        	<input id="apellido2" disabled  name="apellido2" type="text" class="form-control dis" placeholder="Ingresa tu apellido materno aquí" value="$<?=$orden->precioTransporte?>">
                       	</div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<p class="subtitulo">Detalle de los productos</p>
                    	<div class="table-responsive">
                    	<table id="" class="table table-hover table-striped tablesorter">
                            <thead class="styled-thead">
                              <tr>
                                <th></th>
                                <th class="text-center">Nombre Producto</th>
                                <th class="text-center">Precio Unitario</th>                                
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                            <tbody class="styled-tbody" id="">
                            	<?php
                            		foreach ($detalleOrden->productos as $keyProd) {
                            			$producto = new producto($keyProd->id_producto);
                            			$producto->obtener_producto();
					                  
					                    if($keyProd->id_combinacion != 0){
					                       	$combinacion = new combinacion($keyProd->id_combinacion,$keyProd->id_producto);
					                        $combinacion = $combinacion -> obtener_combinacion_estilo_ajax();
					                        for($i = 0; $i < count($combinacion["atributos_valores"]); $i++){
					                            $id_atributo_tpm = $combinacion["atributos_valores"][$i];
					                            $id_valor = $combinacion["atributos_valores"][$i + 1];
					                            $atributo = new atributo($id_atributo_tpm);
					                            $atributo -> obtener_atributo();
					                            $valor = new valor($id_valor,$id_atributo_tpm);
					                            $valor -> obtener_valor();
					                            $texto_combinacion .= $atributo -> nombre_esp.": ".$valor -> nombre_esp." ";
					                            $i++;
					                        }
					                    }
					            ?>
					            <!--HTML PARA LOS PRODUCTOS-->
					            <tr>
						            <th class="text-center" width="100px">
	                            		<img class="img-responsive" aling="center" style="width:100%;" src="../imgProductos/<?=$producto->img_principal?>">
	                            	</th>
									<th width="500px" class="text-center"><?=$producto->titulo_esp?><?=$texto_combinacion?></th>
	                                <th class="text-center">$<?=$producto->precio_mxn?></th>                                
	                                <th class="text-center"><?=$keyProd->stock_general?></th>
	                                <th class="text-center">$<?=$keyProd->stock_general*$producto->precio_mxn?></th>
                            	</tr>
					            <?php        
                            		}
                            	?>
                            </tbody>
                            <tfooter>
                            	<th>
                            	</th>
								<th class="text-center">Nombre Producto</th>
                                <th class="text-center">Precio Unitario</th>                                
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                            </tfooter>
                        </table>
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
                    	<div class="buttonguardar manita dis" onclick="enviarCorreo(<?=$id?>)">Enviar Confirmación</div>
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
<script src="js/correoOrden.js" type="text/javascript"></script>
</body>
</html>
