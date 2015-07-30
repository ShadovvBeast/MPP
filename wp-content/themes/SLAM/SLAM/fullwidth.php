<?php
/*
Template Name Posts: Fullwidth Post
*/
?>
<?php
get_header();
 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <div class="qw-listed-elements"> 
                         <?php get_template_part( 'part', 'single' ); /* Controlled by quantum pro */ ?>             
                  </div>   
    
	</div>
  <?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>
<?php endif; 
get_footer();
?>