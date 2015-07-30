<?php
add_action('init', 'add_qtfbgal_button'); 

function add_qtfbgal_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') && is_admin())  
   {  
     add_filter('mce_external_plugins', 'add_qtfbgal_plugin');  
     add_filter('mce_buttons', 'register_qtfbgal_button');  
	 wp_register_style('style-qtfbgal',get_template_directory_uri().'/plugin/qantum-facebookgallery/editor/style.css');
	 wp_enqueue_style( 'style-qtfbgal' );
   }  
}  

function register_qtfbgal_button($buttons) {  
   array_push($buttons, "qtfbgal");  
   return $buttons;  
} 
function add_qtfbgal_plugin($plugin_array) {  
   $plugin_array['qtfbgal'] = FBGFOLDER.'/plugin/qantum-facebookgallery/editor/script.js';  
   return $plugin_array;  
}  
?>