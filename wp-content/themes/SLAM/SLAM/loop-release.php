<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="row-fluid" >
    	 <div class="span8" >
               <div class="qw-listed-elements">
               		<?php get_template_part( 'part', 'release' ); ?>             
                </div>
      	</div>
        <div class="span4" >
         	<div class="qw-innerbox">
                <div class="qw-inside-innerbox" id="releasesidebar">
                	<?php display_sidebar("Release sidebar right"); ?>
                </div>
         	</div>
        </div>
  	</div>
</div>
 <?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>
<?php endif; ?>
