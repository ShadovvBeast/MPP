<?php
/*
* custom post type Podcast
*/

define ('CUSTOM_TYPE_PODCAST','podcast');
add_action('init', 'podcast_register_type');  

function podcast_register_type() {
	$labelspodcast = array(
    'name' => __(ucfirst(CUSTOM_TYPE_PODCAST)).'s',
    'singular_name' => __(ucfirst(CUSTOM_TYPE_PODCAST)),
    'add_new' => 'Add New ',
    'add_new_item' => 'Add New '.__(ucfirst(CUSTOM_TYPE_PODCAST)),
    'edit_item' => 'Edit '.__(ucfirst(CUSTOM_TYPE_PODCAST)),
    'new_item' => 'New '.__(ucfirst(CUSTOM_TYPE_PODCAST)),
    'all_items' => 'All '.__(ucfirst(CUSTOM_TYPE_PODCAST)).'s',
    'view_item' => 'View '.__(ucfirst(CUSTOM_TYPE_PODCAST)),
    'search_items' => 'Search '.__(ucfirst(CUSTOM_TYPE_PODCAST)).'s',
    'not_found' =>  'No '.CUSTOM_TYPE_PODCAST.' found',
    'not_found_in_trash' => 'No '.CUSTOM_TYPE_PODCAST.'s found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => __(ucfirst(CUSTOM_TYPE_PODCAST)).'s'
  );

  $args = array(
    'labels' => $labelspodcast,
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
	 'menu_icon' => get_template_directory_uri() . '/custom-types/podcast/icon.png',
    'supports' => array('title', 'thumbnail','editor' )
  ); 

    register_post_type( CUSTOM_TYPE_PODCAST , $args );

	/* ============= create custom taxonomy for the podcasts ==========================*/

	 $labels = array(
    'name' => __( 'Podcast filters','labelpro' ),
    'singular_name' => __( 'Filter','labelpro' ),
    'search_items' =>  __( 'Search by filter','labelpro' ),
    'popular_items' => __( 'Popular filters','labelpro' ),
    'all_items' => __( 'All Podcasts','labelpro' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Filter','labelpro' ), 
    'update_item' => __( 'Update Filter','labelpro' ),
    'add_new_item' => __( 'Add New Filter','labelpro' ),
    'new_item_name' => __( 'New Filter Name','labelpro' ),
    'separate_items_with_commas' => __( 'Separate Filters with commas','labelpro' ),
    'add_or_remove_items' => __( 'Add or remove Filters','labelpro' ),
    'choose_from_most_used' => __( 'Choose from the most used Filters','labelpro' ),
    'menu_name' => __( 'Filters','labelpro' ),
  ); 

  register_taxonomy('filter','podcast',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'filter' ),
  ));

}


$podcast_details = array(
    
    array(
        'label' => 'Artist Name',      
        'id'    => '_podcast_artist',
        'type'  => 'text'
        ),
    array(
        'label' => 'Podcast Name',      
        'id'    => '_podcast_name',
        'type'  => 'text'
        ),
    array(
        'label' => 'Date',       
        'id'    => '_podcast_date',
        'type'  => 'text'
        ),
    array(
        'label' => 'Mixcloud, Soundcloud or MP3 url. ',        
        'id'    => '_podcast_resourceurl',
        'type'  => 'text'
        )
    
);

$details_box = new custom_add_meta_box( 'podcast_details', 'Details', $podcast_details, 'podcast', true );

