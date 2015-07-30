<?php
$options = array (

/////////////////////////////////////////////////////////////////////////////////////////

// Activation of the customizer

/////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura

array( "name" => '<i class="icon-key"></i> Activation Key',
	   //"image" => "icon_settings.png",
	  "type" => "section"),



array( 
      "name" => "Envato Username",
	"id" => "qt_envato_user",
	"type" => "text",
	"desc" => 'The Envato username used to purchase the product'
	),

array( "name" => "Purchase Code",
	"id" => "qt_purchase_code",
	"type" => "text",
	"desc" => 'The purchase code of your product. <br>
	<a href="http://themeforest.net/downloads" target="_blank">Get Your Purchase Code Here</a>'
	),

array( "name" => "Activation Key",
	"id" => "qt_activation_key",
	"type" => "text",
	"desc" => 'The Activation Key is needed only for extra services.<br> Is not needed for the theme to work.<br> A valid activation key is needed to use the Beatport Importer plugin.<br> 
	<a href="http://www.qantumthemes.com/activation/" target="_blank">Get Your Activation Key Here</a>'
	),

array( "type" => "close"),//__________________ chiusura //////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////

// Under Construction Page

/////////////////////////////////////////////////////////////////////////////////
	


array( "type" => "open"),//__________________ apertura

array( "name" => '<i class="icon-edit-sign"></i> Layout Options',
	   //"image" => "icon_settings.png",
	  "type" => "section"),



array( "name" => "Logo Image",
	"desc" => "Upload a file from your pc",
	"id" => THEME_SHORTNAME."_logo_corporate",
	"type" => "file",
	"std" => THEMEURL."/img/default_logo.png"),

array( "name" => "Header menu font size",
	"id" => THEME_SHORTNAME."_menufontsize",
	"type" => "text",
	"std" => "14"),

array( "name" => "Header layout balance",
	"desc" => "If you want to have the social icons near the logo, change this",
	"id" => THEME_SHORTNAME."_header_layout_balance",
	"type" => "select",
	"options" => array("12/12", "11/1", "10/2", "9/3", "8/4", "7/5", "6/6", "5/7", "4/8", "3/9", "2/10", "1/11"),
	"std" => "12/12"),
	
array( "name" => "General layout style",
	"desc" => "Choose if you want the layout to be boxed or unboxed",
	"id" => THEME_SHORTNAME."_boxed_layout",
	"type" => "select",
	"options" => array("Unboxed", "Boxed"),
	"std" => "Unboxed"),

array( "name" => "Enable Breadcrumb",
	"desc" => "The breadcrumb is the path of the current content, showed on top of the page",
	"id" => THEME_SHORTNAME."_show_breadcrumb",
	"type" => "select",
	"options" => array("enabled", "disabled"),
	"std" => "enabled"),

array( "name" => "Enable footer widget",
	"desc" => "You can use this option to disable the footer widgets",
	"id" => THEME_SHORTNAME."_footer_widgets",
	"type" => "select",
	"options" => array("enabled", "disabled"),
	"std" => "enabled"),

array( "name" => "Posts archive escerpt",
	"desc" => "This function overrides the native wordpress function because this is better and cuts content only after first paragraph",
	"id" => THEME_SHORTNAME."_do_excerpt",
	"type" => "select",
	"options" => array("Show Excerpt", "Show Full Content"),
	"std" => "Show Excerpt"),

  array( "name" => "Enable Debug to check errors",
	"desc" => "Set true to enable debug view",
	"id" => THEME_SHORTNAME."_debug_enable",
	"type" => "select",
	"options" => array("true", "false"),
	"std" => "true"),

   array( "name" => "Hide admin bar",
	"desc" => "Hide admin bar in frontend. Can corrupt some visual effects.",
	"id" => THEME_SHORTNAME."_hideadminbar",
	"type" => "select",
	"options" => array("hide", "show"),
	"std" => "show"),

array( "type" => "close"),//__________________ chiusura //////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////

// Under Construction Page

/////////////////////////////////////////////////////////////////////////////////
	

array( "type" => "open"),//__________________ apertura

array( "name" => '<i class="icon-minus-sign"></i> Coming soon page',
	  "type" => "section"),

array( "name" => "Custom Text",
	"desc" => "The text for your under construction website. Only Administrators will be able to see the content",
	"id" => THEME_SHORTNAME."_underconstruction_text",
	"type" => "textarea",
	"std" => "Sorry, the website is under development. Come back soon!"),	

array( "name" => "Custom image for under construction page",
	"desc" => "Best size:under 900 x 300 px",
	"id" => THEME_SHORTNAME."_underconstruction_image",
	"type" => "file"
	),	

array( "name" => "Under construction temporary page",
	"id" => THEME_SHORTNAME."_underconstruction_enable",
	"type" => "select",
	"options" => array("disable", "enable"),
	"std" => "disable"),

array( "type" => "close"),//__________________ chiusura //////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////

// Music player options

/////////////////////////////////////////////////////////////////////////////////


array( "type" => "open"),//__________________ apertura

array( "name" => '<i class="icon-music"></i> Music player',
	  "type" => "section"),
	  
	  
	  
array( "name" => "Waveform color",
	"desc" => "",
	"id" => THEME_SHORTNAME."_waveformDataColor",
	"type" => "color",
	"std" => ""
	),

array( "name" => "Play Ring Color",
	"desc" => "",
	"id" => THEME_SHORTNAME."_playRingColor",
	"type" => "color",
	"std" => ""
	),

array( "name" => "Load Ring Color",
	"desc" => "",
	"id" => THEME_SHORTNAME."_loadRingColor",
	"type" => "color",
	"std" => ""
	),



array( "name" => "Playlist type",
	"desc" => "Auto: displays latest N releases, Custom: display only tracks with with checkbox on 'Add To Custom Playlist', from any release.",
	"id" => THEME_SHORTNAME."_playlist_type",
	"type" => "select",
	"options" => array('auto','custom'),
	"std" => "auto"),


array( "name" => "Number of eps in the playlist",
	"desc" => "will be included any track of the first N eps",
	"id" => THEME_SHORTNAME."_qantmplayer_ep_playlist",
	"type" => "select",
	"options" => array("1",'2','3','4','5','6','7','8','9','10','11','12','13','14','15'),
	"std" => "2"),
array( "name" => "Show player in the top menu (The music will still play on other links)",
	"id" => THEME_SHORTNAME."_show_player",
	"type" => "select",
	"options" => array("visible", "hidden"),
	"std" => "visible"),

array( "name" => "Autoplay on site open",
	"id" => THEME_SHORTNAME."_do_autoplay",
	"type" => "select",
	"options" => array("no", "yes"),
	"std" => "no"),

array( "type" => "close"),//__________________ chiusura //////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////

// Color picker

/////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-adjust"></i> Colors',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura

array( "name" => "Colour Scheme (Skin)",
	"desc" => "Select the colour scheme for the theme",
	"id" => THEME_SHORTNAME."_skin",
	"type" => "file_select",
	"folder" => get_template_directory_uri()."/skins",
	"std" => "dark-magenta"),

array( "name" => "Background",
	"desc" => "",
	"id" => THEME_SHORTNAME."_backgroundcolor",
	"type" => "color",
	"std" => ""
	),

array( "name" => "Boxed layout container background",
	"desc" => "Visible only if you choosed boxed layout",
	"id" => THEME_SHORTNAME."_boxedbackground",
	"type" => "color",
	"std" => ""
	),

array( "name" => "Container opacity",
	"desc" => "Integer number between 0 and 100",
	"id" => THEME_SHORTNAME."_container_opacity",
	"type" => "number",
	"std" => ""
	),

array( "name" => "Text color",
	"desc" => "",
	"id" => THEME_SHORTNAME."_textcolor",
	"type" => "color",
	"std" => ""
	),

array( "name" => "Main color",
	"desc" => "",
	"id" => THEME_SHORTNAME."_maincolor",
	"type" => "color",
	"std" => ""
	),


array( "name" => "Secondary color",
	"desc" => "Tip: for better result choose something similar to the main color",
	"id" => THEME_SHORTNAME."_secondarycolor",
	"type" => "color",
	"std" => ""
	),

array( "name" => "Body Background",
	"desc" => "Upload a file from your pc",
	"id" => THEME_SHORTNAME."_body_background",
	"type" => "file",
	"std" => THEMEURL.'/img/default_background.jpg'),


  array( "name" => "Stretch background to fullscreen",
	"desc" => "Set true to use jquery to stretch background",
	"id" => THEME_SHORTNAME."_fullscreen_background",
	"type" => "select",
	"options" => array("true", "false"),
	"std" => "true"),
  
  
  array( "name" => "Custom CSS",
	"desc" => "Want to add any  code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green};",
	"id" => THEME_SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => ""),		
array( "type" => "close"),//__________________ chiusura //////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////

// font

/////////////////////////////////////////////////////////////////////////////////



array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-font"></i> Typography: Google Font',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura




array("name" => "Google Fonts",	  
	"type" => "subtitle"),//__________________ apertura	

array( "name" => "Enable Google Font",
	"desc" => "Set true to enable",
	"id" => THEME_SHORTNAME."_googlefont_enable",
	"type" => "select",
	"options" => array("true", "false")
	),

array( 	"name" => "Font Family 1 (titles)",	  
		"type" => "subtitle"),

array( "name" => "Font 1",
	"desc" => "Example: h1, h2, h3, h4, .postdate p",
	"id" => THEME_SHORTNAME."_googlefont_selectors",
	"type" => "text",
	"std" => 'h1, h2, h3, h4, .postdate, .postdate p, .tagline'),

array( "name" => "Google fonts",
	"desc" => "",
	"id" => THEME_SHORTNAME."_google_font",
	"type" => "googlefont",
	"std" => 'Noticia Text'
	),

array( 	"name" => "Font Family 2 (contents)",	  
		"type" => "subtitle"),

array( "name" => "Font 2",
	"desc" => "Example: .navbar .nav  li  a, .fontface",
	"id" => THEME_SHORTNAME."_googlefont_selectors2",
	"type" => "text",
	"std" => 'body, h5, h6, .navbar .nav li a, .fontface, .vcard, p, input, button, select, textarea'),

array( "name" => "Font Family 2",
	"desc" => "",
	"id" => THEME_SHORTNAME."_google_font2",
	"type" => "googlefont",
	"std" => 'Alef'
	),
array( "type" => "close"),//__________________ chiusura //////////////////////////


array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-font"></i> Typography: Fontface',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura

array("name" => "Fontface selection",	  
	"type" => "subtitle"),//__________________ apertura	

array( "name" => "Enable Font Face",
	"desc" => "Set true to enable font-face",
	"id" => THEME_SHORTNAME."_fontface_enable",
	"type" => "select",
	"options" => array("false","true"),
	"std" => "false"),

array( "name" => "Fonts to use with Fontface (separed by comma)",
	"desc" => "Example: h1, h2, h3, h4, h6, .navbar .nav > li > a, .fontface",
	"id" => THEME_SHORTNAME."_fontface_selectors",
	"type" => "text",
	"std" => 'h1, h2, h3, h4, h6, .navbar .nav > li > a, .fontface'),

array( "name" => "Fontface fonts",
	"desc" => "Generate your own font-face on fontsquirrel.com and upload it unzipped in the \"font\" folder. Add in the _preview folder a png file with same name as the font folder.",
	"id" => THEME_SHORTNAME."_fontface_font",
	"type" => "image_file_select",
	"folder" => get_template_directory_uri()."/font",
	"std" => "Exo"
	),

array( "type" => "close"),//__________________ chiusura //////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////
// home page

/////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-home"></i> Home page',
	   //"image" => "icon_home.png",
	"type" => "section"),//__________________ apertura

array( "name" => "MODULE 0. Revolution Slider (alias)",
	"desc" => "Insert the Slider Alias, for example \"home\" ",
	"id" => THEME_SHORTNAME."_homepage_revslider",
	"type" => "text"
	),

array( "name" => "MODULE 1. Custom page content",
	"desc" => "You can select a previously created page and its content will be shown first of all.",
	"id" => THEME_SHORTNAME."_homepage_extracontent_1",
	"type" => "pageselect"
	),
array( "name" => "MODULE 2. Homepage Podcast Module",
	"desc" => "Show podcasts in the homepage",
	"id" => THEME_SHORTNAME."_homepage_podcast_archive",
	"type" => "select",
	"options" => array("disabled", "enabled" ),
	"std" => "disabled"),
array( "name" => "MODULE 3. Enable homepage slider",
	"desc" => "You can use this option to disable the homepage_slider. The sliders options are in the dedicated tab.",
	"id" => THEME_SHORTNAME."_homepage_slider",
	"type" => "select",
	"options" => array("disabled", "enabled" ),
	"std" => "disabled"),

array( "name" => "MODULE 4. Release 3 box carousel",
	"desc" => "Enable if you want to see the 3 box sliding carousel in home page",
	"id" => THEME_SHORTNAME."_homepage_3boxcarousel",
	"type" => "select",
	"options" => array("disabled", "enabled" ),
	"std" => "disabled"),

array( "name" => "MODULE 5. Homepage Multi Boxes Sidebars",
	"desc" => "Enable if you want to use the multi boxes into your homepage (The box with 3 or more sidebars)",
	"id" => THEME_SHORTNAME."_homepage_multiboxes",
	"type" => "select",
	"options" => array("disabled", "enabled" ),
	"std" => "disabled"),
array( "name" => "MODULE 6. Custom page content",
	"desc" => "Add the content from a specific page to the home",
	"id" => THEME_SHORTNAME."_homepage_extracontent_2",
	"type" => "pageselect"
	),
array( "name" => "MODULE 7. Display latest post archives with sidebar",
	"desc" => "Enable if you want to display latest post archives",
	"id" => THEME_SHORTNAME."_homepage_archive",
	"type" => "select",
	"options" => array("enabled", "disabled"),
	"std" => "enabled"),
/*
array( "name" => "Testimonials",
	"desc" => "Enable to display testimonials in homepage",
	"id" => THEME_SHORTNAME."_homepage_testimonials",
	"type" => "select",
	"options" => array("enabled", "disabled"),
	"std" => "enabled"),
*/

////////////////////////////////////////////////////////////////////////////////////////

																							// Slider
///////////////////////////////////////////////////////////////////////////////////////

array( "type" => "close"), //__________________ chiusura ///////////////////////////
array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-play-circle"></i> Slider: Nivo / QT / Bootstrap',
	   //"image" => "icon_settings.png",
		"type" => "section"),//__________________ apertura	
array( "name" => "Select slider",
	"desc" => "Choose between the different sliders. Nivo slider is not responsive so is hidden in the mobile view",
	"id" => THEME_SHORTNAME."_slider_name",
	"type" => "select",
	"options" => array("Bootstrap Slider","QT Slideshow","Nivo Slider"/*,"Bootstrap Slider", "Coda Slider", "Responsive Slider"*/),
	"std" => "Bootstrap Slider"),
array( "name" => "Bootstrap Slider Autoplay?",
	"desc" => "This options is only for the bootstrap slider",
	"id" => THEME_SHORTNAME."_slider_autoplay",
	"type" => "select",
	"options" => array("yes","no"),
	"std" => "yes"),

array( "name" => "QT Slideshow ID for the home page",
	"id" => THEME_SHORTNAME."_qtslideshow_id",
	"type" => "text",
	"std" => "",
	"class" => "qtslideshow_id"
	),
array( 	"name" => "Nivo settings",	  
		"type" => "subtitle"),//__________________ apertura	

array( "name" => "Nivo Slider Effect",
	"desc" => "Choose between the different sliders",
	"id" => THEME_SHORTNAME."_nivoslider_fx",
	"type" => "select",
	"options" => array("random", "sliceDown", "sliceDownLeft", "sliceDownLeft", "sliceUp", "sliceDownLeft", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold",
					   "fade",
					   "slideInRight",
					   "slideInLeft",
					   "boxRandom",
					   "boxRain",
					   "boxRainGrow",
					   "boxRainGrowReverse",
					   "sliceDownLeft",
					   "sliceDownLeft",
					   "sliceDownLeft",
					   "sliceDownLeft",),
	"std" => "fade"),
array( "name" => "Nivo animation speed",
	"id" => THEME_SHORTNAME."_nivoslider_animSpeed",
	"type" => "text",
	"std" => "1000"),
array( "name" => "Nivo pause time",
	"id" => THEME_SHORTNAME."_nivoslider_pauseTime",
	"type" => "text",
	"std" => "2000"),
array( "name" => "Show slider arrows",
	"id" => THEME_SHORTNAME."_nivoslider_directionNav",
	"type" => "select",
	"options" => array("true", "false"),
	"std" => "true"),
array( "name" => "Hide arrows",
	"id" => THEME_SHORTNAME."_nivoslider_directionNavHide",
	"type" => "select",
	"options" => array("true", "false"),
	"std" => "true"),

array( "name" => "Navigation points",
	"id" => THEME_SHORTNAME."_nivoslider_controlNav",
	"type" => "select",
	"options" => array("true", "false"),
	"std" => "true"),
array( "type" => "close"),//__________________ chiusura ///////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////

																							// General Options

///////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-cog"></i> General',
	"type" => "section"),//__________________ apertura	
array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => THEME_SHORTNAME."_footer_text",
	"type" => "text",
	"std" => '<a href=&quot;http://themeforest.net/item/labelpro-responsive-music-wordpress-theme/3646671?ref=QantumThemes&quot;>SLAM!: Best music wordpress theme</a> - Change this into Appearance > Qantum Themes Admin Panel)'
	),
array( "name" => "Comments closed default text",
	"desc" => "This text is shown if comments are closed",
	"id" => THEME_SHORTNAME."_comments_closed",
	"type" => "text",
	"std" => 'Comments are closed'
	),
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => THEME_SHORTNAME."_favicon",
	"type" => "file",
	"std" => get_template_directory_uri()."/img/favicon.ico"
	),	
array( "type" => "close"), //__________________ chiusura ///////////////////////////

////////////////////////////////////////////////////////////////////////////////////////
																							// Social
///////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-share-sign"></i> Social integration',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura	
array( "name" => "Rss feed URL",
	"desc" => "Standard: ".get_bloginfo('rss2_url') ,
	"id" => THEME_SHORTNAME."_feedburner",
	"type" => "text"),
array( "name" => "Facebook Fanpage",
	"desc" => "You Facebook fanpage url (http://www.facebook.com/...)",
	"id" => THEME_SHORTNAME."_facebook_fanpage",
	"type" => "text"
	),
array( "name" => "Instagram",
	"desc" => "You Instagram  url (http://...)",
	"id" => THEME_SHORTNAME."_instagram",
	"type" => "text"
	),
array( "name" => "Twitter page",
	"desc" => "You Twitter profile url (http://www.twitter.com/...)",
	"id" => THEME_SHORTNAME."_twitter_page",
	"type" => "text"
	),
array( "name" => "LinkedIn",
	"desc" => "You Linkedin profile url (http://www.linkedin.com/...)",
	"id" => THEME_SHORTNAME."_linkedin_page",
	"type" => "text"
	),

array( "name" => "MySpace",
	"desc" => "You Myspace profile url (http://www.myspace.com/...)",
	"id" => THEME_SHORTNAME."_myspace_page",
	"type" => "text"
	),
array( "name" => "Soundcloud page",
	"desc" => "You soundcloud profile url (http:/...)",
	"id" => THEME_SHORTNAME."_soundcloud_page",
	"type" => "text"
	),
array( "name" => "Mixcloud page",
	"desc" => "You Mixcloud profile url (http:/...)",
	"id" => THEME_SHORTNAME."_mixcloud_page",
	"type" => "text"
	),
array( "name" => "Youtube channel",
	"desc" => "You Youtube profile url (http:/...)",
	"id" => THEME_SHORTNAME."_youtube_page",
	"type" => "text"
	),

array( "name" => "Vimeo channel",
	"desc" => "You Vimeo profile url (http:/...)",
	"id" => THEME_SHORTNAME."_vimeo_page",
	"type" => "text"
	),
array( "name" => "Tumblr page",
	"desc" => "You Tumblr profile url (http:/...)",
	"id" => THEME_SHORTNAME."_tumblr_page",
	"type" => "text"
	),

array( "name" => "Flickr page",
	"desc" => "You Flickr profile url (http:/...)",
	"id" => THEME_SHORTNAME."_flickr_page",
	"type" => "text"
	),

array( "name" => "StumbleUpon profile",
	"desc" => "You StumbleUpon profile url (http:/...)",
	"id" => THEME_SHORTNAME."_stumbleupon_page",
	"type" => "text"
	),

array( "name" => "Amazon channel",
	"desc" => "You Amazon profile url (http:/...)",
	"id" => THEME_SHORTNAME."_amazon_page",
	"type" => "text"
	),

array( "name" => "Itunes page",
	"desc" => "You Itunes (http:/...)",
	"id" => THEME_SHORTNAME."_itunes_page",
	"type" => "text"
	),

array( "name" => "Beatport page",
	"desc" => "You Beatport (http:/...)",
	"id" => THEME_SHORTNAME."_beatport_page",
	"type" => "text"
	),
array( "name" => "Reverbnation page",
	"desc" => "You Reverbnation (http:/...)",
	"id" => THEME_SHORTNAME."_reverbnation_page",
	"type" => "text"
	),

array( "name" => "Resident Advisor page",
	"desc" => "You Resident Advisor (http:/...)",
	"id" => THEME_SHORTNAME."_radvisor_page",
	"type" => "text"
	),

array( "name" => "Google+ page",
	"desc" => "You Google+  (http:/...)",
	"id" => THEME_SHORTNAME."_googleplus_page",
	"type" => "text"
	),

array( "name" => "Skype",
	"desc" => "You Skype link ",
	"id" => THEME_SHORTNAME."_skype_page",
	"type" => "text"
	),

array( "name" => "Juno page",
	"desc" => "You Juno  (http:/...)",
	"id" => THEME_SHORTNAME."_juno_page",
	"type" => "text"
	),
array( "name" => "Last FM page",
	"desc" => "Last FM  (http:/...)",
	"id" => THEME_SHORTNAME."_lastfm_page",
	"type" => "text"
	),

array( "name" => "Trackitdown page",
	"desc" => "Trackitdown page  (http:/...)",
	"id" => THEME_SHORTNAME."_trackitdown_page",
	"type" => "text"
	),

array( "name" => "WhatPeoplePlay page",
	"desc" => "WhatPeoplePlay page  (http:/...)",
	"id" => THEME_SHORTNAME."_whatpeopleplay_page",
	"type" => "text"
	),

array( "name" => "Triplevision page",
	"desc" => "Triplevision page  (http:/...)",
	"id" => THEME_SHORTNAME."_triplevision_page",
	"type" => "text"
	),

array( "name" => "Dailymotion page",
	"desc" => "Dailymotion page  (http:/...)",
	"id" => THEME_SHORTNAME."_dailymotion_page",
	"type" => "text"
	),

array( "type" => "close"), //__________________ chiusura ///////////////////////////



////////////////////////////////////////////////////////////////////////////////////////


																							// Facebook options

///////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-facebook-sign"></i> Facebook like button',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura	

array( "name" => "Embed SDK (disable if you want to put manually or other plugins already does)",
	"desc" => "Necessary to add Facebook like. Disable if you already have it",
	"id" => THEME_SHORTNAME."_facebook_sdk_include",
	"type" => "select",
	"options" => array("disabled","enabled"),
	"std" => "disabled"),

array( "name" => "Language",
	"desc" => "Language for the Facebook text",
	"id" => THEME_SHORTNAME."_facebook_lang",
	"type" => "select",
	"options" => array("en_EN","en_US","es_ES","fr_FR","it_IT","de_DE","ja_JP","pt_BR","ru_RU"),
	"std" => "en_EN"),

array( "name" => "Facebook API Key",
	"desc" => "Your facebook application API KEY (<a href=\"https://developers.facebook.com/apps\" target=\"_blank\">CREATE YOUR APP HERE</a>)",
	"id" => THEME_SHORTNAME."_facebook_apikey",
	"type" => "text"
	),

array( "name" => "Facebook Application Secret",
	"desc" => "Your facebook application Secret",
	"id" => THEME_SHORTNAME."_facebook_secret",
	"type" => "text"
	),

array( "name" => "Auto add Facebook like on single pages and posts or other post type",
	"desc" => "Only working with api key saved",
	"id" => THEME_SHORTNAME."_like_on_singles",
	"type" => "select",
	"options" => array("disabled","enabled"),
	"std" => "disabled"),

array( "name" => "Auto add Facebook like on archives",
	"desc" => "Only working with api key saved",
	"id" => THEME_SHORTNAME."_like_on_archives",
	"type" => "select",
	"options" => array("disabled","enabled"),
	"std" => "disabled"),
array( "name" => "Show send button",
	"id" => THEME_SHORTNAME."_fb_data_send",
	"type" => "select",
	"options" => array("false","true"),
	"std" => "false"),

array( "name" => "Layout of like button",
	"id" => THEME_SHORTNAME."_fb_data_layout",
	"type" => "select",
	"options" => array("standard","button_count","box_count"),
	"std" => "button_count"),

array( "name" => "Verb to display",
	"id" => THEME_SHORTNAME."_fb_data_action",
	"type" => "select",
	"options" => array("like","recommend"),
	"std" => "like"),

array( "name" => "Show faces",
	"id" => THEME_SHORTNAME."_fb_data_faces",
	"type" => "select",
	"options" => array("false","true"),
	"std" => "false"),

array( "name" => "Color scheme",
	"id" => THEME_SHORTNAME."_fb_data_colorscheme",
	"type" => "select",
	"options" => array("light","dark"),
	"std" => "light"),

array( "name" => "Font",
	"id" => THEME_SHORTNAME."_fb_data_font",
	"type" => "select",
	"options" => array("arial","lucida grande","segoe ui","thaoma","trebuchet ms","verdana"),
	"std" => "arial"),

array( "name" => "Width",
	"id" => THEME_SHORTNAME."_fb_data_width",
	"type" => "text",
	"std" => "250"
	),

array( "type" => "close"), //__________________ chiusura ///////////////////////////

////////////////////////////////////////////////////////////////////////////////////////
																							// Twitter options

///////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-twitter-sign"></i> Tweet button',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura	

array( "name" => "Auto add Twitter button on single pages and posts ",
	"desc" => "Add the \"tweet this\" button in single pages",
	"id" => THEME_SHORTNAME."_tweet_on_singles",
	"type" => "select",
	"options" => array("disabled","enabled"),
	"std" => "enabled"),
array( "type" => "close"), //__________________ chiusura ///////////////////////////

////////////////////////////////////////////////////////////////////////////////////////

																							// Google+ options
///////////////////////////////////////////////////////////////////////////////////////


array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-google-plus-sign"></i> Google+ button',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura	

array( "name" => "Auto add Google+ button on single pages and posts ",
	"desc" => "Add the \"Google+ this\" button in single pages",
	"id" => THEME_SHORTNAME."_gplus_on_singles",
	"type" => "select",
	"options" => array("disabled","enabled"),
	"std" => "enabled"),
array( "type" => "close"), //__________________ chiusura ///////////////////////////

////////////////////////////////////////////////////////////////////////////////////////



																							// Statistics


///////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-bar-chart"></i> Statistics',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura	

array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => THEME_SHORTNAME."_ga_code",
	"type" => "textarea",
	"std" => ""),	

array( "name" => "Other tracking code (HTML HEAD)",
	"desc" => "Here you can add any javascript for tracking code that will be pushed in the HTML HEAD section",
	"id" => THEME_SHORTNAME."_tracking_head",
	"type" => "textarea",
	"std" => ""),

array( "name" => "Other tracking code (FOOTER)",
	"desc" => "Here you can add anytracking code that will be pushed before the </body> tag",
	"id" => THEME_SHORTNAME."_tracking_footer",
	"type" => "textarea",
	"std" => ""),

array( "type" => "close"), //__________________ chiusura ///////////////////////////

////////////////////////////////////////////////////////////////////////////////////////


																							// Contacts


///////////////////////////////////////////////////////////////////////////////////////


array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-phone-sign"></i> Contacts',
	   //"image" => "icon_settings.png",
	"type" => "section"),//__________________ apertura	

array( "name" => "Name or business denomination",
	"desc" => "",
	"id" => THEME_SHORTNAME."_contact_name",
	"type" => "text"),

array( "name" => "E-mail",
	"desc" => "The address will appear in all the contact sections",
	"id" => THEME_SHORTNAME."_contact_email",
	"type" => "text"),
array( "name" => "Telephone 1",
	"desc" => "Telephone number",
	"id" => THEME_SHORTNAME."_contact_phone1",
	"type" => "text"),
array( "name" => "Telephone 2",
	"desc" => "Telephone number",
	"id" => THEME_SHORTNAME."_contact_phone2",
	"type" => "text"),
array( "name" => "Telephone 3",
	"desc" => "Telephone number",
	"id" => THEME_SHORTNAME."_contact_phone3",
	"type" => "text"),
array( "name" => "Telephone 4",
	"desc" => "Telephone number",
	"id" => THEME_SHORTNAME."_contact_phone4",
	"type" => "text"),

array( "name" => "Address line 1",
	"desc" => "",
	"id" => THEME_SHORTNAME."_contact_address1",
	"type" => "text"),


array( "name" => "Address line 2",
	"desc" => "",
	"id" => THEME_SHORTNAME."_contact_address2",
	"type" => "text"),

array( "name" => "Address line 3",
	"desc" => "",
	"id" => THEME_SHORTNAME."_contact_address3",
	"type" => "text"),

array( "name" => "Address line 4",
	"desc" => "",
	"id" => THEME_SHORTNAME."_contact_address4",
	"type" => "text"),

array( "type" => "close"), //__________________ chiusura ///////////////////////////




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				 // Mixcloud Podcast Importer
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-cloud"></i> Import Mixcloud',
		"type" => "section"),//__________________ apertura	

array( "name" => "Import Podcast",
		"desc" => "Performing the dinamic import",
		"qwaction" => 'importMixcloudNow',
		"type" => "dynamicaction"),

array( "name" => "Mixcloud Channel to import",
		"desc" => "Copy here the mixcloud user flax, eg. for http://.mixcloud.com/CarlCox the flag is \"CarlCox\" ",
		"id" => "importMixcloudNow",
		"dyn_action" => 'importMixcloudNow',
		"type" => "action_field"),

array( "type" => "close"), //__________________ chiusura ///////////////////////////




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


				 // Beatport Artist Importer

				
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-star"></i> Import Artist Page',
		"type" => "section"),//__________________ apertura	

array( "name" => "Import Artist",
		"desc" => "Performing the dinamic import",
		"qwaction" => 'importArtistFromBeatport',
		"type" => "dynamicaction"),

array( "name" => "Beatport Artist to import",
		"desc" => "
		<h2>This function is deprecated. Use the new powerful QantumThemes Beatport Importer!</h2>
		<h2>Go in Tools > <a href=\"tools.php?page=qtbeatimp_settings\">QT Beatp. Importer</a></h2>",
		"id" => "importEpFromBeatport",
		"dyn_action" => 'importEpFromBeatport',
		"type" => "temporary_text"),

array( "type" => "close"), //__________________ chiusura ///////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				 // Beatport EP Importer

				
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

array( "type" => "open"),//__________________ apertura

array( "name" => '<i class="icon-music"></i> Import Release',
		"type" => "section"),//__________________ apertura	

array( "name" => "Import Release",
		"desc" => "Performing the dinamic import",
		"qwaction" => 'importEpFromBeatport',
		"type" => "dynamicaction"),

array( "name" => "Beatport Release to import",
		"desc" => "
		<h2>This function is deprecated. Use the new powerful QantumThemes Beatport Importer!</h2>
		<h2>Go in Tools > <a href=\"tools.php?page=qtbeatimp_settings\">QT Beatp. Importer</a></h2>",
		"id" => "importEpFromBeatport",
		"dyn_action" => 'importEpFromBeatport',
		"type" => "temporary_text"),
array( "type" => "close"), //__________________ chiusura ///////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////

				 // Reference
			
//////////////////////////////////////////////////////////////////////////////////////////////



array( "type" => "open"),//__________________ apertura
array( "name" => '<i class="icon-print"></i> Reference',
	"type" => "section"),//__________________ apertura	

array( "name" => "List of references",
	"type" => "reference"),//__________________ apertura	

array( "type" => "close") //__________________ chiusura ///////////////////////////

);

?>