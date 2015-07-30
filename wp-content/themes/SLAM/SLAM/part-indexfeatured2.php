<?php
/*
	Extract contents put as The Home and put them in the homepage
	// this comes from qantum panel options
*/
if(get_option(THEME_SHORTNAME."_homepage_extracontent_2") != ''){	
	$args = array(
	   'post_type'  => 'any',
	   'posts_per_page' => '1',
		'p' => get_option(THEME_SHORTNAME."_homepage_extracontent_2")
	);
	$posts_query = new WP_Query($args);
	while ($posts_query->have_posts()) : $posts_query->the_post();
		?>
	   <div class="qw-indexmodule">  
        	<div class="qw-innerbox">
        		<div class="qw-inside-innerbox">
	        		<h1 class="qw-archive-title"><?php the_title(); ?></h1>
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