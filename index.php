<?php include_once('includes/header.php') ?>
<?php
	$video_slide = new video_slide();
	$lista_videos_slide = $video_slide -> listar_videos_slide_activos();
	if(count($lista_videos_slide) > 0){
		$src_tmp = $lista_videos_slide[0]["nombre_video"];
	}
?>
<video autoplay muted id="bgvid">
	<source src="<?=mypath;?>videosSlide/<?=$src_tmp;?>" id="mp4Source"  type="video/mp4">
</video>
<div class="contenido">
	<!-- Website Content -->
		<a href="#news">News</a>
		<a href="#work" onclick="openmenu()">Work</a>
		<a href="#about">About</a>
		<a href="#contact" onclick="viewcontact()">Contact</a>
	
	<!-- Website Content -->
	<div class="menuright">
		<div class="menuheader">
			<span class="closebutton" onclick="closemenu()"><img src="<?=mypath?>img/cls.png" /></span>
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
						<div class="col-sm-3" style="padding:0;">
							<a href="#" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-behance fa-2x"></i>
								</button>
							</a>
						</div>
						<div class="col-sm-3" style="padding:0;">
							<a href="#" target="_blank" style="display: block;">
								<button class="redes">
									<i class="fa fa-twitter fa-2x"></i>
								</button>
							</a>
						</div>
						<div class="col-sm-3" style="padding:0;">
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
				<span class="textMedIt">
					Copyright 2015 | Don Porfirio. All rights reserved.
				</span>
			</div>
		</div>
		<div class="col-sm-3" style="text-align: center;">
			<img style="max-width:100%;" src="<?=mypath?>img/logo.png" />
		</div>
	</div>
</div>
<?php include_once('includes/footer.php') ?>
<script type='text/javascript'>
   var count = 1;
   var count_limit = <?php echo count($lista_videos_slide);?>;
   var player=document.getElementById('bgvid');
   var mp4Vid = document.getElementById('mp4Source');
   var videos_slide = new Array();

   <?php
   	 foreach($lista_videos_slide as $video_slide_tmp)
   	 {
   	 	$src_video = $video_slide_tmp["nombre_video"];
   	 	echo "videos_slide.push(".json_encode($src_video).");";
   	 }
   ?>

   player.addEventListener('ended',myHandler,false);
   player.addEventListener('progress', onProgress, false);

   function myHandler(e)
   {

      if(!e) 
      {
         e = window.event; 
      }
      
      if(count == count_limit)
      {
      	count = 0;
      }

      $(mp4Vid).attr('src', "videosSlide/"+videos_slide[count]);
      $(player).fadeOut();
      player.load();
      $(player).delay(1000).fadeIn();
      player.play();
      count++;
   }
   function onProgress(e){

    var vid = document.getElementById('bgvid');
    var percent = null;

    if (vid.buffered.length > 0 && vid.buffered.end && vid.duration) {
        percent = vid.buffered.end(0) / vid.duration;
    } else if (vid.bytesTotal != undefined && vid.bytesTotal > 0 && vid.bufferedBytes != undefined) {
        percent = vid.bufferedBytes / vid.bytesTotal;
    }

    if (percent !== null) {
        percent = 100 * Math.min(1, Math.max(0, percent));

        console.log(percent);
    }

}

</script>