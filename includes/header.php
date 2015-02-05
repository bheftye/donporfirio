<?php
function __autoload($nombre_clase) {
        $nombre_clase = strtolower($nombre_clase);
        include_once 'panel/clases/'.$nombre_clase .'.php';
}


        session_start();
        if(!isset($_SESSION["lang"])){
            $_SESSION["lang"] = "eng";
        }
        $idioma = $_SESSION["lang"];

include_once('lang/'.$idioma.'.php');
include_once('panel/clases/metas.php');
$metas = new metas(1);
$metas -> obtener_metas();
$metas -> listar_img_secundarias_metas();
$imagenes_secundarias = $metas -> lista_imagenes_secundarias;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once("includes/path.php"); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="keywords" content="Locker, Diseño Web, Programacion Web, Redes Sociales, Publicidad, Imagen, Responsive, Webs, PHP, HTML5, CSS3, " /> <!-- IMPORTANTE -->
        <meta name="author" content="Don Porfirio" /><!-- Aqui siempre va Locker AD -->
        <meta property="og:title" content="<?=$metas -> meta_titulo?>" /> <!-- En el caso de un portafolio, se pone el titulo del Portafolio, -->
        <meta property="og:url" content="<?=mypath?>" /> <!-- Este es Link que Facebook Tomara, por eso le pasamos el ID, si es un index o nosotros, solo va la pagina EJ: locker.com.mx -->
        <meta property="og:type" content="website" />
        <meta property="og:description" content="<?=$metas -> meta_descripcion;?>">
        <?php foreach ($imagenes_secundarias as $imagen) {
           echo '<meta property="og:image" content="'.mypath.'imgMetas/secundarias/'.$imagen["ruta"].'"/>';
        }?>
        <meta property="og:locale" content="en_US" />
        <meta property="og:site_name" content="<?=$metas -> meta_empresa?>" /> <!-- Nombre de la Empresa -->

        <link rel='shortcut icon' href='favicon.ico'> 
        <link href="<?=mypath?>css/bootstrap.css" rel="stylesheet">
        <link href="<?=mypath?>royalslider/royalslider.css" rel="stylesheet">
		<link href="<?=mypath?>royalslider/skins/default/rs-default.css" rel="stylesheet">
        <link href="<?=mypath?>css/style.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=mypath?>css/jquery.mCustomScrollbar.css" />
         <link rel="stylesheet" type="text/css" href="<?=mypath?>css/outdatedBrowser.min.css" />
		 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!--[if lt IE 9]>
		      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		    <![endif]-->

        <title>Don Porfirio</title>
</head>
<body>
<div id="outdated">
      <h6>Tu Navegador esta des-actualizado, para que el sitio</h6>
     <h6>funcione correctamente porfavor:</h6>
     <p> <a id="btnUpdateBrowser" href="http://locker.com.mx/actualiza/">Actualiza tu navegador</a></p>
     <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
</div>
<style>
	.mCustomScrollBox {
		direction: ltr !important;
	}
	.mCSB_container{
		margin-left:15px;
		padding-top:15px;
	}
	.mCustomScrollBox>.mCSB_scrollTools{
		opacity:1;
	}
	.mCSB_scrollTools .mCSB_draggerRail{
		background: rgba(255,255,255,1);
	}
	.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{
		background: rgba(249,14,50,1);
	}
</style>
<div id="wraperfondo"></div>
<div id="wraper">
<div id="popupDiv" class="loader">
	<div class="imgloading" ><img src="<?=mypath?>img/logow.png" /></div>
	<div class="imgloading2" ><img src="<?=mypath?>img/logowr.png" /></div>
</div>
<div id="popupDiv" class="loader2"></div>
<div id="popupDiv" class="loader3"></div>
<div id="popupDiv" class="loader4"></div>