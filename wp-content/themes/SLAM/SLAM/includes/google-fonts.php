<?php
	function QTenableGoogleFonts(){
		function QTaggGfont($font,$sel){
			echo '
			
			<!-- ============== QT GOOGLE FONTS ============================================ --> ';
			if($font != '' && $sel != ''){
				$id = str_replace(" ",'+',$font);
				$font = addslashes($font);
				echo '
			<link href="http://fonts.googleapis.com/css?family='.$id.'" rel="stylesheet" type="text/css">
			<style type="text/css">
				.googlefont, '.$sel.' { font-family: "'.$font.'", sans-serif;}
			</style> ';
			}
		}
		
		if( get_option(THEME_SHORTNAME."_googlefont_enable")=='true'){
			$gfont = get_option(THEME_SHORTNAME."_google_font");
			$sel = html_entity_decode (stripslashes(get_option(THEME_SHORTNAME.'_googlefont_selectors')));
			QTaggGfont($gfont,$sel);
			$gfont2 = get_option(THEME_SHORTNAME."_google_font2");
			$sel2 = html_entity_decode (stripslashes(get_option(THEME_SHORTNAME.'_googlefont_selectors2')));
			QTaggGfont($gfont2,$sel2);
		}
		if(get_option(THEME_SHORTNAME."_googlefont_enable")==''){
			QTaggGfont("Abel","h1, h2, h3, h4, .postdate p, .tagline");
			QTaggGfont("Alef","body, h5, h6, .navbar .nav li a, .fontface, .vcard, p, input, button, select, textarea");
		}
	}
	add_action('wp_head','QTenableGoogleFonts',999);
	
?>