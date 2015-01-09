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
}/*
function changecursor(){
	console.log("cursor cambiado");
	$('body').css('cursor', 'url(./img/cls.png),auto');
}*/

function showvideo(){
	$(".contenido").fadeOut(1000);
	$("#wraperfondo").fadeOut(1000);
	$("#bgvid").fadeOut(1000);
	$("#contacto").hide();
	$('body').css('cursor', 'url(./img/cls.png),auto');
	$("#bgvid")[0].pause();
	$("#fullscreenvideo").show();
	$("#bgvid2")[0].currentTime = 0;
	$("#bgvid2")[0].play();
}

$("#fullscreenvideo").on('click',function(){
	$("#fullscreenvideo").hide();
	$("#bgvid2")[0].pause();
	$(".contenido").fadeIn(1000);
	$("#wraperfondo").fadeIn(1000);
	$("#bgvid").fadeIn(1000);
	$("#contacto").show();
	$('body').css('cursor','auto');
	$("#bgvid")[0].currentTime = 0;
	$("#bgvid")[0].play();
});

function verabout(){
	$(".pmenu").removeClass("active");
	$(".mabout").addClass("active");
	$(".bgall").fadeOut(600);
	$("#bgvid")[0].pause();
	$(".all").fadeOut(600);
	$(".titulorojo").animate({"width":"0"},600);;
	$(".titulorojo2").animate({"width":"0"},600);;
	$(".aboutbg").delay(600).fadeIn(600);
	$(".about").delay(600).fadeIn(600);
}

function verhome(){
	$(".pmenu").removeClass("active");
	$(".mhome").addClass("active");
	$(".bgall").fadeOut(600);
	//$(".bgall")[0].pause();
	$(".all").fadeOut(600);
	$("#bgvid").delay(600).fadeIn(600,function(){
		$("#bgvid")[0].currentTime = 0;
		$("#bgvid")[0].play();
	});
	$(".hometitle").delay(600).fadeIn(600);
}

$(document).ready(function(){
	var hashTag = window.location.hash
	//console.log(hashTag);
	if(hashTag=="#home"){
		verhome();
	}else if(hashTag=="#about"){
		verabout();
	}else if(hashTag=="#work"){
		openmenu();
	}else if(hashTag=="#contact"){
		viewcontact();
	}else{
		console.log(hashTag);	
	}
});