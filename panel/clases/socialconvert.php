<?php
include_once('bitly.php');

function autolink($string)
{
//$string = str_replace("\n", ' </br> ', $string);
$content_array = explode(" ", $string);
$output = '';

foreach($content_array as $content)
{
//Link http://
if(substr($content, 0, 7) == "http://")
$content = $short_url = get_bitly_short_url($content);

//starts with https://
if(substr($content, 0, 8) == "https://")
$content = $short_url = get_bitly_short_url($content);


//starts with www.
if(substr($content, 0, 4) == "www.")
$content = $short_url = get_bitly_short_url($content);

$output .= " " . $content;
}

$output = trim($output);
return $output;
}

?>