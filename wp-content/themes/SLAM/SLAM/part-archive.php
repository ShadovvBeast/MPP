<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="qw-innerbox qw-single-element qw-standard-content">
        <div class="qw-inside-innerbox">
         	
            
            <h2 class="qw-archiveitem"><a href="<?php the_permalink(); ?>"  title="<?php the_title(); ?>"><?php the_title(); ?> </a></h2>

             <div class="qw-archive-itemcontent row-fluid">
              <?php
              $contentspan = 12;
              $size = '580';
               if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
                      $url = $thumb['0'];
                      if( $url != ''){
                        $contentspan = 8;
                          ?>
                          <div class="span4">
                              <a href="<?php the_permalink(); ?>" class="qw-img-fx qw-borderbottom">
                                  <img src="<?php echo $url; ?>" class="qw-cover-artwork img-responsive qw-innerbox " alt="<?php echo the_title(); ?>" />
                              </a>
                          </div>
                          <?php
                      }
               };  
              ?>
							<div class="maincontent span<?php echo $contentspan;?>">

                <?php  the_content(); ?>
							</div>
            </div>
            <p class="qw-readallp qw-borderbottom">

              <i class="icon-time icon-white"></i><?php the_time('j F Y') ?>
              <i class="icon-user icon-white"></i><?php the_author_posts_link(); ?>
              <?php 
                    if (get_post_type( $post->ID ) != 'podcast'){
                      the_category( '&nbsp; <i class="icon-tags"></i>', ', ', ''); 
                    }else{
                      echo get_the_term_list( $post->ID, 'filter', '&nbsp; <i class="icon-tags"></i>', ', ', '' ); 
                    }
              ?>
  			       <a href="<?php the_permalink(); ?>" class="qw-readall">Read more <i class="icon icon-chevron-right"></i></a>
           </p>
        </div>
  </div><!--  end single element elements -->
    <?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>
<?php endif; ?>