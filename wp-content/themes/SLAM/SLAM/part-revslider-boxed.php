<?php

$revslider = get_option(THEME_SHORTNAME."_homepage_revslider");

if( $revslider != ''){	
	echo '<div class="qw-revslider">'.do_shortcode('[rev_slider '.$revslider.']').'</div>';
}

?>