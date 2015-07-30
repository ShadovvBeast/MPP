<?php

if(!function_exists('qtHexToRGBA')){
	function qtHexToRGBA($hex){
		$hex = str_replace('#', '', $hex);
	    if (strlen($hex) == 3) {
	        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	    }
	    $r = hexdec(substr($hex,0,2));
	    $g = hexdec(substr($hex,2,2));
	    $b = hexdec(substr($hex,4,2));
	    return $r.','.$g.','.$b;
	}
}



function create_custom_styles(){	
	$response = '';
	$bg_body 			= get_option( THEME_SHORTNAME . '_body_background' );
	$bg_bodycolor 		= get_option( THEME_SHORTNAME . '_backgroundcolor' );
	$text_color 		= get_option( THEME_SHORTNAME . '_textcolor' );
	$main_color 		= get_option( THEME_SHORTNAME . '_maincolor' );
	$secondary_color 	= get_option( THEME_SHORTNAME . '_secondarycolor' );
	
	if ( $bg_bodycolor != '' ) { 
		$response .= 'body {
			background-color:'.$bg_bodycolor.';
			
		}';
	}
	
	if ( $text_color != '' ) { 
		$response .= 'body {
			color:'.$text_color.';
			
		}';
	}
	
	if ( $bg_body != '' ) { 
		$response .= 'body {background: url('.$bg_body.') top center fixed;';
		if(get_option(THEME_SHORTNAME."_fullscreen_background") == 'true'){
			$response .= ' -moz-background-size: cover;-webkit-background-size: cover;	-o-background-size: cover;background-size: cover;background-repeat: no-repeat;';
		}else{
			$response .= 'background-repeat: repeat;';
		}
		$response .= '}';
	}


	if ($main_color!=''){
		
		$response .= '
		a, .nav > li > a:hover  {
			color:'.$main_color.';
		}
		
		.qw-readall, .ca-more, .ca-readall, ul.filterOptions li a:hover,
		a.comment-reply-link, input#submit, input.wpcf7-submit, .navbar-inverse .navbar-inner,
		.dropdown-menu, .navbar-inverse .nav > li > a:hover
		{
			background-color:'.$main_color.';
		
		}
		
		#qw-3boxcarousel span.qw-navarrow {
			background-color: '.$main_color.';
		}
		';
	}
	
	
	if ($secondary_color!=''){
		
		$response .= '
			.dropdown-submenu:hover > a, .dropdown-menu li > a:hover, .navbar-inverse .nav > li > a:focus, .navbar-inverse .nav > li > a:hover, a.qw-readall:hover, .ca-more:hover, .ca-readall:hover,
			a.qw-musicplayer-label:hover, ul.filterOptions li.active a,
			a.comment-reply-link:hover, input#submit:hover, input.wpcf7-submit:hover,
			.navbar-inverse .nav .active > a,
			.navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus, .navbar-inverse .nav li.dropdown.open > .dropdown-toggle,
			.navbar-inverse .nav li.dropdown.active > .dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle,
			.dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a {
				
				background: '.$secondary_color.';
			}
			
			.dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a {
				
				background-color: '.$secondary_color.';
			}
			
			.dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a {
				
				background-color: '.$secondary_color.';
				background: '.$secondary_color.';
			}
			
			#qw-3boxcarousel span.qw-navarrow:hover {
				background-color: '.$secondary_color.' !important;
			}
			
			.navbar-inverse .nav li.dropdown > .dropdown-toggle .caret, .navbar .nav li.dropdown > .dropdown-toggle .caret {
				border-top-color: '.$secondary_color.';
				border-bottom-color: '.$secondary_color.';
			}
			.navbar .sub-menu:after, .navbar .sub-sub-menu:after {
				border-right-color: '.$secondary_color.';
			}
		';
	}
	
	/* Menu font size
	======================================================*/
	$fontsize = get_option(THEME_SHORTNAME.'_menufontsize');
	if($fontsize != '' && is_numeric($fontsize)){
		$response .='
		.navbar .nav > li > a {font-size: '.$fontsize.'px;
			
		}
		';
	}

	/* FONT FACE ENABLING
	======================================================*/
	$response .= '/* FONTFACE DECLARATION 
			_fontface_enable: '.get_option( THEME_SHORTNAME . '_fontface_enable' ).'
			_fontface_selectors: '.get_option( THEME_SHORTNAME . '_fontface_selectors' ).'
			_additionalCssFontFace: '.get_option( THEME_SHORTNAME . '_additionalCssFontFace' ).'
		*/	
		';
	if ( get_option( THEME_SHORTNAME . '_fontface_enable' ) == 'true'  && get_option( THEME_SHORTNAME.'_fontface_selectors' )!='' && get_option( THEME_SHORTNAME.'_additionalCssFontFace' ) != '') {
		$response .= html_entity_decode (stripslashes(get_option(THEME_SHORTNAME.'_fontface_selectors'))).' {
		font-family: \''.get_option( THEME_SHORTNAME.'_additionalCssFontFace' ).'\', Verdana, Arial, sans-serif;
		}';
	}
	

	if(get_option(THEME_SHORTNAME.'_show_player') == 'hidden'){
		$response .='.qw-musicplayer {top:-1000px;margin:-1000px -1000px;position:fixed;}	';
		
	}
	
		
	
	//THEME_SHORTNAME."_container_opacity"
	$opaq = get_option(THEME_SHORTNAME."_container_opacity");
	if(is_numeric($opaq)){
		$opaq = $opaq/100;
	}else{$opaq = 1;}

	if(get_option(THEME_SHORTNAME.'_boxed_layout') == 'Boxed'){
		
		$response.= ' /* Dynamic boxed background color */ 
		'.((get_option(THEME_SHORTNAME.'_boxedbackground') != '')? " body.Boxed .qw-totalwrapper , footer { background-color:rgba(".qtHexToRGBA(get_option(THEME_SHORTNAME.'_boxedbackground')).", ".$opaq.");}":'').'
		';
	}else{

		//$response.= 'body.Unboxed .qw-totalwrapper {margin-top:30px;padding-top:25px;}';
		//a.page-numbers, span.page-numbers
	}


	$response.= " .qw-darkbg{ background-color:rgba(".qtHexToRGBA(get_option(THEME_SHORTNAME.'_boxedbackground')).", ".$opaq.");} ";





	// Page Numbers

	$response.= "a.page-numbers, span.page-numbers {background-color:rgba(".qtHexToRGBA(get_option(THEME_SHORTNAME.'_boxedbackground')).", ".$opaq.");}";


	if(is_user_logged_in()){
		if(get_option( THEME_SHORTNAME . '_hideadminbar') == 'show' || get_option( THEME_SHORTNAME . '_hideadminbar') == ''){
				$response .='
				@media (min-width:980px) {body.Unboxed.admin-bar {padding-top:56px !important;} .navbar-fixed-top{top:32px !important;}}';
			}
	}
	

	if(get_option(THEME_SHORTNAME.'_boxed_layout') == 'Boxed'){
	$response.= ' @media (max-width:767px) {.qw-totalwrapper{padding-right:10px;padding-left:10px;}}';}


	if(get_option(THEME_SHORTNAME.'_boxed_layout') == 'Unoxed'){
	$response.= ' @media (max-width:767px) {body.Unboxed .qw-totalwrapper{padding-right:0;padding-left:0;}}';}
	
	$response .=  html_entity_decode (stripslashes(get_option(THEME_SHORTNAME.'_custom_css')));
	
	echo '<style type="text/css">'.($response).'</style>';
		
}

add_action('wp_head','create_custom_styles');
	
?>