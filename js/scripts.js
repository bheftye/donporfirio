var mypath ='http://localhost:8080/donporfirio2/donporfirio/'; 
var resultadonext ="";
var resultadoprev ="";
var idnext ="";
var idprev ="";
var viewportWidth = $(window).width();
var viewportHeight = $(window).height();

$(window).resize(function() {
	viewportWidth = $(window).width();
	viewportHeight = $(window).height();
	//console.log(viewportWidth);
	if(viewportWidth>=768){
		centervert();
	}
});

function checksize(){
	viewportWidth = $(window).width();
	viewportHeight = $(window).height();
	//console.log(viewportWidth);
	if(viewportWidth>=768){
		centervert();
	}
}

$(".contenido").on('click',function(){
	if($("#contacto").hasClass("cabierto")){
		hidecontact();
	}
	if($(".menuright").hasClass("mabierto")){
		closemenu();
	}
	if($(".galleryright").hasClass("gabierto")){
		closegallery();
	}
	if($(".vimeoright").hasClass("vabierto")){
		closevimeo();
	}
});
$('.menuright').click(function(event){
   event.stopPropagation();
});
$('.galleryright').click(function(event){
   event.stopPropagation();
});
$('.vimeoright').click(function(event){
   event.stopPropagation();
});

$(document).ready(function() {
	var viewportWidth = $(window).width();
	var viewportHeight = $(window).height();
    var j;
    $(document).mousemove(function() {
        clearTimeout(j);
        //$('#fullscreenvideo').css({cursor: 'default'});
        j = setTimeout('hidecursor();', 1000);
    });
    $('#fullscreenvideo').mousemove(function(e){
    	$('#fullscreenvideo').css({cursor: 'url(./img/clsr.png),auto'});
    });
    $('#fullscreenvideo2').mousemove(function(e){
    	$('#fullscreenvideo2').css({cursor: 'url(./img/clsr.png),auto'});
    });
});

function centervert(){
	var proHeight = $(".proyecto").outerHeight();
	//console.log(proHeight);
	$('.proyecto').css({
            position:'absolute',
            //left: ($(window).width() - $('.className').outerWidth())/2,
            right:'60px',
            left:'auto',
            top: (viewportHeight - proHeight)/2
        });
}

function hidecursor() {
    $('#fullscreenvideo').css({cursor: 'none'});
    $('#fullscreenvideo2').css({cursor: 'none'});
}

function openmenu(){
	if($(".menuright").hasClass("mcerrado")){
		$(".menuright").animate({"right":"0"},100,function(){
			$(".menuright").removeClass("mcerrado");
			$(".menuright").addClass("mabierto");
		});
		$(".mwork").addClass("active");
	}
	else{
		closemenu();
	}
}

function opengallery(){
	if($(".galleryright").hasClass("gcerrado")){
		$(".galleryright").animate({"right":"0"},100,function(){
			$(".galleryright").removeClass("gcerrado");
			$(".galleryright").addClass("gabierto");
		});
	}
	else{
		closegallery();
	}
}

function openvimeo(){
	console.log("vimeo");
	if($(".vimeoright").hasClass("vcerrado")){
		$(".vimeoright").animate({"right":"0"},100,function(){
			$(".vimeoright").removeClass("vcerrado");
			$(".vimeoright").addClass("vabierto");
		});
	}
	else{
		closevimeo();
	}
}

function closemenu(){
	$(".mwork").removeClass("active");
	$(".menuright").animate({"right":"-60%"},100);
	$(".menuright").removeClass("mabierto");
	$(".menuright").addClass("mcerrado");
}

function closegallery(){
	$(".galleryright").animate({"right":"-60%"},100);
	$(".galleryright").removeClass("gabierto");
	$(".galleryright").addClass("gcerrado");
}

function closevimeo(){
	$(".vimeoright").animate({"right":"-60%"},100);
	$(".vimeoright").removeClass("vabierto");
	$(".vimeoright").addClass("vcerrado");
}

function viewcontact(){
	if($("#contacto").hasClass("ccerrado")){
		$("#wraperfondo").animate({"top":"-400px"},600);
		$(".contenido").animate({"top":"-400px"},600);
		$("#contacto").animate({"top":"-400px"},600,function(){
			$("#contacto").removeClass("ccerrado");
			$("#contacto").addClass("cabierto");
		});
		$("#bgvid").animate({"top":"-400px"},600);
		$("#bgvid3").animate({"top":"-400px"},600);
		$(".aboutbg").animate({"top":"-400px"},600);
	}
	else{
		hidecontact();
	}
}

//$('#contacto').click(function(event){
    //event.stopPropagation();
    //console.log("cerrar");
//});

function hidecontact(){
	$("#wraperfondo").animate({"top":"0"},600);
	$(".contenido").animate({"top":"0"},600);
	$("#contacto").animate({"top":"0"},600);
	$("#bgvid").animate({"top":"0"},600);
	$("#bgvid3").animate({"top":"0"},600);
	$(".aboutbg").animate({"top":"0"},600);
	$("#contacto").removeClass("cabierto");
	$("#contacto").addClass("ccerrado");
}/*
function changecursor(){
	console.log("cursor cambiado");
	$('body').css('cursor', 'url(./img/cls.png),auto');
}*/

function showvideo(){
	$(".contenido").fadeOut(1000);
	$("#wraperfondo").fadeOut(1000);
	$("#bgvid").fadeOut(1000);
	$("#contacto").fadeOut(1000);
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
	$("#contacto").fadeIn(1000);;
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
	$("#contacto").fadeIn(1000);
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
	//$(".aboutborder").mCustomScrollbar();
}

(function($) {  
  $(window).load(function() {  
    $(".aboutborder").mCustomScrollbar({  
      scrollEasing:"easeOutCirc",  
      mouseWheel:"auto",   
      autoDraggerLength:true,   
      advanced:{  
        updateOnBrowserResize:true,   
        updateOnContentResize:true   
      } // removed extra commas  
    });  
  });  
})(jQuery);

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
	        //$(".titulorojo").width(percent+"px");
	        //$(".titulorojo2").width(percent2+"px");
	});
}

function reproduceproyectohd(){
	$(".contenido").fadeOut(1000);
	$("#wraperfondo").fadeOut(1000);
	$("#bgvid3").fadeOut(1000);
	$("#contacto").fadeOut(1000);
	$('body').css('cursor', 'url(./img/clsr.png),auto');
	$("#bgvid3")[0].pause();
	$("#fullscreenvideo2").show();
	$("#bgvid4")[0].currentTime = 0;
	$("#bgvid4")[0].play();
}

function verproyecto(id){
	closemenu();
	closegallery();
	$(".all").fadeOut('slow');
	//$(".galleryright").empty();
	//$(".vimeoright").empty();
	$(".pmenu").removeClass("active");
	$(".mwork").addClass("active");
	$("#bgvid")[0].pause();
	$("#bgvid4").remove();

	var proyecto_existente = false;
	var data = new FormData;
        data.append('operaciones',"obtener_proyecto");
        data.append("id_proyecto", id);
    var resultado;

	$.ajax({ 
            url: mypath+"functions.php",
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            async:false,
            success:function(data){
                if(data != ""){
                	proyecto_existente = true;
                	resultado = JSON.parse(data);
                }
            }
        });

	if(proyecto_existente){
		//console.log("entro");
		nextproyect(resultado[0].id_proyecto);
		prevproyect(resultado[0].id_proyecto);
		var titulo = (idioma == "esp")? resultado[0].titulo_esp : resultado[0].titulo_eng;
		var subtitulo = (idioma == "esp")? resultado[0].subtitulo_esp : resultado[0].subtitulo_eng;
		var descripcion = (idioma == "esp")? resultado[0].descripcion_esp : resultado[0].descripcion_eng;
		var ver = (idioma == "esp")? "VER" : "WATCH";
		var galeria = (idioma == "esp")? "GALERÍA" : "GALLERY";
		var share = (idioma == "esp")? "COMPARTIR" : "SHARE";
		var pprev = (idioma == "esp")? "PROYECTO ANTERIOR" : "PREVIOUS PROYECT";
		var pnext = (idioma == "esp")? "SIGUIENTE PROYECTO" : "NEXT PROJECT";

		html='';
		html2='';
		html3='';
		html4='';
		html5='';
		html+='<h2>'+subtitulo+'</h2>';
		html+='<h1>'+titulo+'</h1>';
		html+='<div class="row aboutborder">';
		html+='<p style="margin:0;">'+descripcion+'</p>';
		html+='</div>';
		html+='<div class="row">';
		//html+='<div class="col-sm-3 proylink"><button class="proybutton watchproy" onclick="reproduceproyectohd()">'+ver+'</button></div>';
		html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="openvimeo()">VIMEO</button></div>';
		html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="opengallery()">'+galeria+'</button></div>';
		html+='<div class="col-sm-3 proylink"><a href="'+resultado[0].behance+'" target="_blank"><button class="proybutton">BEHANCE</button></a></div>';
		html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="share()">'+share+'</button></div>';
		html+='</div>';
		html+='<div class="row" style="margin-top:-1px;">';
		html+='<div class="col-sm-6 proylink"><a href="#'+resultadoprev+'" onclick="verproyecto('+idprev+')"><button class="proybutton">'+pprev+'</button></a></div>';
		html+='<div class="col-sm-6 proylink"><a href="#'+resultadonext+'" onclick="verproyecto('+idnext+')"><button class="proybutton">'+pnext+'</button></a></div>';
		html+='</div>';
		html2+='<video id="bgvid3" loop muted>';
		html2+='<source src="'+mypath+'vidProyectos/'+resultado[0].nombre_video+'" id="mp4Source"  type="video/mp4">';
		html2+='</video>';
		html3+='<div class="row">';
		html3+='<div class="col-sm-10 sidemenu"><ul><li>'+galeria+'</li></ul></div>';
		html3+='<span class="closebutton" onclick="closegallery()"><img src="'+mypath+'img/cls.png" /></span>';
		html3+='</div>';
		for(var i = 0; i < resultado[0].img_secundarias.length; i++){
			html3+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'imgProyectos/secundarias/'+resultado[0].img_secundarias[i].ruta+'" />';
		}
		$(".galleryright").html(html3);
		html4+='<video id="bgvid4">';
		html4+='<source src="'+mypath+'vidProyectos/'+resultado[0].nombre_video_hd+'" id="mp4Source"  type="video/mp4">';
		html4+='</video>';
		$("#fullscreenvideo2").html(html4);
		html5+='<div class="row">';
		html5+='<div class="col-sm-10 sidemenu"><ul><li>Vimeo</li></ul></div>';
		html5+='<span class="closebutton" onclick="closevimeo()"><img src="'+mypath+'img/cls.png" /></span>';
		html5+='</div>';
		for(var i = 0; i < resultado[0].links_videos.length; i++){
			var link_video = resultado[0].links_videos[i].link_video;
			var splitted_link = link_video.split(".com/");
            var video_id = splitted_link[1];
			html5+='<div style="height:646px;width:100%;" >'+
                        '<iframe id="player'+resultado[0].links_videos[i].id_link+'" src="//player.vimeo.com/video/'+video_id+'?api=1&player_id=player'+resultado[0].links_videos[i].id_link+'" style="height:100%;width:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'+
                    '</div>';
		}
		$(".vimeoright").html(html5);
		
		setTimeout(function(){
			$(".proyecto").html(html).fadeIn('slow', function(){
				checksize();
			});
		}, 1500);
		
		
		$(".bgall").fadeOut(600);
		$(".videoproyecto").delay(1000).html(html2).fadeIn('fast',function(){
			reproduceproyecto();
			$("#bgvid3")[0].currentTime = 0;
			$("#bgvid3")[0].play();
		});
		
		$(".galleryright").show();
		$(".vimeoright").show();
	}	
}

$(document).ready(function(){
	var hashTag = window.location.hash
	console.log(hashTag);
	if(hashTag!=""){
		if(hashTag=="#home"){
			verhome();
		}else if(hashTag=="#about"){
			verabout();
		}else if(hashTag=="#work"){
			openmenu();
		}else if(hashTag=="#contact"){
			viewcontact();
		}else{
			//console.log(hashTag);	
			var url = hashTag.substring(1);
			var data = new FormData;
	        data.append('operaciones',"obtener_proyecto_por_urlamigable");
	        data.append("url_amigable", url);
		    var resultado;
			$.ajax({ 
		            url: mypath+"functions.php",
		            type:'POST',
		            contentType:false,
		            data:data,
		            processData:false,
		            cache:false,
		            async:false,
		            success:function(data){
		                //console.log(data);
		                if(data != ""){
		                	resultado = JSON.parse(data);
		                	setTimeout(function(){
		                		verproyecto(resultado); 
		                	}, 600);
		                }
		            }
		    });
		}
	}
	if(idioma == "esp"){
		$(".aen").removeClass("active");
		$(".aes").addClass("active");
	}
	else{
		$(".aes").removeClass("active");
		$(".aen").addClass("active");
	}
	/*$(".contenido").click(function(){
		closegallery();
		closemenu();
		hidecontact();
	});*/
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
	        //$(".titulorojo").width(percent+"px");
	        //$(".titulorojo2").width(percent2+"px");
	});
});

function showpreview(id,vp){
	//console.log(vp);
	//$(".videono"+id).empty();
	/*var html="";
	html+='<div id="video-container">';
	html+='<video autoplay loop muted class="fillWidth">';
	html+='<source src="'+mypath+'vidProyectos/'+vp+'" type="video/mp4"/>';
	html+='Your browser does not support the video tag. I suggest you upgrade your browser.';
	html+='</video>';
	html+='</div>';
	$(".videono"+id).append(html).delay(600).fadeIn(600);*/
	$(".videono"+id).fadeIn(600);
	$(".fillWidth")[0].play();
	//$(".videono"+id).fadeIn(600);
}

function hidepreview(id){
	//console.log("unhover");
	/*$(".videono"+id).fadeOut(600, function(){
		$(".videono"+id).empty();
	});*/
	$(".videono"+id).fadeOut(600);
	$(".fillWidth")[0].pause();
}

function lxcategoria(idcat){
	var proy_cat_existente = false;
	var data = new FormData;
        data.append('operaciones',"listar_proyecto_categoria");
        data.append("id_categoria", idcat);
    var resultado_cat;
    $(".sidemenu ul li").removeClass("active");
    $(".cat"+idcat).addClass("active");
	$.ajax({ 
            url: mypath+"functions.php",
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            async:false,
            success:function(data){
                //console.log(data);
                if(data != ""){
                	proy_cat_existente = true;
                	//console.log(data)
                	resultado_cat = JSON.parse(data);
                	//console.log(resultado_cat);
                	var html="";
                	//$(".listproyectos").show();
                	for (var x in resultado_cat){
                		var titulo_proyecto = (idioma == "esp")? resultado_cat[x].titulo_esp : resultado_cat[x].titulo_eng;
						var subtitulo_proyecto = (idioma == "esp")? resultado_cat[x].subtitulo_esp : resultado_cat[x].subtitulo_eng;
						var video_preview = resultado_cat[x].nombre_preview;
						var vp = "'"+video_preview+"'";
	                	html+='<a href="#'+resultado_cat[x].url_amigable+'" style="display:block;" onclick="verproyecto('+resultado_cat[x].id_proyecto+')" onmouseenter="showpreview('+resultado_cat[x].id_proyecto+','+vp+')" onmouseleave="hidepreview('+resultado_cat[x].id_proyecto+')"><div style="max-height:200px; overflow:hidden;"  class="proyectofondo" >';
						html+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'imgProyectos/'+resultado_cat[x].img_principal+'" />';
						html+='<div class="fcategoria"></div>';
						html+='<div class="cattitulos">';
						html+='<h4>'+titulo_proyecto+'</h4>';
						html+='<h3>'+subtitulo_proyecto+'</h3>';
						html+='</div>';
						html+='<div class="vidpreview videono'+resultado_cat[x].id_proyecto+'">';
						html+='<div id="video-container">';
						html+='<video autoplay loop muted class="fillWidth">';
						html+='<source src="'+mypath+'vidProyectos/'+video_preview+'" type="video/mp4"/>';
						html+='Your browser does not support the video tag. I suggest you upgrade your browser.';
						html+='</video>';
						html+='</div>';
						html+='</div>';
						html+='</div></a>';
						//$(".listproyectos").append(html);
                	}
                	//console.log(html);
                	console.log("in");
                	$(".listproyectos").animate({marginLeft:"100%"},600,function(){
                		$(".listproyectos").empty().append(html).delay(600).animate({marginLeft:"0"},600);
                	})
                	//$(".listproyectos").delay(600).animate({marginLeft:"0"},600);         	
                }
            }
        });
}

function nextproyect(id){
	/*$(".proyecto").fadeOut(600);
	$(".bgall").fadeOut(600);
	$("#bgvid4").remove();*/
	var data = new FormData;
        data.append('operaciones',"obtener_proyecto_siguiente");
        data.append("id_proyecto", id);
    var resultado;
	$.ajax({ 
            url: mypath+"functions.php",
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            async:false,
            success:function(data){
                //console.log(data);
                if(data != ""){
                	resultados = JSON.parse(data);
                	resultadonext = resultados.url_proyecto_siguiente;
                	idnext = resultados.id_proyecto_siguiente;
                	//return resultadonext;
                	/*setTimeout(function(){
                		verproyecto(resultado); 
                	}, 600);*/
                	          	
                }
            }
    });
}

function prevproyect(id){
	/*$(".proyecto").fadeOut(600);
	$(".bgall").fadeOut(600);
	$("#bgvid4").remove();*/
	var data = new FormData;
        data.append('operaciones',"obtener_proyecto_anterior");
        data.append("id_proyecto", id);
    var resultado;

	$.ajax({ 
            url: mypath+"functions.php",
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            async:false,
            success:function(data){
                //console.log(data);
                if(data != ""){
                	//console.log()
                	resultados = JSON.parse(data);
					resultadoprev = resultados.url_proyecto_anterior;
					idprev = resultados.id_proyecto_anterior;
                	//console.log(resultados.id_proyecto_anterior);
                	//console.log(resultados.url_proyecto_anterior);
                	//return resultadoprev;
                	/*setTimeout(function(){
                		verproyecto(resultado); 
                	}, 600);*/
                }
            }
    });
}

function changelang(lang){
    var data = new FormData;
    data.append('operaciones', 'cambiar_idioma'); 
    data.append('lang', lang);  
     $.ajax({ 
            url: mypath+"functions.php",
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            success:function(data){
                location.reload();
            }
        });
}
