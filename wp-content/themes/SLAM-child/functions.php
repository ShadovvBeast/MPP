<?php  

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


function qt_rewrite_flush_child() {
    flush_rewrite_rules();
    if ( has_nav_menu( 'primary' ) ) {
	     wp_nav_menu( array( 'menu_location_1' => 'nav_menu' ) );
	}
}
add_action( 'after_switch_theme', 'qt_rewrite_flush_child' );