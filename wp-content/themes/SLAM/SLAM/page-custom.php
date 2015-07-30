<?php
/*
Template Name: Fullwidth Page
*/
?>
<?php 

get_header(); 

 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


	 <h1 class="qw-archive-title"><?php echo the_title(); ?></h1>


<div class="row-fluid" >
	<div class="span12" >
		   <div class="qw-listed-elements">
				 <?php
                 get_template_part( 'part', 'page' ); 
                 ?>    
			</div>
	</div>
</div>
<div class="canc"></div>    
</div>

<?php endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>

<?php endif; ?>
<?php
get_footer(); 

?>