<?php
function valid() {
$recuest_from_telegram=false;
if(isset($_POST)){
	$data=file_get_contents("php://input");
	if(json_encode($data)!=null)
		$recuest_from_telegram=json_decode($data,1);
}
return $recuest_from_telegram;
}
function get($url){
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_HEADER ,0);
	$data=curl_exec($ch);
	curl_close($ch);
	return $data;
}