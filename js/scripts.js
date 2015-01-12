var mypath ='http://localhost:8080/donporfirio2/donporfirio/';

function openmenu(){
	$(".menuright").animate({"right":"0"},100);
	$(".mwork").addClass("active");
}

function opengallery(){
	console.log("galeria");
	$(".galleryright").animate({"right":"0"},100);
}

function closemenu(){
	$(".mwork").removeClass("active");
	$(".menuright").animate({"right":"-60%"},100);
}

function closegallery(){
	$(".galleryright").animate({"right":"-60%"},100);
}

function viewcontact(){
	$("#wraperfondo").animate({"top":"-400px"},600);
	$(".contenido").animate({"top":"-400px"},600);
	$("#contacto").animate({"top":"-400px"},600);
	$("#bgvid").animate({"top":"-400px"},600);
	$("#bgvid3").animate({"top":"-400px"},600);
}

function hidecontact(){
	$("#wraperfondo").animate({"top":"0"},600);
	$(".contenido").animate({"top":"0"},600);
	$("#contacto").animate({"top":"0"},600);
	$("#bgvid").animate({"top":"0"},600);
	$("#bgvid3").animate({"top":"0"},600);
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
	$('body').css('cursor', 'url(./img/clsr.png),auto');
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

$("#fullscreenvideo2").on('click',function(){
	$("#fullscreenvideo2").hide();
	$("#bgvid4")[0].pause();
	$(".contenido").fadeIn(1000);
	$("#wraperfondo").fadeIn(1000);
	$("#bgvid3").fadeIn(1000);
	$("#contacto").show();
	$('body').css('cursor','auto');
	$("#bgvid3")[0].currentTime = 0;
	$("#bgvid3")[0].play();
});

function verabout(){
	$(".pmenu").removeClass("active");
	$(".mabout").addClass("active");
	$(".bgall").fadeOut(600);
	$("#bgvid")[0].pause();
	$(".videoproyecto").empty();
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
   			//console.log("entro");
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

function reproduceproyectohd(){
	$(".contenido").fadeOut(1000);
	$("#wraperfondo").fadeOut(1000);
	$("#bgvid3").fadeOut(1000);
	$("#contacto").hide();
	$('body').css('cursor', 'url(./img/clsr.png),auto');
	$("#bgvid3")[0].pause();
	$("#fullscreenvideo2").show();
	$("#bgvid4")[0].currentTime = 0;
	$("#bgvid4")[0].play();
}

function verproyecto(id){
	closemenu();
	closegallery();
	$(".galleryright").empty();
	$(".videoproyecto").empty();
	$(".proyecto").empty();
	$(".pmenu").removeClass("active");
	$(".mwork").addClass("active");
	$(".bgall").fadeOut(600);
	$("#bgvid")[0].pause();
	//$(".bgall")[0].pause();
	html='';
	html2='';
	html3='';
	html4='';
	html+='<h2>Subtitulo</h2>';
	html+='<h1>NOMBRE CORTO</h1>';
	html+='<div class="row aboutborder">';
	html+='<p style="margin:0;">Once again our good friends from Big Studios in Toronto invited us to collaborate with them on another great project.This time we were comisioned to design the look for CBC Sports both Winter and Summer Graphics Package. We developed a series of cool environments and animated this high energy pieces that celebrate the love for sports.</p>';
	html+='</div>';
	html+='<div class="row">';
	html+='<div class="col-sm-3 proylink"><button class="proybutton watchproy" onclick="reproduceproyectohd()">WATCH</button></div>';
	html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="opengallery()">GALLERY</button></div>';
	html+='<div class="col-sm-3 proylink"><button class="proybutton">BEHANCE</button></div>';
	html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="share()">SHARE</button></div>';
	html+='</div>';
	html+='<div class="row" style="margin-top:-1px;">';
	html+='<div class="col-sm-6 proylink"><button class="proybutton">PREVIOUS PROJECT</button></div>';
	html+='<div class="col-sm-6 proylink"><button class="proybutton">NEXT PROJECT</button></div>';
	html+='</div>';
	$(".proyecto").append(html);
	html2+='<video id="bgvid3" loop muted>';
	html2+='<source src="'+mypath+'vidProyectos/482c2daa.mp4" id="mp4Source"  type="video/mp4">';
	html2+='</video>';
	//console.log(html);
	$(".videoproyecto").append(html2);
	html3+='<div class="row">';
	html3+='<div class="col-sm-10 sidemenu"><ul><li>Gallery</li></ul></div>';
	html3+='<span class="closebutton" onclick="closegallery()"><img src="'+mypath+'img/cls.png" /></span>';
	html3+='</div>';
	html3+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'img/ejemwork.jpg" />';
	html3+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'img/ejemwork.jpg" />';
	html3+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'img/ejemwork.jpg" />';
	$(".galleryright").append(html3);
	html4+='<video id="bgvid4">';
	html4+='<source src="'+mypath+'vidProyectos/a35e3627.mp4" id="mp4Source"  type="video/mp4">';
	html4+='</video>';
	$("#fullscreenvideo2").append(html4);
	$(".all").fadeOut(600);
	$(".galleryright").delay(600).fadeIn(600);
	//$("#fullscreenvideo2").delay(600).fadeIn(600);
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

function showpreview(id){
	//console.log("hover");
	var html="";
	html+='<div id="video-container">';
	html+='<video autoplay loop muted class="fillWidth">';
	html+='<source src="'+mypath+'vidProyectos/482c2daa.mp4" type="video/mp4"/>';
	html+='Your browser does not support the video tag. I suggest you upgrade your browser.';
	html+='</video>';
	html+='</div>';
	$(".videono"+id).append(html);
	$(".videono"+id).show();
}

function hidepreview(id){
	//console.log("unhover");
	$(".videono"+id).hide();
	$(".videono"+id).empty();
}