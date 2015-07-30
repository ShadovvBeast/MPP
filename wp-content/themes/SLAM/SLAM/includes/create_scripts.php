<?php
function create_scripts(){
	$main_dependencies = array();
	wp_enqueue_script('jquery');
	$main_dependencies[] = 'jquery';
	if(get_option(THEME_SHORTNAME.'_slider_name') == 'Nivo Slider' ){
		wp_enqueue_script( 'nivoslider',	THEMEURL.'/js/nivo-slider/jquery.nivo.slider.pack.js',		'jquery',THEMEVERSION,	true   );
		$main_dependencies[] = 'nivoslider';
	} 
	wp_enqueue_script('gmaps','http://maps.google.com/maps/api/js?sensor=false&amp;marker=yes"',$main_dependencies,THEMEVERSION,true );




	wp_enqueue_script( 'wpb_composer_front_js' );

	wp_enqueue_script('slam-scripts',			THEMEURL . '/js/labelpro-scripts.js',$main_dependencies,THEMEVERSION,true );
	$main_dependencies[] = 'slam-scripts';
	wp_enqueue_script('mainscript',			THEMEURL . '/js/main.js',$main_dependencies,THEMEVERSION,true );
	$main_dependencies[] = 'mainscript';

}
