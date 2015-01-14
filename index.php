<?php include_once('includes/header.php') ?>
<?php
	$video_slide = new video_slide();
	$lista_videos_slide = $video_slide -> listar_videos_slide_activos();
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
<div id="fullscreenvideo">
	<video id="bgvid2" loop>
		<source src="<?=mypath;?>videosSlide/<?=$src_hd;?>" id="mp4Source"  type="video/mp4">
	</video>
</div>
<video autoplay muted id="bgvid" class="bgall" loop>
	<source src="<?=mypath;?>videosSlide/<?=$src_tmp;?>" id="mp4Source"  type="video/mp4">
</video>
<div class="contenido collapse in">
	<!-- Website Content -->
	<div class="container">
		<div class="row logohome">
			<div class=" col-sm-1" style="padding:0;">
				<div class="titulorojo2"><img src="<?=mypath?>img/logowr.png" /></div>
				<img src="<?=mypath?>img/logow.png" />
			</div>
		</div>
		<div id="menu">
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
				<img style="max-width:100%;" src="<?=mypath?>img/bd.png" />
			</div>
		</div>
		<div class="col-sm-6 col-sm-push-6 hometitle all">
			<h1><?=$lista_videos_slide[0]["titulo_video"]?></h1>
			<button class="bwatch" onclick="showvideo()"><?=WATCH?></button>
		</div>
		<div class="col-sm-7 col-sm-push-5 about all">
			<h2><?=AB2?></h2>
			<h1>BROADCAST DESIGN &amp; MOTION GRAPHICS</h1>
			<div class="row">
				<div class="col-sm-8 col-sm-push-4 aboutborder">
					<p>Don Porfirio is a Broadcast Design and Motion Graphics Studio with a great passion for design. We are a team of graphic artists in search for new challenges and opportunities to create original concepts while we do what we love most... design.</p>
					<p style="margin:0;">Driven by passion, creativity and love for great design, we create high impact animation.</p>
				</div>
				<div class="col-sm-8 col-sm-push-4 redesabout">
					<span class="textboldw"><?=FOLLOW?></span>
					<a href="#" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-vimeo-square"></i>
						</button>
					</a>
					<a href="#" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-behance"></i>
						</button>
					</a>
					<a href="#" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-twitter"></i>
						</button>
					</a>
					<a href="#" target="_blank" style="display: block;">
						<button class="redesb">
							<i class="fa fa-facebook"></i>
						</button>
					</a>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-lg-push-6 col-md-8 col-md-push-4 col-sm-9 col-sm-push-3 proyecto all"></div>
	</div>
	<!-- Website Content -->
	<div class="menuright">
		<div class="menuheader">
			<div class="row">
				<div class="col-sm-10 sidemenu">
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
			echo '<a href="#'.$un_proyecto["url_amigable"].'" style="display:block;" onclick="verproyecto('.$un_proyecto["id_proyecto"].')" onmouseenter="showpreview('.$un_proyecto["id_proyecto"].','.$vp.')" onmouseleave="hidepreview('.$un_proyecto["id_proyecto"].')"><div style="max-height:200px; overflow:hidden;"  class="proyectofondo" >
					<img style="width:100%; margin: 1px 0;" src="'.mypath.'imgProyectos/'.$un_proyecto["img_principal"].'" />
					<div class="vidpreview videono'.$un_proyecto["id_proyecto"].'"></div>
				</div></a>';
		}
		?>
		</div>
	</div>
	<div class="galleryright">
		<div class="row">
				<div class="col-sm-10 sidemenu"></div>
			<span class="closebutton" onclick="closemenu()"><img src="<?=mypath?>img/cls.png" /></span>
		</div>
	</div>
</div>
<div id="contacto">
	<span class="closebutton" onclick="hidecontact()"><img src="<?=mypath?>img/cls.png" /></span>
	<div class="container">
		<div class="col-sm-9" style="padding:0;">
			<div class="row topsec">
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textMedIt">We are always looking for fresh new talent, please send us your demo reel to: </span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack" style="border:none;"><a href="mailto:info@donporfirio.tv">info@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm" style="border:none;"><?=THANK?></div>
					</div>
				</div>
			</div>
			<div class="row topsec">
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General &amp; Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack"><a href="mailto:rpuig@donporfirio.tv">rpuig@donporfirio.tv</a></div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textbold"><?=FOLLOW?></span><br/>
					<br/>
					<div class="row">
						<div class="col-sm-3" style="padding:0;">
							<a href="#" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-vimeo-square fa-2x"></i>
								</button>
							</a>
						</div>
						<div class="col-sm-3" style="padding:0; margin-left:-1px;">
							<a href="#" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-behance fa-2x"></i>
								</button>
							</a>
						</div>
						<div class="col-sm-3" style="padding:0; margin-left:-1px;">
							<a href="#" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-twitter fa-2x"></i>
								</button>
							</a>
						</div>
						<div class="col-sm-3" style="padding:0; margin-left:-1px;">
							<a href="#" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-facebook fa-2x"></i>
								</button>
							</a>
						</div>
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
