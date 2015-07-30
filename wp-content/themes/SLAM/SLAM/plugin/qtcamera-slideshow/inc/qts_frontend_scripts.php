<?php

function qts_enqueue(){
	// js
	/*
	wp_enqueue_script('jquerymobile',CUSTOM_PLUGIN_DIR.'assets/scripts/jquery.mobile.customized.min.js','jquery','1.0',true);
	wp_enqueue_script('easing',CUSTOM_PLUGIN_DIR.'assets/scripts/jquery.easing.1.3.js','jquery','1.0',true);
	wp_enqueue_script('cameramin',CUSTOM_PLUGIN_DIR.'assets/scripts/camera.min.js','jquery','1.0',true);
	wp_enqueue_script('qtslideshow',CUSTOM_PLUGIN_DIR.'assets/scripts/qtslideshow.main.js',array('jquery','cameramin','easing','jquerymobile'),'1.0',true);
	*/
	wp_enqueue_script('qtslideshow',CUSTOM_PLUGIN_DIR.'assets/scripts/qtcamera-minified.js',array('jquery'),'1.0',true);

	// css
	wp_register_style('qtscss',CUSTOM_PLUGIN_DIR.'assets/css/camera.css');
	wp_enqueue_style( 'qtscss' );
}
if(!is_admin()){
	add_action('wp_enqueue_scripts','qts_enqueue');	
}



