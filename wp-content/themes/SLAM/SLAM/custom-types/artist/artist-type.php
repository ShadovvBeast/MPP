<?php
define ('CUSTOM_TYPE_ARTIST','artist');
add_action('init', 'artist_register_type');  
function artist_register_type() {
	$name = CUSTOM_TYPE_ARTIST;
	
	$labels = array(
		'name' => __(ucfirst($name)).'s',
		'singular_name' => __(ucfirst($name)),
		'add_new' => 'Add New ',
		'add_new_item' => 'Add New '.__(ucfirst($name)),
		'edit_item' => 'Edit '.__(ucfirst($name)),
		'new_item' => 'New '.__(ucfirst($name)),
		'all_items' => 'All '.__(ucfirst($name)).'s',
		'view_item' => 'View '.__(ucfirst($name)),
		'search_items' => 'Search '.__(ucfirst($name)).'s',
		'not_found' =>  'No '.$name.' found',
		'not_found_in_trash' => 'No '.$name.'s found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => __(ucfirst($name)).'s'
	);
	

		
    $args = array(
        'labels' => $labels,
        'singular_label' => __(ucfirst(CUSTOM_TYPE_ARTIST)),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'page',
		'has_archive' => true,
		'publicly_queryable' => true,
		'rewrite' => true,
		'query_var' => true,
		'exclude_from_search' => false,
		'can_export' => true,
        'hierarchical' => false,
		'page-attributes' => true,
		'menu_icon' => get_template_directory_uri() . '/custom-types/artist/icon.png',
        'supports' => array('title', 'thumbnail','editor', 'page-attributes' )

    );  
    register_post_type( CUSTOM_TYPE_ARTIST , $args );
	
	$labels = array(
		'name' => __( 'Artist genres','labelpro' ),
		'singular_name' => __( 'Genres','labelpro' ),
		'search_items' =>  __( 'Search by genre','labelpro' ),
		'popular_items' => __( 'Popular genres','labelpro' ),
		'all_items' => __( 'All Artists','labelpro' ).'s',
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Genre','labelpro' ), 
		'update_item' => __( 'Update Genre','labelpro' ),
		'add_new_item' => __( 'Add New Genre','labelpro' ),
		'new_item_name' => __( 'New Genre Name','labelpro' ),
		'separate_items_with_commas' => __( 'Separate Genres with commas','labelpro' ),
		'add_or_remove_items' => __( 'Add or remove Genres','labelpro' ),
		'choose_from_most_used' => __( 'Choose from the most used Genres','labelpro' ),
		'menu_name' => __( 'Genres','labelpro' )
	); 
	register_taxonomy('artistgenre','artist',array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'artistgenre' )
	));
}








$artist_tab_1 = array(
    
    array(
        'label' => 'Nationality',    
        'id'    => '_artist_nationality',
        'type'  => 'text'
        ),
    array(
        'label' => 'Resident in',      
        'id'    => '_artist_resident',
        'type'  => 'text'
        ),
    array(
        'label' => 'Agency',       
        'id'    => '_artist_booking_contact_name',
        'type'  => 'text'
        ),
    array(
        'label' => 'Phone ',        
        'id'    => '_artist_booking_contact_phone',
        'type'  => 'text'
        ),
     array(
        'label' => 'Email ',        
        'id'    => '_artist_booking_contact_email',
        'type'  => 'text'
        ),
     array(
        'label' => 'Header Image ',        
        'id'    => '_artist_headerimage',
        'type'  => 'image'
        )
);

$artist_tab_1_box = new custom_add_meta_box( 'artist_tab_1', 'Booking details', $artist_tab_1, 'artist', true );



$artist_tab_2 = array(
    array(
        'label' => 'Website',  
        'id'    => '_artist_website',
        'type'  => 'text'
        ),
    array(
        'label' => 'Facebook',      
        'id'    => '_artist_facebook',
        'type'  => 'text'
        ),
    array(
        'label' => 'Beatport',       
        'id'    => '_artist_beatport',
        'type'  => 'text'
        ),
    array(
        'label' => 'Soundcloud ',        
        'id'    => '_artist_soundcloud',
        'type'  => 'text'
        ),
    array(
        'label' => 'Mixcloud ',        
        'id'    => '_artist_mixcloud',
        'type'  => 'text'
        ),
    array(
        'label' => 'Myspace ',        
        'id'    => '_artist_myspace',
        'type'  => 'text'
        ),
    array(
        'label' => 'Resident Advisor ',        
        'id'    => '_artist_residentadv',
        'type'  => 'text'
        ),
    array(
        'label' => 'Twitter ',        
        'id'    => '_artist_twitter',
        'type'  => 'text'
        )
);

$artist_tab_2_box = new custom_add_meta_box( 'artist_tab_2', 'Link details', $artist_tab_2, 'artist', true );






$artist_tab_3 = array(
    array(
        'label' => 'Youtube video 1',  
        'id'    => '_artist_youtubevideo1',
        'type'  => 'text'
        ),
    array(
        'label' => 'Youtube video 2',      
        'id'    => '_artist_youtubevideo2',
        'type'  => 'text'
        ),
    array(
        'label' => 'Youtube video 3',       
        'id'    => '_artist_youtubevideo3',
        'type'  => 'text'
        )

);

$artist_tab_3_box = new custom_add_meta_box( 'artist_tab_3', 'Videos', $artist_tab_3, 'artist', true );




