<?php

define ('BEATPORTAPI','http://api.beatport.com/catalog/3/beatport/');
echo '<h2>Importing Release with old V2 api</h2>';

$releaseid = trim($_GET['importEpFromBeatport']);

function getEpFromBeatport($releaseid){
	$debug = '';
	$result ='';
	$releaseid = trim($releaseid);

	if(!is_numeric($releaseid)){
		return 'Invalid ID'; 
	}
	$url = 'http://api.beatport.com/catalog/search?v=2.0&perPage=50&format=json&query=releaseId%3A'.$releaseid;


	$debug .='<br /> DEBUG START:<BR>'.$url.'<br />';
	$data = retrivefile($url);
	if($data == false){
		$debug .= 'Impossible to get file'; 
	}else{
		$debug .= '<br />Data downloaded<br />';	
	}
	$json_a=json_decode($data, true); 
	/*
	if(!isset($json_a['results'][0])){
		$debug .= 'Not a good release ID, sorry';	
	}
	*/


	/*
	*
	*
	*
	*	Modificato 04/11/2013: beatport ha messo in coda la release ID
	*
	*
	*/

	$releaseindex = 0;
	$release_trovata = 0;
	$n = 0;
	foreach($json_a['results'] as $res){
		if($res['type'] == 'release')
		{
			$releaseindex = $n;
			$release_trovata = 1; // ho trovato qual'era la release
		}
		$n++;
	}
	if($release_trovata == 0){
		return 'No release infos retriven. Beatport API response is not containing the correct infos.';
	}
	$debug .= '<h3>Release general info:</h3>
				<pre>'.json_encode($json_a['results'][$releaseindex]).'</pre>';
	$release = $json_a['results'][$releaseindex];

	// Fine modifica ====================================================



	$debug .='<br /> Title<BR>'.$release['name'].'<br />';
	//================ SETUP GENERAL RELEASE INFOS ======================
	//echo '<pre>'.json_encode($release).'</pre>';
	if($release['name']==''){
		$debug .= 'Not a good release name, sorry';	
	}
	$postexixts = 	post_exists_by_title ($release['name']);		
	if($postexixts != 0 && $postexixts!=''){
		if(!is_numeric($postexixts)){
			$debug.="<br /><strong>Error checking existence. Must stop, very sorry.</strong><br />";
		}
	}
	$postexixts =0;
	
	if ($postexixts ==0 || get_option(THEME_SHORTNAME.'_debug_enable')=='true'){		
						

						/* = Creation of the post
						========================================================================*/
						
						$new_post = array(
						 'post_title' => addslashes($release['name']),
						 'post_content' => addslashes($release['description']),
						 'post_status' => 'publish',
						 'post_date' => date('Y-m-d H:i:s'),
						 'post_type' => 'release',
						 'tags_input' => addslashes($release['category']),
						 'filter' => true
						);
						
						kses_remove_filters(); // must remove filters or many times security will block this
						if($post_id = wp_insert_post($new_post)){
							$debug.="<br /><p style='color:#00F'>Post created (".$post_id."). Now is time to create the details</p><br />";
							$postexixts = $post_id;
						}
					

						/* = Check before going on for nothing
						========================================================================*/

						if(!is_numeric($post_id)){
							return $debug.'<br>Impossible to create the post. Wordpress error in importEpFromBeatport.php';
						}



						/* = Creation of the tracks
						========================================================================*/

						$general_release_details_label = $release['label']['name'];
						if($release['slug']!='' && $release['id']!=''){
							$general_release_details_buy_link = 'http://pro.beatport.com/release/'.$release['slug'].'/'.$release['id'];
						}else{
							$general_release_details_buy_link ='';	
						}
						$details_array = array('general_release_details_label'=>$general_release_details_label,
											   'general_release_details_release_date'=>$release['releaseDate'],
											   'general_release_details_buy_link'=>$general_release_details_buy_link,
											   'general_release_details_publishdate'=>$release['publishDate'],
											   'general_release_details_exclusive'=>$release['exclusive'],
											   'general_release_details_category'=>$release['category'], 
											   'general_release_details_catalognumber'=>$release['catalogNumber'] 
											   );
						foreach($details_array as $post_meta => $meta_value){
							add_post_meta($post_id, $post_meta, $meta_value); // This creates a blank custom_field entry to start
						}


						/* = Insert the featured image
						========================================================================*/
						$featuredimage = set_featuredimage_by_url($release['images']['large']['url'],$post_id);


						/* = Creation of the tracks
						========================================================================*/
						$tracks = $json_a['results'];
					//	unset($tracks[0]);// in the old API this was the release general info
						$debug.= '<textarea>'.json_encode($tracks).'</textarea>';

						// CREATION OF THE DETAILS:
						$release_details_result = create_release_details($releaseid,$post_id,$tracks);


						if($release_details_result == true){
							$debug.="<br /><h3>Details created.</h3>";
							$result .= '<p style="color:#02f; font-size:16px;">Release created: '.$release['name'].'<br /><a href="'.get_permalink($postexixts).'" target="_blank">Click here to see</a></p>';
						}else{
							$debug.="<br /><p style='color:#F00'>Error creating details: YOU MUST RETRY TO CREATE DETAILS FROM THE SINGLE RELEASE EDIT PAGE<br />
									Error: ".$release_details_result."<br />
									Please retry
									</p><br />";
						}
						
	}else{
		$result.= 'This item is already existing. Trash it to import again';
	}

	//=============== END SETUP GENERAL RELEASE INFOS ===================
	if(get_option(THEME_SHORTNAME.'_debug_enable')=='true' ){
		$result.=$debug;
	}
	//echo get_option(THEME_SHORTNAME.'_debug_enable');

	return $result;
}//end main function


if(is_numeric($releaseid)){
	echo getEpFromBeatport($releaseid);
}else{
	echo 'Bad Release ID!';	
}



?>