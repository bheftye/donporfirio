<?php
include_once('userend.php');
include_once('orden.php');
include_once('correo.php');


class correoEnvioProductos extends correo
{
    var $userend;
    var $datosuserend;
    var $orden;
    var $path  = "http://clientes.locker.com.mx/notmonday/";

    function correoEnvioProductos($idorden)
    {    
        $this->correo();
        $this->orden = new orden($idorden);
        $this->orden->obtener_orden();
        $this->userend = new userend($this->orden->iduserend);
        $this->userend->obten_userend();
        $this->userend->obteneDatosUserend();     
    }
    
    function genera_asunto()
    {
        $this->correo->Subject='NotMonday Orden En Proceso';
    }
    
    function genera_destino()
    {
        $this->correo->AddAddress($this->userend->correo);
    }
    
    function genera_mensaje()
    {
        

$this->correo->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Message NotMonday</title> <!-- Nombre del sitio web -->
        

        <style> 
            @media only screen and (max-width: 300px){ 
                body {
                    width:218px !important;
                    margin:auto !important;
                }
                .table {width:195px !important;margin:auto !important;}
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}      
                span.title{font-size:20px !important;line-height: 23px !important}
                span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}        
                td.box p{font-size: 12px !important;font-weight: bold !important;}
                .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr { 
                    display: block !important; 
                }
                .table-recap{width: 200px!important;}
                .table-recap tr td, .conf_body td{text-align:center !important;}    
                .address{display: block !important;margin-bottom: 10px !important;}
                .space_address{display: none !important;}   
            }
            @media only screen and (min-width: 301px) and (max-width: 500px) { 
                body {width:308px!important;margin:auto!important;}
                .table {width:285px!important;margin:auto!important;}   
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}    
                .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr { 
                    display: block !important; 
                }
                .table-recap{width: 293px !important;}
                .table-recap tr td, .conf_body td{text-align:center !important;}
                
            }
            @media only screen and (min-width: 501px) and (max-width: 768px) {
                body {width:478px!important;margin:auto!important;}
                .table {width:450px!important;margin:auto!important;}   
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}            
            }
            @media only screen and (max-device-width: 480px) { 
                body {width:308px!important;margin:auto!important;}
                .table {width:285px;margin:auto!important;} 
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
                
                .table-recap{width: 285px!important;}
                .table-recap tr td, .conf_body td{text-align:center!important;} 
                .address{display: block !important;margin-bottom: 10px !important;}
                .space_address{display: none !important;}   
            }
        </style>
    </head>
    <body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
        <table class="table table-mail" style="width:100%;margin-top:10px;">
            <tr>
                <td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
                <td align="center" style="padding:7px 0">
                    <table class="table" bgcolor="#ffffff" style="width:100%">
                        <tr>
                            <td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
                                <!-- Nombre del sitio web, url de la página, ruta del logo de la página y otra ves el nombre.-->
                                <a title="NotMonday" href="'.$this->path.'" style="color:#337ff1">
                                    <img src="'.$this->path.'img/logo.png" alt="NotMonday" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="titleblock" style="padding:7px 0">
                                <font size="2" face="Open-sans, sans-serif" color="#555454">                                    
                                    <span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">Pedido Enviado</span>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
                                <table class="table" style="width:100%">
                                    <tr>
                                        <td width="10" style="padding:7px 0">&nbsp;</td>
                                        <td style="padding:7px 0">
                                            <font size="2" face="Open-sans, sans-serif" color="#555454">
                                                <p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:15px;padding-bottom:10px">
                                                    Detalles del mensaje:</p>
                                                <span style="color:#777">
                                                    Hola '.$this->userend->datosuserend->nombre.' '.$this->userend->datosuserend->apellido.' </br>
                                                    <span style="color:#333"><strong>Le agradecemos por realizar sus compras en NOTMONDAY.</strong></span><br />
                                                </span>
                                                <p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
                                                    PEDIDO-ENVIADO:</p>
                                                <span style="color:#777">
                                                    <span style="color:#333">El pedido con el folio '.$this->orden->idorden.' ha sido enviado.</span><br />
                                                    <span style="color:#333"><strong>Fecha De Compra: </strong>'.$this->orden->fecha.'</span><br />
                                                    <span style="color:#333"><strong>Cantidad De Productos: </strong>'.$this->orden->num_productos.'</span><br />
                                                    <span style="color:#333"><strong>Precio del transporte: </strong>'.$this->orden->precioTransporte.'</span><br />
                                                    <span style="color:#333"><strong>Total Compra: </strong>'.$this->orden->total_productos.'</span><br />
                                                    <span style="color:#333"><strong>Estado de la orden: </strong>Enviado</span><br />
                                                </span>
                                                <p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:12px;padding-bottom:10px">
                                                    ¡gracias por su compra!.</p>    
                                            </font>
                                        </td>
                                        <td width="10" style="padding:7px 0">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="footer" style="border-top:4px solid #333333;padding:7px 0">
                                        <!-- url y nombre de la página web -->
                                <span><a href="'.$this->path.'" style="color:#337ff1">NotMonday</a></span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
            </tr>
        </table>
    </body>
</html>';
        
    }
}
?>