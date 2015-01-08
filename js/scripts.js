function openmenu(){
	$(".menuright").animate({"right":"0"},100);
}

function closemenu(){
	$(".menuright").animate({"right":"-60%"},100);
}

function viewcontact(){
	$("#wraperfondo").animate({"top":"-400px"},600);
	$(".contenido").animate({"top":"-400px"},600);
	$("#contacto").animate({"top":"-400px"},600);
	$("#bgvid").animate({"top":"-400px"},600);
}

function hidecontact(){
	$("#wraperfondo").animate({"top":"0"},600);
	$(".contenido").animate({"top":"0"},600);
	$("#contacto").animate({"top":"0"},600);
	$("#bgvid").animate({"top":"0"},600);
}
function changecursor(){
	console.log("cursor cambiado");
	$(this).css( 'cursor', 'url("../img/cls.png"), auto' );
}
function showvideo(){
	$(".contenido").animate({"top":"-100%"},2000);
	$("#wraperfondo").animate({"width":"0"},2000);
	$("#contacto").hide();
}
