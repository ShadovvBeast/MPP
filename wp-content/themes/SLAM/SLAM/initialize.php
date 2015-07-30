<?php
	$selected_slider = get_option('qp_slider_name');
	// css and js initialization
	function init_scripts_and_styles(){
		if(!is_admin() ){
			add_action('wp_enqueue_scripts','create_stylesheets');
			add_action('wp_enqueue_scripts','create_scripts',99999999999999);
			
		}
	}		
	add_action('init', 'init_scripts_and_styles');


	
	// initialize sidebars by taking the sidebar array from functions.php
	if ( function_exists('register_sidebar') ){
		$n = 0; // used for the css classes and id 
		while( $n < count($theme_sidebars) ){
				register_sidebar(
					array(
					'name' =>  $theme_sidebars[$n][0],
					'id' =>  'sidebar-'.$n,
					'description' => $theme_sidebars[$n][1],
					'before_widget' => '<'.SIDEBARITEM.' class="'.SIDEBARITEMCLASS.' sidebaritem-'.$n.'" id="thewidgetid-'.$n.'"> ',
					'after_widget'  => '</div>',
					'before_title'  => '<'.SIDEBARTITLE.' class="sidebaritem-'.$n.'-title qw-sidebartitle">',
					'after_title'   => '</'.SIDEBARTITLE.'>' 
					)
				);
			$n++;
		}
	}