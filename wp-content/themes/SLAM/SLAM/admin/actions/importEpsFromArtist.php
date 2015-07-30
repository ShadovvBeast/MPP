<?php
echo '<h2>Importing all artist\'s eps</h2>';
define ('BEATPORTAPI','http://api.beatport.com/catalog/3/beatport/');

$releaseid = trim($action_argument);

function getEpFromBeatportByArtist($releaseid){

	$debug = '';
	$result ='';
	$releaseid = trim($releaseid);
	if(!is_numeric($releaseid)){
		return 'Invalid ID'; 
	}
	$url = BEATPORTAPI.'release?id='.$releaseid;
	
	//die($url);

	$debug .='<br />'.$url.'<br />';

	$data = retrivefile($url);

	if($data == false){
		$debug .= 'Impossible to get file'; 
		$baderror = true;
		return $debug;
	}else{
		$debug .= '<br />Data downloaded<br />';	
	}

	$json_a=json_decode($data, true); 

	/*

	if(!isset($json_a['results']['release'])){
		$debug .= 'Not a good release ID, sorry';	
	}

	*/

	$release = $json_a['results']['release'];

	//================ SETUP GENERAL RELEASE INFOS ======================

	if($release['name']==''){
		$debug .= 'Not a good release name, sorry';	
	}

	$new_post = array(
	 'post_title' => addslashes($release['name']),
	 'post_content' => addslashes($release['description']),
	 'post_status' => 'publish',
	 'post_date' => addslashes($release['publishDate']),//publishDate
	 /*'post_author' => $user_ID,*/
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
					
						$cachefile = CACHEPATH.'release-'.$postexixts.'.txt';
					
						//create a cache file to grab contents in case of problem, and delete it after creating details
					
						//if this file esists, it means that we har problems creating details
					
						if(!is_file($cachefile)){
							if(!$fp = fopen($cachefile,"w")){
								return "<br /><p style='color:#F00'>ERROR SAVING CACHE FILE (".$postexixts.").<br />
										ABORTED. YOU MUST CREATE DETAILS MANUALLY! 
										<br />Check cache folder permission to make this go right!(admin/actions/cache).<br />
										It must be at least 755</p><br />";
							};
							fwrite($fp,$data);
							fclose($fp);
					
						}
					
						$release_details_result = create_release_details($releaseid,$postexixts);
						if($release_details_result == 0){
							$debug.="<br />Details created. Errors:<br />".$release_details_result;
							$result .= '<p style="color:#02f; font-size:16px;">Release created: '.$release['name'].'<br /><a href="'.get_permalink(				$postexixts).'" target="_blank">Click here to see</a></p>';
							
							
					
		}else{
	
			$debug.="<br /><p style='color:#F00'>Error creating details: YOU MUST RETRY TO CREATE DETAILS FROM THE SINGLE RELEASE EDIT PAGE<br />Error: ".$release_details_result."<br />
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


if($_GET['importEpsFromArtist']!=''){
	echo importEpsFromArtist($_GET['importEpsFromArtist']);
}

function importEpsFromArtist($action_argument){
	//http://api.beatport.com/catalog/3/releases?facets[]=performerName:Acida+Corporation&perPage=350
	
	
	$toreplace = array('%20',' ');
	$replacer = array('+','+');
	$action_argument = (str_replace($toreplace,$replacer,$action_argument));
	$url ='http://api.beatport.com/catalog/3/releases?facets[]=performerName:'.$action_argument.'&perPage=350';
	
	
	$data = retrivefile($url);

	if($data == false || $data == ''){
		return '<div class="alert">Impossible to get file from Beatport. <br /> Check if your server is allowed to execute file_get_contents or curl please.</div>'; 
	}else{
		$debug .= '<br />Data downloaded<br />';	
	}

	$json_a=json_decode($data, true); 	


	$release = $json_a['results'];
	
	$ids = 0;
	$Result='';
	foreach ($release as $r){
		$ids .= $r['id'].'<br />';
		$Result .= getEpFromBeatportByArtist($r['id']).'<hr />';
	}
	
	
	
	
	
	return '<h3>'.$url.'</h3>'.'<hr />'.$Result;
}


?>