<?php include_once('includes/header.php') ?>
<?php
	$video_slide = new video_slide();
	$lista_videos_slide = $video_slide -> listar_videos_slide_activos();
	$video_slide -> listar_img_secundarias_inicio();
	$imagenes_inicio = $video_slide -> lista_imagenes_secundarias;
	
	if(count($lista_videos_slide) > 0){
		$src_tmp = $lista_videos_slide[0]["nombre_video"];
		$src_hd = $lista_videos_slide[0]["nombre_video_hd"];
	}

	$categoria = new categoria();
	$cateogrias = $categoria -> listar_categorias_activas();

	$proyecto = new proyecto();
	$lista_proyectos = $proyecto -> listar_proyectos_activos();

	$redes_sociales = new redes_sociales(1);
	$redes_sociales -> obtener_redes_sociales();

	$url_twitter = $redes_sociales -> twitter;
	$url_facebook = $redes_sociales -> facebook;
	$url_behance = $redes_sociales -> behance;
	$url_vimeo = $redes_sociales -> vimeo;


?>
<div class="bgall aboutbg"></div>
<div class="bgall videoproyecto"></div>
<div id="fullscreenvideo2"></div>
<div id="bufferload"><i class="fa fa-spinner fa-2x"></i></div>
<div id="slideproy" class="bgall bgproy"></div>
<div id="fullscreenvideo">
	<div id="clsfull" onclick="hidehd()"><?=CLOSE?> <img src="<?=mypath?>img/cls2.png" /></div>
	<video id="bgvid2" loop>
		<source src="<?=mypath;?>videosSlide/<?=$src_hd;?>" id="mp4Source"  type="video/mp4">
	</video>
</div>
<?php
if(strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) {
//if(1==1) {
?>	
<div id="content-slider-1" class="royalSlider contentSlider rsDefault bgall bghome">
  <?php
  	foreach ($imagenes_inicio as $imagen) {
  		$ruta_imagen =  mypath."imgInicio/".$imagen["nombre_imagen"];
  		echo "<div style='margin-top: -10px; background:url(".$ruta_imagen.") no-repeat center center; width:100%; height:100%; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'>
  		 <h3 style='margin:0;'></h3>
    <p></p>
    <span class='rsTmb'></span>
    </div>";
  	}
  ?>

</div>
<?php
}
else{
?>
<video autoplay muted id="bgvid" class="bgall" loop>
	<source src="<?=mypath;?>videosSlide/<?=$src_tmp;?>" id="mp4Source"  type="video/mp4">
</video>
<?php
}
?>
<div class="contenido collapse in">
	<!-- Website Content -->
	<div class="container">
		<div class="row logohome">
			<div class=" col-sm-1" style="padding:0;">
				<div class="titulorojo2"><img src="<?=mypath?>img/logowr.png" /></div>
				<img src="<?=mypath?>img/logow.png" class="hidden-xs" />

				<nav class="navbar navbar-default visible-xs">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="border:hidden;">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="#"><img src="<?=mypath?>img/logow.png" style="margin-top:-15px;" /></a>
				    </div>

				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    	<div class="row"><span class="closebutton navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="z-index: 100; float:right;"><img src="<?=mypath?>img/cls.png" /></span></div>
				      <ul class="nav navbar-nav">
				        <li><a class="pmenu mhome active" href="#home" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="verhome()"><?=HOME?></a></li>
						<li><a class="pmenu mwork" href="#work" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="openmenu()"><?=WORK?></a></li>
						<li><a class="pmenu mabout" href="#about" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="verabout()"><?=ABOUT?></a></li>
						<li><a class="pmenu mcontact" href="#contact" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="viewcontact()"><?=CONTACT?></a></li>
						<li class="idioma"><a style="display:inline" class="aen <?php echo ($idioma == "eng " || $idioma == "eng")? "active" : "";?>" href="#" onclick="changelang('eng')">ENG</a> / <a style="display:inline" href="#" class="aes <?php echo ($idioma == "esp" || $idioma == "esp ")? "active" : "";?>" onclick="changelang('esp')">ESP</a></li>
				      </ul>
				    </div>
				  </div>
				</nav>


			</div>
		</div>
		<div id="menu" class="hidden-xs">
			<ul>
				<li><a class="pmenu mhome active" href="#home" onclick="verhome()"><?=HOME?></a></li>
				<li><a class="pmenu mwork" href="#work" onclick="openmenu()"><?=WORK?></a></li>
				<li><a class="pmenu mabout" href="#about" onclick="verabout()"><?=ABOUT?></a></li>
				<li><a class="pmenu mcontact" href="#contact" onclick="viewcontact()"><?=CONTACT?></a></li>
				<li class="idioma"><a class="aen <?php echo ($idioma == "eng " || $idioma == "eng")? "active" : "";?>" href="#" onclick="changelang('eng')">ENG</a> / <a href="#" class="aes <?php echo ($idioma == "esp" || $idioma == "esp ")? "active" : "";?>" onclick="changelang('esp')">ESP</a></li>
			</ul>
		</div>
		<div class="row logobottom" style="padding:0 60px;"><!--
			<div class="progress progress-striped active">
			    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
			</div>-->
			<div class="col-sm-2" style="padding:0;">
				<div class="titulorojo"><img src="<?=mypath?>img/dptitler.png" /></div>
				<img src="<?=mypath?>img/dptitle.png" />
			</div>
		</div>
		<div class="row logobottomr" style="text-align: right; padding:0 60px;">
			<div class="col-sm-3 col-sm-push-9" style="padding:0;">
				<img style="/*max-width:100%;*/ max-width:200px;" src="<?=mypath?>img/bd.png" />
			</div>
		</div>
		<div class="col-sm-6 col-sm-push-6 hometitle all">
			<h1><?=$lista_videos_slide[0]["titulo_video"]?></h1>
			<button class="bwatch" onclick="showvideo()"><?=WATCH?></button>
		</div>
		<div class="col-sm-7 col-sm-push-5 about all">
			<h2><?//=AB2?></h2>
			<h1>BROADCAST DESIGN &amp; MOTION GRAPHICS</h1>
			<div class="row">
				<!--<div class="col-sm-8 col-sm-push-4 aboutborder">-->
					<div class="col-sm-7 col-sm-push-5 aboutborder">
					<p>Don Porfirio is a Broadcast Design and Motion Graphics Studio with a great passion for design. We are a team of graphic artists in search for new challenges and opportunities to create original concepts while we do what we love most... design.</p>
					<p style="margin:0;">Driven by passion, creativity and love for great design, we create high impact animation.</p>
				</div>
				<!--<div class="col-sm-8 col-sm-push-4 redesabout">-->
					<div class="col-sm-7 col-sm-push-5 redesabout">
					<span class="textboldw"><?=FOLLOW?></span>
					<?php
					if($url_vimeo!=""){
					?>
					<a href="<?=$url_vimeo?>" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-vimeo-square"></i>
						</button>
					</a>
					<?php
					}
					if($url_behance!=""){
					?>
					<a href="<?=$url_behance?>" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-behance"></i>
						</button>
					</a>
					<?php
					}
					if($url_twitter!=""){
					?>
					<a href="<?=$url_twitter?>" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-twitter"></i>
						</button>
					</a>
					<?php
					}
					if($url_facebook!=""){
					?>
					<a href="<?=$url_facebook?>" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-facebook"></i>
						</button>
					</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-lg-push-6 col-md-8 col-md-push-4 col-sm-9 col-sm-push-3 proyecto all"></div>
	</div>
	<!-- Website Content -->
	<div class="menuright mcerrado">
		<div class="fondo_proyectos"></div>
		<div class="menuheader">
			<div class="row">
				<div class="col-sm-10 col-xs-10 sidemenu">
					<ul>
						<li class="cat0 active" onclick="lxcategoria(0)">
							<?php
									$nombre = ($idioma == "esp")? "TODOS":"ALL"; 
									echo $nombre;
							?>
						</li>
						<?php
							foreach ($cateogrias as $una_categoria) {
								$nombre = ($idioma == "esp")? $una_categoria["nombre_esp"]:$una_categoria["nombre_eng"]; 
								echo "<li class='cat".$una_categoria["id_categoria"]."' onclick='lxcategoria(".$una_categoria["id_categoria"].")'>".$nombre."</li>";
							}
						?>
					</ul>
				</div>
				<span class="closebutton" onclick="closemenu()"><img src="<?=mypath?>img/cls.png" /></span>
			</div>
		</div>
		<div class="listproyectos">
		<?php
		foreach ($lista_proyectos as $un_proyecto) {
			$titulo_proyecto = ($idioma == "es")? $un_proyecto["titulo_esp"] : $un_proyecto["titulo_eng"];
			$subtitulo_proyecto = ($idioma == "es")? $un_proyecto["subtitulo_esp"] : $un_proyecto["subtitulo_eng"];
			$video_preview = $un_proyecto["nombre_preview"];
			$vp = "'".$video_preview."'";
			echo '<a href="#'.$un_proyecto["url_amigable"].'" style="display:block;" onclick="verproyecto('.$un_proyecto["id_proyecto"].')" onmouseenter="showpreview('.$un_proyecto["id_proyecto"].','.$vp.')" onmouseleave="hidepreview('.$un_proyecto["id_proyecto"].')">
					<div style="max-height:200px; overflow:hidden; position:relative;"  class="proyectofondo" >
					<img style="width:100%; margin: 1px 0;" src="'.mypath.'imgProyectos/'.$un_proyecto["img_principal"].'" />
					<div class="fcategoria"></div>
					<div class="cattitulos">
					<h4>'.$subtitulo_proyecto.'</h4>
					<h3>'.$titulo_proyecto.'</h3>
					</div>
					<div class="vidpreview videono'.$un_proyecto["id_proyecto"].'">
					<div id="video-container">';
			if($un_proyecto["nombre_preview"]!=""){
					echo '<video autoplay loop muted class="fillWidth">
					<source src="'.mypath.'vidProyectos/'.$video_preview.'" type="video/mp4"/>
					Your browser does not support the video tag. I suggest you upgrade your browser.
					</video>';
			}else{
					echo '<img style="width:100%; margin: 1px 0;" src="'.mypath.'imgProyectos/'.$un_proyecto["img_principal"].'" />';
			}
			echo '</div>
					</div>
					</div>
				</a>';
		}
		?>
		</div>
	</div>
	<div class="galleryright gcerrado">
		<div class="fondo_proyectos"></div>
		<div class="row" style="background-color:#fff;">
			<div class="col-sm-10 sidemenu"></div>
			<span class="closebutton" onclick="closemenu()"><img src="<?=mypath?>img/cls.png" /></span>
		</div>
	</div>
	<div class="vimeoright vcerrado">
		<div class="fondo_proyectos"></div>
		<div class="row" style="background-color:#fff;">
			<div class="col-sm-10 col-xs-10 sidemenu"></div>
			<span class="closebutton" onclick="closemenu()"><img src="<?=mypath?>img/cls.png" /></span>
		</div>
	</div>
</div>
<div id="contacto" class="ccerrado">
	<span class="closebutton" onclick="hidecontact()"><img src="<?=mypath?>img/cls.png" /></span>
	<div class="container">
		<div class="col-sm-9" style="padding:0;">
			<div class="row topsec">
				<div class="col-sm-4 col-xs-12">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4 hidden-xs">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<span class="textMedIt">We are always looking for fresh new talent, please send us your demo reel to: </span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack" style="border:none;"><a href="mailto:info@donporfirio.tv">info@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm" style="border:none;"><?=THANK?></div>
					</div>
				</div>
			</div>
			<div class="row topsec">
				<div class="col-sm-4 hidden-xs">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4 hidden-xs">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4 col-xs-12">
					<span class="textbold"><?=FOLLOW?></span><br/>
					<br/>
					<div class="row" style="height:36px;">
						<?php
						if($url_vimeo!=""){
						?>
						<div class="col-sm-3 col-xs-3" style="padding:0;height:36px;">
							<a href="<?=$url_vimeo?>" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-vimeo-square"></i>
								</button>
							</a>
						</div>
						<?php
						}
						if($url_behance!=""){
						?>
						<div class="col-sm-3 col-xs-3" style="padding:0;height:36px; margin-left:-1px;">
							<a href="<?=$url_behance?>" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-behance"></i>
								</button>
							</a>
						</div>
						<?php
						}
						if($url_twitter!=""){
						?>
						<div class="col-sm-3 col-xs-3" style="padding:0;height:36px; margin-left:-1px;">
							<a href="<?=$url_twitter?>" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-twitter"></i>
								</button>
							</a>
						</div>
						<?php
						}
						if($url_facebook!=""){
						?>
						<div class="col-sm-3 col-xs-3" style="padding:0;height:36px; margin-left:-1px;">
							<a href="<?=$url_facebook?>" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-facebook"></i>
								</button>
							</a>
						</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="row" style="padding-left:15px;">
				<span class="textMedItBottom">
					<?=COPY?>
				</span>
			</div>
		</div>
		<div class="col-sm-3 imgcontacto" style="text-align: center;">
			<img style="max-width:100%;" src="<?=mypath?>img/logo.png" />
		</div>
	</div>
</div>
<?php
	echo "<script>
			var idioma = ".json_encode($idioma).";
	</script>";
?>
<?php include_once('includes/footer.php') ?>