<?php include_once('includes/header.php') ?>
<!-- Website Content -->
	<a href="#news">News</a>
	<a href="#work" onclick="openmenu()">Work</a>
	<a href="#about">About</a>
	<a href="#contact">Contact</a>
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
		<span class="closebutton" onclick="closemenu()"><img style="width:100%; margin: 1px 0;" src="<?=mypath?>/img/cls.png" /></span>
	</div>
	<?php
	$i=0;
	while($i<6){
	?>
	<img style="width:100%; margin: 1px 0;" src="<?=mypath?>/img/ejemwork.jpg" />
	<?php
	$i++;
	}
	?>
</div>
<?php include_once('includes/footer.php') ?>