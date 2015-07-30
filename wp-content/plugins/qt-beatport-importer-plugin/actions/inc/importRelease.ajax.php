<?php


function importReleaseOldVersionDeprecated($releaseid){
	$debug = '';
	$result ='';
	$releaseid = trim($releaseid);

	if(!is_numeric($releaseid)){
		return 'Invalid ID'; 
	}
	$url = 'http://api.beatport.com/catalog/search?v=2.0&perPage=50&format=json&query=releaseId%3A'.$releaseid;


	$debug .='<br /> DEBUG START:<BR>'.$url.'<br />';
	$data = get_remote_contents($url);
	if($data == false){
		$debug .= 'Impossible to get file'; 
	}else{
		$debug .= '<br />Data downloaded<br />';	
	}
	$json_a=json_decode($data, true); 
	

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
	
	if ($postexixts ==0 || get_option(THEME_SHORTNAME.'_debug_enable')=='true' && isset($release['name'])){		
						

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
						//unset($tracks[0]);// in the old API this was the release general info
						$debug.= '<textarea>'.json_encode($tracks).'</textarea>';

						// CREATION OF THE DETAILS:
						$release_details_result = create_release_details_new($releaseid,$post_id,$tracks);


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
		//$result.=$debug;
	}
	//echo get_option(THEME_SHORTNAME.'_debug_enable');

	return $result;
}//end main function



function importRelease($releaseid){
	$data = false;
	$debug = '';
	$result ='';
	$releaseid = trim($releaseid);
	
	if(!is_numeric($releaseid)){
		return 'Invalid ID'; 
	}

	$parameters = array(
	             'id'=>$releaseid	             
	 			);
	$requestString = '/catalog/3/releases';
	if(function_exists('obtainBeatportDataOAuth')){
		$data = obtainBeatportDataOAuth($requestString,$parameters);			
	}


	if($data == false){
		return '<div class="alert">Impossible to get file from Beatport. <br /> Check if your server is allowed to execute file_get_contents or curl please.</div>'; 
	}else{
		$debug .= '<br />Data downloaded<br />';	
	}

	$json_a=json_decode($data, true); 
	//$release = $json_a['results']['release'];//this was old
	$release = $json_a['results'][0]; // new api wants this
	
	//================ SETUP GENERAL RELEASE INFOS ======================

	if($release['name']==''){
		$debug .= 'Not a good release name, sorry';	
	}

	$new_post = array(
	 'post_title' => addslashes($release['name']),
	 'post_content' => addslashes($release['description']),
	 'post_status' => 'publish',
	 'post_date' => addslashes($release['publishDate']),//publishDate
	 'post_type' => 'release',
	 'tags_input' => addslashes($release['category']),
	 'filter' => true
	);

	$postexixts = 	post_exists_by_title ($release['name']);		
	// check if a post was already created and force delete it
	if($postexixts != 0 && $postexixts!=''){
		if(is_numeric($postexixts)){
			// wp_delete_post($postexixts,false);
		}else{
			$debug.="<br /><strong>Error checking existence. Must stop, very sorry.</strong><br />";
		}
	}
	
	$postexixts =0;
	
	if ($postexixts ==0){			
		kses_remove_filters(); // must remove filters or many times security will block this
		if($post_id = wp_insert_post($new_post)){
			$debug.="<br /><p style='color:#00F'>Post created (".$post_id."). PROCEEDING!</p><br />";
			$postexixts = $post_id;
		}
		$release_details_result = create_release_details($releaseid,$post_id,$data);
		

		if($release_details_result != false){
			//$debug.="<br />Details created.<br />".$release_details_result;
			$result .= '<p style="color:#02f; font-size:16px;">Release created: '.$release['name'].'<br /><a href="'.get_permalink($postexixts).'" target="_blank">Click here to see</a></p>';
		}else{
			$debug.= $release_details_result;
		}
		
	}else{
		$result.= 'This item is already existing. Trash it to import again';
	}
	//=============== END SETUP GENERAL RELEASE INFOS ===================
	return $result;
}//end main function




/* = Import Artist
================================================================================================================*/


function createArtistPage($url){
	$result = '';
	$debug = '';
	$url = str_replace('http://','',$url);
	$url = str_replace('pro.beatport.com/','',trim($_GET['Url']));
	$url_array	= explode('/', $url);
	$type 		= $url_array[1];
	$id 		= trim($url_array[3]);
	if(!is_numeric($id)){
		return 'Invalid ID'; 
	}
	$parameters = array(
	             'id'=>$id
	 			);
	$requestString = '/catalog/3/artists/';

	if(function_exists('obtainBeatportDataOAuth')){
		$data = obtainBeatportDataOAuth($requestString,$parameters);			
	}

	$json_a=json_decode($data, true); 
	$jsonArrayData = $json_a['results'][0];

	if($jsonArrayData['name']=='' || !isset($jsonArrayData['name'])){return 'Bad data retriven. Maybe wrong id?'; }
	
	$tags = '';

	for($n=0; $n<count($jsonArrayData['genres']); $n++){
		$tags .= $jsonArrayData['genres'][$n]['name'].',';
	}
	$postexixts = 	post_exists_by_title ($jsonArrayData['name']);	

	if($postexixts != 0 && $postexixts!=''){
		if(is_numeric($postexixts)){
			// wp_delete_post($postexixts,false); //leave the old one in trash in case of mistakes
		}else{
			$debug.="<br /><strong>Error checking existence. Must stop, very sorry.</strong><br />";
		}
		return '<h2>This artist page is already existing.</h2>
		<p> To prevent the accidental overwrite, you cannot reimport existing artists pages, so you must first delete the existing one (also from trash)</p>';
	}

	$new_post = array(
	 'post_title' => addslashes($jsonArrayData['name']),
	 'post_content' => addslashes($jsonArrayData['biography']),
	 'post_status' => 'publish',
	 'post_date' => date('Y-m-d H:i:s'),
	 'post_type' => 'artist',
	 'tax_input' => array('genre' => addslashes($tags)),
	 'filter' => true
	);

	if ($postexixts ==0){		
		kses_remove_filters();
		if($post_id = wp_insert_post($new_post)){
			if(set_featuredimage_by_url($jsonArrayData['images']['large']['url'],$post_id)){
					$debug.="<br />Thumbnail created: <br />".$jsonArrayData['images']['large']['url'];
			}
			$debug.="<br />Artist created<br />".$post_id;
			$result .= '<p style="color:#02f; font-size:16px;">Artist created: '.$jsonArrayData['name'].'<br />
			<a href="'.get_permalink($post_id).'" target="_blank">Click here to see</a></p>
			<p>
			<a href="post.php?post='.get_permalink($post_id).'&action=edit" >Edit this artist page</a></p>
			</p>';
		}else{
			$result.="<p style='color:#F00'>Error, this page cannot be create automatically. <br />[support code: importRelease.ajax.php:159]</p>";
					
		}				
	}				
	return '<p>'.$result.'<p><p><small>'.$debug.'</small></p>';
}//end main function

?>