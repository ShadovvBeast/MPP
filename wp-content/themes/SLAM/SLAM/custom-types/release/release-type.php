<?php

/* = custom post type release
===================================================*/


define ('CUSTOM_TYPE_RELEASE','release');
add_action('init', 'release_register_type');  


function release_register_type() {

   
	
	$labelsrelease = array(
		'name' => esc_attr__("Releases","labelpro").'s',
		'singular_name' => esc_attr__("Release","labelpro"),
		'add_new' => 'Add new release',
		'add_new_item' => 'Add new '.esc_attr__("release","labelpro"),
		'edit_item' => 'Edit '.esc_attr__("release","labelpro"),
		'new_item' => 'New '.esc_attr__("release","labelpro"),
		'all_items' => 'All '.esc_attr__("release","labelpro"),
		'view_item' => 'View '.esc_attr__("release","labelpro"),
		'search_items' => 'Search '.esc_attr__("Releases","labelpro"),
		'not_found' =>  'No '.esc_attr__("release","labelpro").' found',
		'not_found_in_trash' => 'No '.esc_attr__("release","labelpro").' found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => esc_attr__("Releases","labelpro").'s'
	);
	$args = array(
		'labels' => $labelsrelease,
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
		'page-attributes' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_menu' => true,
		'menu_icon' => get_template_directory_uri() . '/custom-types/release/icon.png',
		'supports' => array('title', 'thumbnail','editor' )
	); 
    register_post_type( CUSTOM_TYPE_RELEASE , $args );



	/* ============= create custom taxonomy for the releases ==========================*/
	 $labels = array(
    'name' => esc_attr__( 'Release genres','labelpro' ),
    'singular_name' => esc_attr__( 'Genre','labelpro' ),
    'search_items' =>  esc_attr__( 'Search by genre','labelpro' ),
    'popular_items' => esc_attr__( 'Popular genres','labelpro' ),
    'all_items' => esc_attr__( 'All releases','labelpro' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => esc_attr__( 'Edit genre','labelpro' ), 
    'update_item' => esc_attr__( 'Update genre','labelpro' ),
    'add_new_item' => esc_attr__( 'Add New genre','labelpro' ),
    'new_item_name' => esc_attr__( 'New genre Name','labelpro' ),
    'separate_items_with_commas' => esc_attr__( 'Separate genres with commas','labelpro' ),
    'add_or_remove_items' => esc_attr__( 'Add or remove genres','labelpro' ),
    'choose_from_most_used' => esc_attr__( 'Choose from the most used genres','labelpro' ),
    'menu_name' => esc_attr__( 'genres','labelpro' ),
  ); 

  register_taxonomy('genre','release',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genre' ),

  ));

}




/* = Fields
===================================================*/



$prefix = 'track_';

$fields = array(
	
	array( // Repeatable & Sortable Text inputs
		'label'	=> 'Release Tracks', // <label>
		'desc'	=> 'Add one for each track in the release', // description
		'id'	=> $prefix.'repeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'featured' => 'meta_box_santitize_boolean',
			'title' => 'sanitize_text_field',
			'desc' => 'wp_kses_data'
		),
		
		'repeatable_fields' => array ( // array of fields to be repeated
			'releasetrack_track_title' => array(
				'label' => 'Title',
				'id' => 'releasetrack_track_title',
				'type' => 'text'
			),
			'releasetrack_artist_name' => array(
				'label' => 'Artists',
				'desc'	=> '(All artists separated bu comma)', // description
				'id' => 'releasetrack_artist_name',
				'type' => 'text'
			),
			'releasetrack_mp3_demo' => array(
				'label' => 'MP3 Demo',
				'desc'	=> '(Never upload your full quality tracks, someone can steal them)', // description
				'id' => 'releasetrack_mp3_demo',
				'type' => 'file'
			),
			'releasetrack_soundcloud_url' => array(
				'label' => 'Soundcloud or Youtube',
				'desc'	=> 'Will be transformed into an embedded player in the release page', // description
				'id' 	=> 'releasetrack_scurl',
				'type' 	=> 'text'
			),
			'releasetrack_buy_url' => array(
				'label' => 'Track Buy link',
				'desc'	=> 'A link to buy the single track', // description
				'id' 	=> 'releasetrack_buyurl',
				'type' 	=> 'text'
			),
			'exclude_from_playlist' => array(
				'label' => 'Exclude from Playlist',
				'desc'	=> 'Check to exclude', // description
				'id' 	=> 'exclude',
				'type' 	=> 'checkbox'
			)
			
	
		)
	)
);



$fields_links = array(
	
	array( // Repeatable & Sortable Text inputs
		'label'	=> 'Custom Buy Links', // <label>
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
				'label' => 'Custom Buy Text',
				'desc'	=> '(example: Itunes, Beatport, Trackitdown)',
				'id' => 'cbuylink_anchor',
				'type' => 'text'
			),
			'custom_buylink_url' => array(
				'label' => 'Custom Buy URL ',
				'desc'	=> '(example: http://...)', // description
				'id' => 'cbuylink_url',
				'type' => 'text'
			)
		)
	)
);
			
$track_details = array(
	
	array(
		'label' => 'Record label',		
		'id'    => 'general_release_details_label',
		'type'  => 'text'
		),
	array(
		'label' => 'Release date',		
		'id'    => 'general_release_details_release_date',
		'type'  => 'text'
		),
	array(
		'label' => 'Main "buy" link',		
		'id'    => 'general_release_details_buy_link',
		'type'  => 'text'
		),
	array(
		'label' => 'Catalog Number',		
		'id'    => 'general_release_details_catalognumber',
		'type'  => 'text'
		),
	array(
		'label' => 'Add to custom Playlist',
		'desc'	=> 'Check to add', // description
		'id' 	=> 'add_to_custom_playlist',
		'type' 	=> 'checkbox'
	)
	
);

$details_box = new custom_add_meta_box( 'release_details', 'Details', $track_details, 'release', true );
$sample_box = new custom_add_meta_box( 'release_tracks', 'Tracks', $fields, 'release', true );
$buylinks_box = new custom_add_meta_box( 'release_buylinkss', 'Custom buy links', $fields_links, 'release', true );



