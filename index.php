<?php include_once('includes/header.php') ?>
<video autoplay id="bgvid">
<source src="<?=mypath?>vids/video1.webm" id="mp4Source"  type="video/webm">
</video>
<div class="contenido">
	<!-- Website Content -->
		<a href="#news">News</a>
		<a href="#work" onclick="openmenu()">Work</a>
		<a href="#about">About</a>
		<a href="#contact" onclick="viewcontact()">Contact</a>
		<div>
			<div>
				<a href="#winter_olympics_2013" onclick="verProyecto(2)">Winter Olympics
					<video></video>
				</a>
			</div>
		</div>
	
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
		<div class="col-sm-9"></div>
		<div class="col-sm-3" style="text-align: center;">
			<img style="max-width:100%;" src="<?=mypath?>img/logo.png" />
		</div>
	</div>
</div>
<?php include_once('includes/footer.php') ?>
<script type='text/javascript'>
   var count=1;
   var player=document.getElementById('bgvid');
   var mp4Vid = document.getElementById('mp4Source');
   player.addEventListener('ended',myHandler,false);
    player.addEventListener('progress', onProgress, false);

   function myHandler(e)
   {

      if(!e) 
      {
         e = window.event; 
      }
      count++;
      $(mp4Vid).attr('src', "vids/video"+count+".webm");
      player.load();
      player.play();
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