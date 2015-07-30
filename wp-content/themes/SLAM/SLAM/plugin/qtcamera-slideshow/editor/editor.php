<?php


	add_action('init', 'add_qtslideshows_button'); 

function add_qtslideshows_button() {  
 	if ( get_current_post_type() != 'qtslideshow' ) {
			   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
			   {  
				 add_filter('mce_external_plugins', 'add_qtslideshows_plugin');  
				 add_filter('mce_buttons', 'register_qtslideshows_button');  
				 wp_register_style('style-qtslideshows',get_template_directory_uri().'/plugin/qtcamera-slideshow/editor/style.css');
				 wp_enqueue_style( 'style-qtslideshows' );
			   }  
	}
}  

function register_qtslideshows_button($buttons) {  
   array_push($buttons, "qtslideshows");  
   return $buttons;  
} 
function add_qtslideshows_plugin($plugin_array) {
   
   $plugin_array['qtslideshows'] = get_template_directory_uri().'/plugin/qtcamera-slideshow/editor/script.js';  
   return $plugin_array;  
}