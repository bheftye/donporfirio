<?php
/* Regresa una URL Corta */
function get_bitly_short_url($url,$login='luiseffe',$appkey='R_ebdfeefe8711912d6ddf567254fe3817',$format='txt') {
	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}

/* Regresa la URL Expandida */
function get_bitly_long_url($url,$login='luiseffe',$appkey='R_ebdfeefe8711912d6ddf567254fe3817',$format='txt') {
	$connectURL = 'http://api.bit.ly/v3/expand?login='.$login.'&apiKey='.$appkey.'&shortUrl='.urlencode($url).'&format='.$format;
	return curl_get_result($connectURL);
}

/* Regresa el resultado de la URL */
function curl_get_result($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

/* get the short url 
$short_url = get_bitly_short_url('http://locker.com.mx/');

/* get the long url from the short one 
$long_url = get_bitly_long_url($short_url);
*/
?>