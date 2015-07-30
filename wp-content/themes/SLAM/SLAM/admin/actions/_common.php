<?php

// common useful functz
function post_exists_by_title ($title){
/*	$sql = "SELECT * FROM `".TABLEPREF."posts` WHERE post_title = '".$title."' AND post_status = 'publish' ";
	if($res = mysql_query($sql)){
		if(mysql_num_rows($res)>0){
			while ($rec = mysql_fetch_array($res)){
				return $rec['ID'];
			}
		}else{
			return 0;
		}
	}else{
		return false;
	}*/

	global $wpdb;
	$query = $wpdb->prepare('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_title = %s', addslashes($title));
	$searchedID = $wpdb->get_var( $query );
	if ( !empty($searchedID) ) {
		return $searchedID;
	}
	return 0;

}

function retrivefile($url){
	if($url != '') {
		if (function_exists('wp_remote_get')){ 
			$response = wp_remote_get( $url );
			if( is_wp_error( $response ) ) {
			   $error_message = $response->get_error_message();
			   die('Adminindex.php says: Wrong resource url');
			   return "";
			} else {
				return $response ['body'];
			}
		}
	}

}


/* = get_mid_by_key
================================================================*/
function get_mid_by_key( $post_id, $meta_key ) {
	  global $wpdb;
	  $mid = $wpdb->get_var( $wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key) );
	  if( $mid != '' )
	  return (int)$mid;
	  return false;
}

/* = creare_release_details
================================================================*/


/* note this version of the software is for the old api (rescue version)*/


function create_release_details ($releaseid,$post_id,$tracksListr){
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



//==================== SET FEATURED IMAGE BY URL ==========================================================

function set_featuredimage_by_url($image_url,$post_id){
	if ($image_url == '' || $post_id == '' ){
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
	if(wp_mkdir_p($upload_dir['path'])){
		$file = $upload_dir['path'] . '/' . $filename;
	}else{
		$file = $upload_dir['basedir'] . '/' . $filename;
	}
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



?>