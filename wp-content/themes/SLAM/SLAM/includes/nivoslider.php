
<div id="wrapper" class="hidden-phone hidden-tablet visible-desktop">

            <div class="slider-wrapper theme-default"  >
            
                <div class="ribbon"></div>
                
                <div id="slider" class="nivoSlider">
                  
                <?php  
				
                $posts_query = new WP_Query('post_type=sliders&post_status=publish&posts_per_page=18');
				
       			$sliders = '';
				
				while ($posts_query->have_posts()) : $posts_query->the_post();
				
					echo 	'<a class="nivo-image" href="'.get_post_meta( $post->ID,  '_cd_slider_link', true ).'" >
					
					<img alt="See more!" src="'.get_post_meta( $post->ID,  '_cd_slider_image', true ).'"  width="900" height="300" />
					
			 		</a>'; 
			
				endwhile;
				
 				wp_reset_query();
				
 				?>

                </div>
                
            </div>
 
    	<div class="canc"></div>
        
</div>













