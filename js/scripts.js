function openmenu(){
	$(".menuright").animate({"right":"0"},600);
}

function closemenu(){
	$(".menuright").animate({"right":"-60%"},600);
}

function viewcontact(){
	$("#wraperfondo").animate({"top":"-400px"},1000);
	$(".contenido").animate({"top":"-400px"},1000);
	$("#contacto").animate({"top":"-400px"},1000);
	$("#bgvid").animate({"top":"-400px"},1000);
}

function hidecontact(){
	$("#wraperfondo").animate({"top":"0"},1000);
	$(".contenido").animate({"top":"0"},1000);
	$("#contacto").animate({"top":"0"},1000);
	$("#bgvid").animate({"top":"0"},1000);
}