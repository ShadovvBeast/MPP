<?php
if(get_option( THEME_SHORTNAME . '_skin' ) != ''){
	define( 'THEMESKIN', get_option( THEME_SHORTNAME . '_skin' ) );
}else{
	define( 'THEMESKIN', 'dark-magenta' );

}
function create_stylesheets(){
	$stylesheets_to_load = array(


		array(	'labelpro-style', 	THEMEURL . '/css/bootstrap.qantum.css', 			false, THEMEVERSION, 'screen' ),
		array( 	'stylethemecolors', THEMEURL . '/skins/' . THEMESKIN . '/colors.css', 	false, THEMEVERSION, 'screen' ),
		array( 	'lp-iconfont', THEMEURL . '/css/labelpro-iconfont/styles.css', 	false, THEMEVERSION, 'screen' ),
		array(  'styletheme', 		THEMEURL . '/skins/' . THEMESKIN . '/ie-lt8.css', 	false, THEMEVERSION, 'screen', 'lt IE 9', 'endif'),
		//array(  'style-mCustomScrollbar', THEMEURL . '/js/custom-scrollbar-plugin/jquery.mCustomScrollbar.css', false, THEMEVERSION, 'screen' ),
		array(  'style-perfectscrollbar', THEMEURL . '/js/scrollbar/perfect-scrollbar.min.css', false, THEMEVERSION, 'screen' ),
		array(  'main-theme-css', 	THEMEURL . '/style.css', 							false, THEMEVERSION, 'screen' ) 
	);
	if ( get_option( THEME_SHORTNAME . '_fontface_enable' ) == 'true' && get_option( THEME_SHORTNAME . '_fontface_font' ) != '' ) {
		array_push( $stylesheets_to_load, array(
			  'fontfacecustom',
			 THEMEURL . "/font/" . get_option( THEME_SHORTNAME . '_fontface_font' ) . '/stylesheet.css',
			 false,
			 THEMEVERSION,
			 'screen' 
		) );
	} 
	
	if ( get_option( THEME_SHORTNAME . '_homepage_slider' ) == 'enabled' && get_option( THEME_SHORTNAME . '_slider_name' ) == 'Nivo Slider' ) {
		
		array_push( 
				$stylesheets_to_load, 
				array( 
					'default',
					THEMEURL . '/js/nivo-slider/themes/default/default.css',
					false,
					THEMEVERSION,
					'screen' 
				)
		);
		
		array_push( 
				   $stylesheets_to_load, 
					array( 
						'nivoslider',
						THEMEURL . '/js/nivo-slider/nivo-slider.css',
						false,
						THEMEVERSION,
						'screen' 
					)
		);
		
	}
	if(!is_admin()){
		foreach ( $stylesheets_to_load as $a ) {
 			wp_register_style( $a[ 0 ], $a[ 1 ] , false, $a[ 3 ] );
			if(isset($a[ 5 ])){
				$GLOBALS['wp_styles']->add_data( $a[ 0 ], 'conditional', $a[ 5 ]);
			}
 			wp_enqueue_style( $a[ 0 ] ); 
		}
	}
}
?>