<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        #CSS
        wp_enqueue_style('gt3_default_style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style("gt3_responsive", get_template_directory_uri() . '/css/responsive.css');
        if (gt3_get_theme_option("default_skin") == 'skin_light') {
            wp_enqueue_style('gt3_skin', get_template_directory_uri() . '/css/light.css');
        }
        wp_enqueue_style("gt3_custom", $wp_upload_dir['baseurl'] . "/" . "custom.css");

        #JS
        wp_enqueue_script("jquery");
		wp_enqueue_script('gt3_mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array(), false, true);
		wp_enqueue_script('gt3_jscrollpane_js', get_template_directory_uri() . '/js/jquery.jscrollpane.min.js', array(), false, true);
        wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array(), false, true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

/*#Additional files for plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('nextgen-gallery/nggallery.php')) {
    if (!function_exists('nextgen_files')) {
        function nextgen_files()
        {
            wp_enqueue_style("gt3_nextgen", get_template_directory_uri() . '/css/nextgen.css');
            wp_enqueue_script('gt3_nextgen_js', get_template_directory_uri() . '/js/nextgen.js', array(), false, true);
        }
    }
    add_action('wp_enqueue_scripts', 'nextgen_files');
}*/

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    #CSS (MAIN)
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/core/admin/css/jquery-ui.css');
    wp_enqueue_style('colorpicker_css', get_template_directory_uri() . '/core/admin/css/colorpicker.css');
    wp_enqueue_style('gallery_css', get_template_directory_uri() . '/core/admin/css/gallery.css');
    wp_enqueue_style('colorbox_css', get_template_directory_uri() . '/core/admin/css/colorbox.css');
    wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    #CSS OTHER

    #JS (MAIN)
    wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js');
    wp_enqueue_script('ajaxupload_js', get_template_directory_uri() . '/core/admin/js/ajaxupload.js');
    wp_enqueue_script('colorpicker_js', get_template_directory_uri() . '/core/admin/js/colorpicker.js');
    wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
    wp_enqueue_script('backgroundPosition_js', get_template_directory_uri() . '/core/admin/js/jquery.backgroundPosition.js');
    wp_enqueue_script(array("jquery-ui-core", "jquery-ui-dialog", "jquery-ui-sortable"));
    wp_enqueue_media();
}

#Data for creating static css/js files.
$text_headers_font = gt3_get_theme_option("text_headers_font");

$main_menu_size = gt3_get_theme_option("menu_font_size");
$main_menu_height = substr(gt3_get_theme_option("menu_font_size"), 0, -2);
$main_menu_height = (int)$main_menu_height + 2;
$main_menu_height = $main_menu_height . "px";

$h1_font_size = gt3_get_theme_option("h1_font_size");
$h1_line_height = substr(gt3_get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height + 2;
$h1_line_height = $h1_line_height . "px";

$h2_font_size = gt3_get_theme_option("h2_font_size");
$h2_line_height = substr(gt3_get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height + 2;
$h2_line_height = $h2_line_height . "px";

$h3_font_size = gt3_get_theme_option("h3_font_size");
$h3_line_height = substr(gt3_get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height + 2;
$h3_line_height = $h3_line_height . "px";

$h4_font_size = gt3_get_theme_option("h4_font_size");
$h4_line_height = substr(gt3_get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height + 2;
$h4_line_height = $h4_line_height . "px";

$h5_font_size = gt3_get_theme_option("h5_font_size");
$h5_line_height = substr(gt3_get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height + 2;
$h5_line_height = $h5_line_height . "px";

$h6_font_size = gt3_get_theme_option("h6_font_size");
$h6_line_height = substr(gt3_get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height + 2;
$h6_line_height = $h6_line_height . "px";

$header_bg = gt3_HexToRGB(gt3_get_theme_option("header_bg_dark"));
$header_text = gt3_get_theme_option("header_text_dark");
$main_menu_text_color = gt3_get_theme_option("main_menu_text_color_dark");
$submenu_text_color = gt3_get_theme_option("submenu_text_color_dark");
$submenu_border = gt3_get_theme_option("submenu_border_dark");
$body_bg = gt3_get_theme_option("body_dark");
$main_text_color = gt3_get_theme_option("main_text_color_dark");
$header_text_color = gt3_get_theme_option("header_text_color_dark");
$block_bg = gt3_HexToRGB(gt3_get_theme_option("block_bg_dark"));
$footer_text = gt3_get_theme_option("footer_text_dark");
//background:rgba(' . gt3_HexToRGB(gt3_get_theme_option("theme_color1")) . ',0);

$custom_css = new cssJsGenerator(
    $filename = "custom.css",
    $filetype = "css",
    $output = '
	/* SKIN COLORS */
	.main_header {
		background:rgba(' . $header_bg . ',0.85);
	}
	.main_header:before {
		background: -moz-linear-gradient(rgba(' . $header_bg . ',0), rgba(' . $header_bg . ',1))!important;
		background: -ms-linear-gradient(rgba(' . $header_bg . ',0), rgba(' . $header_bg . ',1))!important;
		background: -o-linear-gradient(rgba(' . $header_bg . ',0), rgba(' . $header_bg . ',1))!important;
		background: -webkit-linear-gradient(rgba(' . $header_bg . ',0), rgba(' . $header_bg . ',1))!important;
	}
	.main_header:after {
		background: -moz-linear-gradient(rgba(' . $header_bg . ',1), rgba(' . $header_bg . ',0))!important;
		background: -ms-linear-gradient(rgba(' . $header_bg . ',1), rgba(' . $header_bg . ',0))!important;
		background: -o-linear-gradient(rgba(' . $header_bg . ',1), rgba(' . $header_bg . ',0))!important;
		background: -webkit-linear-gradient(rgba(' . $header_bg . ',1), rgba(' . $header_bg . ',0))!important;
	}
	.main_header nav ul.menu > li > a,
	ul.mobile_menu > li > a,	
	.filter_toggler {
		color:#' . $main_menu_text_color . ';
	}
	ul.mobile_menu li a {
		color:#' . $main_menu_text_color . '!important;
	}
	.main_header nav .sub-menu a {
		color:#' . $submenu_text_color . ';
	}
	ul.mobile_menu .sub-menu a {
		color:#' . $submenu_text_color . '!important;
	}
	ul.mobile_menu .sub-menu:before,
	ul.mobile_menu ul.sub-menu li:before,
	.main_header nav ul.menu .sub-menu:before,
	.main_header nav ul.sub-menu li:before {
		background:#' . $submenu_border . ';
	}
	.copyright {
		color:#' . $footer_text . ';
	}
	.site_wrapper {
		background:rgba(' . $block_bg . ',0.85);
	}

	h5.shortcode_accordion_item_title,
	h5.shortcode_toggles_item_title,
	h5.shortcode_accordion_item_title.state-active {
		color:#' . $main_text_color . '!important;
	}

    /* CSS HERE */
	body,
	.preloader {
		background:#' . $body_bg . ';
	}
	p, td, div,
	input {
		color:#' . $main_text_color . ';
		font-family:' . gt3_get_theme_option("main_font") . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.fs_descr {
		font-family:' . gt3_get_theme_option("main_font") . '!important;
	}
	a:hover {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}

	.main_header nav ul.menu li a,
	.main_header nav ul.menu li span,
	ul.mobile_menu li a,
	ul.mobile_menu li span,
	.filter_toggler {
		font-family: ' . gt3_get_theme_option("main_menu_font") . ';
		font-size: ' . $main_menu_size . ';
		line-height: ' . $main_menu_height . ';
	}

	::selection {background:#' . gt3_get_theme_option("theme_color1") . ';}
	::-moz-selection {background:#' . gt3_get_theme_option("theme_color1") . ';}

	.main_header nav ul.sub-menu > li:hover > a,
	.main_header nav ul.sub-menu > li.current-menu-item > a,
	.main_header nav ul.sub-menu > li.current-menu-parent > a,
	.mobile_menu > li.current-menu-item > a,
	.mobile_menu > li.current-menu-parent > a,
	a,
	blockquote.shortcode_blockquote.type5:before,
	.main_header nav ul.menu li:hover > a,
	.main_header nav ul.menu li.current-menu-ancestor > a,
	.main_header nav ul.menu li.current-menu-item > a,
	.main_header nav ul.menu li.current-menu-parent > a,
	ul.mobile_menu li.current-menu-ancestor > a span,
	ul.mobile_menu li.current-menu-item > a span,
	ul.mobile_menu li.current-menu-parent > a span,
	.dropcap.type2,
	.dropcap.type5,
	.widget_nav_menu ul li a:hover,
	.widget_archive ul li a:hover,
	.widget_pages ul li a:hover,
	.widget_categories ul li a:hover,
	.widget_recent_entries ul li a:hover,
	.widget_meta ul li a:hover,
	.widget_posts .post_title:hover,
	.shortcode_iconbox a:hover .iconbox_title,
	.shortcode_iconbox a:hover .iconbox_body,
	.shortcode_iconbox a:hover .iconbox_body p,
	.shortcode_iconbox a:hover .ico i,
	.price_item.most_popular h1,
	.featured_items_title h5 a:hover,
	.optionset li a:hover,
	.portfolio_dscr_top h3 a:hover,
	.portfolio_block h5 a:hover,
	.blogpost_title a:hover,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="password"]:focus,
	textarea:focus,
	.author_name a:hover,
	.header_filter .optionset li.selected a,
	.filter_toggler:hover {	
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}

	input[type="text"]:focus::-webkit-input-placeholder,
	input[type="email"]:focus::-webkit-input-placeholder,
	input[type="password"]:focus::-webkit-input-placeholder,
	textarea:focus::-webkit-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
		-webkit-font-smoothing: antialiased;
	}
	
	input[type="text"]:focus::-moz-placeholder,
	input[type="email"]:focus::-moz-placeholder,
	input[type="password"]:focus::-moz-placeholder,
	textarea:focus::-moz-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
		opacity: 1;
		-moz-osx-font-smoothing: grayscale;
	}
	
	input[type="text"]:focus:-ms-input-placeholder,
	input[type="email"]:focus:-ms-input-placeholder,
	input[type="password"]:focus:-ms-input-placeholder,
	textarea:focus:-ms-input-placeholder,
	.widget_posts .post_title:hover {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	
	h5.shortcode_accordion_item_title:hover,
	h5.shortcode_accordion_item_title.state-active,
	h5.shortcode_toggles_item_title:hover,
	h5.shortcode_toggles_item_title.state-active {
		color:#' . gt3_get_theme_option("theme_color1") . '!important;
	}

	.highlighted_colored,
	.shortcode_button.btn_type5,
	.shortcode_button.btn_type4:hover,
	h5.shortcode_accordion_item_title:hover .ico,
	h5.shortcode_toggles_item_title:hover .ico,
	h5.shortcode_accordion_item_title.state-active .ico,
	h5.shortcode_toggles_item_title.state-active .ico,
	.box_date .box_month,
	.preloader:after,
	.price_item.most_popular .price_item_title,
	.price_item.most_popular .price_item_btn a,
	.price_item .price_item_btn a:hover,
	.shortcode_button.btn_type1:hover	{
		background-color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	#mc_signup_submit:hover,
	.shortcode_button.btn_type4:hover,
	.load_more_works:hover,
	.pp_wrapper input[type="submit"]:hover,
	.search_button:hover {
		background-color:#' . gt3_get_theme_option("theme_color1") . '!important;
	}
	blockquote.shortcode_blockquote.type5 .blockquote_wrapper,
	.widget_tag_cloud a:hover,
	.fs_blog_top,
	.simple-post-top,
	.widget_search .search_form,
	.module_cont hr.type3,
	blockquote.shortcode_blockquote.type2 {
		border-color:#' . gt3_get_theme_option("theme_color1") . ';
	}

	/*Fonts Families and Sizes*/
	* {
		font-family:' . gt3_get_theme_option("main_font") . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	p, td, div,
	blockquote p,
	input,	
	input[type="text"],
	input[type="email"],
	input[type="password"],
	textarea {
		font-size:' . gt3_get_theme_option("main_content_font_size") . ';
		line-height:' . gt3_get_theme_option("main_content_line_height") . ';
	}
	.main_header nav ul.menu > li > a,
	ul.mobile_menu > li > a {
		font-size:'.$main_menu_size.';
		line-height: '.$main_menu_height.';
	}
	.main_header nav ul.menu > li > a:before,
	ul.mobile_menu > li > a:before {
		line-height: '.$main_menu_height.';
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 small, h2 small, h3 small, h4 small, h5 small, h6 small,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
		font-family: ' . $text_headers_font . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
		padding:0;
		color:#' . $header_text_color . ';
	}
	blockquote.shortcode_blockquote.type3:before,
	blockquote.shortcode_blockquote.type4:before,
	blockquote.shortcode_blockquote.type5:before,
	.dropcap,
	.shortcode_tab_item_title,
	.shortcode_button,
	input[type="button"], 
	input[type="reset"], 
	input[type="submit"],
	a.shortcode_button,
	.search404.search_form .search_button {
		font-family: ' . $text_headers_font . ';
	}
	.sidebar_header {
		font-family:' . gt3_get_theme_option("main_content_font") . ';
	}	
	.load_more_works {
		font-family: ' . $text_headers_font . ';
		color:#' . $header_text_color . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	.box_date span,
	.countdown-row .countdown-section:before,
	.countdown-amount,
	.countdown-period {
		font-family: ' . $text_headers_font . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	.iconbox_header .ico i,
	.title,
	.comment-reply-link:before,
	.ww_footer_right .blogpost_share span {
		color:#' . $header_text_color . ';
	}
	a.shortcode_button,
	.chart.easyPieChart,
	.chart.easyPieChart span,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.search404 .search_button {
		font-family: ' . $text_headers_font . ';		
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
		font-weight:' . gt3_get_theme_option("headings_weight") . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	
	input[type="button"],
	input[type="reset"],
	input[type="submit"] {
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased; 		
	}
	h1, h1 span, h1 a {
		font-size:' . $h1_font_size . ';
		line-height:' . $h1_line_height . ';
	}
	h2, h2 span, h2 a {
		font-size:' . $h2_font_size . ';
		line-height:' . $h2_line_height . ';
	}
	h3, h3 span, h3 a {
		font-size:' . $h3_font_size . ';
		line-height:' . $h3_line_height . ';
	}
	h4, h4 span, h4 a, 
	h3.comment-reply-title,
	h3.comment-reply-title a {
		font-size:' . $h4_font_size . ';
		line-height:' . $h4_line_height . ';
	}
	h5, h5 span, h5 a {
		font-size:' . $h5_font_size . ';
		line-height:' . $h5_line_height . ';
	}
	h6, h6 span, h6 a,
	.comment_info h6:after {
		font-size:' . $h6_font_size . ';
		line-height:' . $h6_line_height . ';
	}
	@media only screen and (max-width: 760px) {
		.fw_content_wrapper {
			background:#' . $body_bg . '!important;
		}
	}
    '
);

?>