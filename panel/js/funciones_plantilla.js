

	var files2 = new Array();
	var txtsObjects = new Array();
	var images = IMAGES;
	var txts = TXTS;
	var lastBody = "";
	var imagenesTemplate = new Array("template1.jpg", "template2.jpg", "template3.jpg", "template4.jpg", "template5.jpg");
	var textosTemplate = new Array();
	var txt1 = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.";
	var txt2 = "Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.";
	var txt3 = "Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.";
	textosTemplate.push(txt1);
	textosTemplate.push(txt2);
	textosTemplate.push(txt3);

	$('#files3').on('change',function(event){
				files2 = event.target.files;
				event.target.files = "";
				addImage();
	});

	function addImage(){
			var data = new FormData();
			if(files2.length > 0){
				data.append('files', files2[0]);

				data.append("operaciones", "guardarImagenPortafolio");
				data.append("idportafolio", ID_PORTAFOLIO);
				$('#ModalCarga').modal('show');
				$.ajax({
					url: 'operaciones_portafolio.php',
					type: 'POST',
					data: data,
					cache: false,
					processData: false, // Don't process the files
					contentType: false, // Set content type to false as jQuery will tell the server its a query string request
					success: function(data, textStatus, jqXHR)
					{
						$('#ModalCarga').modal('hide');
					if(typeof data.error === 'undefined')
					{
						if(data != "Fallo la subida del archivo." && data != "No se realizo ninguna operación."){
							images++;
							console.log(data);
							$("#myTable tbody").append(''+
								'<tr class="img" id="img'+data+'" data-imgid="'+data+'" data-id="'+images+'">'+
								'<td>'+
								'<div style="width:100%;height:auto;overflow:auto;">'+
                                            '<div class="image-wrapper">'+
                                                '<span class="image-options">'+
                                                    '<ul class="ulmenuoptions">'+
                                                        '<li  class="pull-left">'+
                                                            '<span class="inputUploadFont fontOptionsImg"><i class="fa fa-2x fa-bars"></i></span>'+
                                                        '</li>'+
                                                        '<li class="pull-right" style="margin-rigth:20px;" onclick="deleteElement(\'img\', \''+data+'\')"  class="limenuoptions manita">'+
                                                            '<span class="inputUploadFont fontOptionsImg"><i style="margin-right:20px;" class="fa fa-2x fa-times manita"></i></span>'+
                                                        '</li>'+
                                                    '</ul>'+
                                                '</span>'+
                                                '<img width="100%" class="img" data-id="'+images+'" height="auto" id="img'+images+'" src="http://plataformacerouno.com/portafolio/secundarias/'+data+'" title="Imagen">'+
                                            '</div>'+                                       
                                        '</div>'+
								'</td>'+
								'</tr>');
								$('tr.img').not(':visible').remove();
								window.location.hash = '#img'+data;
						}
						else{
							alert(data);
						}
					}
					else
					{
					// Handle errors here
						console.log('ERRORS: ' + data.error);
					}
					},
						error: function(jqXHR, textStatus, errorThrown)
					{
					// Handle errors here
						console.log('ERRORS: ' + textStatus);
					// STOP LOADING SPINNER
					}
				});
			}
		files2 = new Array();
	}

	function addImageToTemplate(){
		$("#myTable tbody").append(''+
			'<tr class="img" id="img'+images+'" data-imgid="'+images+'" data-id="'+images+'">'+
			'<td>'+
			'<div style="width:100%;height:auto;overflow:auto;">'+
                        '<div class="image-wrapper">'+
                            '<span class="image-options">'+
                                '<ul class="ulmenuoptions">'+
                                    '<li  class="pull-left">'+
                                        '<span class="inputUploadFont fontOptionsImg"><i class="fa fa-2x fa-bars"></i></span>'+
                                    '</li>'+
                                    '<li class="pull-right" style="margin-rigth:20px;" onclick="deleteElementTemplate(\'img\', \''+images+'\')"  class="limenuoptions manita">'+
                                        '<span class="inputUploadFont fontOptionsImg"><i style="margin-right:20px;" class="fa fa-2x fa-times manita"></i></span>'+
                                    '</li>'+
                                '</ul>'+
                            '</span>'+
                            '<img width="100%" class="img" data-id="'+images+'" height="auto" id="img'+images+'" src="img/'+imagenesTemplate[Math.floor(Math.random()*imagenesTemplate.length)]+'" title="Imagen">'+
                        '</div>'+                                       
                    '</div>'+
			'</td>'+
			'</tr>');
			$('tr.img').not(':visible').remove();
			window.location.hash = '#img'+images;
			images++;
	}

	
	function deleteElementTemplate(type, dataId){
		if(confirm("¿Seguro que deseas eliminar este elemento?")){
			if(type == "img"){
				$("tr."+type+"[data-id='"+dataId+"']").remove();
			}
			else{
				$("tr."+type+"[data-id='"+dataId+"']").remove();
			}
		}
		
		return;
	}

	function deleteElement(type, dataId){
		if(confirm("¿Seguro que deseas eliminar este elemento?")){
			
			if(type == "img"){
				var eliminacionExitosa = false;
				var data = new FormData();
				data.append("operaciones", "elimnarImagenPortafolio");
				data.append("idportafolio", ID_PORTAFOLIO);
				data.append("httpFilePath", dataId)
				//data.append("httpFilePath",$.trim($("#"+type+dataId).attr("src")));
				//console.log('hola'+dataId);

					$.ajax({
						url: 'operaciones_portafolio.php',
						type: 'POST',
						data: data,
						cache: false,
						processData: false, // Don't process the files
						contentType: false, // Set content type to false as jQuery will tell the server its a query string request
						success: function(data, textStatus, jqXHR)
						{
						if(typeof data.error === 'undefined')
						{
							console.log(data);
							if(data == "true"){
								console.log(data);
								eliminacionExitosa = true;
								console.log('aqui dentro'+dataId);
								$("tr."+type+"[data-imgid='"+dataId+"']").remove();
       							
							}
						}
						else
						{
						// Handle errors here
							console.log('ERRORS: ' + data.error);
						}
						},
							error: function(jqXHR, textStatus, errorThrown)
						{
						// Handle errors here
							console.log('ERRORS: ' + textStatus);
						// STOP LOADING SPINNER
						}
					});
				$("tr."+type+"[data-id='"+dataId+"']").remove();
			}
			else{
				console.log('entre')
				console.log(type)
				console.log(dataId)
				$("tr."+type+"[data-id='"+dataId+"']").remove();
			}
		}
		
		return;
	}

	function addTextAreaTemplate(){
		txts++;
		var textarea = "<tr class=\"txt\" data-id=\""+txts+"\"><td>"+
							"<div class=\"col-xs-12 txt-container\">"+
								"<span style=\"width:25px;\"   class=\"pull-left\"><i style=\"float:left;\" class=\"fa fa-2x fa-bars\"></i></span>"+
								"<span style=\"width:25px;\" onclick=\"deleteElementTemplate('txt', '"+txts+"')\"  class=\"pull-right limenuoptions manita\"><i style=\"float:rigth;\" class=\"fa fa-2x fa-times\"></i></span>"+
							"</div>"+
							"<div id=\"txt"+txts+"\" data-id=\""+txts+"\" ><p>"+textosTemplate[Math.floor(Math.random()*textosTemplate.length)]+"</p></div>"+
						"</td></tr>";
		$("#myTable tbody").append(textarea);
	}

	function addTextArea(){
		txts++;
		var textarea = "<tr class=\"txt\" data-id=\""+txts+"\"><td>"+
							"<div class=\"col-xs-12 txt-container\">"+
								"<span style=\"width:25px;\"   class=\"pull-left\"><i style=\"float:left;\" class=\"fa fa-2x fa-bars\"></i></span>"+
								"<span style=\"width:25px;\" onclick=\"deleteElement('txt', '"+txts+"')\"  class=\"pull-right limenuoptions manita\"><i style=\"float:rigth;\" class=\"fa fa-2x fa-times\"></i></span>"+
							"</div>"+
							"<div id=\"txt"+txts+"\" data-id=\""+txts+"\" ></div>"+
						"</td></tr>";
		$("#myTable tbody").append(textarea);
		setTimeout(createTxtArea("txt"+txts),2000);
		
	}

	function createTxtArea(id){
		$('tr.txt').not(':visible').remove();
	  	$("#"+id).summernote({height: 150,
			focus: true,
			toolbar: [
    						//[groupname, [button list]]
    						['style', ['bold', 'italic', 'underline', 'clear']],
							['Misc', ['fullscreen']],
 		 				],
				onpaste: function(e) {
					//alert('entre');
					var thisNote = $(this);
					//alert(thisNote);
					var updatePastedText = function(someNote){
						var original = someNote.code();
						//alert(original);
						var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
						someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
					};
					setTimeout(function () {
						//this kinda sucks, but if you don't do a setTimeout, 
						//the function is called before the text is really pasted.
						updatePastedText(thisNote);
					}, 10);
		
		
				}
		});
	}
	
	 /*function CleanPastedHTML(input) {
			  // 1. remove line breaks / Mso classes
			  var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
			  var output = input.replace(stringStripper, ' ');
			  // 2. strip Word generated HTML comments
			  var commentSripper = new RegExp('<!--(.*?)-->','g');
			  var output = output.replace(commentSripper, '');
			  var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>','gi');
			  // 3. remove tags leave content if any
			  output = output.replace(tagStripper, '');
			  // 4. Remove everything in between and including tags '<style(.)style(.)>'
			  var badTags = ['style', 'script','applet','embed','noframes','noscript'];
			
			  for (var i=0; i< badTags.length; i++) {
				tagStripper = new RegExp('<'+badTags[i]+'.*?'+badTags[i]+'(.*?)>', 'gi');
				output = output.replace(tagStripper, '');
			  }
			  // 5. remove attributes ' style="..."'
			  var badAttributes = ['style', 'start'];
			  for (var i=0; i< badAttributes.length; i++) {
				var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"','gi');
				output = output.replace(attributeStripper, '');
			  }
			  return output;
		}*/
	
	function saveProgress(){
		updateProjectInfo();
		generateXML();
		
	}

	function publish(){
		saveProgress();
		var data = new FormData();
			data.append("operaciones", "publicarPortafolio");
			data.append("idportafolio", ID_PORTAFOLIO);

			$.ajax({
				url: 'operaciones_portafolio.php',
				type: 'POST',
				data: data,
				cache: false,
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data, textStatus, jqXHR)
				{
				if(typeof data.error === 'undefined')
				{
					if(data != "Fallo la publicación del proyecto" && data != "No se realizo ninguna operación."){
						//alert("Proyecto publicado con éxito.");
						window.location.href= linkPerfil;
						console.log(data);
					}
					else{
						alert(data);
					}
				}
				else
				{
				// Handle errors here
					console.log('ERRORS: ' + data.error);
				}
				},
					error: function(jqXHR, textStatus, errorThrown)
				{
				// Handle errors here
					console.log('ERRORS: ' + textStatus);
				// STOP LOADING SPINNER
				}
			});
	}

	function updateProjectInfo(){
			var data = new FormData();
			data.append("operaciones", "guardarInformacionAdicional");
			data.append("idportafolio", ID_PORTAFOLIO);
			data.append("tags", $.trim($("#tags").val()));
			data.append("colabs", $.trim($("#colabs").val()));
			data.append("copyright", $.trim($("#copyright").val()));

			$.ajax({
				url: 'operaciones_portafolio.php',
				type: 'POST',
				data: data,
				cache: false,
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data, textStatus, jqXHR)
				{
				if(typeof data.error === 'undefined')
				{
					if(data != "Fallo la actualización de los tags" && data != "No se realizo ninguna operación."){
						//alert("Información Adicional Guardada");
						//console.log(data);
					}
					else{
						alert(data);
					}
				}
				else
				{
				// Handle errors here
					console.log('ERRORS: ' + data.error);
				}
				},
					error: function(jqXHR, textStatus, errorThrown)
				{
				// Handle errors here
					console.log('ERRORS: ' + textStatus);
				// STOP LOADING SPINNER
				}
			});
		
	}

	function encodeHTML(string){
		return string.replace(/&/g, '&amp;')
               .replace(/</g, '&lt;')
               .replace(/>/g, '&gt;')
               .replace(/"/g, '&quot;')
               .replace(/'/g, '&apos;');
	}

	function decodeHTML(string){
		 return string.replace(/&apos;/g, "'")
               .replace(/&quot;/g, '"')
               .replace(/&gt;/g, '>')
               .replace(/&lt;/g, '<')
               .replace(/&amp;/g, '&');
	}

	function generateXML(){
		var xmlNodes = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>\n";
			xmlNodes += "<title>\n"+$("#project-title").html()+"\n</title>\n";
			xmlNodes += "<subtitle>\n"+$("#project-subtitle").html()+"\n</subtitle>\n";
		var nodes =	$("#myTable tbody tr");
		for (var i = 0; i < nodes.length; i++) {
			var node = nodes[i];
			if($(node).hasClass("txt")){
				var dataId = $(node).attr("data-id");
				var content = $("#txt"+dataId).code();
				xmlNodes+="<text"+i+">\n"+encodeHTML(content)+"\n</text"+i+">\n";
			}
			else{
				if($(node).hasClass("img")){
					var dataId = $(node).attr("data-id");
					var content = $("#img"+dataId).attr("src");
					xmlNodes+="<img"+i+">\n"+encodeHTML(content)+"\n</img"+i+">\n";
				}
				else{
					if($(node).hasClass("video")){
						var dataId = $(node).attr("data-id");
						var type = $(node).attr("data-type")+"";
						var content = "";
						if(type == "txt"){
							content += $("#video"+dataId).val();
						}
						else{
							content += $("#video"+dataId).html();
						}
						
						content = content.trim();
						xmlNodes+="<video"+i+">\n"+encodeHTML(content)+"\n</video"+i+">\n";
					}
				}
			}
		};
		xmlNodes += "</document>";
		//console.log(xmlNodes);

		var data = new FormData();
		data.append("nodes", xmlNodes);
		data.append("operaciones", "guardarXML");
		data.append("idportafolio", ID_PORTAFOLIO);
		$.ajax({
					url: 'operaciones_portafolio.php',
					type: 'POST',
					data: data,
					cache: false,
					processData: false, // Don't process the files
					contentType: false, // Set content type to false as jQuery will tell the server its a query string request
					success: function(data, textStatus, jqXHR)
					{
					if(typeof data.error === 'undefined')
					{
						//console.log(data);
						if(data != "Fallo la subida del archivo." && data != "No se realizo ninguna operación."){
							$('#ModalGuardado').modal('show');
							setTimeout(function() {
								$('#ModalGuardado').modal('hide');
							}, 2000);
						}
						else{
							alert(data);
						}
					}
					else
					{
					// Handle errors here
						console.log('ERRORS: ' + data.error);
					}
					},
						error: function(jqXHR, textStatus, errorThrown)
					{
					// Handle errors here
						console.log('ERRORS: ' + textStatus);
					// STOP LOADING SPINNER
					}
				});
		
	}

	function generateXMLPreview(){
		var xmlNodes = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>\n";
			xmlNodes += "<title>\n"+$("#project-title").html()+"\n</title>\n";
			xmlNodes += "<subtitle>\n"+$("#project-subtitle").html()+"\n</subtitle>\n";
		var nodes =	$("#myTable tbody tr");
		for (var i = 0; i < nodes.length; i++) {
			var node = nodes[i];
			if($(node).hasClass("txt")){
				var dataId = $(node).attr("data-id");
				var content = $("#txt"+dataId).code();
				xmlNodes+="<text"+i+">\n"+encodeHTML(content)+"\n</text"+i+">\n";
			}
			else{
				if($(node).hasClass("img")){
					var dataId = $(node).attr("data-id");
					var content = $("#img"+dataId).attr("src");
					xmlNodes+="<img"+i+">\n"+encodeHTML(content)+"\n</img"+i+">\n";
				}
				else{
					if($(node).hasClass("video")){
						var dataId = $(node).attr("data-id");
						var type = $(node).attr("data-type")+"";
						var content = "";
						if(type == "txt"){
							content += $("#video"+dataId).val();
						}
						else{
							content += $("#video"+dataId).html();
						}
						
						content = content.trim();
						xmlNodes+="<video"+i+">\n"+encodeHTML(content)+"\n</video"+i+">\n";
					}
				}
			}
		};
		xmlNodes += "</document>";
		//console.log(xmlNodes);

		var data = new FormData();
		data.append("nodes", xmlNodes);
		data.append("operaciones", "guardarXML");
		data.append("idportafolio", ID_PORTAFOLIO);
		$.ajax({
					url: 'operaciones_portafolio.php',
					type: 'POST',
					data: data,
					cache: false,
					processData: false, // Don't process the files
					contentType: false, // Set content type to false as jQuery will tell the server its a query string request
					success: function(data, textStatus, jqXHR)
					{
					if(typeof data.error === 'undefined')
					{
						//console.log(data);
						if(data != "Fallo la subida del archivo." && data != "No se realizo ninguna operación."){
							$('#ModalGuardado').modal('show');
							setTimeout(function() {
								$('#ModalGuardado').modal('hide');
							}, 2000);
							showPreview();
						}
						else{
							alert(data);
						}
					}
					else
					{
					// Handle errors here
						console.log('ERRORS: ' + data.error);
					}
					},
						error: function(jqXHR, textStatus, errorThrown)
					{
					// Handle errors here
						console.log('ERRORS: ' + textStatus);
					// STOP LOADING SPINNER
					}
				});
		
	}

	function showPreview(){
		var data = new FormData();
		data.append("operaciones", "obtenerPreviewPortafolio");
		data.append("idportafolio", ID_PORTAFOLIO);
		$('#ModalVista').modal('show');
		$.ajax({
			url: 'operaciones_portafolio.php',
			type: 'POST',
			data: data,
			cache: false,
			processData: false, // Don't process the files
			contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			success: function(data, textStatus, jqXHR)
			{
			$('#ModalVista').modal('hide');
			if(typeof data.error === 'undefined')
			{
				if(data != "No se puede mostrar" && data != "No se realizo ninguna operación."){
					$("#main_content").hide();
					$("#preview_content").html(data);
					$("#preview_content").show();
					console.log(data);
				}
				else{
					alert(data);
				}
			}
			else
			{
			// Handle errors here
				console.log('ERRORS: ' + data.error);
			}
			},
				error: function(jqXHR, textStatus, errorThrown)
			{
			// Handle errors here
				console.log('ERRORS: ' + textStatus);
			// STOP LOADING SPINNER
			}
		});
	}

	function returnToEdit(){
		$("#preview_content").hide();
		$("#main_content").show();
	}

