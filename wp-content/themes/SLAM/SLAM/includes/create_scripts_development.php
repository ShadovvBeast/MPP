<?php
function create_scripts(){

	wp_enqueue_script('jquery');
	
	//wp_enqueue_script('style-perfectscrollbar',	THEMEURL . '/js/scrollbar/perfect-scrollbar.with-mousewheel.min.js','jquery',THEMEVERSION,true );
	//wp_enqueue_script('cookiejqueryok',		THEMEURL . '/js/jquerycookie.js',										'jquery',THEMEVERSION,true );
	//wp_enqueue_script('easing',				THEMEURL . '/js/jquery.easing.1.3.js',									'jquery',THEMEVERSION,true );
	//wp_enqueue_script('equalizeblocks',		THEMEURL . '/js/same-height-blocks.js',									'jquery',THEMEVERSION,true );
	//wp_enqueue_script('nicescroll',		THEMEURL . '/js/jquery.nicescroll.js',									'jquery',THEMEVERSION,true );
	
	
	// $main_dependencies = array('jquery','style-perfectscrollbar','cookiejqueryok','easing','equalizeblocks');
	
	// if(get_option( THEME_SHORTNAME . '_fullscreen_background' )== 'true'){
	// //	wp_enqueue_script('anystretch',			THEMEURL . '/js/jquery.anystretch.min.js','jquery',THEMEVERSION,true );
	// //	$main_dependencies[] = 'anystretch';
	// }
	
	//wp_enqueue_script( 'quicksand', 		THEMEURL.'/js/jquery.quicksand.js',		'jquery',THEMEVERSION,	true   );
	//wp_enqueue_script( 'podcastarchive', 	THEMEURL.'/js/podcastarchive.js',		'jquery',THEMEVERSION,	true   );
	// $main_dependencies[] = 'quicksand';
	// $main_dependencies[] = 'quicksandcustom';
	// $main_dependencies[] = 'podcastarchive';
		
	// if(get_option(THEME_SHORTNAME.'_homepage_3boxcarousel') == 'enabled' ){
	// 	wp_enqueue_script(  'contentcarouselDynamic', 	THEMEURL.'/includes/CircularContentCarousel/js/jquery.contentcarousel-customized.js','jquery',THEMEVERSION,	true  ) ;
	// 	wp_enqueue_script( 'CcarouselMsDynamic', 		THEMEURL.'/includes/CircularContentCarousel/js/mainscript.js','jquery',THEMEVERSION,	true  );
	// 	$main_dependencies[] = 'contentcarouselDynamic';
	// 	$main_dependencies[] = 'CcarouselMsDynamic';
	// }

	if(get_option(THEME_SHORTNAME.'_slider_name') == 'Nivo Slider' ){
		wp_enqueue_script( 'nivoslider',	THEMEURL.'/js/nivo-slider/jquery.nivo.slider.pack.js',		'jquery',THEMEVERSION,	true   );
	} 

	//wp_enqueue_script('bootstrap',			THEMEURL . '/js/bootstrap.min.js',$main_dependencies,THEMEVERSION,true );
	
	wp_enqueue_script('mainscript',			THEMEURL . '/js/main.js',$main_dependencies,THEMEVERSION,true );
	$main_dependencies[] = 'mainscript';
	// this must be the last
	//wp_enqueue_script('fitvids',			THEMEURL . '/js/jquery.fitvids.min.js','mainscript',THEMEVERSION,true );

}
