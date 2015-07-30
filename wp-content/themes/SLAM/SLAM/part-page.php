<div class="qw-innerbox"> 
    <div class="qw-inside-innerbox"> 
		       <?php
                $size = '950';
                 if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
                        $url = $thumb['0'];
                        if( $url != ''){
                            $big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full'  );
                            $big = $big[0];
                            ?>
                                        <img src="<?php echo $big; ?>" class="qw-featuredimage" alt="<?php echo the_title(); ?>"  >
                            <?php
                        }
                 };
                ?>
                <div class="qw-standard-content ">
					<div class="maincontent">
                        <?php the_content(); ?>  
                    </div> 
                     <?php 
					 comments_template();
					 ?>
                </div>
 	<?php
         if(get_option(THEME_SHORTNAME.'_like_on_singles')=='enabled'){
            echo  addLikeButton (get_permalink($post->ID));
         }
         if(get_option(THEME_SHORTNAME.'_tweet_on_singles')=='enabled'){
            echo  addTweetButton (get_permalink());
         }
          if(get_option(THEME_SHORTNAME.'_gplus_on_singles')=='enabled'){
            echo  addGplusButton (get_permalink());
         }
     ?>
     <div class="canc"></div>
   </div> 
</div><!--  end single element elements --> 





                 
