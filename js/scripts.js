var mypath ='http://localhost:8888/donporfirio/'; 
var resultadonext ="";
var resultadoprev ="";
var idnext ="";
var idprev ="";
var viewportWidth = $(window).width();
var viewportHeight = $(window).height();
var social_img = "";
var social_description = "";
var social_title = "";
var url = "";
var total_proyectos_escondidos = 0;
var proyectos_escondidos = new Array();


$(window).resize(function() {
	viewportWidth = $(window).width();
	viewportHeight = $(window).height();
	//console.log(viewportWidth);
	if(viewportWidth>=768){
		centervert();
		centervertA();
		centervertH();
	}
});

function checksize(){
	viewportWidth = $(window).width();
	viewportHeight = $(window).height();
	//console.log(viewportWidth);
	if(viewportWidth>=768){ 
		centervert();
		centervertA();
		centervertH();
	}
}

function bajartituloH(){
	if(viewportWidth<=767){ 
		viewportHeight = $(window).height();
		var logotxt = $('.footertxt').outerHeight();
		var all2txt = $('.hometitle').outerHeight();
		var menutxt = $('.logohome').outerHeight();
		var total = viewportHeight - (all2txt + menutxt);
		console.log(all2txt);
		console.log(menutxt);
		console.log(total);
		if(total>50){
			$('#logobottom_2').css({
			    position: 'absolute',
			    bottom: '15px',
			});
		}
	}
}

function bajartituloA(){
	if(viewportWidth<=767){ 
		var logotxt = $('.footertxt').outerHeight();
		var all3txt = $('.about').outerHeight();
		var menutxt = $('.logohome').outerHeight();
		var total = viewportHeight - (all3txt + menutxt);
		console.log(all3txt);
		console.log(menutxt);
		console.log(total);
		if(total>50){
			$('#logobottom_2').css({
			    position: 'absolute',
			    bottom: '15px',
			});
		}
	}
}

function bajartituloP(){
	if(viewportWidth<=767){ 
		var logotxt = $('.footertxt').outerHeight();
		var all1txt = $('.proyecto').outerHeight();
		var menutxt = $('.logohome').outerHeight();
		var total = viewportHeight - (all1txt + menutxt);
		console.log(all1txt);
		console.log(menutxt);
		console.log(total);
		if(total>50){
			$('#logobottom_2').css({
			    position: 'absolute',
			    bottom: '15px',
			});
		}
	}
}

function showNewProyects(){
    proyectos_escondidos = $(".img-hidden");
    total_proyectos_escondidos = $(proyectos_escondidos).size();
    showProyect(0);
}

function showProyect(index){
        if(index < total_proyectos_escondidos){
            var proyecto_escondido = proyectos_escondidos[index];
            $(proyecto_escondido).hide().delay(500);
            $(proyecto_escondido).fadeIn("slow");
            $(proyecto_escondido).removeClass("img-hidden");
            setTimeout(function(){showProyect(index+1)}, 500);
        }
        
}

function royal(){
	 $('#content-slider-1').royalSlider({
	    autoHeight: true,
	    arrowsNav: false,
	    fadeinLoadedSlide: false,
	    controlNavigationSpacing: 0,
	    controlNavigation: 'tabs',
	    imageScaleMode: 'none',
	    imageAlignCenter:false,
	    loop: true,
	    loopRewind: true,
	    transitionType: 'fade',
	    numImagesToPreload: 6,
	    keyboardNavEnabled: true,
	    usePreloader: false,
	    autoPlay: {
    		// autoplay options go gere
    		enabled: true,
    		delay: 5000,
    		pauseOnHover: false
    	}
	  });
}

function royal2(){
	console.log("ROYAL");
	 $('#content-slider-2').royalSlider({
	    autoHeight: true,
	    arrowsNav: false,
	    fadeinLoadedSlide: false,
	    controlNavigationSpacing: 0,
	    controlNavigation: 'tabs',
	    imageScaleMode: 'none',
	    imageAlignCenter:false,
	    loop: true,
	    loopRewind: true,
	    transitionType: 'fade',
	    numImagesToPreload: 6,
	    keyboardNavEnabled: true,
	    usePreloader: false,
	    autoPlay: {
    		// autoplay options go gere
    		enabled: false,
    		delay: 5000,
    		pauseOnHover: false
    	}
	  });
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
        if(viewportWidth>=768){
        	j = setTimeout('hidecursor();', 1000);
        }
    });
    $('#fullscreenvideo').mousemove(function(e){
    	//$('#fullscreenvideo').css({cursor: 'url(./img/clsr.png),auto'});
    	 $('#fullscreenvideo').css({cursor: 'auto'});
    	 $('#clsfull').show();
    });
    $('#fullscreenvideo2').mousemove(function(e){
    	//$('#fullscreenvideo2').css({cursor: 'url(./img/clsr.png),auto'});
    	$('#fullscreenvideo').css({cursor: 'auto'});

    });
    bajartituloH();
    if(ipad==false){
    	reproduceproyecto1();
    }

});

function centervert(){
	if(viewportWidth>=768){
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
}

function centervertA(){
	if(viewportWidth>=768){
	var proHeight = $(".about").outerHeight();
	//console.log(proHeight);
	$('.about').css({
            position:'absolute',
            //left: ($(window).width() - $('.className').outerWidth())/2,
            right:'60px',
            left:'auto',
            top: (viewportHeight - proHeight)/2
        });
	}
}

function centervertH(){
	if(viewportWidth>=768){
	var proHeight = $(".hometitle").outerHeight();
	//console.log(proHeight);
	$('.hometitle').css({
            position:'absolute',
            //left: ($(window).width() - $('.className').outerWidth())/2,
            right:'60px',
            left:'auto',
            top: (viewportHeight - proHeight)/2
        });
	}
}

function hidecursor() {
    $('#fullscreenvideo').css({cursor: 'none'});
    $('#fullscreenvideo2').css({cursor: 'none'});
    $('#clsfull').hide();
}

function openmenu(){
	if($(".menuright").hasClass("mcerrado")){
		$(".menuright").animate({"right":"0"},100,function(){
			$(".menuright").removeClass("mcerrado");
			$(".menuright").addClass("mabierto");
		});
		$(".mwork").addClass("active");
		$(".mhome").removeClass("active");
		$(".mabout").removeClass("active");
		if($(".hometitle").is(":visible")){
			$("#logobottom_2").css({bottom:"10px", position:"absolute"});
		}
		$(".pmenu").removeClass("active");
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

	if(viewportWidth>=768){
		$(".menuright").animate({"right":"-60%"},100);
	}
	else{
		$(".menuright").animate({"right":"-100%"},100);
	}
	$(".menuright").removeClass("mabierto");
	$(".menuright").addClass("mcerrado");

	if($(".hometitle").is(":visible")){
		$(".mhome").addClass("active");
	}
	
	if($(".about").is(":visible")){
		$(".mabout").addClass("active");
	}

	if($(".proyecto").is(":visible")){
		$(".mwork").addClass("active");
	}
}

function closegallery(){
	if(viewportWidth>=768){
		$(".galleryright").animate({"right":"-60%"},100);
	}else{
		$(".galleryright").animate({"right":"-100%"},100);
	}
	$(".galleryright").removeClass("gabierto");
	$(".galleryright").addClass("gcerrado");
}

function closevimeo(){
	if(viewportWidth>=768){
		$(".vimeoright").animate({"right":"-60%"},100);
	}else{
		$(".vimeoright").animate({"right":"-100%"},100);
	}
	$(".vimeoright").removeClass("vabierto");
	$(".vimeoright").addClass("vcerrado");
}

function viewcontact(){
	//console.log(viewportWidth);
	if($("#contacto").hasClass("ccerrado")){
		if(viewportWidth>=768){
			$("#wraperfondo").animate({"top":"-400px"},600);
			$(".contenido").animate({"top":"-400px"},600);
			$("#contacto").animate({"top":"-400px"},600,function(){
				$("#contacto").removeClass("ccerrado");
				$("#contacto").addClass("cabierto");
			});
		}
		else{
			$("#contacto").animate({"top":"-100%"},600,function(){
				$("#contacto").removeClass("ccerrado");
				$("#contacto").addClass("cabierto");
			});			
		}
		if(viewportWidth>=768){
			if(ipad == false){
				$("#bgvid").animate({"top":"-400px"},600);
				$("#bgvid3").animate({"top":"-400px"},600);
			}
			else{
				$("#content-slider-1").animate({"top":"-400px"},600);
				$("#content-slider-2").animate({"top":"-400px"},600);
			}
			$(".aboutbg").animate({"top":"-400px"},600);
		}
		$(".pmenu").removeClass("active");
		$(".mcontact").addClass("active");
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
	if(viewportWidth>=768){
		$("#wraperfondo").animate({"top":"0"},600);
		$(".contenido").animate({"top":"0"},600);
	}
	$("#contacto").animate({"top":"0"},600);
	if(viewportWidth>=768){
		if(ipad == false){
			$("#bgvid").animate({"top":"0"},600);
			$("#bgvid3").animate({"top":"0"},600);
		}
		else{
			$("#content-slider-1").animate({"top":"0"},600);
			$("#content-slider-2").animate({"top":"0"},600);
		}
		$(".aboutbg").animate({"top":"0"},600);
	}
	$("#contacto").removeClass("cabierto");
	$("#contacto").addClass("ccerrado");

	$(".pmenu").removeClass("active");
	if($(".hometitle").is(":visible")){
		$(".mhome").addClass("active");
	}
	
	if($(".about").is(":visible")){
		$(".mabout").addClass("active");
	}

	if($(".proyecto").is(":visible")){
		$(".mwork").addClass("active");
	}
}/*
function changecursor(){
	console.log("cursor cambiado");
	$('body').css('cursor', 'url(./img/cls.png),auto');
}*/

function showvideo(){
	$(".contenido").fadeOut(1000);
	$("#wraperfondo").fadeOut(1000);
	if(ipad == false){
		$("#bgvid").fadeOut(1000);
		$("#bufferload2").hide();
	}
	else{
		$("#content-slider-1").fadeOut(1000);
	}
	$("#contacto").fadeOut(1000);
	//$('body').css('cursor', 'url(./img/clsr.png),auto');
	if(ipad == false)
		$("#bgvid")[0].pause();
	$("#fullscreenvideo").show();
	$("#bgvid2")[0].currentTime = 0;
	$("#bgvid2")[0].play();
	reproduceproyecto2();
}

function reproduceproyecto2(){
	$("#bgvid2").on(
	    "timeupdate", 
   			function (event){
   			//console.log("entro");
		    var vid = document.getElementById('bgvid2');
		    var percent = null;
		    var buffervideo = null;
		    var percent = vid.currentTime/vid.duration;
		    var buffervideo = $("#bgvid2").get(0).buffered.end(0) / $("#bgvid2").get(0).duration;
		    //console.log("video "+percent);
		    //console.log("buffer"+$('video').get(0).buffered.end(0) / $('video').get(0).duration);
	        if(buffervideo<=percent){
	        	$("#bufferload").show();
	        }
	        else{
	        	$("#bufferload").hide();
	        }
	});
}
function reproduceproyecto1(){
	$("#bgvid").on(
	    "timeupdate", 
   			function (event){
   			//console.log("entro");
		    var vid = document.getElementById('bgvid');
		    var percent = null;
		    var buffervideo = null;
		    var percent = vid.currentTime/vid.duration;
		    var buffervideo = $("#bgvid").get(0).buffered.end(0) / $("#bgvid").get(0).duration;
		    //console.log("video "+percent);
		    //console.log("buffer"+$("#bgvid").get(0).buffered.end(0) / $("#bgvid").get(0).duration);
	        if(buffervideo<=percent){
	        	$("#bufferload2").show();
	        }
	        else{
	        	$("#bufferload2").hide();
	        }
	});
}
function reproduceproyecto3(){
	$("#bgvid3").on(
	    "timeupdate", 
   			function (event){
   			//console.log("entro");
		    var vid = document.getElementById('bgvid3');
		    var percent = null;
		    var buffervideo = null;
		    var percent = vid.currentTime/vid.duration;
		    var buffervideo = $("#bgvid3").get(0).buffered.end(0) / $("#bgvid3").get(0).duration;
		    //console.log("video "+percent);
		    //console.log("buffer"+$("#bgvid").get(0).buffered.end(0) / $("#bgvid").get(0).duration);
	        if(buffervideo<=percent){
	        	$("#bufferload2").show();
	        }
	        else{
	        	$("#bufferload2").hide();
	        }
	});
}
function hidehd(){
	$("#fullscreenvideo").hide();
	$("#bgvid2")[0].pause();
	$(".contenido").fadeIn(1000);
	$("#wraperfondo").fadeIn(1000);
	if(ipad == false)
		$("#bgvid").fadeIn(1000);
	else
		$("#content-slider-1").fadeIn(1000);
	$("#contacto").fadeIn(1000);;
	//$('body').css('cursor','auto');
	if(ipad == false){
		$("#bgvid")[0].currentTime = 0;
		$("#bgvid")[0].play();
		reproduceproyecto1();
	}
}
/*
$("#fullscreenvideo").on('click',function(){
	$("#fullscreenvideo").hide();
	$("#bgvid2")[0].pause();
	$(".contenido").fadeIn(1000);
	$("#wraperfondo").fadeIn(1000);
	if(ipad == false)
		$("#bgvid").fadeIn(1000);
	else
		$("#content-slider-1").fadeIn(1000);
	$("#contacto").fadeIn(1000);;
	//$('body').css('cursor','auto');
	if(ipad == false){
		$("#bgvid")[0].currentTime = 0;
		$("#bgvid")[0].play();
	}
});
*/
$("#fullscreenvideo2").on('click',function(){
	$("#fullscreenvideo2").hide();
	//$("#bgvid4")[0].pause();
	$(".contenido").fadeIn(1000);
	$("#wraperfondo").fadeIn(1000);
	if(ipad == false)
		$("#bgvid3").fadeIn(1000);
	else
		$("#content-slider-2").fadeIn(1000);
	$("#contacto").fadeIn(1000);
	//$('body').css('cursor','auto');
	if(ipad == false){
		$("#bgvid3")[0].currentTime = 0;
		$("#bgvid3")[0].play();
	}
});

function verabout(){
	/*$(".loader2").animate({"left":"0"},600);
	$(".loader3").animate({"left":"0"},600);
	$(".loader4").animate({"top":"0"},600);
	$(".loader").animate({"top":"0"},600,function(){*/
		$("#slideproy").empty();
		//$('.imgloading').show();
		//$('.imgloading2').show();
		playslider();
		$(".pmenu").removeClass("active");
		$(".mabout").addClass("active");
		$("#logobottom_2").css({bottom:"0px", position:"relative"});
		$(".bgall").fadeOut(600);
		if(ipad == false)
			$("#bgvid")[0].pause();
		$(".videoproyecto").empty();
		$(".all").fadeOut(600);
		//$(".titulorojo").animate({"width":"0"},600);
		//$(".titulorojo2").animate({"width":"0"},600);
		$(".aboutbg").delay(600).fadeIn(600);
		$(".about").delay(600).fadeIn(600,function(){
			bajartituloA();
			/*$('.imgloading2').hide(function(){
				$(".loader").animate({"top":"-100%"},600);
				$(".loader2").animate({"left":"-100%"},600);
				$(".loader3").animate({"left":"100%"},600);
				$(".loader4").animate({"top":"100%"},600);
				$('.imgloading').hide();
			});*/
		}); 
		$('.aboutborder').mCustomScrollbar("destroy");
		$(".aboutborder").mCustomScrollbar({  
		      scrollEasing:"easeOutCirc",  
		      mouseWheel:"auto",   
		      autoDraggerLength:true,   
		      advanced:{  
		        updateOnBrowserResize:true,   
		        updateOnContentResize:true   
		      } // removed extra commas  
		    }); 
		centervert();
		//$(".aboutborder").mCustomScrollbar();
	//});
}

function playslider(){
	$(".imgloading2").width("0px");
    $(".imgloading2").animate({"width":"51px"},1500,playslider);//^callback function
}  
 
$( window ).resize(function() { 
	$('.aboutborder').mCustomScrollbar("destroy");
	$(".aboutborder").mCustomScrollbar({  
	      scrollEasing:"easeOutCirc",  
	      mouseWheel:"auto",   
	      autoDraggerLength:true,   
	      advanced:{  
	        updateOnBrowserResize:true,   
	        updateOnContentResize:true   
	      } // removed extra commas  
	    }); 
	centervert();
	centervertA();
	centervertH();
});

function verhome(){
	/*$(".loader2").animate({"left":"0"},600);
	$(".loader3").animate({"left":"0"},600);
	$(".loader4").animate({"top":"0"},600);
	$(".loader").animate({"top":"0"},600,function(){*/
		$("#slideproy").empty();
		//$('.imgloading').show();
		//$('.imgloading2').show();
		playslider();
		
		$("#logobottom_2").css({bottom:"10px", position:"absolute"});
		$(".bgall").fadeOut(600);
		$(".videoproyecto").empty();
		//$(".bgall")[0].pause();
		$(".all").fadeOut(600);
		if(ipad == false){
			$("#bgvid").delay(600).fadeIn(600,function(){
				$("#bgvid")[0].currentTime = 0;
				$("#bgvid")[0].play();
				reproduceproyecto1();
			});
		}
		else{
			$("#content-slider-1").delay(600).fadeIn(600);
		}
		$(".hometitle").delay(600).fadeIn(600,function(){
			bajartituloH();
			centervertH();
			$(".pmenu").removeClass("active");
			$(".mhome").addClass("active");
			/*$('.imgloading2').hide(function(){
				$(".loader").animate({"top":"-100%"},600);
				$(".loader2").animate({"left":"-100%"},600);
				$(".loader3").animate({"left":"100%"},600);
				$(".loader4").animate({"top":"100%"},600);
				$('.imgloading').hide();
			});*/
		});
	//});
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
	//$('body').css('cursor', 'url(./img/clsr.png),auto');
	$("#bgvid3")[0].pause();
	$("#fullscreenvideo2").show();
	$("#bgvid4")[0].currentTime = 0;
	$("#bgvid4")[0].play();
}

function verproyecto(id){
	/*$(".loader2").animate({"left":"0"},600);
	$(".loader3").animate({"left":"0"},600);
	$(".loader4").animate({"top":"0"},600);*/
	//$(".loader").animate({"top":"0"},600,function(){
		$("#slideproy").empty();
		///$('.imgloading').show();
		//$('.imgloading2').show();
		playslider();
		closemenu();
		closegallery();
		$(".hometitle").fadeOut('slow');
		$("#logobottom_2").css({position:"relative", bottom:"0px"});
		$(".proyecto").css("right","-1000px");
		if(ipad == false){
			if($("#bgvid3").length > 0){
				$("#bgvid3")[0].pause();
			}
		}
		//$(".galleryright").empty();
		//$(".vimeoright").empty();
		$(".pmenu").removeClass("active");
		$(".mwork").addClass("active");
		if(ipad == false){
			$("#bgvid")[0].pause();
			$("#bgvid4").remove();
		}
	
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
			var meta_descripcion = (idioma == "esp")? resultado[0].meta_descripcion_esp : resultado[0].meta_descripcion_eng;
			var img_principal = resultado[0].img_principal;
			var ver = (idioma == "esp")? "VER" : "WATCH";
			var galeria = (idioma == "esp")? "GALERÍA" : "GALLERY";
			var style_frame = (idioma == "esp")? "MARCO DE ESTILO" : "STYLE FRAME";
			var share = (idioma == "esp")? "COMPARTIR" : "SHARE";
			var pprev = (idioma == "esp")? "PROYECTO ANTERIOR" : "PREVIOUS PROYECT";
			var pnext = (idioma == "esp")? "SIGUIENTE PROYECTO" : "NEXT PROJECT";

			social_title = titulo;
			social_description = meta_descripcion;
			social_img = mypath+"imgProyectos/"+img_principal;
			url = window.location.href;
			console.log(url);
	
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
			html+='<div class="col-sm-3 col-xs-6 proylink"><button class="proybutton" onclick="openvimeo()">'+galeria+'</button></div>';
			html+='<div class="col-sm-3 col-xs-6 proylink"><button class="proybutton" onclick="opengallery()">'+style_frame+'</button></div>';
			html+='<div class="col-sm-3 col-xs-6 proylink"><a href="'+resultado[0].behance+'" target="_blank"><button class="proybutton">BEHANCE</button></a></div>';
			html+='<div class="col-sm-3 col-xs-6 proylink">'+
						'<button class="redesb redesc" onclick="shareTwitter()"> <i class="fa fa-twitter"></i></button>'+
						'<button class="redesb redesc" onclick="shareFacebook()" style="border-left:solid 1px #fff;"> <i class="fa fa-facebook"></i></button>'+
						'<button class="redesb redesc" onclick="sharePinterest()" style="border-left:solid 1px #fff;border-right:solid 1px #fff;"> <i class="fa fa-pinterest"></i></button>';
			html+='</div>';
			html+='<div class="row" style="margin-top:-1px;">';
			html+='<div class="col-sm-6 col-xs-12 proylink"><a href="#'+resultadoprev+'" onclick="verproyecto('+idprev+')"><button class="proybutton">'+pprev+'</button></a></div>';
			html+='<div class="col-sm-6 col-xs-12 proylink"><a href="#'+resultadonext+'" onclick="verproyecto('+idnext+')"><button class="proybutton">'+pnext+'</button></a></div>';
			html+='</div>';
			if(ipad == false){
				html2+='<video id="bgvid3" loop muted>';
				html2+='<source src="'+mypath+'vidProyectos/'+resultado[0].nombre_video+'" id="mp4Source"  type="video/mp4">';
				html2+='</video>';
			}
			else{
				html2+='<div id="content-slider-2" class="royalSlider contentSlider rsDefault bgall bghome">';
				for(var z = 0; z < resultado[0].img_secundarias.length; z++){
					html2+='<div style="margin-top: -10px; background:url('+mypath+'imgProyectos/secundarias/'+resultado[0].img_secundarias[z].ruta+') no-repeat center center; width:100%; height:100%; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">';
					html2+='<span class="rsTmb"></span>';
					html2+='</div>';
				}
				html2+='</div>';
			}
			html3+='<div class="fondo_proyectos"></div><div class="row" style="background-color:#fff;">';
			html3+='<div class="col-sm-10 col-xs-10 sidemenu"><ul><li>'+style_frame+'</li></ul></div>';
			html3+='<span class="closebutton" onclick="closegallery()"><img src="'+mypath+'img/cls.png" /></span>';
			html3+='</div>';
			for(var i = 0; i < resultado[0].img_secundarias.length; i++){
				html3+='<img class="gray-img" style="width:100%;border-bottom:solid #fff 2px;" src="'+mypath+'imgProyectos/secundarias/'+resultado[0].img_secundarias[i].ruta+'" />';
			}
			$(".galleryright").html(html3);
			/*
			html4+='<video id="bgvid4">';
			html4+='<source src="'+mypath+'vidProyectos/'+resultado[0].nombre_video_hd+'" id="mp4Source"  type="video/mp4">';
			html4+='</video>';
			$("#fullscreenvideo2").html(html4);
			*/
			html5+='<div class="fondo_proyectos"></div><div class="row" style="background-color:#fff;">';
			html5+='<div class="col-sm-10 col-xs-10 sidemenu"><ul><li>'+galeria+'</li></ul></div>';
			html5+='<span class="closebutton" onclick="closevimeo()"><img src="'+mypath+'img/cls.png" /></span>';
			html5+='</div>';
			for(var i = 0; i < resultado[0].links_videos.length; i++){
				var link_video = resultado[0].links_videos[i].link_video;
				var splitted_link = link_video.split(".com/");
	            var video_id = splitted_link[1];
				html5+='<div style="height:377px;width:100%;border-bottom:solid #fff 2px;" >'+
	                        '<iframe id="player'+resultado[0].links_videos[i].id_link+'" src="//player.vimeo.com/video/'+video_id+'?api=1&player_id=player'+resultado[0].links_videos[i].id_link+'" style="height:100%;width:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'+
	                    '</div>';
			}
			$(".vimeoright").html(html5);
	
			$(".all").fadeOut('slow');
			$(".bgall").fadeOut('slow');
	
			if(ipad == false){
				setTimeout(function(){
					$(".videoproyecto").delay(1000).html(html2).fadeIn('fast',function(){
					reproduceproyecto();
					$("#bgvid3")[0].currentTime = 0;
					$("#bgvid3")[0].play();
					reproduceproyecto3();
				});
				}, 1000);
			}
			else{
				setTimeout(function(){
					$("#slideproy").delay(1000).html(html2).fadeIn('fast');
					$(".proyecto").css("right","0");
				}, 1000);
			}
			
			setTimeout(function(){
				$(".proyecto").html(html).fadeIn('slow', function(){
					checksize();
					if(viewportWidth<=767){
						$(".proyecto").css("right","0px");
					}
					bajartituloP();
					royal2();
					/*$('.imgloading2').hide(function(){
						royal2();
						$(".loader").animate({"top":"-100%"},600);
						$(".loader2").animate({"left":"-100%"},600);
						$(".loader3").animate({"left":"100%"},600);
						$(".loader4").animate({"top":"100%"},600);
						$('.imgloading').hide();
					});*/
				});
				$(".aboutborder").mCustomScrollbar({  
			      scrollEasing:"easeOutCirc",  
			      mouseWheel:"auto",   
			      autoDraggerLength:true,   
			      advanced:{  
			        updateOnBrowserResize:true,   
			        updateOnContentResize:true   
			      } // removed extra commas  
			    }); 
			}, 1500);
			$(".galleryright").show();
			$(".vimeoright").show();
		}	
	//});	
}

function shareFacebook(){
    window.open("http://www.facebook.com/share.php?u="+url,'_blank');
}
function shareTwitter(){
    window.open("https://twitter.com/share?text=Don Porfirio - "+social_title +"&url="+url ,'_blank');
}
function sharePinterest(){
  	window.open("https://www.pinterest.com/pin/create/button/?url="+encodeURIComponent(url)+"&description="+social_title+"&media="+encodeURIComponent(social_img) , '_blank');
    console.log(social_description);
}

$(document).ready(function(){
	royal();
	var hashTag = window.location.hash
	console.log(hashTag);
	if(hashTag!=""){
		if(hashTag=="#home"){
			verhome();
			$('.imgloading2').hide(function(){
				$('.imgloading').hide();
				$(".loader").animate({"top":"-100%"},600);
				$(".loader2").animate({"left":"-100%"},600);
				$(".loader3").animate({"left":"100%"},600);
				$(".loader4").animate({"top":"100%"},600);
			});

		}else if(hashTag=="#about"){
			verabout();
			$('.imgloading2').hide(function(){
				$('.imgloading').hide();
				$(".loader").animate({"top":"-100%"},600);
				$(".loader2").animate({"left":"-100%"},600);
				$(".loader3").animate({"left":"100%"},600);
				$(".loader4").animate({"top":"100%"},600);
			});
		}else if(hashTag=="#work"){
			openmenu();
			centervertH();
			$('.imgloading2').hide(function(){
				$('.imgloading').hide();
				$(".loader").animate({"top":"-100%"},600);
				$(".loader2").animate({"left":"-100%"},600);
				$(".loader3").animate({"left":"100%"},600);
				$(".loader4").animate({"top":"100%"},600);
			});
		}else if(hashTag=="#contact"){
			viewcontact();
			centervertH();
			$('.imgloading2').hide(function(){
				$('.imgloading').hide();
				$(".loader").animate({"top":"-100%"},600);
				$(".loader2").animate({"left":"-100%"},600);
				$(".loader3").animate({"left":"100%"},600);
				$(".loader4").animate({"top":"100%"},600);
			});
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
		                		console.log('trabajo');
								$('.imgloading2').hide(function(){
									$('.imgloading').hide();
									$(".loader").animate({"top":"-100%"},600);
									$(".loader2").animate({"left":"-100%"},600);
									$(".loader3").animate({"left":"100%"},600);
									$(".loader4").animate({"top":"100%"},600);
								});
		                	}, 600);
		                }
		            }
		    });
		}
	}
	else{
		centervertH();
		$('.imgloading').hide();
		$('.imgloading2').hide(function(){
			$(".loader").animate({"top":"-100%"},600);
			$(".loader2").animate({"left":"-100%"},600);
			$(".loader3").animate({"left":"100%"},600);
			$(".loader4").animate({"top":"100%"},600);
		});
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
/*
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
*/
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
	if(ipad==false){
		$(".videono"+id).fadeIn(600);
		$(".fillWidth")[0].play();
	}
	//$(".videono"+id).fadeIn(600);
}

function hidepreview(id){
	//console.log("unhover");
	/*$(".videono"+id).fadeOut(600, function(){
		$(".videono"+id).empty();
	});*/
	if(ipad==false){
		$(".videono"+id).fadeOut(600);
		$(".fillWidth")[0].pause();
	}
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
						console.log(video_preview);
						var vp = "'"+video_preview+"'";
	                	html+='<a href="#'+resultado_cat[x].url_amigable+'" onclick="verproyecto('+resultado_cat[x].id_proyecto+')" onmouseenter="showpreview('+resultado_cat[x].id_proyecto+','+vp+')" onmouseleave="hidepreview('+resultado_cat[x].id_proyecto+')"><div style="max-height:200px; overflow:hidden;"  class="proyectofondo img-hidden" >';
						html+='<img style="width:100%; height:100%; margin: 0;" src="'+mypath+'imgProyectos/'+resultado_cat[x].img_principal+'" />';
						html+='<div class="fcategoria"></div>';
						html+='<div class="cattitulos">';
						html+='<h4>'+titulo_proyecto+'</h4>';
						html+='<h3>'+subtitulo_proyecto+'</h3>';
						html+='</div>';
						html+='<div class="vidpreview videono'+resultado_cat[x].id_proyecto+'">';
						html+='<div id="video-container">';
						if(video_preview!=""){
							html+='<video autoplay loop muted class="fillWidth">';
							html+='<source src="'+mypath+'vidProyectos/'+video_preview+'" type="video/mp4"/>';
							html+='Your browser does not support the video tag. I suggest you upgrade your browser.';
							html+='</video>';
						}else{
							html+='<img style="width:100%; height:100%; margin: 1px 0;" src="'+mypath+'imgProyectos/'+resultado_cat[x].img_principal+'" />';
						}
						html+='</div>';
						html+='</div>';
						html+='</div></a>';
						//$(".listproyectos").append(html);
                	}
                	//console.log(html);
                	console.log("in");
                	/*$(".listproyectos").animate({left:"2000px"},800,function(){
                		$(".listproyectos").empty().append(html).delay(400).animate({left:"0"},800);
                	})*/
					$(".listproyectos").fadeOut("fast",function(){
						$(".listproyectos").empty().append(html).delay(400).show(function(){
							showNewProyects();
						});
					});
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
