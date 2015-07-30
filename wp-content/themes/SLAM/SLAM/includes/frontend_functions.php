<?php

/*

	What is this?

	================================================================================

	This file contains the functions needed in some template files to generate 

	additional data or some filters for wordpress queries.

	This is loaded only for non-admin pages (front-end)

	Is loaded by functions.php

*/


function header_layout_balance($part=''){
	$balance = get_option( THEME_SHORTNAME . '_header_layout_balance' );	
	if($balance != ''){
		$ar= explode('/',$balance);
		if($part == 'logo'){
			return $ar[0];
		}else{
			return $ar[1];
		}
	}else{
		return '12';
	}
}




function qp_get_group( $group_name , $post_id = NULL ){
  global $post,$wpdb; 	
  if(!$post_id){ $post_id = $post->ID; }
  $post_meta_data = get_post_meta($post->ID, $group_name, true);  
  return $post_meta_data;
}






add_filter( 'the_category', 'fix_html5_error_by_wp' );
 
function fix_html5_error_by_wp( $text) {
    $text = str_replace('rel="category tag"', '', $text);
    return $text;
}




// Hide the admin bar if selected in admin panel



if ( get_option( THEME_SHORTNAME . '_hideadminbar' ) == 'hide' ) {



	add_filter( 'show_admin_bar', '__return_false' );



} 





// define a new excerpt length



add_filter( 'excerpt_length', 'my_excerpt_length' );

function my_excerpt_length( $length )
{
	return 25;
}



// define the text for excerpt read more link



add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $text )
{
	global $post;
	return ' <a href="'.get_permalink().'">Read more</a> ';
}



// create excerpts ==============================================



function create_excerpt_cont( $content )



{

	$queried_post_type = get_query_var('post_type');


	if ( !is_single() && !is_page() && !is_singular() && $queried_post_type == 'post' ) {



		$exploded = explode( '</p>', $content );



		return $exploded[ 0 ] . '</p>';



	} //!is_single() && !is_page() && !is_singular()



	else {



		return $content;



	}



}


if(get_option(THEME_SHORTNAME.'_do_excerpt') == 'Show Excerpt' || get_option(THEME_SHORTNAME.'_do_excerpt') == ''){
	add_action( 'the_content', 'create_excerpt_cont' );
}


// logo



function display_logo(){



	if(get_option('qp_logo_corporate')!=''){



		echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.get_option('qp_logo_corporate').'" class="qw_logo_top" alt="'.addslashes(get_bloginfo('name')).' Home" ></a>';



	}else{



		echo '<h2 class="qw_site_title"><a href="'.esc_url( home_url( '/' ) ).'">'.get_bloginfo('name').'</a></h2>';	



	}



}





// sidebar







function display_sidebar($name){







	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($name) ) :







	//	echo $name.' non supportata';







	endif; 







}











// create_detail_item: function used inside the theme to create page details



function create_detail_item( $name, $type, $value, $label, $params )



{



	$label = preg_replace( '/\(http:\/\/\.\.\.\)/', '', $label );



	switch ( $type ) {



		case "section":



			return '



				<h3>' . $label . '</h3>';



			break;



		case "text":



			return '



					<p class="qw-detail-section">



						<span class="qw-detail-label ' . $name . '">' . $label . ':</span>



						<span class="qw-detail-value ' . $name . '">' . $value . '</span>



						<span class="canc"></span>



					</p>



				';



			break;



		case "link":

			

			

			

			return '



					<p class="qw-detail-links">



						<span class="qw-detail-label ' . $name . '">' . $label . ':</span>



						<span class="qw-detail-value ' . $name . '"><a href="' . $value . '" rel="external nofollow">Visit</a></span>



						<span class="canc"></span>



					</p>



				';



			break;



		case "medialink":



			return '



				<div class="qw-detail-medialink ' . $name . ' ' . $params[ 'class' ] . ' ">



					<a href="' . $value . '" rel="external nofollow" class="">' . $value . '</a>



				</div>



			';



			break;



		case "textarea":



			return $value;



			break;



		case "separator":



			return '



									<div class="qw-separator"></div>





							';



			break;



	} //$type
}



// create_details: used in many templates, is needed to retrive some "post_meta". See function's arguments below to know how powerful it is.



function create_details( $postID, $custom_type, $filter = 'all', $params = array( ) ){
	include get_template_directory() . '/custom-types/' . $custom_type . '/vars.php';
	$return = '';
	foreach ( $fields as $f ) {
		$f[ 2 ] = get_post_meta( $postID, $f[ 0 ], true );
		if ( $filter == 'all' || $filter == $f[ 0 ] || $filter == $f[ 1 ] || $filter == $f[ 2 ] || $filter == $f[ 3 ] || $filter == $f[ 4 ] ) {
			if (  $f[ 2 ] != '' ) {
				$return .= create_detail_item( $f[ 0 ], $f[ 1 ], $f[ 2 ], $f[ 3 ], $params );
			} 
		} 
	} 
	return $return;
}



// get_artist_tracks: used in the artist's pages, is needed to automatically find all the tracks by this artist and create the link to the tracks in his page

if(!function_exists('get_artist_tracks')){
function get_artist_tracks( $name ){
	wp_reset_postdata();
	$result         = '';
	$args           = array(

		'post_type' => 'release',
		 'posts_per_page' => 200,
 		 'meta_query' => array(
				array(
					'key' => 'track_repeatable',
					'value' => $name,
					'compare' => 'LIKE'
				)
			)
	);
	$the_query_meta = new WP_Query( $args );
	global $post;
	while ( $the_query_meta->have_posts() ):
		$the_query_meta->the_post();
		setup_postdata( $post );
		if ( $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(
			 '100',
			'100' 
		) ) ) {

			$url       = $thumb[ '0' ];
			$thumbcode = '<img class="qw-artist-release-img" src="' . $url . '" alt="' . $post->post_title . '" />';
		} //$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '30', '30' ) )
		$result .= '<li><a href="' . get_permalink( $post->ID ) . '" class="qw-author-release fontface">' . $thumbcode . $post->post_title . '</a></li>';
	endwhile;
	wp_reset_postdata();
	return $result;
}}





// qw_permalink_by_name: this functions is needed to find the permalink to an artist by searching for specific post type with the name as title



function qw_permalink_by_name( $name, $posttype = 'artist' ){
	wp_reset_query();
	global $post;
	global $wpdb;
	if ( $page_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE ( post_name = \"" . ( $name ) . "\" or post_title = \"" . ( $name ) . "\" ) and post_status = 'publish' and post_type='" . $posttype . "' " ) ) {
		return get_permalink( $page_id );
	} //$page_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE ( post_name = \"" . ( $name ) . "\" or post_title = \"" . ( $name ) . "\" ) and post_status = 'publish' and post_type='" . $posttype . "' " )
	;
	//return get_permalink($page_id);
	wp_reset_query();
}


function sanitizeMagicfieldsExternalUrl( $url ){
	$urlar = explode( '://', $url );
	return 'http://' . $urlar[ count( $urlar ) - 1 ];
}

function addLikeButton( $url ){
	$html = '
	<div 
	class="fb-like" 
	data-href="' . $url . '" 
	data-send="'. get_option( THEME_SHORTNAME . 'qp_fb_data_send' ).'" 
	data-width="' . get_option( THEME_SHORTNAME . '_fb_data_width' ) . '" 
	data-layout="' . get_option( THEME_SHORTNAME . '_fb_data_layout' ) . '" 
	data-show-faces="' . get_option( THEME_SHORTNAME . '_fb_data_faces' ) . '" 
	data-action="' . get_option( THEME_SHORTNAME . '_fb_data_action' ) . '" 
	data-colorscheme="' . get_option( THEME_SHORTNAME . '_fb_data_colorscheme' ) . '" 
	data-font="' . get_option( THEME_SHORTNAME . '_fb_data_font' ) . '">
	</div>';
	//$html = '<div class="fb-like" data-href="http://qantumthemes.com/lp2/features/social-integration/" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-colorscheme="dark"></div>';
	return $html;
}

function addTweetButton( $url ){
	$html = '
	<div class="social-btn-container">
	<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
	</div>';
	return $html;
}

function addGplusButton( $url ){
	$html = '<div class="social-btn-container"><div class="g-plusone" data-size="tall" data-annotation="inline" data-width="200"></div></div>';
	return $html;
}




if ( get_option( THEME_SHORTNAME . '_homepage_slider' ) == 'enabled' && get_option( THEME_SHORTNAME . '_slider_name' ) == 'Bootstrap Slider' &&  get_option( THEME_SHORTNAME . '_slider_autoplay' ) == 'yes') {
function footer_bs_js( ){
		echo '	<script type="text/javascript">
				jQuery(window).load(function() {
					jQuery("#myCarousel").carousel();
				});
				</script>
		';
	}
	add_action( 'wp_footer', 'footer_bs_js',99999999 );
}


//================================ NIVO SLIDER ===========================================

// generates css and js links for nivo slider, if enabled





if (get_option( THEME_SHORTNAME . '_homepage_slider' ) == 'enabled' && get_option( THEME_SHORTNAME . '_slider_name' ) == 'Nivo Slider') {

	function footer_nivo_js()
	{
		echo '
			<script type="text/javascript">
			$(window).load(function() {
				$(\'#slider\').nivoSlider({
					effect: "' . get_option( THEME_SHORTNAME . '_nivoslider_fx' ) . '", 
					slices: 15, // For slice animations
					boxCols: 8, // For box animations
					boxRows: 4, // For box animations
					animSpeed: "' . get_option( THEME_SHORTNAME . '_nivoslider_animSpeed' ) . '", // Slide transition speed
					pauseTime: "' . get_option( THEME_SHORTNAME . '_nivoslider_pauseTime' ) . '", // How long each slide will show
					startSlide: 0, // Set starting Slide (0 index)
					directionNav: "' . get_option( THEME_SHORTNAME . '_nivoslider_directionNav' ) . '", // Next & Prev navigation
					directionNavHide: "' . get_option( THEME_SHORTNAME . '_nivoslider_directionNavHide' ) . '", // Only show on hover
					controlNav: "' . get_option( THEME_SHORTNAME . '_nivoslider_controlNav' ) . '", // 1,2,3... navigation
					controlNavThumbs: false, // Use thumbnails for Control Nav
					controlNavThumbsFromRel: false, // Use image rel for thumbs
					controlNavThumbsSearch: \'.jpg\', // Replace this with...
					controlNavThumbsReplace: \'_thumb.jpg\', // ...this in thumb Image src
					keyboardNav: true, // Use left & right arrows
					pauseOnHover: true, // Stop animation while hovering
					manualAdvance: false, // Force manual transitions
					captionOpacity: 0.8, // Universal caption opacity
					prevText: \'Prev\', // Prev directionNav text
					nextText: \'Next\', // Next directionNav text
					randomStart: false // Start on a random slide
				});
			});
			</script>';
	}
	add_action( 'wp_footer', 'footer_nivo_js',9999999999 );

} //get_option( THEME_SHORTNAME . '_homepage_slider' ) == 'enabled' && get_option( THEME_SHORTNAME . '_slider_name' ) == 'Nivo Slider'



//================================ CIRCULAR CONTENT CAROUSEL ===========================================
// hook to wp_head to include carousel css
if ( get_option( THEME_SHORTNAME . '_homepage_3boxcarousel' ) == 'enabled' ) {
	// wp_reset_query();
	function create_carousel_styles( )
	{
		$stylesheets_to_load = array(
			 array(
				 '3BOXCUSTOM',
				THEMEURL . '/includes/CircularContentCarousel/css/style-customized.css',
				false,
				THEMEVERSION,
				'screen' 
			),
			array(
				 '3BOXSCROLLPANEL',
				THEMEURL . '/includes/CircularContentCarousel/css/jquery.jscrollpane.css',
				false,
				THEMEVERSION,
				'screen' 
			) 
		);
		foreach ( $stylesheets_to_load as $a ) {
			wp_register_style( $a[ 0 ], $a[ 1 ] , false, $a[ 3 ] );
			if(isset($a[ 5 ])){
				$GLOBALS['wp_styles']->add_data( $a[ 0 ], 'conditional', $a[ 5 ]);
			}
			wp_enqueue_style( $a[ 0 ] );
		} //$stylesheets_to_load as $a
	}
	add_action( 'wp_head', 'create_carousel_styles' );
} //get_option( THEME_SHORTNAME . '_homepage_3boxcarousel' ) == 'enabled'





//====================================== creation of social icons in the artist pages =======================

 function social_link_icons($id){
	$res = '';
	$links_array=array(  
		'_artist_website' 	=> 'icon-home',
		'_artist_facebook'	=>'lpicon-facebook',
		'_artist_beatport'	=>'lpicon-beatport',
		'_artist_soundcloud'=>'lpicon-soundcloud',
		'_artist_mixcloud'	=>'lpicon-mixcloud',
		'_artist_myspace'	=>'lpicon-myspace',
		'_artist_residentadv'=>'lpicon-radvisor',
		'_artist_twitter'	=>'lpicon-tw'
	);		
	foreach ($links_array as $l => $r){
		$valore = get_post_meta( 
								$id,  
								$l, 
								true 
								);
		if($valore!=''){
			$res .= '<li><a target="_blank" href="'.$valore.'" class="icon '.$r.' qw-disableembedding" ></a></li>';
		}
	}
	return $res;
}





//=============================== creation of metadata in header ===================

function createMetadata($postid){
		
		$returnvar = '';
		$returnvar .= "\n";		
		$returnvar .= '<meta property="og:title" content="' . get_the_title($postid) . '"/>';
		$returnvar .= "\n";
 
		/* if(is_post_type( 'release' )){
			 $type = 'music.song';
		 }else{
			  $type = 'article';
		 }*/
 

 	
       
		
		
 $returnvar .= "\n";
        $returnvar .= '<meta property="og:url" content="' . get_permalink($postid) . '"/>';
 $returnvar .= "\n";
        $returnvar .= '<meta property="og:site_name" content="'.get_bloginfo( 'name' ).'"/>';
	 $returnvar .= "\n";	
		if(has_post_thumbnail( $postid )) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'medium' );
        	$returnvar .= '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		}
	
		
		$returnvar .= "\n";		
		$mp3 = get_post_meta($postid,'releasetrack_mp3_demo',true) ;
		if($mp3 != ''){
			$returnvar .= '<meta property="og:og:audio" content="' . $mp3  . '"/>';
			 $type = 'music.song';
		}else{
			 $type = 'article';	
		}
		
		 $returnvar .= '<meta property="og:type" content="'.$type.'"/>';
	
		return $returnvar;
}



?>