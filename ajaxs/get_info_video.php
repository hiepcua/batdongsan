<?php
function get_youtube($url){
	$youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";
	$curl = curl_init($youtube);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$return = curl_exec($curl);
	curl_close($curl);
	return $return;
}
$url = isset($_POST['url'])?$_POST['url']:''; // youtube video url 
// Display Data 
echo get_youtube($url);
?>