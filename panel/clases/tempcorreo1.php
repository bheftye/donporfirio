<?php
include_once('correo1.php');
include_once('correo1img.php');
include_once('correo1img2.php');
include_once('correo.php');


class tempcorreo1 extends correo
{
	var $correo1;
    var $correoPrueba;
    var $destinatario;
    var $correo;
    var $urlDesuscribir;
	
	function tempcorreo1($idcorreo1,$destinatario, $urlDesuscribir = "",$correoPrueba="")
    {
		$this->correo();    
     	$this->correo1=new correo1($idcorreo1);
		$this->correo1->obtenerCorreo1();
		$this->correo1->listarCorreo1img();
		$this->correo1->listarCorreo1img2();
        $this -> correoPrueba = $correoPrueba;
        $this -> destinatario = $destinatario;
        $this -> urlDesuscribir = $urlDesuscribir;
        $this->correo->From = $this -> correo1 -> from;
        $this->correo->FromName = $this -> correo1 -> fromname;
        $this -> correo ->  ConfirmReadingTo = 'email_tracker@locker.com.mx';
        $this->correo->addCustomHeader("Return-Receipt-To: email_tracker@locker.com.mx");
        $this->correo->addCustomHeader("X-Confirm-Reading-To: email_tracker@locker.com.mx");
        $this->correo->addCustomHeader("Disposition-notification-to: email_tracker@locker.com.mx");
    }
    
    function genera_asunto()
    {
        $this->correo->Subject=$this->correo1->titulo;//este es de datos_usuario y nomusuario es de usuario
    }
    
    function genera_destino()
    {
		if($this -> destinatario != ""){
            $this -> correo -> AddAddress($this -> destinatario);
        }
        if($this -> correoPrueba != ""){
            $this -> correo -> AddAddress($this -> correoPrueba);
            $this -> token = "no-aplicable";
        }

    }
    
    function genera_mensaje()
    {
        //$usuario= $this->usuariocliente;
       	$this->correo->Body = '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Responsive Email Template</title>
                                                                                                                                                                                                                                                                                                                                                                                                        
<style type="text/css">
	.ReadMsgBody {width: 100%; background-color: #f1efe6;}
	.ExternalClass {width: 100%; background-color: #f1efe6;}
	body	 {width: 100%; background-color: #f1efe6; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Georgia, Times, serif}
	table {border-collapse: collapse;}
	
	@media only screen and (max-width: 640px)  {
					body[yahoo] .deviceWidth {width:440px!important; padding:0;}	
					body[yahoo] .center {text-align: center!important;}	 
			}
			
	@media only screen and (max-width: 479px) {
					body[yahoo] .deviceWidth {width:280px!important; padding:0;}	
					body[yahoo] .center {text-align: center!important;}	 
			}
    a{
        text-decoration:none;
    }

</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Georgia, Times, serif;">

<!-- Wrapper -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td width="100%" valign="top" bgcolor="#f1efe6" style="padding-top:20px">
		
			<!-- Start Header-->
			<table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
				<tr>
					<td width="100%" bgcolor="#f1efe6">

                            <!-- Logo -->
                            <table border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                <tr>
                                    <td style="padding:10px 20px" class="center">
                                        <a title="" href="'.$this -> correo1 -> linklogo.'" style="color:#337ff1">
                                            <img src="http://clientes.locker.com.mx/panelTemplate/panel/correos/correo1/'.$this->correo1->logo.'" width="230" height="auto" alt="logo" />
                                        </a>
                                    </td>
                                </tr>
                            </table><!-- End Logo -->
                            
                            <!-- Nav -->
                            <table border="0" cellpadding="0" cellspacing="0" align="right" class="deviceWidth">
                                <tr>
                                    <td class="center" style="font-size: 24px; color: #272727; font-weight: light; text-align: right; font-family: Georgia, Times, serif; line-height: 20px; vertical-align: middle; padding:10px 20px; font-style:italic">
                                        <p>'.$this->correo1->titulo.'</p>
                                    </td>
                                </tr>
                            </table><!-- End Nav -->

					</td>
				</tr>
			</table><!-- End Header -->
			<table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1efe6">
				<tr>
					<td>
						<table style="border-bottom: 3px solid #'.$this -> correo1 -> color.'">
                        	<tr>
                        		<td width="580"></td>
                            </tr>
                        </table>
					</td>
				</tr>
				<tr>
					<td style="font-size: 13px; color: #000; font-weight: normal; text-align: left; font-family: Georgia, Times, serif; line-height: 24px; vertical-align: top; padding:10px 8px 10px 8px">
						'.$this -> correo1 -> nomemp.'
					</td>
				</tr>
			</table>
			<!-- One Column -->
			<table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1efe6">
				<tr>
					<td valign="top" style="padding:0" bgcolor="#f1efe6">
                    ';
                    if($this -> correo1 -> ruta != ""){
                        $this -> correo -> Body.=  '<a href="#"><img  class="deviceWidth" src="http://clientes.locker.com.mx/panelTemplate/panel/correos/correo1/'.$this->correo1->ruta.'" width="580" height="auto" alt="" border="0" style="display: block; border-radius: 4px;" /></a> ';                    

                    }
                    
					 $this -> correo -> Body.= '</td>
				</tr>
                <tr>
                    <td style="font-size: 13px; color: #000; font-weight: normal; text-align: left; font-family: Georgia, Times, serif; line-height: 24px; vertical-align: top; padding:10px 8px 10px 8px" bgcolor="#f1efe6">
                        
                        <table>
                            <tr>                    
                                <td valign="middle" style="padding:0 10px 10px 0"><a href="#" style="text-decoration: none; color: #272727; font-size: 16px; color: #272727; font-weight: bold; font-family:Arial, sans-serif ">
                                	'.$this->correo1->subtitulo.'
                                </td>
                            </tr>
                        </table>

						'.htmlspecialchars_decode($this->correo1->desc1).'							
                    </td>
                </tr>              
			</table><!-- End One Column -->
			<table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1efe6">
				<tr>
					<td>
						<table style="border-bottom: 3px solid #'.$this -> correo1 -> color.'">
                        	<tr>
                        		<td width="580"></td>
                            </tr>
                        </table>
					</td>
				</tr>				
			</table>
			<!-- Two Column (Images Stacked over Text) -->
			<table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#f1efe6">
				<tr>
					<td class="center" style="padding:10px 0 0 5px">

                        <table width="49%" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                            <tr>
                                <td style="font-size: 12px; color: #000; font-weight: normal; text-align: left; font-family: Georgia, Times, serif; line-height: 24px; vertical-align: top; padding:10px 8px 10px 8px">';
                                    if(htmlspecialchars_decode($this -> correo1 -> desc2 != "")){
                                        $this->correo->Body.='<p>'.htmlspecialchars_decode($this->correo1->desc2).'</p>';
                                    }
                                $this->correo->Body.='</td>
                            </tr>                         
                        </table>
                                                
                        <table width="49%" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">                         
                            <tr>
                                <td style="font-size: 12px; color: #000; font-weight: normal; text-align: left; font-family: Georgia, Times, serif; line-height: 24px; vertical-align: top; padding:10px 8px 10px 8px">';
                                 if(htmlspecialchars_decode($this -> correo1 -> desc3 != "")){               
                                     $this->correo->Body.='<p>'.htmlspecialchars_decode($this->correo1->desc3).'</p>';
                                 }
                                 $this->correo->Body.='</td>
                            </tr>                         
                        </table>                                        

					</td>
				</tr>
			</table><!-- End Two Column (Images Stacked over Text) -->
			<!-- Two Column (Images Stacked over Text) -->
			<table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#f1efe6">
				<tr>
					<td class="center" style="padding:10px 0 0 5px">';
						foreach ($this->correo1->correo1img as $elemento1) {
                            if($elemento1['ruta'] != ""){
							$this->correo->Body.='<table width="49%" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                            <tr>
                                <td align="center">                               
                                    <p style="mso-table-lspace:0;mso-table-rspace:0; margin:0"><img width="267" src="http://clientes.locker.com.mx/panelTemplate/panel/correos/correo1/correo1img/'.$elemento1['ruta'].'" alt="" border="0" style="border-radius: 4px; width: 267px"; height:150px; class="deviceWidth" /></p>
                                </td>
                            </tr>                       
                        </table>';
                            }
						}
                        $this->correo->Body.='</td>
				</tr>
			</table><!-- End Two Column (Images Stacked over Text) -->';
if($this->correo1->correo2img[0]['ruta'] != ""){
$this->correo->Body.='<div style="height:15px">&nbsp;</div><!-- spacer -->
			<table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1efe6">
				<tr>
					<td>
                   
						<table style="border-bottom: 3px solid #'.$this -> correo1 -> color.'">
                        	<tr>
                        		<td width="580"></td>
                            </tr>
                        </table>
					</td>
				</tr>				
			</table>
			<div style="height:15px">&nbsp;</div><!-- spacer -->
			<table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#f1efe6">
				<tr>
					<td valign="top" style="padding:0" bgcolor="#fff">
						<a href="#"><img  class="deviceWidth" src="http://clientes.locker.com.mx/panelTemplate/panel/correos/correo1/correo2img/'.$this->correo1->correo2img[0]['ruta'].'" width="580" height="200" alt="" border="0" style="display: block; border-radius: 4px;" /></a>						
                    </td>
				</tr>          
			</table><!-- End One Column -->';
}
           
$this->correo->Body.='
			 
            <!-- 2 Column Images - text left -->
			<table width="580" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#f1efe6">
				<tr>
					<td style="padding:10px 0">  
                           <font size="2" face="Open-sans, sans-serif" color="#343433" align="center">
                                <span class="title" style="font-size:14px;">
                                    PARA MAYOR INFORMACIÓN
                                </span>
                            </font>                                               
                    </td>
                </tr>
            </table><!-- End 2 Column Images  - text left -->
            <!-- 2 Column Images - text left -->
			
        <table width="580"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
                <td width="580">
                    <ul class="navlistred" style="padding: 0">';

                    if($this -> correo1 -> facebook != ""){
                      $this -> correo -> Body.='<li style="display:inline;list-style-type: none;padding: 0 0 0 0;text-decoration:none;margin-left:0px;"><a href="'.$this -> correo1 -> facebook.'" target="_blank"><img width="auto" height="18" src="http://locker.com.mx/panel/img/facebook.png"></a></li>';
                    }
                    if($this -> correo1 -> twitter != ""){
                        $this -> correo -> Body.='<li style="display:inline;list-style-type: none;padding: 0 0 0 0;text-decoration:none;margin-left:10px;"><a href="'.$this -> correo1 -> twitter.'" target="_blank"><img width="auto" height="18" src="http://locker.com.mx/panel/img/twitter.png"></a></li>';
                    }
                    if($this -> correo1 -> instagram != ""){
                        $this -> correo -> Body.='<li style="display:inline;list-style-type: none;padding: 0 0 0 0;text-decoration:none;margin-left:10px;"><a href="'.$this -> correo1 -> instagram.'" target="_blank"><img width="auto" height="18" src="http://locker.com.mx/panel/img/instagram.png"></a></li>';
                    }
                    if($this -> correo1 -> youtube != ""){
                        $this -> correo -> Body.='<li style="display:inline;list-style-type: none;padding: 0 0 0 0;text-decoration:none;margin-left:10px;"><a href="'.$this -> correo1 -> youtube.'" target="_blank"><img width="auto" height="18" src="http://locker.com.mx/panel/img/youtube.png"></a></li>';
                    }

                    $this -> correo -> Body.='    
                    </ul>
                </td> 
            </tr>
            <tr>
                <td>Si deseas dejar de recibir actualizaciones por correo electrónico, date de baja de nuestro boletín dándole click <a href="'.$this -> urlDesuscribir.'">aquí</a>.<br><br> </td>
            </tr>
        </table>        
		</td>
	</tr>
</table> <!-- End Wrapper -->

</body>
</html>';                                       
    }
}
?>