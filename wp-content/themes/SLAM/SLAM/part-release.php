<div class="qw-innerbox">
   <div class="qw-inside-innerbox" >
          <h1 class="qw-artist-title"><?php echo the_title(); ?></h1>

          <div class="row-fluid">
                <div class="span4">
                 
                  <?php
                  $size = '250';
                   if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
                          $url = $thumb['0'];
                          if( $url != ''){
                              $big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                              $big = $big[0];
                              ?>
                                <a href="<?php echo $big; ?>" class="qw-nolightbox qw-cover-artwork  qw-img-fx qw-innerbox qtfgcolorbox">
                                       <img src="<?php echo $url; ?>" class="qw-cover-artwork qw-image-100 qw-autoheight qw-borderbottom" alt="<?php echo the_title(); ?>" >
                                </a>
                              <?php
                          }
                   };
                  ?>
                      <div class="qw-release-infos">
                              <?php 
                              $det = get_post_meta($post->ID,'general_release_details_label',TRUE);
                              if ( $det!='' ) {
                                  ?>
                                      <p>Label: <strong><?php echo $det; ?></strong></p>
                              <?php } ?> 
                              <?php 
                              $det = get_post_meta($post->ID,'general_release_details_release_date',TRUE);
                              if ( $det!='' ) {
                              ?>
                                      <p>Release date: <strong><?php echo  $det; ?></strong></p>
                              <?php } ?>  
                               <?php 
                              $det = get_post_meta($post->ID,'general_release_details_catalognumber',TRUE);
                              if ( $det!='' ) {
                              ?>
                                      <p>Catalog number: <strong><?php echo  $det; ?></strong></p> 
                              <?php } ?>  
                              <p class="qw-borderbottom qw-bottomspacer"><span class="qw-bottomspacer"></span></p>
                              <?php
                              $det = get_post_meta($post->ID,'general_release_details_buy_link',TRUE);
                              if ( $det!='' ) {
                              ?>
                                      <p>
                                          <a id="buynowdefault" class="btn btn-info btn-primary" rel="prettyPhoto" target="_blank" href="<?php echo $det; ?>" >
                                          <i class="icon-shopping-cart icon-white"></i>Buy now
                                          </a>
                                      </p>

                              <?php } ?>     

                              <?php
                                // update from V2: multiple buy link
                                $eventslinks= qp_get_group('track_repeatablebuylinks');    
                                if(is_array($eventslinks)){
                                  if(count($eventslinks)>0){
                                    foreach($eventslinks as $e){ 
                                        if ($e['cbuylink_url']!='') {
                                            echo '
                                             <p>
                                            <a href="'.$e['cbuylink_url'].'" class="btn btn-primary qw-buy-link custombuylink">
                                             <i class="icon-shopping-cart icon-white"></i>
                                             '.$e['cbuylink_anchor'].'</a>
                                             </p>';
                                        }
                                      
                                    }
                                  }
                                }
                ?>
                      </div>
                  </div>     <!-- span4 -->                       
        
                  <div class="span8">
                       <div class="qw-inside-innerbox qw-sidebar-item qw-playlist-release-info" id="qw-release-playlist"> 
                          <h3>Tracks:</h3>
                          <table><tbody>
                          <?php 

                            $events= qp_get_group('track_repeatable');   
                            if(is_array($events)){
                              foreach($events as $event){ 
                                if(!isset($defaulttrack)){
                                  $defaulttrack = $event['releasetrack_mp3_demo'];
                                }
                                
                                ?>
                                              
                                              
                                  <?php 
                                  // Single track buy link
                                  $trackBuyLink='';
                                  $colspan = ' colspan="2" ';
                                   if(isset($event['releasetrack_buyurl'])){
                                    if($event['releasetrack_buyurl']!=''){
                                      if($event['releasetrack_mp3_demo'] != ''){
                                        $colspan = ' colspan="3" ';
                                      }
                                      $trackBuyLink='<a data-toggle="tooltip" title="Buy this track" class="qw-singletrack-buy" href="'.$event['releasetrack_buyurl'].'" target="_blank"><i class="icon-shopping-cart"></i></a></td>';
                                    }
                                   }?>              
                                 <?php 
                                 // TRACK PLAYER FROM SOUNDCLOUD OR YOUTUBE
                                  $hide_mp3_link=false;
                                  if(isset($event['releasetrack_scurl'])){
                                    if($event['releasetrack_scurl']!=''){
                                      $hide_mp3_link=true;
                                      ?>
                                        <tr class="qw-release-track-row">
                                          <td <?php echo $colspan; ?>>
                                              <a href="<?php echo $event['releasetrack_scurl']; ?>"><?php echo $event['releasetrack_track_title']; ?></a>
                                            </td>
                                        </tr>
                                     <?php  
                                    }
                                  } 

                                ?>
                                  <tr class="qw-release-track-row">
                                  
                                  <td>
                                      <div class="row-fluid qw-notopspacing">
                                          <?php if ($hide_mp3_link == false){
                                           if(preg_match("/.mp3/", $event['releasetrack_mp3_demo'])){ ?>
                                          <a class="playable-mp3-link span2" href="<?php echo sanitizeMagicfieldsExternalUrl($event['releasetrack_mp3_demo']); ?>">></a>
                                         <?php }} ?>

                                         <div class="span10">
                                              <span class="qw-track-name">
                                              <?php echo $event['releasetrack_track_title']; ?><br />
                                              </span>
                                              <span class="qw-artists-names">
                                              <?php 
                                                $aname = $event['releasetrack_artist_name'];
                                                $nar=explode(',',$aname);
                                                $n=0;
                                                foreach($nar as $aname){
                                                  $n++;
                                                  $aname = trim($aname);
                                                  $link = qw_permalink_by_name($aname);
                                                  if($link!=''){
                                                  echo '<a href="'.$link.'" class="qw-artistname-title">'.$aname.'</a>';  
                                                  }else{
                                                    echo $aname;  
                                                  };
                                                  if($n<count($nar))
                                                  echo ', ';
                                                }
                                              ?>
                                              </span>
                                          </div>

                                      </div>


                                    </span>
                                  </td>
                                  <td>
                                     <?php echo $trackBuyLink; ?>
                                  </td>
                                </tr>

                      <?php }
                        }//end debuf if
                      ?>
                      </tbody></table>
                       </div>
                       <div class="maincontent qw-releasecontent">
                       <?php the_content(); ?>  
                       </div>
                  </div><!-- span8 -->


        </div>
        
        <div class="canc"></div>


        
        <?php  echo get_the_term_list( $post->ID, 'genre', '<p class="qw-list-tags"><i class="icon-tags"></i>', ' ', '</p>' );  ?>
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
</div> 

