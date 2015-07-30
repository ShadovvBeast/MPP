<?php

define ('CUSTOM_TYPE_EVENT','event');
define ('EVENT_PREFIX','event');
define ( 'CUSTOM_PLUGIN_DIR_EVENTS', get_template_directory_uri() . '/custom-types/qt-events/' );

/* = import CSS and JS for ADMIN
==========================================================================*/
add_action( 'admin_enqueue_scripts', 'enqueue_qtevents_scripts' );
function enqueue_qtevents_scripts() {	
	
	global $post_type;
    if ( get_current_post_type() == CUSTOM_TYPE_EVENT ) {
		//require_once('inc/metaboxes/meta_box.php');// no, lo prende già il tema!!
		wp_enqueue_script( 'script-events', CUSTOM_PLUGIN_DIR_EVENTS.'/script-admin.js','jquery' , '1.0.0',true);
	}
	/*
	wp_register_style( 'qtbtimpstyle', get_stylesheet_directory_uri().'/plugin/qt-beatport-importer/lib/style.css', false, '1.0.0' );
	wp_enqueue_style( 'qtbtimpstyle' );
   
    wp_localize_script( 'qtbtimpscript', 'Qtbtimpscript', array(
        'ajaxurl' => get_stylesheet_directory_uri().'/plugin/qt-beatport-importer/lib/main.js',
        'nonce' => wp_create_nonce( 'qtbtimpscript-nonce' )
    ) );
*/
}

/* = main function 
=========================================*/

function event_register_type() {

	$labelsevent = array(
        'name' => esc_attr__(ucfirst(CUSTOM_TYPE_EVENT)).'s',
        'singular_name' => esc_attr__(ucfirst(CUSTOM_TYPE_EVENT)),
        'add_new' => 'Add New ',
        'add_new_item' => 'Add New '.__(ucfirst(CUSTOM_TYPE_EVENT)),
        'edit_item' => 'Edit '.__(ucfirst(CUSTOM_TYPE_EVENT)),
        'new_item' => 'New '.__(ucfirst(CUSTOM_TYPE_EVENT)),
        'all_items' => 'All '.__(ucfirst(CUSTOM_TYPE_EVENT)).'s',
        'view_item' => 'View '.__(ucfirst(CUSTOM_TYPE_EVENT)),
        'search_items' => 'Search '.__(ucfirst(CUSTOM_TYPE_EVENT)).'s',
        'not_found' =>  'No '.CUSTOM_TYPE_EVENT.' found',
        'not_found_in_trash' => 'No '.CUSTOM_TYPE_EVENT.'s found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => esc_attr__(ucfirst(CUSTOM_TYPE_EVENT)).'s'
    );

  $args = array(
        'labels' => $labelsevent,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
         'menu_icon' => CUSTOM_PLUGIN_DIR_EVENTS.'assets/menu-icon.png',
    	'page-attributes' => true,
    	'show_in_nav_menus' => true,
    	'show_in_admin_bar' => true,
    	'show_in_menu' => true,
        'supports' => array('title','thumbnail','editor','page-attributes'/*,'post-formats'*/)
  ); 

    register_post_type( CUSTOM_TYPE_EVENT , $args );
  
    //add_theme_support( 'post-formats', array( 'gallery','status','video','audio' ) );
	
	 $labels = array(
		'name' => esc_attr__( 'Event type','labelpro' ),
		'singular_name' => esc_attr__( 'Types','labelpro' ),
		'search_items' =>  esc_attr__( 'Search by genre','labelpro' ),
		'popular_items' => esc_attr__( 'Popular genres','labelpro' ),
		'all_items' => esc_attr__( 'All events','labelpro' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Type','labelpro' ), 
		'update_item' => esc_attr__( 'Update Type','labelpro' ),
		'add_new_item' => esc_attr__( 'Add New Type','labelpro' ),
		'new_item_name' => esc_attr__( 'New Type Name','labelpro' ),
		'separate_items_with_commas' => esc_attr__( 'Separate Types with commas','labelpro' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove Types','labelpro' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used Types','labelpro' ),
		'menu_name' => esc_attr__( 'Types','labelpro' ),
	  ); 

	  register_taxonomy('eventtype','event',array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'eventtype' ),
	  ));




	  $labelsa = array(
		'name' => esc_attr__( 'Event area','labelpro' ),
		'singular_name' => esc_attr__( 'Areas','labelpro' ),
		'search_items' =>  esc_attr__( 'Search by area','labelpro' ),
		'popular_items' => esc_attr__( 'Popular areaa','labelpro' ),
		'all_items' => esc_attr__( 'All areaa','labelpro' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_attr__( 'Edit Area','labelpro' ), 
		'update_item' => esc_attr__( 'Update Area','labelpro' ),
		'add_new_item' => esc_attr__( 'Add New Area','labelpro' ),
		'new_item_name' => esc_attr__( 'New Type Area','labelpro' ),
		'separate_items_with_commas' => esc_attr__( 'Separate areas with commas','labelpro' ),
		'add_or_remove_items' => esc_attr__( 'Add or remove areas','labelpro' ),
		'choose_from_most_used' => esc_attr__( 'Choose from the most used areas','labelpro' ),
		'menu_name' => esc_attr__( 'areas','labelpro' ),
	  ); 

	  register_taxonomy('eventarea','event',array(
		'hierarchical' => true,
		'labels' => $labelsa,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'eventarea' ),
	  ));




    $prefix = EVENT_PREFIX;
    $fields = array(
		 array(
			'label' => 'Date',
			'id'    => EVENT_PREFIX . 'date',
			'type'  => 'date'
		),
		array(
			'label' => 'Street',
			'id'    => EVENT_PREFIX . 'street',
			'type'  => 'text'
		),
		 array(
			'label' => 'City',
			'id'    => EVENT_PREFIX . 'city',
			'type'  => 'text'
		),
		array(
			'label' => 'CAP',
			'id'    => EVENT_PREFIX . 'cap',
			'type'  => 'text'
		), 
		 array(
			'label' => 'Coordinates',
			  'desc'  => 'In google maps do a right click on the event and click "what\'s here" than copy coords from the search box.<br /><br>
			Coords must be written like this: 38.900867,1.419283', // description
			'id'    => EVENT_PREFIX . 'coord',
			'type'  => 'text'
		),

		array(
			'label' => 'Website',
			'id'    => EVENT_PREFIX . 'website',
			'type'  => 'text'
		),
		array(
			'label' => 'Location',
			'id'    => EVENT_PREFIX . 'location',
			'type'  => 'text'
		),
		 array(
			'label' => 'Phone',
			'id'    => EVENT_PREFIX . 'phone',
			'type'  => 'text'
		),
		  array(
			'label' => 'Facebook Event Link',
			'id'    => EVENT_PREFIX . 'facebooklink',
			'type'  => 'text'
		),
		array(
			'label' => 'Add Facebook Event Comments',
			'desc'  => 'Check if you want to add a Facebook comment form',
			'id'    => $prefix . 'fbcomments',
			'type'  => 'checkbox',
			'sanitizer' => 'meta_box_santitize_boolean'
		),
		
		array( // Repeatable & Sortable Text inputs
			'label'	=> 'Ticket Buy Links', // <label>
			'desc'	=> 'Add one for each link to external websites', // description
			'id'	=> $prefix.'repeatablebuylinks', // field id and name
			'type'	=> 'repeatable', // type of field
			'sanitizer' => array( // array of sanitizers with matching kets to next array
				'featured' => 'meta_box_santitize_boolean',
				'title' => 'sanitize_text_field',
				'desc' => 'wp_kses_data'
			),
			'repeatable_fields' => array ( // array of fields to be repeated
				'custom_buylink_anchor' => array(
					'label' => 'Ticket Buy Text',
					'desc'	=> '(example: This website, or Ticket One, or something else)',
					'id' => 'cbuylink_anchor',
					'type' => 'text'
				),
				'custom_buylink_url' => array(
					'label' => 'Ticket Buy URL ',
					'desc'	=> '(example: http://...)', // description
					'id' => 'cbuylink_url',
					'type' => 'text'
				)
			)
		)                       
    );
	

	

    if(post_type_exists(CUSTOM_TYPE_EVENT)){

        if(function_exists('custom_meta_box_field')){
            $sample_box 		= new custom_add_meta_box(CUSTOM_TYPE_EVENT, ucfirst(CUSTOM_TYPE_EVENT).' details', $fields, CUSTOM_TYPE_EVENT, true );
        			}

        function event_admin_init(){
			// wp_enqueue_script(wp_enqueue_script("googlemaps", "http://maps.googleapis.com/maps/api/js?sensor=false", 'jquery', '1.0',true));   
          	// wp_enqueue_script(wp_enqueue_script("mobilegmap", get_template_directory_uri()."/custom-types/events/jquery.mobilegmap.min.js", 'jquery', '1.0',true));   
           	// wp_enqueue_script(wp_enqueue_script("mobilegmap-script", get_template_directory_uri()."/custom-types/events/script.js", 'jquery', '1.0',true));   
			// wp_enqueue_script('jquery-ui-datepicker');
        	 wp_enqueue_style('style-event', get_template_directory_uri()."/custom-types/qt-events/style-event.css");
        }
		
        add_action('wp_enqueue_scripts', 'event_admin_init');
		
    }
	
}

add_action('init', 'event_register_type');  

/* = Visualization
========================================================*/
function do_eventmap($coord,$title){
			$latlong = explode(',',$coord);
			return "
			<h2 class=\"qw_event_title\">Event Map</h2>
			 <script type=\"text/javascript\" src=\"http://maps.google.com/maps/api/js?sensor=false&marker=yes\"></script>
				<div id=\"map\" class=\"qtevent_map\" style=\"width: 100%; height: 370px\"></div> 
				<script type=\"text/javascript\" id=\"qteventscript\" >
				var mylat = ".$latlong[0].";
				var mylon = ".$latlong[1].";
				var nomesede = \"".addslashes($title)."\";
				var locations = [
				  [nomesede, mylat, mylon, 4]
				];
				var map = new google.maps.Map(document.getElementById('map'), {
				  zoom: 16, center: new google.maps.LatLng(mylat, mylon), mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				var infowindow = new google.maps.InfoWindow();
				var marker, i;
			
				for (i = 0; i < locations.length; i++) {  
				  marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map
				  });
				  google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
					  infowindow.setContent(locations[i][0]);
					  infowindow.open(map, marker);
					}
				  })(marker, i));
				}
			  </script>";
		}
function do_eventcomments($link){
	return '<div class="fb-comments" data-href="'.$link.'" data-numposts="5" data-width="100%" data-colorscheme="dark"></div>';
//	return '<h2 class=\"qw_event_title\">Comments</h2><div id="fb-root"></div><div class="eventcomments"><script src="http://connect.facebook.net/'.get_bloginfo( 'language' ).'/all.js#appId=187479484629057&amp;xfbml=1"></script><fb:comments href="'.$link.'" num_posts="100" width="550"></fb:comments></div>';

}



function add_event_fields_in_content($content){
	
		global $post;
		if($post){
			$id = $post -> ID;
			
			if(get_post_type( $id ) != CUSTOM_TYPE_EVENT){
				return $content;
			}
			
			$street = get_post_meta($id,EVENT_PREFIX . 'street',true); 
			$city = get_post_meta($id,EVENT_PREFIX . 'city',true); 
			$cap = get_post_meta($id,EVENT_PREFIX . 'cap',true); 
			$website = get_post_meta($id,EVENT_PREFIX . 'website',true); 
			$phone = get_post_meta($id,EVENT_PREFIX . 'phone',true); 
			$coord = get_post_meta($id,EVENT_PREFIX . 'coord',true); 
			$location = get_post_meta($id,EVENT_PREFIX . 'location',true); 
			$date = get_post_meta($id,EVENT_PREFIX . 'date',true); 
			$facebooklink = get_post_meta($id,EVENT_PREFIX . 'facebooklink',true); 
			$fbcomments = get_post_meta($id,EVENT_PREFIX . 'fbcomments',true); 
			$title = get_the_title($id);
			$map = '';
			
			if($city!=''){
				$map = 	'
						<div class="gmap" id="map" data-center="'.$street.' '.$city.'" data-zoom="15">
							<address>
							  <strong>'.get_the_title($id).'</strong><br />
							  '.$street.'<br />
							  '.$cap.' '.$city.'
							</address>
						  </div>';
			}

			$details = '
			<h2 class="qw_event_title ">Event Details</h2>
			<table class="table eventtable" cellpadding:"0" cellspacing="0" >
					<tbody>
							'.(($date!='') ? '<tr><th>Date:</th> <td>'.$date.'</th></tr>' : '').'
							'.(($location!='') ? '<tr><th>Location:</th> <td>'.$location.'</td></tr>' : '').'
							'.(($street!='' || $city!='') ? '<tr><th>Address:</th> <td> '.$street.' -  '.$cap.' '.$city.'</td></tr>' : '').'
							'.(($phone!='') ? '<tr><th>Phone:</th> <td>'.$phone.'</td></tr>' : '').'
							'.(($website!='') ? '<tr><th>Website:</th> <td><a href="'.$website.'" target="_blank" rel="external nofollow">'.$website.'</a>'.'</td></tr>' : '').'
							'.(($facebooklink!='') ? '<tr><th>Event:</th> <td><a href="'.$facebooklink.'" target="_blank" rel="external nofollow">'.$facebooklink.'</a>'.'</td></tr>' : '').'

					</tbody>
			</table>';
			
			

			// update from V2: multiple buy link
			$buylinks = '<p class="buylinks">';
			$eventslinks= qp_get_group(EVENT_PREFIX.'repeatablebuylinks',$id); 	 
			
			if(is_array($eventslinks)){
				if(count($eventslinks)>0){
					foreach($eventslinks as $e){ 
						if(isset($e['cbuylink_url'])){
							if($e['cbuylink_url']!=''){
								$buylinks .= '
								<a href="'.$e['cbuylink_url'].'" class="btn btn-info btn-small qw-buy-link custombuylink">
								 <i class="icon-shopping-cart icon-white"></i>
								 Buy on '.$e['cbuylink_anchor'].'</a>
								';
							}
						}
					}
				}
			}
			$buylinks .= '</p>';
			//echo $buylinks;
								
			if(is_single()){
				return $buylinks.$details.$content.(($coord!='') ? do_eventmap($coord,$title):'').(($fbcomments!='') ? do_eventcomments(get_permalink($post->ID)):'');
			}else{
				return $content.$buylinks;	
			}
		}
}

if(!is_admin()){
	add_filter ('the_content','add_event_fields_in_content');
}

include 'widget.php';
include 'eventslist_by_date.php';
include 'shortcode.php';