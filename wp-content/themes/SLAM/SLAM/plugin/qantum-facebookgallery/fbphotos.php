<?php
include ('editor/editor.php');

define ("FBGFOLDER",get_template_directory_uri());

/* = Get Picture List
============================================================*/
function fbgal_picture_list($gid = ''){	
	$gid = str_replace('https://www.facebook.com/media/set/?set=a.','',$gid);
	$gid = str_replace('http://www.facebook.com/media/set/?set=a.','',$gid);

	$garr = explode('.',$gid);
	$gid = $garr[0];
	
	if($gid==0 || !is_numeric($gid)){
		return false;
	}
	$galleryurl = 'http://graph.facebook.com/'.$gid;
	


	$url = $galleryurl.'/photos?fields=images,picture';

	//$url = 'http://www.google.it';

	if (function_exists('wp_remote_get'))
	{ 
		$response = wp_remote_get( $url );
		

		if( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   return  false;
		} else {
			//print_r ($response['body']);
			return ($response);

		}
	}
}

/* = Create Gallery HTML
============================================================*/
function fbgal_create_gallery($gallery=''){
	//return $gallery;
	if(!isset($gallery) || $gallery==''){
		return false;
	}
	$toreplace = array('_s.jpg','_s.png','_s.jpeg','_s.gif','p50x50','s130x130',	'/v/t1.0-9/',	'_n');
	$replacers = array('_n.jpg','_n.png','_n.jpeg','_n.gif','p800x800','p800x800',	'/',			'_o');
	
	$gallerylist = fbgal_picture_list($gallery);
	if(!isset($gallerylist) || $gallerylist=='' || $gallerylist == false){
		return false;
	}

	$obj = $gallerylist['body'];
	$list = json_decode($obj);
	$array = $list->data;


	

	if(is_array($array)){
		$html ='';
		$n=0;
		$t='';
		foreach($array as $photo){
			$pic = $photo->picture;
			



			//OLD //$link = /*$photo->images[0]->source;//*/str_replace($toreplace,$replacers,$pic);



			$link = $photo->images[0]->source;;

			$t .= '<dl class="gallery-item">
					<dt class="gallery-icon">
					<a href="'.$link.'" class="qw-squaredpic" title="">';
			$t .= '<img src="'.$pic.'" class="" id="'.$pic.'" alt="" />';
			$t .= '</a>
					</dt>
					</dl>
					';
			$n++;
		
		}
		$html = '<div class="gallery gallery-columns-3 gallery-size-thumbnail">'.$t.'<br style="clear: both;"></div>';
		//$html ='<ul class="gallerylist gallery-facebook">'.$html.'</ul>';		
	}
	return $html;
}



/* = Main function
============================================================*/
function fbgal_gimmet_gallery( $atts){
	extract( shortcode_atts( array(
		'id' => '0',
	), $atts ) );


	return fbgal_create_gallery($id);
}

add_shortcode('qtfbgal', 'fbgal_gimmet_gallery');



?>