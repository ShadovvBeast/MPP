<?php
// GOOGLE ANALYTICS tracking code from qantum panel (this is in the head section as suggested by google) )
echo  html_entity_decode (stripslashes(get_option( THEME_SHORTNAME.'_ga_code' )));
// other tracking code from qantum panel (any code you want to add, to keep it apart from GA)
echo  html_entity_decode (stripslashes(get_option( THEME_SHORTNAME.'_tracking_head' )));
?>