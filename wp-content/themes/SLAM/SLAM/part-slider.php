<div class="qw-slider-box">
  <div class="spacer">
  </div>
  <div class="qw-innerbox">
    <?php
			$selected_slider = get_option(THEME_SHORTNAME.'_slider_name');
			switch ($selected_slider){
				case 'Nivo Slider':
					include ('includes/nivoslider.php');
				break;
				case 'Bootstrap Slider':
					include ('includes/bootstrapslider.php');
				break;
				case 'QT Slideshow':
						if(function_exists('qtslideshows_add_slideshow') && is_numeric(get_option(THEME_SHORTNAME."_qtslideshow_id"))){
							echo do_shortcode('[qtslideshows id="'.get_option(THEME_SHORTNAME."_qtslideshow_id").'" /]');
						}else{
							echo 'error';	
						}
				break;
			}
	?>
  </div>
</div>

