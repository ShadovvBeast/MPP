<?php

define ('CUSTOM_TYPE_QTSLIDESHOW','qtslideshow');


function qtslideshow_register_type() {

	$labelsqtslideshow = array(
        'name' => __(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)).'s',
        'singular_name' => __(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)),
        'add_new' => 'Add New ',

        'add_new_item' => 'Add New '.__(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)),
        'edit_item' => 'Edit '.__(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)),
        'new_item' => 'New '.__(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)),
        'all_items' => 'All '.__(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)).'s',
        'view_item' => 'View '.__(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)),
        'search_items' => 'Search '.__(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)).'s',
        'not_found' =>  'No '.CUSTOM_TYPE_QTSLIDESHOW.' found',
        'not_found_in_trash' => 'No '.CUSTOM_TYPE_QTSLIDESHOW.'s found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => __(ucfirst(CUSTOM_TYPE_QTSLIDESHOW)).'s'
    );

  $args = array(
        'labels' => $labelsqtslideshow,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'page',
		'exclude_from_search' => true,
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => CUSTOM_PLUGIN_DIR.'assets/menu-icon.png',
    	'page-attributes' => true,
    	'show_in_nav_menus' => false,
    	'show_in_admin_bar' => true,
    	'show_in_menu' => true,
		'show_in_nav_menus' => false,
        'supports' => array('title','editor','page-attributes'/*,'post-formats'*/)
  ); 

   register_post_type( CUSTOM_TYPE_QTSLIDESHOW , $args );
	// register_taxonomy_for_object_type('category', CUSTOM_TYPE_QTSLIDESHOW);
	//add_theme_support( 'post-formats', array( 'gallery','status','video','audio' ) );

     include 'metaboxes.php';

}
add_action('init', 'qtslideshow_register_type');  


