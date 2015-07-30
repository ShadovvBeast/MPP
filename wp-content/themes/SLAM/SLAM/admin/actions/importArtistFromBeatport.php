<?php

define ('BEATPORTAPI','http://api.beatport.com/catalog/3/beatport/');



echo '<h2>Importing Artist</h2>';



$artistid = trim($action_argument);





function getArtistFromBeatport($artistid){



	$debug = '';

	$result ='';

	

	$artistid = $artistid;

	

	if(!is_numeric($artistid)){

		return 'Invalid ID'; 

	}

	

	$url = BEATPORTAPI.'artist?id='.$artistid;

//	echo $url;

	

	$debug .='<br />'.$url.'<br />';

	

	$data = retrivefile($url);

	

	

	

	

	if($data == false){

		return 'Impossible to get file'; 

	}else{

		$debug .= '<br />Data downloaded<br />';	

	}

	

	

	

	

	

	$json_a=json_decode($data, true); 

	

	/*

	if(!isset($jsonArrayData['results']['artist'])){

		$debug .= 'Not a good artist ID, sorry';	

	}

	*/

	$jsonArrayData = $json_a['results']['artist'];

	

	

	

	

	

	

	

	//return '<pre>'.$jsonArrayData['name'].'</pre>';

	

	//================ SETUP GENERAL RELEASE INFOS ======================

	

	

	if($jsonArrayData['name']=='' || !isset($jsonArrayData['name'])){return 'Bad data retriven. Maybe wrong id?'; }

	

	$tags = '';



	for($n=0; $n<count($jsonArrayData['genres']); $n++){

		$tags .= $jsonArrayData['genres'][$n]['name'].',';

	}





	$new_post = array(

	 'post_title' => addslashes($jsonArrayData['name']),

	 'post_content' => addslashes($jsonArrayData['biography']),

	 'post_status' => 'publish',

	 'post_date' => date('Y-m-d H:i:s'),

	/* 'post_author' => $user_ID,*/

	 'post_type' => 'artist',

	 'tax_input' => array('genre' => addslashes($tags)),

	 'filter' => true

	);

	

	$postexixts = 	post_exists_by_title ($jsonArrayData['name']);		

	

	

	// check if a post was already created and force delete it

	if($postexixts != 0 && $postexixts!=''){

		if(is_numeric($postexixts)){

			// wp_delete_post($postexixts,false); //leave the old one in trash in case of mistakes

		}else{

			$debug.="<br /><strong>Error checking existence. Must stop, very sorry.</strong><br />";

		}

	}

	if ($postexixts ==0){						
						
							kses_remove_filters(); // must remove filters or many times security will block this
						
								
						
							if($post_id = wp_insert_post($new_post)){
						
								if(set_featuredimage_by_url($jsonArrayData['images']['large']['url'],$post_id)){
						
										$debug.="<br />Thumbnail created: <br />".$jsonArrayData['images']['large']['url'];
						
								}
						
								$debug.="<br />Artist created<br />".$post_id;
						
								$result .= '<p style="color:#02f; font-size:16px;">Artist created: '.$jsonArrayData['name'].'<br /><a href="'.get_permalink($post_id).'" target="_blank">Click here to see</a></p>';
						
								
						
							
						
								
						
							}else{
						
								$debug.="<p style='color:#F00'>Error, please retry
						
										</p>";
						
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



if(is_numeric($artistid)){

	echo getArtistFromBeatport($artistid);

}else{

	echo 'Bad Artist ID!';	

}


?>