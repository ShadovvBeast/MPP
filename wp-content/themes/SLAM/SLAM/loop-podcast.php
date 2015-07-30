<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



               <div class="qw-listed-elements">

               		 <?php get_template_part( 'part', 'podcast' ); /* Controlled by quantum pro */ ?>             

                </div>


 

</div>


<?php endwhile; else: ?>

<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>

<?php endif; ?>