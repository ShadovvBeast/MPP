<?php

/*

	* custom post type portfolio

*/



define ('CUSTOM_TYPE_SLIDERS','sliders');



add_action('init', 'sliders_register_type');  



function sliders_register_type() {
	$name = CUSTOM_TYPE_SLIDERS;
	
	$labels = array(
		'name' => __(ucfirst($name)).'',
		'singular_name' => __(ucfirst($name)),
		'add_new' => 'Add New ',
		'add_new_item' => 'Add New '.__(ucfirst($name)),
		'edit_item' => 'Edit '.__(ucfirst($name)),
		'new_item' => 'New '.__(ucfirst($name)),
		'all_items' => 'All '.__(ucfirst($name)).'',
		'view_item' => 'View '.__(ucfirst($name)),
		'search_items' => 'Search '.__(ucfirst($name)).'',
		'not_found' =>  'No '.$name.' found',
		'not_found_in_trash' => 'No '.$name.'s found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => __(ucfirst($name)).''
	);
    $args = array(
		'menu_position' => 50,
        'labels' => $labels,
        'singular_label' => __(ucfirst(CUSTOM_TYPE_SLIDERS)),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'page',		
		'query_var' => false,
		'exclude_from_search' => true,
		'has_archive' => true,
		'rewrite' => array("slug" => CUSTOM_TYPE_SLIDERS),
		'can_export' => true,
        'hierarchical' => false,
        'rewrite' => true,
		'page-attributes' => true,
		'show_in_nav_menus' => false,
        'supports' => array('title', 'editor','page-attributes'),
		'menu_icon' => get_template_directory_uri() . '/custom-types/sliders/icon.png',

       );  
    register_post_type( CUSTOM_TYPE_SLIDERS , $args );
}


/* = meta box 
========================================================================*/

$current_post_type = CUSTOM_TYPE_SLIDERS;

// ======================== create form ====================== 


function cd_sliders_meta_cb( $post ) // <- <- <- <- <- <- <- <- <- <- <- EDIT THIS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

{
	include 'vars.php';
	$post_type = get_post_type( $post );
	wp_nonce_field( 'save_'.$post_type.'_meta', $post_type.'_nonce' );
	foreach($fields as $f){
		$f[2] = get_post_meta( $post->ID,  $f[0], true );
		echo qantumpro_create_form_row( $f[0], $f[1], $f[2], $f[3]);
	}
    echo '<div class="canc">&nbsp;</div>';
}

//____________________________________________________________________________________
add_action( 'add_meta_boxes', 'cd_add_sliders_meta' );
function cd_add_sliders_meta()
{
	add_meta_box( 'sliders-meta', __( ucfirst('sliders').' data' ), 'cd_sliders_meta_cb', 'sliders', 'normal', 'high' );
}

// ======================== save ====================== 
add_action( 'save_post', 'cd_'.$current_post_type.'_meta_save' );
function cd_sliders_meta_save( $id )
{
	$typename = CUSTOM_TYPE_SLIDERS;
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if( !isset( $_POST[$typename.'_nonce'] ) || !wp_verify_nonce( $_POST[$typename.'_nonce'], 'save_'.$typename.'_meta' ) ) return;
	if ( ! current_user_can( 'edit_post', $id ) ) die('non posso editare il post');
	$allowed = array(
		'p'	=> array()
	);
	include 'vars.php';
	include get_template_directory().'/custom-types/form_saving.php';
	foreach($fields as $f){
		if(isset($f[0]) && isset($_POST[$f[0]])){
			qantumpro_save_form_row($f[0], $f[1], $_POST[$f[0]], $f[3],$id);
		}
	}
}

?>