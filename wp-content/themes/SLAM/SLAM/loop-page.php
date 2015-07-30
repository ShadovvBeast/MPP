<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="row-fluid">

    	 <div class="span12">
         <h1 class="qw-archive-title"><?php echo the_title(); ?></h1>
        </div>
  </div>
  <div class="row-fluid" >
    	 <div class="span8" >
           <div class="qw-listed-elements">
           		<?php	 get_template_part( 'part', 'page' );  ?>             
            </div>
      	</div>
        <div class="span4">
         	<div class="qw-innerbox">
                <div class="qw-inside-innerbox">
                	<?php display_sidebar("Single page sidebar"); ?>
                </div>                 
         	</div>
        </div>
  </div>

</div>

  <?php endwhile; else: ?>

<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>

<?php endif; ?>



