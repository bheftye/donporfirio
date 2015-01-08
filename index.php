<?php include_once('includes/header.php') ?>
<?php
	$video_slide = new video_slide();
	$lista_videos_slide = $video_slide -> listar_videos_slide_activos();
	if(count($lista_videos_slide) > 0){
		$src_tmp = $lista_videos_slide[0]["nombre_video"];
	}
?>
<video autoplay muted id="bgvid" loop>
	<source src="<?=mypath;?>videosSlide/<?=$src_tmp;?>" id="mp4Source"  type="video/mp4">
</video>
<div class="contenido">
	<!-- Website Content -->
	<div class="container">
		<div class="row logohome">
			<div class=" col-sm-1">
				<div class="titulorojo2"><img src="<?=mypath?>img/logowr.png" /></div>
				<img style="max-width:100%;" src="<?=mypath?>img/logow.png" />
			</div>
		</div>
		<div id="menu">
			<ul>
				<li><a href="#home" onclick="changecursor()" class="active">Home</a></li>
				<li><a href="#work" onclick="openmenu()">Work</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact" onclick="viewcontact()">Contact</a></li>
				<li class="idioma"><a href="#">ENG</a> / <a href="#" class="active">ESP</a></li>
			</ul>
		</div>
		<div class="row logobottom"><!--
			<div class="progress progress-striped active">
			    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
			</div>-->
			<div class="col-sm-2">
				<div class="titulorojo"><img src="<?=mypath?>img/dptitler.png" /></div>
				<img src="<?=mypath?>img/dptitle.png" />
			</div>
		</div>
		<div class="row logobottomr">
			<div class="col-sm-3 col-sm-push-9">
				<img style="max-width:100%;" src="<?=mypath?>img/bd.png" />
			</div>
		</div>
	</div>
	<!-- Website Content -->
	<div class="menuright">
		<div class="menuheader">
			<div class="row">
				<div class="col-sm-10 sidemenu">
					<ul>
						<li class="active">
							all
						</li>
						<li>
							BROADCAST DESIGN
						</li>
						<li>
							sports
						</li>
						<li>
							2d
						</li>
						<li>
							3d
						</li>
					</ul>
				</div>
				<span class="closebutton" onclick="closemenu()"><img src="<?=mypath?>img/cls.png" /></span>
			</div>
		</div>
		<?php
		$i=0;
		while($i<6){
		?>
		<img style="width:100%; margin: 1px 0;" src="<?=mypath?>img/ejemwork.jpg" />
		<?php
		$i++;
		}
		?>
	</div>
</div>
<div id="contacto">
	<span class="closebutton" onclick="hidecontact()"><img src="<?=mypath?>img/cls.png" /></span>
	<div class="container">
		<div class="col-sm-9" style="padding:0;">
			<div class="row topsec">
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General & Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack">rpuig@donporfirio.tv</div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General & Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack">rpuig@donporfirio.tv</div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textMedIt">We are always looking for fresh new talent, please send us your demo reel to: </span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack" style="border:none;">info@donporfirio.tv</div>
						<div class="col-sm-6 tbdefault bdbtm" style="border:none;">Thank You!</div>
					</div>
				</div>
			</div>
			<div class="row topsec">
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General & Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack">rpuig@donporfirio.tv</div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textbold">Roberto Puig</span><br/>
					<span class="textitalic">Director General & Creativo</span><br/>
					<div class="row tabborder">
						<div class="col-sm-6 tbdefault bgblack">rpuig@donporfirio.tv</div>
						<div class="col-sm-6 tbdefault bdbtm">+52 (999) 925 5239</div>
						<div class="col-sm-12 tbdefault">Mérida, Yucatán, MX</div>
					</div>
				</div>
				<div class="col-sm-4">
					<span class="textbold">FOLLOW US:</span><br/>
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
					Copyright 2015 | Don Porfirio. All rights reserved.
				</span>
			</div>
		</div>
		<div class="col-sm-3 imgcontacto" style="text-align: center;">
			<img style="max-width:100%;" src="<?=mypath?>img/logo.png" />
		</div>
	</div>
</div>
<?php include_once('includes/footer.php') ?>
<script type='text/javascript'>
	$(document).ready(function(){
		//console.log("hola");
	  $("#bgvid").on(
	    "timeupdate", 
   			function (event){
   			//console.log("entro");
		    var vid = document.getElementById('bgvid');
		    var percent = null;
		    var percent2 = null;
		    var percent = 137*(vid.currentTime/vid.duration);
		    var percent2 = 51*(vid.currentTime/vid.duration);
		    console.log(percent);
	        //$('.progress-bar').css('width', percent+'%').attr('aria-valuenow', percent);
	        $(".titulorojo").width(percent+"px");
	        $(".titulorojo2").width(percent2+"px");
			});
	});
</script>