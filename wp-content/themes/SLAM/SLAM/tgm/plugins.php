<?php

require_once ('class-tgm-plugin-activation.php');



///////////////////////////////////////////////////////////////////////////////////////////
/////// Required Plugins
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('labelpro_required_plugins') ):
function labelpro_required_plugins() {
	$plugins = array(
		array(
                    'name'     			=> 'Revolution Slider', 
                    'slug'     			=> 'revslider', 
                    'source'   			=> get_template_directory()  . '/tgm/plugins/revslider.zip',
                    'required' 			=> false,
                    'version' 			=> '',
                    'force_activation' 	=> false, 
                    'force_deactivation'=> true,
                    'external_url' 		=> ''
		)
		,array(
                    'name'     			=> 'Advanced Ajax Page Loader', 
                    'slug'     			=> 'advanced-ajax-page-loader', 
                    'source'   			=> get_template_directory()  . '/tgm/plugins/advanced-ajax-page-loader.zip',
                    'required' 			=> false,
                    'version' 			=> '',
                    'force_activation' 	=> false, 
                    'force_deactivation'=> true,
                    'external_url' 		=> ''
		)  
		,array(
                    'name'     			=> 'WPBakery Visual Composer', 
                    'slug'     			=> 'js_composer', 
                    'source'   			=> get_template_directory()  . '/tgm/plugins/js_composer.zip',
                    'required' 			=> true,
                    'version' 			=> '',
                    'force_activation' 	=> false, 
                    'force_deactivation'=> true,
                    'external_url' 		=> ''
		) 
		,array(
                    'name'     			=> 'QantumThemes Free Beatport Importer', 
                    'slug'     			=> 'qt-beatport-importer-plugin', 
                    'source'   			=> get_template_directory()  . '/tgm/plugins/qt-beatport-importer-plugin.zip',
                    'required' 			=> true,
                    'version' 			=> '',
                    'force_activation' 	=> false, 
                    'force_deactivation'=> true,
                    'external_url' 		=> ''
		) 
		,array(
                    'name'     			=> 'QantumThemes Ajax RevSlider', 
                    'slug'     			=> 'qt_ajax_revslider', 
                    'source'   			=> get_template_directory()  . '/tgm/plugins/qt_ajax_revslider.zip',
                    'required' 			=> true,
                    'version' 			=> '',
                    'force_activation' 	=> false, 
                    'force_deactivation'=> true,
                    'external_url' 		=> ''
		)     
		,array(
                    'name'     			=> 'Easy Installer', 
                    'slug'     			=> 'easy_installer', 
                    'source'   			=> get_template_directory()  . '/tgm/plugins/easy_installer.zip',
                    'required' 			=> true,
                    'version' 			=> '',
                    'force_activation' 	=> false, 
                    'force_deactivation'=> true,
                    'external_url' 		=> ''
		)    
	);

	$config = array(
		'domain'       		=> 'labelpro',         	
		'default_path' 		=> '',                         	
		'parent_menu_slug' 	=> 'themes.php', 				
		'parent_url_slug' 	=> 'themes.php', 				
		'menu'         		=> 'install-required-plugins', 	
		'has_notices'      	=> true,                       
		'is_automatic'    	=> true,
		'message' 			=> '',							
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'labelpro' ),
			'menu_title'                       			=> __( 'Install Plugins', 'labelpro' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'labelpro' ), 
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'labelpro' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  				=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 				=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 					=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					 	=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  	=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'labelpro' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'labelpro' ),
			'complete' 						=> __( 'All plugins installed and activated successfully. %s', 'labelpro' ), 
			'nag_type'						=> 'updated'
		)
	);
	tgmpa($plugins, $config);
}
endif; // end   labelpro_required_plugins  
?>
