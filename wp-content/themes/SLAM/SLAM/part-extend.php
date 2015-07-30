<?php



define ('ENVATOAPIBASE','http://marketplace.envato.com/api/edge/');
define ('QTITEMID','3646671');
define ('QTAPIKENV','ieergnh6pqto1foe1zcfv3p0sva8h4n3');
define ('QTAUTHOR','QantumThemes');
define ('SERVICE','http://qantumthemes.com/activation/working.php');



//	qt_get_procedure_settings // needed for extra features for other plugins
//	========================================================================================================================
if(!function_exists('qt_get_procedure_settings')){
function qt_get_procedure_settings(){

	

	/*
	*
	*
	*	Check if the theme is already actived
	*
	*/

	$alreadyActived = get_option("qtThemeActive");
	if($alreadyActived != ''){
		return $alreadyActived;
	} 

	$user = get_option('qt_envato_user');
	$pc = get_option('qt_purchase_code');
	$authorUser = QTAUTHOR;
	$apiKey = QTAPIKENV;
	$url = esc_url("http://marketplace.envato.com/api/edge/".esc_attr($authorUser)."/".esc_attr($apiKey)."/verify-purchase:".esc_attr($pc).".json");

	$whitelist = array(
		    '127.0.0.1',
		    '::1'
	);


	
	$local = false;
	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist) && get_option('qt_purchase_code') != ''){
    	$local = true;
	}


	if($authorUser!=''
	   && $apiKey !=''
	   && $user !=''
	   && $pc !=''
	   && $authorUser  !=''
	){

		
		
		$verify = qwGetEnvDataTheme($url);
		if($verify == false) {
			return 'Api request denied';
		}
		$data = json_decode($verify, true);
		if(!isset($data['verify-purchase'])){
			return 'Purchase invalid - err 1';
		}
		$verif_arr = $data['verify-purchase'];
		if(!isset($data['verify-purchase']['item_id'])){
			return 'Purchase invalid - err 2';
		}
		if(!isset($data['verify-purchase']['buyer'])){
			return 'Purchase invalid - err user';
		}			
		if($data['verify-purchase']['item_id'] == QTITEMID && $data['verify-purchase']['buyer'] == $user){
			$control = md5(QTITEMID.$user.$pc);		

			update_option("qtThemeActive", 	$control);

			return $control;
		} else {
			return 'Purchase invalid - err 3';
		}
		return 'Key Error'; // never arrive here
		return false;

	} else if($local == false) {
		return 'Your version of SLAM! Theme is not yet fully active. To enjoy all the functions, please activate it.';
	} else if ($local == true){
		return 'local';
	}
}}




if(!function_exists('qwGetEnvData')){	
function qwGetEnvDataTheme ($url){
	$defaults = array(
	 'method' => 'GET',
	 'timeout' => 10,
	 'redirection' => 5,
	 'httpversion' => '1.0',
	 'user-agent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
	 'reject_unsafe_urls' => false,
	 'blocking' => true,
	 'headers' => array(),
	 'cookies' => array(),
	 'body' => null,
	 'compress' => false,
	 'decompress' => true,
	 'sslverify' => true,
	 'stream' => false,
	 'filename' => null,
	 'limit_response_size' => null,
	);

    $response = wp_remote_get(
        $url, 
        $defaults
	);	        
	if ( is_wp_error( $response ) ) {
		$whitelist = array(
		    '127.0.0.1',
		    '::1'
		);
		if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist) && get_option('qt_purchase_code') != ''){
		   $error_message = $response->get_error_message();

		   ?><div class="error"><?php
			echo  "Something went wrong: ".$error_message."<br>It seems you are without external internet connection or your server is not allowed to use CURL functions";
			?></div><?php

		}

	   return false;
	} else {
	   return $response['body'];//$response ;
	}
}
}

if(!function_exists('qw_admin_notice')){	

function qw_admin_notice() {

		

	$activation = get_option('qtThemeActive');
	$createActivation = qt_get_procedure_settings();

	$whitelist = array(
		    '127.0.0.1',
		    '::1'
	);




	if($activation == ""){
		if(in_array($_SERVER['REMOTE_ADDR'], $whitelist) && get_option('qt_purchase_code') != ''){
	    	?>
		    <div class="updated">
		        <p>Thanks for using SLAM! When you will go online, please remember to activate your theme.</p>
		    </div>
		    <?php
		    
		}else {
		    ?>
		    <div class="error">
		        <p><?php echo $activation; ?>Your version of SLAM! Theme is not yet fully active. To enjoy all the functions, please activate it 
		        	<a href="<?php echo esc_url(get_admin_url( $blog_id = "", "/themes.php?page=adminindex.php" )); ?>">here</a></p>
		    </div>
		    <?php
		}
	}
	return true;

	
}}
add_action( 'admin_notices', 'qw_admin_notice' );
?>