<?php




define ('BEATPORTAPIBASE','http://oauth-api.beatport.com/catalog/3/');
define ('BEATPORTAPI',BEATPORTAPIBASE.'beatport/');
define ('INCLUSIONPATH',urldecode($_GET['secretpath']));

/* = Wordpress Engine Inclusion
===================================================*/
include(INCLUSIONPATH.'wp-load.php');




/* = Beatport Importer Ajax Service
===================================================*/
include 'inc/_common.php';
if (!class_exists('OAuthSimpleException')) {
    require 'inc/oauth/OAuthSimple.php';
}


/* = GET THE INFO ABOUT APP AND USER
======================================================*/

if(!isset($_GET['BPcheck'])){
	die(false);
}
if($_GET['BPcheck']==''){
	die(false);
}


$decodedToken = base64_decode($_GET['BPcheck']);
$decodedArray = explode('[++]', $decodedToken);
$accessToken = $decodedArray[0];
$accessTokenSecret = $decodedArray[1];
$apiKey = $decodedArray[2];
$apiSecret = $decodedArray[3];
define('BPACCESS_TOKEN',$accessToken );
define('BPACCESS_TOKEN_SECRET',$accessTokenSecret);
define('BPAPIKEY',$apiKey );
define('BPAPISECRET',$apiSecret);

/* = FUNCTION TO GET THE CURRENT PAGE URL
======================================================*/

if(!function_exists('curPageURL')){
	function curPageURL() {
		 $pageURL = 'http';
		if(isset($_SERVER["HTTPS"])){
		    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}
}


/* = GRAB BEATPORT CONTENT USING OAUTH PROTOCOL
======================================================*/

if(!function_exists('obtainBeatportDataOAuth')){
	function obtainBeatportDataOAuth ($requestString = '',$parameters = array()){
		/*
		*
		*
		*
		*			Qui chiamo funzione del tema per festire le activation keys
		*
		*
		*
		*
		*
		*/

			$baseurl = 'https://oauth-api.beatport.com/';
			$accessurl = 'identity/1/oauth/direct-access-token';
			$req_url = 'https://oauth-api.beatport.com/identity/1/oauth/request-token';
			$authurl = 'https://oauth-api.beatport.com/identity/1/oauth/authorize';
			$acc_url = 'https://oauth-api.beatport.com/identity/1/oauth/access-token';
			$api_url = 'https://oauth-api.beatport.com';


			/* = inizializzazione base
			=================================================*/
			$oauthObject = new OAuthSimple();
	        $oauthObject->reset();
	      	$signatures = array( 
	                    'request_token_uri' => $req_url,
	                    'authorize_uri' => $authurl, 
	                    'access_token_uri' => $acc_url,
	                    'consumer_key'     => BPAPIKEY,
	                    'shared_secret'    => BPAPISECRET,
	                    'oauth_secret' => BPACCESS_TOKEN_SECRET,
	                    'oauth_token' =>BPACCESS_TOKEN
	                );
			if(!is_array($parameters)){
				$parameters = array();
			}
	         $result = $oauthObject->sign(array(
	            'path'      => $api_url.$requestString ,
	            //'path' => $acc_url,
	            'parameters'=> $parameters,
	            'signatures'=> $signatures
	            )
	        );
	       	
	        if(!function_exists('wp_remote_post')){
	        	return 'Error: wp remote post is not existing';
	        }

	        $response = wp_remote_post($result['signed_url'], array(
				'method' => 'POST'
			    )
			);
	        
			if ( is_wp_error( $response ) ) {
			   $error_message = $response->get_error_message();
			   return "Something went wrong: ".$error_message."<br>It seems you are without external internet connection or your server is not allowed to use CURL functions";
			} else {
			   return $response['body'];//$response ;
			}
			
	}
}


if(isset($_GET['action']))
{
	if($_GET['action']=='createArtistPage'){

		require 'inc/importRelease.ajax.php';
		echo createArtistPage($_GET['Url']);
	}
	if($_GET['action']=='getReleasesId'){
		require 'inc/getReleasesId.ajax.php';
		echo return_id_array($_GET['Url']);
	}
	if($_GET['action']=='ImportRelease'){
		require 'inc/importRelease.ajax.php';
		echo importRelease($_GET['releaseid']);
	}
	if(!isset($_GET['action'])){
		echo 'Error: no action set';
	}
}	else{
	echo 'no action';
}






	

?>