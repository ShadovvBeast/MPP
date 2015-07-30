<?php


function qtfontawesome_bootstrap(){
	wp_register_style( 'style-fontawesome', THEMEURL.'/plugin/qt-fontawesome/css/font-awesome.min.css', false, '1.0.0' );
	wp_enqueue_style( 'style-fontawesome' );
}
add_action('admin_enqueue_scripts','qtfontawesome_bootstrap',9999);

function qtfontawesome_scripts(){
	if(!is_admin()){
		wp_register_style( 'style-fontawesome', THEMEURL.'/plugin/qt-fontawesome/css/font-awesome.min.css', 'bootstrap-dark', '1.0.0' );
		wp_enqueue_style( 'style-fontawesome' );
	}
}
add_action('wp_enqueue_scripts','qtfontawesome_scripts',9999);

?>