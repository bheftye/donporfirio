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
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once("includes/path.php"); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Locker Agencia Creativa" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="keywords" content="Locker, Diseño Web, Programacion Web, Redes Sociales, Publicidad, Imagen, Responsive, Webs, PHP, HTML5, CSS3, " /> <!-- IMPORTANTE -->
        <meta name="author" content="Locker AD" /><!-- Aqui siempre va Locker AD -->
        <meta property="og:title" content="Locker - Don Porfirio" /> <!-- En el caso de un portafolio, se pone el titulo del Portafolio, -->
        <meta property="og:url" content="http://clientes.locker.com.mx/donporfirio" /> <!-- Este es Link que Facebook Tomara, por eso le pasamos el ID, si es un index o nosotros, solo va la pagina EJ: locker.com.mx -->
        <meta property="og:type" content="website" />
        <meta property="og:description" content="Descripcion" /><!-- Descripción de Algún portafolio o proyecto, si es Index o Nosotros, poner Breve Descripción. -->
        <meta property="og:image" content="http://clientes.locker.com.mx/donporfirio/img/logo.png" /><!-- Path de la Imagen Principal del Proyecto -->
        <meta property="og:locale" content="en_US" />
        <meta property="og:site_name" content="Locker Agencia Creativa" /> <!-- Nombre de la Empresa -->

        <link rel='shortcut icon' href='favicon.ico'> 
        <link href="<?=mypath?>css/bootstrap.css" rel="stylesheet">
        <link href="<?=mypath?>css/style.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <title>Don Porfirio</title>
</head>
<body>
<div id="wraperfondo"></div>
<div id="wraper">