<?php

$revslider = get_option(THEME_SHORTNAME."_homepage_revslider");

if(get_option(THEME_SHORTNAME."_boxed_layout") == 'Unboxed' && $revslider != ''){	
	echo '<div class="qw-topspacer revsliderspacer hidden-phone hidden-tablet"></div>'.do_shortcode('[rev_slider '.$revslider.']');
}

?>