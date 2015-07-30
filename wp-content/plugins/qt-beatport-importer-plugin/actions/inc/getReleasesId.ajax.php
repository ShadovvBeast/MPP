<?php

function return_id_array($url){
	$url = str_replace('http://','',trim($_GET['Url']));
	$url = str_replace('pro.beatport.com/','',trim($_GET['Url']));
	$url_array	= explode('/', $url);
	$type 		= $url_array[1];
	$id 		= $url_array[3];
	$data = false;//just in case 
	switch ($type){
		case "release":
			$parameters = array(
	             'id'=>$id
	         );
			$requestString = '/catalog/3/releases';
			break;

		case "artist":
			$parameters = array(
	             'facets'=>'performerId:'.$id,
	             'perPage'=>'1000'
	         );
			$requestString = '/catalog/3/releases';
			break;
		case "label":

			$parameters = array(
	             'facets'=>'labelId:'.$id,
	             'perPage'=>'500'
	        );
	        $requestString = '/catalog/3/releases';
			
			break;
		break;
			default:
			return false;
	}
	if(function_exists('obtainBeatportDataOAuth')){
		$data = obtainBeatportDataOAuth($requestString,$parameters);			
	}
	return $data;
}

?>