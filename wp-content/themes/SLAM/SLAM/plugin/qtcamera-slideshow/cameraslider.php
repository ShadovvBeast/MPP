<?php
/*
Plugin Name: QT Camera Slider Plugin
Plugin URI: http://www.qantumthemes.com
Description: Add to your theme amazing mslider capabilites
Version: 1.0
Author: Igor Nardo
*/

/* = Library inclusion
===========================================================*/

// shortcode: [qtslideshows id=xxx]
define ( 'CUSTOM_PLUGIN_DIR', get_template_directory_uri() . '/plugin/qtcamera-slideshow/' );
define ( 'QTS_PREFIX', 'qtslider_' );

if(is_admin()){
	global $post_type;
    if ( get_current_post_type() == 'qtslideshow' ) {
		//require_once('inc/metaboxes/meta_box.php');// no, lo prende già il tema!!
	}
}

require_once('inc/post_type_slider/index.php'); 
require_once('inc/qts_frontend_scripts.php'); 
require_once('inc/qts_html_generator.php'); 
require_once('editor/editor.php'); 