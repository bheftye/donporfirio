<?php 
	include_once("./panel/clases/plantilla_mailing.php");
	$operaciones=$_POST['operaciones'];

	switch($operaciones){

		case "guardarXML":
				if(isset($_POST["idplantilla"]) && isset($_POST["nodes"]))
				{
					$uploaddir = './xmlPlantilla/';
					$idplantilla = $_POST["idplantilla"];
					$Plantilla = new plantilla_mailing($idplantilla);
					$Plantilla -> obtenplantilla_mailing();
					if($Plantilla -> xml_file != ""){
						$fileName = $Plantilla -> xml_file;
					}
					else{
						$fileName = uniqid($idplantilla).".xml";
					}
					$xmlContent = $_POST["nodes"];

					if(file_put_contents($uploaddir.$fileName, $xmlContent) !== FALSE){
						$Plantilla = new Plantilla($idplantilla);
						$Plantilla -> xml_file = $fileName;
						$Plantilla -> modificarNombreXML();
					}
					else{
						$data = "Fallo la subida del archivo.";
					}

				}
				else
				{
					//$data = array('success' => 'Form was submitted', 'formData' => $_POST);
					$data = "No se realizo ninguna operación";
				}
		break;

		case "elimnarImagenPlantilla":
				if(isset($_POST["idplantilla"]) && isset($_POST["httpFilePath"]))
				{
					//data.append("httpFilePath",$("#"+type+dataId).attr("src"));
					$files = array();
					$idplantilla = $_POST["idplantilla"];
					$httpFilePath = $_POST["httpFilePath"];
				 	$fileName = basename($httpFilePath);
					$uploaddir = './Plantilla/secundarias/';
					//echo 'aqui toy'.$httpFilePath;
					//echo $uploaddir.$fileName;
					if(file_exists($uploaddir.$fileName))
					{
						unlink($uploaddir.$fileName);
						$data = "true";
					}
					else
					{
						$data = "Fallo la eliminación del archivo.";
					}
						
				}
				else{
					$data = "No se realizo ninguna operación";
				}
				echo $data;
		break;

		case 'obtenerPreviewPlantilla':
				if(isset($_POST["idplantilla"]))
				{	
					$idplantilla = $_POST["idplantilla"];
					$dibujador = new DibujadorPlantilla($idplantilla);
					$dibujador -> dibujarPreviewplantilla_mailing(); 
				}
				else{
					echo "No se pudo mostrar";
				}
		break; 

		case 'eliminarPlantilla':
			if(isset($_POST["idplantilla"]))
				{	
					$idplantilla = $_POST["idplantilla"];
					$Plantilla = new Plantilla($idplantilla);
					$Plantilla -> eliminarPlantilla();
					echo "true";
				}
				else{
					echo "false";
				}
			break;

		case 'obtenerPlantillasPorMasUsadas':
				
					
					$Plantilla = new plantilla_mailing();
					$group_number = filter_var($_REQUEST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
					if(!is_numeric($group_number)){
						header('HTTP/1.1 500 Invalid number!');
						exit();
					}
					$items_per_groups = $_REQUEST['items_per_group'];
					$position = ($group_number * $items_per_groups);
					$Plantilla -> obtenerPlantillasPorMasVisitas($position, $items_per_groups);
				
		break;

		case 'listarAll':
			$Plantilla = new plantilla_mailing();
			$group_number = filter_var($_REQUEST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
			if(!is_numeric($group_number)){
				header('HTTP/1.1 500 Invalid number!');
				exit();
			}
			$items_per_groups = $_REQUEST['items_per_group'];
			$idartista = $_REQUEST['idartista'];
			$position = ($group_number * $items_per_groups);
			$Plantilla -> obtenerPlantillasAll($idartista,$position,$items_per_groups);
		break;

		default:
			$data = "No se realizo ninguna operación";
			echo $data;
		break;

	}
?>