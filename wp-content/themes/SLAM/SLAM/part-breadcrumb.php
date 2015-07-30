<?php
if ( function_exists( 'bcn_display' ) && !is_front_page() && (get_option(THEME_SHORTNAME.'_show_breadcrumb') != 'disabled') ){
	echo ' <div class="breadcrumbs hidden-phone">';
	bcn_display();
	echo '</div>';
} //function_exists( 'bcn_display' ) && !is_home()
?>