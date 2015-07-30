<?php
/*

	Connected to Qwantum theme, this action import all mixcloud channels into custom post type "podcast"

*/


// CREARE VARIANTE SINGOLO PODCAST 
//http://api.mixcloud.com/USERNAME/PODCAST/



echo '<h1>In Action</h1>';
$id = trim($action_argument);
echo createpostsMixcloud('http://api.mixcloud.com/'.$id.'/cloudcasts/?limit=500');

function createpostsMixcloud($feedurl_json){
		$functionResult = '';
		$response = wp_remote_get( $feedurl_json );
		if( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   echo('Sorry: the name is wrong or your server can\'t reach the Mixcloud service');
		   return;
		} else {
			$miofile= $response ['body'];
		}
		$json_a=json_decode($miofile, true); 
		$quantisono=0;
		$testreturn = '';
		foreach($json_a['data'] as $p)

		{		
			//if( $p['type'] == 'upload' && $p['from']['name'] != ''){			
				//$nodeType 		= $p['type'];
				$url			= $p['url'];
				$picture 		= $p['pictures']['large'];
				$picture_med	= $p['pictures']['medium'];
				$name 			= $p['name'];
				$artist 		= $p['user']['name'];
				$created_time 	= $p['created_time'];
				$artistpicture 	= $p['user']['pictures']['large'];
				$artags 		= $p['tags'];
				$tags			= '';
				$to_replace_in_date = array("T","Z");
				$realdate = str_replace($to_replace_in_date, " ", $created_time);

				$quantisono ++;
				$tp =0;
				$postexixts = 	post_exists_by_title ($name);										
				if($postexixts > 0){
					$tp =1;
					echo '<br /><font color="#FF0000">Podcast already added:</font> '.$postexixts.'<br />';	
				}
				if(!$picture || $picture=='' || $picture==NULL || !isset($picture)){
					$tp =1;
				}

				if($tp==0 && $picture!='' && $picture != NULL ){					
						$response = wp_remote_get( $feedurl_json );
						if( is_wp_error( $response ) ) {
						   $error_message = $response->get_error_message();
						   echo('Sorry: the name is wrong or your server can\'t reach the Mixcloud service');
						   return;
						} else {
							$resp= $response ['response']['code'];
						}
						//$testreturn .= $headers[0].'<br />';
						if($resp=='200'){
										$temp = explode('extaudio/',$picture);
										$temp2 = explode('.jpg',$temp[1]);
										$uid = $temp2[0];	
										$artags = $p['tags'];
										for($n=0; $n<count($artags); $n++){
											$tags .= $p['tags'][$n]['name'].',';
										}
										
										$feedurl = urlencode($url);
										$debugResult ='<br />
													- FEED : '.$feedurl.
												'<br />
													- NAME : '.$name.
												'<br />
													- PICTURE : '.$picture.
												'<br />
													- ARTIST NAME : '.$artist.
												'<br />
													- ARTIST PICTURE : '.$artistpicture.
												'<br />
													- TAGS : '.$tags;
										$embedding_code='<a href="'.urlencode($feedurl).'" class="qw_mixcloud_podcast_embed"></a>';
										$postcontent = '';													
										if($feedurl != ''){ 
											$new_post = array(
											 'post_title' => addslashes($name),
											 'post_name' => sanitize_title_with_dashes($name),
											 'post_content' => addslashes($postcontent),
											 'post_status' => 'publish',
											 'post_date' => $realdate,
											 'post_type' => 'podcast',
											/* 'tags_input' => addslashes($tags),*/
											 'tax_input' => array('filter' => addslashes($tags)),
											 'filter' => true
											);															
											kses_remove_filters();
											if($post_id = wp_insert_post($new_post)){ // insert post to database
												if(!set_featuredimage_by_url($picture,$post_id)){
													$errors++;	
													$functionResult .= 	 '<br />Impossible to set featured image';
												}
												add_post_meta( $post_id, '_podcast_artist', $artist ); 
												add_post_meta( $post_id, '_podcast_name', $name );
												add_post_meta( $post_id, '_podcast_date', $created_time );
												add_post_meta( $post_id, '_podcast_resourceurl', $url );
												add_post_meta( $post_id, '_podcast_picture', $picture );
												add_post_meta( $post_id, '_podcast_artistpicture', $artistpicture );
												$functionResult .= '<p style="color:#0f0">Podcast created: '.$post_id.' - '.$name.'</p>'; 
											}	else{
												$functionResult .= '<p style="color:#f00">Error creating post '.$name.'</p>'; 
											}
											kses_init_filters();
										}else{
											$functionResult .= 	'ERROR in content with '.$name;
										}
						}//end if http response
				}
		}	

		return $functionResult;
}


?>