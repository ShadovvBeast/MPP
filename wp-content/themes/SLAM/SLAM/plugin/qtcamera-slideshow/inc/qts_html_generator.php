<?php
	function getVimeoThumb($id,$size) {
		$jsonvimeo = wp_remote_get("http://vimeo.com/api/v2/video/".$id.".json");
		$body = $jsonvimeo['body'];
		$a = json_decode($body);
		return $a[0]->$size;
	}
	add_shortcode('qtslideshows','qtslideshows_add_slideshow');
	function qtslideshows_add_slideshow($atts){									
			$thumbsize['w'] = '150';
			$thumbsize['h'] = '80';
			$bigsize['w'] = '900';
			$bigsize['h'] = '350';
			extract( shortcode_atts( array(
				'id' => false,
			), $atts ) );
			if(!$id){echo '[Slideshow id not specified]'; return;};
			$slides = array();

			//= Retrive custom slides
			//========================================================
			$events = get_post_meta($id, QTS_PREFIX.'slider_images', true);  
			$maxheight = get_post_meta($id, QTS_PREFIX.'slideshow_maxheight', true);  
			//print_r($events); 
			if(is_array($events)){
				$n=0;
				foreach($events as $e){
					$big =  wp_get_attachment_url( $e[QTS_PREFIX.'slider_image']);
					$thumb =  wp_get_attachment_thumb_url( $e[QTS_PREFIX.'slider_image']);
					//return 
					$temparray = array(
						'big' =>  		$big,
						'link' =>  		$e[QTS_PREFIX.'slider_link'],
						'video_url' =>  $e[QTS_PREFIX.'video_url'],
						'thumb' =>		$thumb,
						'html' => 		$e[QTS_PREFIX.'slide_title'],
						'n' => 		$n
					);
					//print_r ($temparray);
					if($temparray['big'] != '' || $temparray['video_url'] != '' ){
						$slides[] = $temparray;
					}
					//print_r ($slides);
					$n++;		
				}
			}

			// = Retrive last posts
			//========================================================
			if(get_post_meta($id, QTS_PREFIX.'latestposts', true) == 1){ 
				$maxslides = get_post_meta($id, QTS_PREFIX.'elements_number', true)+1;
				$args = array(
				   'post_type'  => 'post',
				   'post_status'  => 'publish',
				   'posts_per_page' => $maxslides,
					'meta_query' => array(
						array(
						 'key' => '_thumbnail_id',
						 'compare' => 'EXISTS'
						),
					)
				);
				$posts_query = new WP_Query($args);
				global $post;
				while ($posts_query->have_posts()) : $posts_query->the_post();
					if( has_post_thumbnail()){
						if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $thumbsize['w'],$thumbsize['w']) )){
							$big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $bigsize['w'],$bigsize['w']) );    
							
							$temparray = array(
								'big' =>  $big[0],
								'thumb' => $thumb[0],
								'html' => get_the_title()
								);
		
							$video = get_post_meta($post->ID, QTS_PREFIX.'featured_video',true);
							if($video != ''){
								$temparray ['video_url'] = $video;
							}
		
							if($thumb!=''){
								$slides[] = $temparray;
							}
						}
					}
				endwhile; 
				wp_reset_query();
			}

			//_____________________________________ SECOND PART OF THE FUNCTION _____________________________________
			//_____________________________________ CREATING HTML CODE...
				
			if(count($slides)>0){
				$final='';
				foreach($slides as $data){
					$video ='';
					if(isset( $data['video_url'])){
						$video = $data['video_url'];
						$videourl = $video;
					}
					/* = if a video url has been iput
					===========================================================*/
					if($video!=''){
						//echo $video;
						if (preg_match ("/\b(?:youtube)\.com\b/i", $video)) {
							$path = parse_url($video, PHP_URL_PATH);
							$query = parse_url($video, PHP_URL_QUERY);
							parse_str($query, $args);
							$replace = '<iframe src="http://www.youtube.com/embed/'.$args['v'].'" width="100%" height="100%"  frameborder="0" allowfullscreen></iframe>';
							$data['video_url'] = $replace;
							$data['video_url'] = $replace;
							$data['big'] =  'http://img.youtube.com/vi/'.$args['v'].'/maxresdefault.jpg';
							$data['thumb'] =  'http://img.youtube.com/vi/'.$args['v'].'/default.jpg';
						}
						if (preg_match ("/vimeo\.com/i", $video)) {	
							$id = str_replace('/','',parse_url($video, PHP_URL_PATH));
							$replace = '<iframe src="http://player.vimeo.com/video/'.$id.'" width="100%" height="100%"  frameborder="0" allowfullscreen></iframe>';
							$data['video_url'] = $replace;
							$data['big'] = getVimeoThumb($id,'thumbnail_large');
							$data['thumb'] =getVimeoThumb($id,'thumbnail_small');
						}
					}
			
					/* = Final code
					===========================================================*/
					$link = '';
					if(isset($data['link'])){
						if($data['link'] != ''){
							$link = ' data-link="'.$data['link'].'" ';
						}
					}
					$html = '';
					if(isset($data['html'])){
						if($data['html'] != ''){
							$html = ' <div class="camera_caption fadeFromBottom">'.$data['html'].' </div>';
						}
					}
					$video_url = '';
					if(isset($data['video_url'])){
						if($data['video_url'] != ''){
							$video_url = 'videourl:'.$data['video_url'];
						}
					}
					$final .= '
						<div '.$link.' data-thumb="'.$data['thumb'].'" data-src="'.$data['big'].'">
							'.$html.'
							'.$video_url.'
						</div>
						';
		
				}// end of the foreach loop
		

				if($maxheight != ''){
					$css = 	'<style type="text-css"> .cameraslider-'.$id.' {height: '.$maxheight.' !important;display:none;} </style>';
				}else{
					$css = '';
				}
				return '<div 
				class="cameraslideshow-box camera_wrap qtslideshow" 
				data-filespath="'.get_template_directory_uri().'/plugin/qtcamera-slideshow/assets/images/'.'" 
				id="cameraslider-'.$id.'" 
				data-maxheight="'.$maxheight.'">'.$final.'</div><div class="canc"></div>'.$css;
		}//if(count($slides)>0){
	}// end of main function
?>