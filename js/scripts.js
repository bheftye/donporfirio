var mypath ='http://localhost:8888/donporfirio/'; 

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
	$(".aboutbg").animate({"top":"-400px"},600);
}

function hidecontact(){
	$("#wraperfondo").animate({"top":"0"},600);
	$(".contenido").animate({"top":"0"},600);
	$("#contacto").animate({"top":"0"},600);
	$("#bgvid").animate({"top":"0"},600);
	$("#bgvid3").animate({"top":"0"},600);
	$(".aboutbg").animate({"top":"0"},600);
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
	$(".galleryright").empty();
	$(".videoproyecto").empty();
	$(".proyecto").empty();
	$(".pmenu").removeClass("active");
	$(".mwork").addClass("active");
	$(".bgall").fadeOut(600);
	$("#bgvid")[0].pause();
	//$(".bgall")[0].pause();
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
                //console.log(data);
                if(data != ""){
                	proyecto_existente = true;
                	resultado = JSON.parse(data);
                	//console.log(resultado);              	
                }
            }
        });

	if(proyecto_existente){
		var titulo = (idioma == "es")? resultado[0].titulo_esp : resultado[0].titulo_eng;
		var subtitulo = (idioma == "es")? resultado[0].subtitulo_esp : resultado[0].subtitulo_eng;
		var descripcion = (idioma == "es")? resultado[0].descripcion_esp : resultado[0].descripcion_eng;
		var behance = (resultado[0].behance == "")? "#"+resultado[0].url_amigable : resultado[0].behance;
		html='';
		html2='';
		html3='';
		html4='';
		html+='<h2>'+subtitulo+'</h2>';
		html+='<h1>'+titulo+'</h1>';
		html+='<div class="row aboutborder">';
		html+='<p style="margin:0;">'+descripcion+'</p>';
		html+='</div>';
		html+='<div class="row">';
		html+='<div class="col-sm-3 proylink"><button class="proybutton watchproy" onclick="reproduceproyectohd()">WATCH</button></div>';
		html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="opengallery()">GALLERY</button></div>';
		html+='<div class="col-sm-3 proylink"><a href="'+behance+'" target="_blank"><button class="proybutton">BEHANCE</button></a></div>';
		html+='<div class="col-sm-3 proylink"><button class="proybutton" onclick="share()">SHARE</button></div>';
		html+='</div>';
		html+='<div class="row" style="margin-top:-1px;">';
		html+='<div class="col-sm-6 proylink"><button class="proybutton" onclick="prevproyect('+resultado[0].id_proyecto+')">PREVIOUS PROJECT</button></div>';
		html+='<div class="col-sm-6 proylink"><button class="proybutton" onclick="nextproyect('+resultado[0].id_proyecto+')">NEXT PROJECT</button></div>';
		html+='</div>';
		$(".proyecto").append(html);
		html2+='<video id="bgvid3" loop muted>';
		html2+='<source src="'+mypath+'vidProyectos/'+resultado[0].nombre_video+'" id="mp4Source"  type="video/mp4">';
		html2+='</video>';
		//console.log(html);
		$(".videoproyecto").append(html2);
		html3+='<div class="row">';
		html3+='<div class="col-sm-10 sidemenu"><ul><li>Gallery</li></ul></div>';
		html3+='<span class="closebutton" onclick="closegallery()"><img src="'+mypath+'img/cls.png" /></span>';
		html3+='</div>';
		for(var i = 0; i < resultado[0].img_secundarias.length; i++){
			html3+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'imgProyectos/secundarias/'+resultado[0].img_secundarias[i].ruta+'" />';
		}
		$(".galleryright").append(html3);
		html4+='<video id="bgvid4">';
		html4+='<source src="'+mypath+'vidProyectos/'+resultado[0].nombre_video_hd+'" id="mp4Source"  type="video/mp4">';
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

function showpreview(id,vp){
	//console.log(vp);
	//$(".videono"+id).empty();
	var html="";
	html+='<div id="video-container">';
	html+='<video autoplay loop muted class="fillWidth">';
	html+='<source src="'+mypath+'vidProyectos/'+vp+'" type="video/mp4"/>';
	html+='Your browser does not support the video tag. I suggest you upgrade your browser.';
	html+='</video>';
	html+='</div>';
	$(".videono"+id).append(html).delay(600).fadeIn(600);
	//$(".videono"+id).fadeIn(600);
}

function hidepreview(id){
	//console.log("unhover");
	$(".videono"+id).fadeOut(600, function(){
		$(".videono"+id).empty();
	});
}

function lxcategoria(idcat){
	var proy_cat_existente = false;
	var data = new FormData;
        data.append('operaciones',"listar_proyecto_categoria");
        data.append("id_categoria", idcat);
    var resultado_cat;
    $(".sidemenu ul li").removeClass("active");
    $(".cat"+idcat).addClass("active");
    //$(".listproyectos").fadeOut(600, function(){
    	$(".listproyectos").empty();
    	//$(".listproyectos").show();  
    //});
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
                		var titulo_proyecto = (idioma == "es")? resultado_cat[x].titulo_esp : resultado_cat[x].titulo_eng;
						var subtitulo_proyecto = (idioma == "es")? resultado_cat[x].subtitulo_esp : resultado_cat[x].subtitulo_eng;
						var video_preview = resultado_cat[x].nombre_preview;
	                	html+='<a href="#'+resultado_cat[x].url_amigable+'" style="display:block;" onclick="verproyecto('+resultado_cat[x].id_proyecto+')" onmouseenter="showpreview('+resultado_cat[x].id_proyecto+')" onmouseleave="hidepreview('+resultado_cat[x].id_proyecto+')"><div style="max-height:200px; overflow:hidden;"  class="proyectofondo" >';
						html+='<img style="width:100%; margin: 1px 0;" src="'+mypath+'imgProyectos/'+resultado_cat[x].img_principal+'" />';
						html+='<div class="vidpreview videono'+resultado_cat[x].id_proyecto+'"></div>';
						html+='</div></a>';
						//$(".listproyectos").append(html);
                	}
                	//console.log(html);
                	$(html).appendTo(".listproyectos");
                	//$(".listproyectos").fadeIn(600);         	
                }
            }
        });
}

function nextproyect(id){
	$(".proyecto").fadeOut(600);
	$(".bgall").fadeOut(600);
	$("#bgvid4").remove();
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
                console.log(data);
                if(data != ""){
                	resultado = JSON.parse(data);
                	setTimeout(function(){
                		verproyecto(resultado); 
                	}, 600);
                	          	
                }
            }
    });
}

function prevproyect(id){
	$(".proyecto").fadeOut(600);
	$(".bgall").fadeOut(600);
	$("#bgvid4").remove();
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
                	resultado = JSON.parse(data);
                	setTimeout(function(){
                		verproyecto(resultado); 
                	}, 600);
                }
            }
    });
}
