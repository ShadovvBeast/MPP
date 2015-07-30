<?php
/*

	First time setup initialization

*/

function the_theme_setup()
{
	//__________________________________________________________
	$the_theme_status = get_option( 'theme_setup_status' );// THIS IS THE OPTION THAT SAYS IF IT IS THE FIRST SETUP

	//__________________________________________________________

	$theme_menus = array(
			'menu_location_1' => 'Top Menu Location',
		);
	if ( function_exists('register_nav_menus') ){
		register_nav_menus( $theme_menus);	
	}
	//check if i have a top menu or create one
	$mymenuname = 'Top Menu'; 
	$menu       = get_term_by( 'name', $mymenuname, 'nav_menu' ); 

	if($menu!=false){
		$menu_id    = $menu->term_id; 
		$menu_real_id =$menu_id ;
	}else{
		// i don't have my menu so i create it and add twuo links to test it
		$menu_real_id = wp_create_nav_menu( $mymenuname ); 
		wp_update_nav_menu_item($menu_real_id, 0, array( 
			'menu-item-title' =>  __('Home'), 
			'menu-item-classes' => 'home', 
			'menu-item-url' => home_url( '/' ), 
			'menu-item-status' => 'publish')
		); 
		$release =  get_post_type_archive_link('release');
		$podcast =  get_post_type_archive_link('podcast');
		$artist =  get_post_type_archive_link('artist');
		$event =  get_post_type_archive_link('event');
		if ( get_option('permalink_structure') ) { 
			$release =  '/release\/';
			$podcast =  '/podcast\/';
			$artist =  '/artist\/';
			$event =  '/event\/';
		} else {
			$release =  '?post_type=release';
			$podcast =  '?post_type=podcast';
			$artist =  '?post_type=artist';
			$event =  '?post_type=event';
		}
		 wp_update_nav_menu_item($menu_real_id, 0, array( 
		'menu-item-title' =>  'Releases', 
		'menu-item-url' => home_url( $release ), 
		'menu-item-status' => 'publish')); 
		 wp_update_nav_menu_item($menu_real_id, 0, array( 
		'menu-item-title' =>  'Podcasts', 
		'menu-item-classes' => '', 
		'menu-item-url' => home_url( $podcast ), 
		'menu-item-status' => 'publish'));
		 wp_update_nav_menu_item($menu_real_id, 0, array( 
		'menu-item-title' =>  'Artists', 
		'menu-item-classes' => '', 
		'menu-item-url' => home_url( $artist ), 
		'menu-item-status' => 'publish'));
		 wp_update_nav_menu_item($menu_real_id, 0, array( 
		'menu-item-title' =>  'Events', 
		'menu-item-classes' => '', 
		'menu-item-url' => home_url( $event ), 
		'menu-item-status' => 'publish'));
		flush_rewrite_rules( false );
		set_theme_mod( 'nav_menu_locations' , array( 'menu_location_1' => $menu_real_id ) );
	}
	

		
	//delete_option( 'theme_setup_status' );//re-enable to run again the first setup
	
	$theme_menus = array('menu_location_1' => 'Top Menu Location');
	
	if ( $the_theme_status !== '1' ) {
		
		 
		// set default options
		$core_settings = array(
			'posts_per_page'=>8
		);
		
		foreach ( $core_settings as $k => $v ) {
			update_option( $k, $v );
		}
		
		require (get_template_directory().'/admin/option_fields.php'); // basic qantumthemes admin options list
		foreach($options as $o){
			if(isset($o['std']) && isset($o['id']) && get_option($o['id'])!= ''){
				update_option( $o['id'], $o['std'] );
			}
		}
		update_option( 'theme_setup_status', '1' );
		$msg = '
		<div class="updated">
			<h1>Congratulations!</h1>
			<p>This is your first installation, and we made all the boring stuff for you! Now you can go in the 
			 <a href="' . admin_url( 'themes.php?page=adminindex.php' ) . '" title="See Settings">theme settings</a> and start to build your amazing website!
			</p>
		</div>';
		add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );	
	}
	elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {
			//delete_option( 'theme_setup_status' );
			
			$msg = '<div class="updated">
						<p>The ' . get_option( 'current_theme' ) . ' theme was successfully re-activated. </p>
					</div>';
			add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
	}
}

add_action( 'after_setup_theme', 'the_theme_setup' );


?>