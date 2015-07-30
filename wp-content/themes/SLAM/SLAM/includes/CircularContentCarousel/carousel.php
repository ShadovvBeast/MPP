<h1 class="qw-archive-title">Latest Releases</h1>
    <div class="hidden-phone hidden-tablet">
        <div class="qw-navirow " id="qw-3boxcarousel">
                        <span class="qw-navarrow qw-nav-prev">Previous</span><span class="qw-navarrow qw-nav-next">Next</span>
                        <div class="row-fluid">
          <div class="span12"  id="ca-outcontainer">
            


            <div class="qw-innerbox"  id="ca-outcontainer-content" > 

                    <div id="ca-container" class="ca-container ">
                    <div class="ca-wrapper ">
                    <?php
                    $slider_category = get_term_by('name', get_option('qp_slider_cat'), 'category','ARRAY_A');
                    $posts_query = new WP_Query('post_type=release&post_status=publish&posts_per_page=6&showposts=6');
                    $slidenum = 0;
                    $sliders ='';
                    $alternativeContents = '';
                    while ($posts_query->have_posts()) : $posts_query->the_post();
                            $slidenum ++;


                            if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' )){
                                $url = $thumb['0'];
                                if( $url != ''){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                                    $thumb = $thumb[0];
                                }
                         };

                            $alternativeContents .= '<tr>
                                                        <td style="width:16%">
                                                        '.((has_post_thumbnail())? 
                                                          '<img src="'.$url.'" class="img-responsive" alt="" >'
                                                           :'').'
                                                        </td>
                                                        <td style="width:84%">
                                                           
                                                                
                                                                    <a href="'.get_the_permalink().'">'.get_the_title().'</a>
                                                               
                                                            
                                                        </td>
                                                    </tr>';
                            ?>
                                <div class="ca-item ca-item-<?php  echo $slidenum; ?>">
                                    <div class="ca-item-main qw-borderbottom">
                                        <div class="qw-carousel-imagepreview">
                                                <?php  if(has_post_thumbnail())  { ?>					
                                                    <a href="#" class="ca-expand-box">
                                                    <?php the_post_thumbnail('large',array('class' => 'qw-carouselimage img-responsive','title' =>'Info')); ?>
                                                    </a>
                                                <?php }?>
                                        </div>
                                        <h5 class="qw-carousel-title"><?php the_title(); ?></h5>
                                    </div>
                                    <div class="ca-content-wrapper qw-borderbottom">
                                        <div class="ca-content">
                                            <h6><?php the_title(); ?></h6>
                                            <a href="#" class="ca-close qw-hideme" >&times;</a>
                                            <div class="ca-content-text qw-content-text">
                                                <div class="row-fluid ca-carouselrow">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                                 <ul class="qw-carousel-tracklist span6">
                                                                            <?php 
                                                                                $events= qp_get_group('track_repeatable'); 	
                                                                                $tracknumber = 0;
                                                                                if(is_array($events)){
                                                                                        foreach($events as $event){ 
                                                                                            if($tracknumber<6) {   
                                                                                             ?>
                                                                                             <li class="qw-carousel-track">  
                                                                                                <?php
                                                                                                if(array_key_exists('releasetrack_mp3_demo', $event)){
                                                                                                    if($event['releasetrack_mp3_demo'] != '') {
                                                                                                        if(preg_match("/.mp3/", $event['releasetrack_mp3_demo'])){
                                                                                                ?>

                                                                                                      <a href="<?php echo sanitizeMagicfieldsExternalUrl($event['releasetrack_mp3_demo']); ?>" class="qw-carousel-mp3">mp3</a>

                                                                                                <?php
                                                                                                        }
                                                                                                }}
                                                                                                ?>


                                                                                                <span class="qw-track-name">
                                                                                                <?php echo $event['releasetrack_track_title']; ?><br />
                                                                                                </span>
                                                                                                <span class="qw-artists-names">
                                                                                                <?php echo $event['releasetrack_artist_name'];	?>
                                                                                                </span>
                                                                                            </li>
                                                                                    <?php 
                                                                                            }// end iftracklist < 6
                                                                                        }// end if(is_array($events)){
                                                                                $tracknumber++;
                                                                            }
                                                                            ?>  
                                                                  </ul>  
                                                                  <div class="span6">
                                                                        <h4><a class="qw-carousel-alltracks" href="<?php the_permalink(); ?>">See all tracks (<?php echo count($events); ?> total) >></a></h4>
                                                                        <p>
                                                                            <?php 
                                                                            if ( get_post_meta($post->ID,'general_release_details_label',TRUE) ) {
                                                                            echo ' Label: '.get_post_meta($post->ID,'general_release_details_label',TRUE).'<br />';
                                                                            }
                                                                            ?>
                                                                            <?php 
                                                                            if ( get_post_meta($post->ID,'general_release_details_release_date',TRUE) ) {
                                                                            echo 'Release date: '.get_post_meta($post->ID,'general_release_details_release_date',TRUE).'<br />';
                                                                            }
                                                                            ?>
                                                                        </p>
                                                                         <?php if ( get_post_meta($post->ID,'general_release_details_buy_link',TRUE) ) { ?>
                                                                        <p>
                                                                            <a class="btn btn-small btn-primary qw-beatport-link" href="<?php echo get_post_meta($post->ID,'general_release_details_buy_link',TRUE); ?>" >
                                                                            <i class="icon-shopping-cart icon-white"></i>Buy now
                                                                            </a>
                                                                        </p>
                                                                        <?php } ?> 	
                                                                  </div>
                                                             </div>
                                                        </div>
                                                  </div>  
                                            </div>
                                            <div class="ca-readall">
                                                <a href="<?php the_permalink(); ?>">Go to release page</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php                   
                    endwhile;        
                    wp_reset_query();


                    ?>	

                    </div><!-- ca-wrapper -->
                    </div><!-- ca-container -->
    </div><!-- ca-wrapper -->
</div><!-- ca-container -->
</div><!-- ca-container -->
</div><!-- ca-container -->
</div><!-- ca-container -->

<table class="hidden-desktop qw-alternative-tracklist qw-innerbox">
    <?php echo $alternativeContents; ?>
</table>

<?php


/*
// LOADED BY FUNCTIONS.PHP ON create_carousel_styles FUNCTION
// i leave this if you need to modify something
wp_register_style( 'CircularContentCarousel', THEMEURL.'/includes/CircularContentCarousel/css/style-customized.css');
wp_enqueue_style( 'CircularContentCarousel' );	
wp_register_style( 'jscrollpane', THEMEURL.'/includes/CircularContentCarousel/css/jquery.jscrollpane.css');
wp_enqueue_style( 'jscrollpane' );	


Not needed! Already inside
wp_register_script( 'easingDynamic', THEMEURL.'/includes/CircularContentCarousel/js/jquery.easing.1.3.js');
wp_enqueue_script( 'easingDynamic' );
wp_register_script( 'mousewheelDynamic', THEMEURL.'/includes/CircularContentCarousel/js/jquery.mousewheel.js');
wp_enqueue_script( 'mousewheelDynamic' );
*/
//all scripts are loaded in create_scripts.php
?>