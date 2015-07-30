<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php 
        $url = get_post_meta($post->ID,'_artist_headerimage',true);
          if($url!='' && $url != 0){
           
        ?>
        <div class="qw-artist-header qw-innerbox">

              <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>"  class="qw_artistimage qw-innershadow " />


          </div>
        <?php }; ?>
        <div class="row-fluid" >
            <div class="span8" >
                <?php get_template_part( 'part', 'artist' ); /* Controlled by quantum pro */ ?>             
            </div>
            <div class="span4">
             	<div class="qw-innerbox">
                    <div class="qw-inside-innerbox">
                    	<?php display_sidebar("Artist sidebar right"); ?>
                    </div>
             	</div>
            </div>
        </div>
</div>
 <?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>
<?php endif; ?>