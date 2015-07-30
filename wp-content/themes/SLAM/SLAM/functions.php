<?php
/*
	===========================================================================================================================
	General technical infos:
	This theme is composed by 2 parts: the admin and the front-end theme.
	There are 3 main files containing the functions that makes this theme run: 
		-functions.php (this file)
		-initialize.php (which contains the hooks to head and footer and other initialization functions)
		-includes/frontend_functions.php (that contains many functions, filters and custom queries used by frontend templates)
		
	CSS and JS are loaded dinamically.
	===========================================================================================================================

*/


//	Theme path

//	This code creates both a constant and a function to include in every function thet requires the full theme path

// this shortname is the shortname used in custom fields to prevent issues with unknown plugins that you can install in future
// ========================================================================================================================

define( 'THEME_SHORTNAME', "qp" );

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'woocommerce' );


// Used to shorten the work
// =======================================================================================================================

define( 'THEMEURL', get_template_directory_uri() );

// generic function to shorten the work

function themeurl()
{
	echo THEMEURL;
}

// including jquery:
// see initialize.php
		



if ( isset( $table_prefix ) ) {
	if ( $table_prefix != '' ) {
		define( 'TABLEPREF', $table_prefix );
	} 
	else {
		die( 'Configuration errors. DB access denied.' );
	}
} else {
	die( 'Config errors. DB access denied' );
}



if(is_admin() ){
	require_once get_template_directory() . '/custom-types/form_creation.php';
	include_once 'admin/adminindex.php';
}

// custom post types
// ========================================================================================================================

/**
 * gets the current post type in the WordPress Admin
 */
function get_current_post_type() {
  global $post, $typenow, $current_screen;
	
  //we have a post so we can just get the post type from that
  if ( $post && $post->post_type )
    return $post->post_type;
    
  //check the global $typenow - set in admin.php
  elseif( $typenow )
    return $typenow;
    
  //check the global $current_screen object - set in sceen.php
  elseif( $current_screen && $current_screen->post_type )
    return $current_screen->post_type;
  
  //lastly check the post_type querystring
  elseif( isset( $_REQUEST['post_type'] ) )
    return sanitize_key( $_REQUEST['post_type'] );
	
  //we do not know the post type!
  return null;
}


include 		'admin/option_fields.php';
require			'metaboxes/meta_box.php';
require_once 	'custom-types/qt-pages/index-pages.php';
require_once 	'custom-types/sliders/sliders-type.php';
require_once 	'custom-types/artist/artist-type.php';
require_once 	'custom-types/podcast/podcast-type.php';
require_once 	'custom-types/release/release-type.php';
require_once 	'custom-types/qt-events/events.php';
require_once 	'plugin/breadcrumb-navxt/breadcrumb_navxt_admin.php';


/*
*
*	Flush Rewrite Rules ===========================================================================
*
*	======================================================================================
*/



function qt_rewrite_flush() {
    flush_rewrite_rules();
    if ( has_nav_menu( 'primary' ) ) {
	     wp_nav_menu( array( 'menu_location_1' => 'nav_menu' ) );
	}
}
add_action( 'after_switch_theme', 'qt_rewrite_flush' );



if(is_admin()){
//	require_once 	'plugin/qt-beatport-importer/qt-beatport-importer.php'; // replaced by standalone plugin version
}
require_once 	'plugin/qantum-facebookgallery/fbphotos.php';
require_once 	'plugin/qtcamera-slideshow/cameraslider.php';
require_once 	'plugin/dw-shortcodes-bootstrap/designwall-shortcodes-qtedited.php';
require_once 	'plugin/qt-fontawesome/fontawesome.php';
require_once 	'tgm/plugins.php';

add_action('after_setup_theme', 'labelpro_init');
if( !function_exists('labelpro_init') ):
    function labelpro_init() {
        add_action('tgmpa_register', 'labelpro_required_plugins');
    }
endif; // end   labelpro_init  


require_once 'includes/verify_theme_settings.php';



// custom widgets
//	========================================================================================================================

require_once 'widgets/facebook-widget.php';
require_once 'widgets/recent-release-widget.php';
require_once 'widgets/artists-widget.php';
require_once 'widgets/podcast-widget.php';
require_once 'widgets/qantumplayer/index.php';

//  theme version, used in all versioning references and for cache purposes, css, js etc...
//	========================================================================================================================

define( 'THEMEVERSION'		, '4.5' );

//  General theme settings
//	========================================================================================================================

define( 'SIDEBARITEMCLASS'	, 'qw-sidebar-item' ); 	// standard class of the item around any sidebar item
define( 'SIDEBARITEM'		, 'div' ); 				// you can specify if you items of the sidebar (widget) must be into a div, li or anything else
define( 'SIDEBARTITLE'		, 'h2' ); 				// specify which tag to use to wrap around widget titles



// Theme variables
//	========================================================================================================================


// define a new size for thumbnails

if ( function_exists( 'add_theme_support' ) ) {
	// Featured image support
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 75, 75, true ); // Normal post thumbnails  
	add_image_size( 'screen-shot', 720, 540 ); // Full size screen  
}


//	Frontend templates functions
//	========================================================================================================================

if(!is_admin() ){
	require_once get_template_directory() . '/includes/create_css.php';
	require_once get_template_directory() . '/includes/create_scripts.php';
	require_once get_template_directory() . '/includes/menu_walker.php';
	// frontend_functions: needed by front-end theme and this contains many functions used to add filters or functions to retrive additional data
	require_once get_template_directory() . '/includes/frontend_functions.php';
	require_once 	get_template_directory() . '/includes/google-fonts.php';

	add_action('wp_enqueue_scripts', 'force_js_composer_front_load');
	function force_js_composer_front_load() {
	    wp_enqueue_style('js_composer_front');
	}


}else{
	function qtAdminGeneralScript(){
		wp_enqueue_style( 'general-admin-css', THEMEURL . '/admin/adminstyles.css', $deps = array(), $ver = false, $media = 'all' );
	}
	add_action('admin_enqueue_scripts','qtAdminGeneralScript');
}


// creation of sidebars
//	========================================================================================================================

require_once get_template_directory() . '/includes/create_sidebars.php';


//	Initialization
//	========================================================================================================================

include_once 'initialize.php';

if ( ! isset( $content_width ) ) $content_width = 550;

load_theme_textdomain( 'labelpro', get_template_directory() .'/languages' );




//	Extension functions
//	========================================================================================================================

include 'part-extend.php';



?>