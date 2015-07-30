<?php
if ( get_option( THEME_SHORTNAME . '_facebook_sdk_include' ) == 'enabled' ){
?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
			<?php
				$fblang = $fblang = get_option(THEME_SHORTNAME.'_facebook_lang','en_EN');	
				
			?>
		  js.src = "//connect.facebook.net/<?php echo $fblang;?>/all.js#xfbml=1&appId=<?php echo get_option( THEME_SHORTNAME . '_facebook_apikey' );?>";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
        </script>
	<?php
} 
?>