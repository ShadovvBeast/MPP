<?php

// just a small program to create all the social icons
$social = array(
				array('rss',			THEME_SHORTNAME.'_feedburner'),
				array('fb',				THEME_SHORTNAME.'_facebook_fanpage'),
				array('instagram',		THEME_SHORTNAME.'_instagram'),
				array('tw',				THEME_SHORTNAME.'_twitter_page'),
				array('in',				THEME_SHORTNAME.'_linkedin_page'),
				array('myspace',		THEME_SHORTNAME.'_myspace_page'),
				array('soundcloud',		THEME_SHORTNAME.'_soundcloud_page'),
				array('mixcloud',		THEME_SHORTNAME.'_mixcloud_page'),
				array('youtube',		THEME_SHORTNAME.'_youtube_page'),
				array('vimeo',			THEME_SHORTNAME.'_vimeo_page'),
				array('tumblr',			THEME_SHORTNAME.'_tumblr_page'),
				array('flickr',			THEME_SHORTNAME.'_flickr_page'),
				array('stumbleupon',	THEME_SHORTNAME.'_stumbleupon_page'),
				array('amazon',			THEME_SHORTNAME.'_amazon_page'),
				array('apple',			THEME_SHORTNAME.'_itunes_page'),
				array('beatport',		THEME_SHORTNAME.'_beatport_page'),
				array('reverbnation',	THEME_SHORTNAME.'_reverbnation_page'),
				array('radvisor',		THEME_SHORTNAME.'_radvisor_page'),
				array('googleplus',		THEME_SHORTNAME.'_googleplus_page'),
				array('skype',			THEME_SHORTNAME.'_skype_page'),
				array('juno',			THEME_SHORTNAME.'_juno_page'),
				array('lastfm',			THEME_SHORTNAME.'_lastfm_page'),
				array('trackitdown',	THEME_SHORTNAME.'_trackitdown_page'),
				array('whatpeopleplay',	THEME_SHORTNAME.'_whatpeopleplay_page'),
				array('triplevision',	THEME_SHORTNAME.'_triplevision_page'),
				array('dailymotion',	THEME_SHORTNAME.'_dailymotion_page')

				);
foreach($social as $s){
	if(get_option($s[1])!=''){
		echo '<li><a target="_blank" rel="nofollow" href="'.get_option($s[1]).'" class="icon lpicon-'.$s[0].' qw-disableembedding" ></a></li>';
	}
}

?>