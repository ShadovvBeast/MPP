<div id="myCarousel" class="carousel slide">

   <div class="carousel-inner">
			
			<?php  
                        
					$posts_query = new WP_Query('post_type=sliders&post_status=publish&posts_per_page=12');
					
					$sliders = '';
					
					$n='active';
					
					while ($posts_query->have_posts()) : $posts_query->the_post();
					
			
						
						echo '<div class="item '.$n.'">
						<a class="nivo-image" href="'.get_post_meta( $post->ID,  '_cd_slider_link', true ).'" >
						<img src="'.get_post_meta( $post->ID,  '_cd_slider_image', true ).'" alt="">
						</a>
						</div>';
						$n='inactive';
					
					endwhile;
					
					wp_reset_query();
					
					?>
                </div>
                
     <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
     
     <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    
</div>

