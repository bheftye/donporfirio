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
	//$("#bgvid3")[0].pause();
	$(".all").fadeOut(600);
	$(".titulorojo").animate({"width":"0"},600);
	$(".titulorojo2").animate({"width":"0"},600);
	$(".aboutbg").delay(600).fadeIn(600);
	$(".about").delay(600).fadeIn(600);
}

function verhome(){
	$(".pmenu").removeClass("active");
	$(".mhome").addClass("active");
	$(".bgall").fadeOut(600);
	//$("#bgvid3")[0].pause();
	$(".videoproyecto").empty();
	//$(".bgall")[0].pause();
	$(".all").fadeOut(600);
	$("#bgvid").delay(600).fadeIn(600,function(){
		$("#bgvid")[0].currentTime = 0;
		$("#bgvid")[0].play();
	});
	$(".hometitle").delay(600).fadeIn(600);
}

function reproduceproyecto(){
	$("#bgvid3").on(
	    "timeupdate", 
   			function (event){
   			console.log("entro");
		    var vid = document.getElementById('bgvid3');
		    var percent = null;
		    var percent2 = null;
		    var percent = 137*(vid.currentTime/vid.duration);
		    var percent2 = 51*(vid.currentTime/vid.duration);
		    //console.log(percent);
	        //$('.progress-bar').css('width', percent+'%').attr('aria-valuenow', percent);
	        $(".titulorojo").width(percent+"px");
	        $(".titulorojo2").width(percent2+"px");
	});
}

function verproyecto(id){
	closemenu();
	$(".pmenu").removeClass("active");
	$(".mwork").addClass("active");
	$(".bgall").fadeOut(600);
	$("#bgvid")[0].pause();
	//$(".bgall")[0].pause();
	html='';
	html2='';
	html+='<h2>Subtitulo</h2>';
	html+='<h1>NOMBRE CORTO</h1>';
	html+='<div class="row aboutborder">';
	html+='<p>Once again our good friends from Big Studios in Toronto invited us to collaborate with them on another great project.This time we were comisioned to design the look for CBC Sports both Winter and Summer Graphics Package. We developed a series of cool environments and animated this high energy pieces that celebrate the love for sports.</p>';
	html+='</div>';
	$(".proyecto").append(html);
	html2+='<video id="bgvid3" loop muted>';
	html2+='<source src="http://localhost:8080/donporfirio2/donporfirio/vidProyectos/482c2daa.mp4" id="mp4Source"  type="video/mp4">';
	html2+='</video>';
	//console.log(html);
	$(".videoproyecto").append(html2);
	$(".all").fadeOut(600);
	$(".videoproyecto").delay(600).fadeIn(600,function(){
		reproduceproyecto();
		$("#bgvid3")[0].currentTime = 0;
		$("#bgvid3")[0].play();
	});
	$(".proyecto").delay(600).fadeIn(600);
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
		    //console.log(percent);
	        //$('.progress-bar').css('width', percent+'%').attr('aria-valuenow', percent);
	        $(".titulorojo").width(percent+"px");
	        $(".titulorojo2").width(percent2+"px");
	});
});