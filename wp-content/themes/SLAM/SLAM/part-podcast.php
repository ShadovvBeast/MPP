
<div class="qw-single-element qw-innerbox qw-podcast"> 
    <div class="qw-inside-innerbox ">
        <h1 class="qw-artist-title "><?php echo the_title(); ?></h1>
        <div class="row-fluid">
        	 <div class="span4 hidden-phone">
             	
        				<?php
                        $size = '270';
                         if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
                                $url = $thumb['0'];
                                if( $url != ''){
                                    $big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                                    $big = $big[0];														
                                    ?>
                                         <a href="<?php echo $big; ?>" class="qw-cover-artwork qw-archive-imagelink qw-img-fx qw-innerbox qw-nolightbox qtfgcolorbox">
                                            <img src="<?php echo $url; ?>" class="qw-cover-artwork qw-image-100" alt="<?php echo the_title(); ?>" >
                                        </a>
                                    <?php
                                }
                         };
                        ?>
                   <?php 
                   echo get_the_term_list( $post->ID, 'filter', '<p class="qw-list-tags"><i class="icon-tags"></i>', ' ', ' ' ); 
                 ?>
                
            </div>
            <div class="span8">  
        			<div class="qw-inside-innerbox maincontent">
        				<?php 
        				//======================= PLAYER ======================
                        $pUrl = get_post_meta($post->ID,'_podcast_resourceurl',true);
                        if($pUrl!=''){
        					
        					$domain = parse_url($pUrl);?>
                 
                        	<div class="qw-innerbox qw-podcastplayer">

                                     <div class="qw-sound-embedding maincontent">
                                <?php if(preg_match("/\.mp3/", $pUrl)){
                                    echo do_shortcode('[audio src="'.esc_url( $pUrl).'"]');
                                } else { ?>
                                   
                                    	<a href="<?php echo str_replace("https://","http://",$pUrl); ?>" class="qw-auto-embedding" >
                                   		<img src="<?php themeurl(); ?>/css/img/mp3.png" />
                                   		</a>
                                   
                                <?php } ?>
                                    
 </div>  
                            </div>
                            
                        <?php }; ?>
        				
        					<?php
                            //======================= CHANNEL IMAGE ======================
                            $size = '100';
                            $col2='12';
                             if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
                                $url = $thumb['0'];
                                if( $url != ''){
                                    $big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                                    $big = $big[0];
                                    $col2='10';
                                    ?>
                                      <a href="<?php echo $big; ?>" class="qw-img-fx qw-innerbox qw-channelimage">
                                             <img src="<?php echo $url; ?>" class="qw-cover-artwork qw-image-100 qw-smallthumb" alt="<?php echo the_title(); ?>" >
                                      </a>
                                    <?php
                                }
                             };
                            ?>
                            <?php 
                            //======================= CHANNEL NAME ======================
                            $artist = get_post_meta($post->ID,'_podcast_artist',true);
                            if($artist!=''){?>
                                <h3 class="qw_podcast_artist" ><?php echo $artist;?></h3>
                            <?php }; ?>
                     
                        <div class="separator"></div>
        				<?php
                        $pDate = get_post_meta($post->ID,'_podcast_date',true);
                        $date_array = explode('T',$pDate);
                        $pDate = $date_array[0];
                        if($pDate!=''){ ?>
                            <p class="qw_podcast_date">Published on: <?php echo $pDate; ?></p>
                        <?php }; ?>	
                        <?php the_content(); ?>
        		</div>
            </div> 

        
            <div class="canc"></div>

               
                 <?php
                         if(get_option(THEME_SHORTNAME.'_like_on_singles')=='enabled'){
                            echo  addLikeButton (get_permalink());
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
    </div>
</div><!--  end single element elements -->