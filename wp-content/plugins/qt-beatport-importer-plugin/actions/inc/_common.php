<?php


// common useful functz


function get_inclusion_url($s=3){
	$u='';
	for($n=0; $n<$s ; $n++){
		$u.= '../';
	}
	return $u;
}


function post_exists_by_title ($title){

	
	global $wpdb;
	global $table_prefix;

	$return = $wpdb->get_row( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $title . "' && post_status = 'publish' && post_type = 'post' ", 'ARRAY_N' );
	if( empty( $return ) ) {
		return 0;
	} else {
		return true;
	}

}




function get_remote_contents ($Url) {
	if(!function_exists('wp_remote_get')){


			if (!function_exists('curl_init')){ 
				if (!function_exists('file_get_contents')){ 
					return false;
				}else{
					return file_get_contents($url);
				}
			}else{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $Url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				if($output = curl_exec($ch)){
					curl_close($ch);
					return $output;
				}else{
					return false;
				}
			}


	}else{
		$response = wp_remote_get( $Url );
		if( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   die('COMMON: Wrong resource url');
		   return "";
		} else {
			return $response ['body'];
		}
	}
}


/////////////////////////////////// get_mid_by_key

function get_mid_by_key( $post_id, $meta_key ) {

	  global $wpdb;

	  $mid = $wpdb->get_var( $wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key) );

	  if( $mid != '' )

		return (int)$mid;

	 

	  return false;

}



/* = creare_release_details
================================================================*/


function create_release_details_new ($releaseid,$post_id,$tracksListr){
	$errors = '';
	$tracks_data = $tracksListr;
	$tracks_count =0;
	$debugger = '<h3>Debugger postmeta for '.count($tracks_data).' tracks</h3>';
	$data_tracks = array();
	foreach ($tracks_data as $t){
			$temparray = array();
			if($t['type']=='track'){
				$tracks_count = $tracks_count+1; // used in magic fields table
				$artists = '';
				$index = 0;
				foreach($t['artists'] as $artist){
					$index ++;
					$artists .= $artist['name'];
					if($index < count($t['artists'])){
							$artists .= ', ';
					}
				}
				$metas_array = array(
									 'releasetrack_track_title' => $t['title'],
									 'releasetrack_artist_name' => $artists,
									 'releasetrack_mp3_demo' 	=> $t['sampleUrl']
									);
				array_push($data_tracks,$metas_array);
				
			}//enf if
			else{
				$debugger .= 'This is not a track <br />';	
			}
	}//end foreach

	$myMeta = add_post_meta($post_id, 'track_repeatable', ($data_tracks));
	if(!is_numeric($myMeta)){
			$errors.= $myMeta.', ';							
	};

	if ($errors == ''){
			return true;
	}
	return $errors;	
}

	

function create_release_details ($releaseid,$post_id,$data){

	$errors = 0;
	$json_a=json_decode($data, true); 
	$single_release_data = $json_a['results'][0];
	$general_release_details_label = $single_release_data['label']['name'];

	if($single_release_data['slug']!='' && $single_release_data['id']!=''){
		$general_release_details_buy_link = 'http://pro.beatport.com/release/'.$single_release_data['slug'].'/'.$single_release_data['id'];
	}else{
		$general_release_details_buy_link ='';	
	}

	$details_array = array('general_release_details_label'=>$general_release_details_label,
						   'general_release_details_release_date'=>$single_release_data['releaseDate'],
						   'general_release_details_buy_link'=>$general_release_details_buy_link,
						   'general_release_details_publishdate'=>$single_release_data['publishDate'],
						   'general_release_details_exclusive'=>$single_release_data['exclusive'],
						   'general_release_details_category'=>$single_release_data['category'],
						   'general_release_details_catalognumber'=>$single_release_data['catalogNumber']
						   );

	foreach($details_array as $post_meta => $meta_value){
		add_post_meta($post_id, $post_meta, $meta_value); // This creates a blank custom_field entry to start
	}
	
	if(!set_featuredimage_by_url($single_release_data['images']['large']['url'],$post_id)){
		$errors++;	
		$debugger .= '<br />Impossible to set featured image';
	}

	//======================= NOW I CAN IMPORT ALL THE TRACKS ========================


	$parameters = array(
	 	'releaseId'=>$releaseid,
	 	'perPage' => 100
	);
	$requestString = '/catalog/3/tracks';
	if(function_exists('obtainBeatportDataOAuth')){
		$Tdata = obtainBeatportDataOAuth($requestString,$parameters);			
	}
	
	$Tjson_a=json_decode($Tdata, true); 

	$tracks_data = $Tjson_a['results'];

	$tracks_count =0;
	$debugger = '<h3>Debugger postmeta for '.count($tracks_data).' tracks</h3>';
	$data_tracks = array();
	
	foreach ($tracks_data as $t){
		$temparray = array();
		if($t['type']=='track'){
			$tracks_count = $tracks_count+1; // used in magic fields table
			$artists = '';
			$index = 0;
			foreach($t['artists'] as $artist){
				$index ++;
				$artists .= $artist['name'];

				if($index < count($t['artists'])){
						$artists .= ', ';
				}
			}
			$sampleurl = '';
			if(isset($t['sampleUrl'])){
				$sampleurl = $t['sampleUrl'];
			}else{
				/*
					Try to import sample, if impossible store the remote url
				*/
				$sampleurl = 'http://samples.beatport.com/lofi/'.$t['id'].'.LOFI.mp3';
				/*$importedFile = get_sample_file_as_attachment($sampleurl, $post_id, $t['title']);
				if($importedFile != false){
					$sampleurl = $importedFile;
				}*/
			}
			$metas_array = array(
								 'releasetrack_track_title' => $t['title'],
								 'releasetrack_artist_name' => $artists,
								 'releasetrack_mp3_demo' 	=> $sampleurl
								);
			array_push($data_tracks,$metas_array);
			
		}//enf if
		else{
			$debugger .= $t['title'].' is not a track <br />';	
		}
	}//end foreach
	if(!is_numeric(add_post_meta($post_id, 'track_repeatable', ($data_tracks)))){
		return false;					
	}else{
		return true;
	};

	// end of the function, unlink cache file that is useless if all is ok


}

//=============== END creare_release_details ===============================================================



// Try importing mp3 sample
if(!function_exists('get_sample_file_as_attachment')){
function get_sample_file_as_attachment($file_url, $post_id, $track_title){
	if ($file_url == '' || $post_id == ''){
		return false;	
	}
	$errors = 0;
	$upload_dir = wp_upload_dir();
	// Updated from issue with godaddy hosting on 2013 07 10
	if(function_exists('file_get_contents')){ // requests allow_url_fopen = On on php.ini
		$output = file_get_contents($file_url);
	}else {
		if (!function_exists('curl_init')){ 
			return false;
		}else{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			if($output = curl_exec($ch)){
				curl_close($ch);
			}else{
				return false;
			}
		}
	}
	$filename = sanitize_file_name($track_title).".mp3";
	if(wp_mkdir_p($upload_dir['path'])){
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	if(!file_put_contents($file, $output)){
		return false;	
	}

	/*	
	Needed also this to get the good URL
	*/

	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => sanitize_file_name($track_title),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$tape_attachment_id = wp_insert_attachment( $attachment, $file, $post_id );
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $tape_attachment_id, $file );
	if(!wp_update_attachment_metadata( $tape_attachment_id, $attach_data )){
		return false;	
	}
	if(!set_post_thumbnail( $post_id, $tape_attachment_id )){
		$errors++;
	}
	if ($errors == 0){
		return $upload_dir['url']. '/' . $filename;
	}

	/*
	*	In case it arrives here, something is wrong. Better to return false
	*/
	return false;
}
}

	

//==================== SET FEATURED IMAGE BY URL ==========================================================

	
if(!function_exists('set_featuredimage_by_url')){
function set_featuredimage_by_url($image_url,$post_id){
	if ($image_url == '' || $post_id == ''){
		return false;	
	}
	$errors = 0;
	$upload_dir = wp_upload_dir();
	// Updated from issue with godaddy hosting on 2013 07 10
	if(function_exists('file_get_contents')){ // requests allow_url_fopen = On on php.ini
		$image_data = file_get_contents($image_url);
	}else {
		if (!function_exists('curl_init')){ 
			return false;
		}else{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $Url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			if($output = curl_exec($ch)){
				curl_close($ch);
				$image_data = $output;
			}else{
				return false;
			}
		}
	}
	$filename = basename($image_url);
	if(wp_mkdir_p($upload_dir['path']))
		$file = $upload_dir['path'] . '/' . $filename;
	else
		$file = $upload_dir['basedir'] . '/' . $filename;
	if(!file_put_contents($file, $image_data)){
		return false;	
	};
	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => sanitize_file_name($filename),
		'post_content' => '',
		'post_status' => 'inherit'
	);
	$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	if(!wp_update_attachment_metadata( $attach_id, $attach_data )){
		return false;	
	}
	if(!set_post_thumbnail( $post_id, $attach_id )){
		$errors++;
	}
	if ($errors == 0){
		return true;	
	}
}
}



?>