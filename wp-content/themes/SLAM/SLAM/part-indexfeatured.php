<?php

/*
	Extract contents put as The Home and put them in the homepage
	// this comes from qantum panel options
*/
	
if(get_option(THEME_SHORTNAME."_homepage_extracontent_1") != ''){	
	$args = array(
	   'post_type'  => 'any',
	   'posts_per_page' => '1',
		'p' => get_option(THEME_SHORTNAME."_homepage_extracontent_1")
	);
	$posts_query = new WP_Query($args);
	while ($posts_query->have_posts()) : $posts_query->the_post();
		if( has_post_thumbnail()){

			$big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300,300) );    
		}
		
		?>
		<div class="spacer"> </div>  
		<div class="row-fluid">  
			<div class="span12" >
		    	<div class="qw-innerbox">
		        	<div class="qw-inside-innerbox maincontent">
						<?php the_content(); ?>
		            </div>
		        </div>
		 	</div>
		</div>

	<?php
	endwhile; 
	wp_reset_query();
}
?>