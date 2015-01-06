<?php
session_start();
$req='cmd=_notify-validate';
include_once('orden.php');
include_once('detalle_orden.php');
include_once('conexion.php');
include_once('correoProcesandoOrden.php');
include_once('producto.php');
//include_once('pruebaipn.php');
$header='';
foreach($_POST as $key=>$value)
{
	$value=urlencode(stripslashes($value));
	$req.="&$key=$value";
}
//$header =$header.
$header .="POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Host: www.sandbox.paypal.com\r\n";
$header .="Content-Type: application/x-www-form-urlencoded\r\n";
$header .="Content-Length: ".strlen($req)."\r\n\r\n";

$fp=fsockopen('ssl://www.sandbox.paypal.com',443,$errno,$errstr,30);



$item_name= $_POST['item_name'];

if($_POST['item_number']!='')
$item_number= $_POST['item_number'];
else
$item_number= $_POST['item_number1'];

$payment_status= $_POST['payment_status'];
$payment_amount= $_POST['mc_gross'];
$payment_currency= $_POST['mc_currency'];
$txn_id= $_POST['txn_id'];
$receiver_email= $_POST['receiver_email'];
$payer_email= $_POST['payer_email'];
$invoice_id= $_POST['invoice_id'];

if(!$fp){
	echo 'error';
}else{

	fputs($fp,$header.$req);
	while(!feof($fp)){
		$res=fgets($fp,1024);

		if(strcmp($res,"VERIFIED")==0)
		{	

				
			switch($payment_status)
			{
				case 'Completed':							
					$orden = new orden($item_number,'','','','',3);
					$orden->updateStatus();
					$orden->obtener_orden();
					
					$detalle=new detalle_orden($item_number);
        			$detalle->obtener_productos_orden();
        			
        			foreach($detalle->productos as $elemento){  
                        $prod=new producto($elemento->id_producto);
                        $prod->disminuir_inventario($elemento->stock_general);
                        if($elemento->id_combinacion != 0){
                        	$prod->disminuir_inventario_combinacion ($elemento->stock_general,$elemento->id_combinacion);
                        } 	
                    }
                    $correoProcesandoOrden = new correoProcesandoOrden($item_number);
					$correoProcesandoOrden->enviar();
				break;
				case 'Pending':
					$orden = new orden($item_number,'','','','',2);
					$orden->updateStatus();
				break;
				case 'Reversed':
					$orden = new orden($item_number,'','','','',1);
					$orden->updateStatus();
					
				break;
			}
	}else if(strcmp($res,"INVALID")==0)
		{
			/*$prueba= new pruebaipn(0,$item_number,'entre en el else');
			$prueba->insertaprueba();*/
			$orden = new orden($item_number,'','','','',0);
			$orden->updateStatus();	
		}
	}
	fclose($fp);
}
?>