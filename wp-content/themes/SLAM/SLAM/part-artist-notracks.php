<div class="qw-innerbox qw-artist-page">
           <div class="maincontent">
              <div class="qw-inside-innerbox qw-nobottompadding" >
                  <h1 class="qw-artist-title "><?php echo the_title(); ?></h1>
                     <?php
                          $size = '580';
                           if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
                                  $url = $thumb['0'];
                                  if( $url != ''){
                                      $big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                                      $big = $big[0];
                                      ?>
                                           <a href="<?php echo $big; ?>" class="qw-cover-artwork qw-archive-imagelink qw-img-fx qw-innerbox qtfgcolorbox cboxElement">
                                                  <img src="<?php echo $url; ?>" class="qw-featuredimage qw-image-100" alt="<?php echo the_title(); ?>"  >
                                            </a>
                                      <?php
                                  }
                           };
                     ?>     
                  <?php
								// ===================== social link icons ==============================================
							   
									$socialicons = social_link_icons($post->ID);							
									if($socialicons != '') {
										?>
										<ul class="qw-social">
										<?php
										echo $socialicons;
										?>
										</ul>
								   <?php 	}  ?>
						
                        		<div class="spacer"></div>
                        		<div class="separator"></div>
                                <div class="spacer"></div>
                                
                                <?php
                								$detVideo = create_details( $post->ID, 'artist','Youtube video',$params=array('class'=>''));
                								$detTracks = '';// get_artist_tracks ($post -> post_title);
                								$det1 = create_details( $post->ID, 'artist','Agency'); // includes/frontend_functions.php
                								$det2 = create_details( $post->ID, 'artist','Phone');
                								$det3 = create_details( $post->ID, 'artist','Email');
                                                $haveBookings = 0;
                                                if($det1!='' ||$det2!='' ||$det3!='' ){
                                                    $haveBookings = 1;
                                                }
                								
                								$Nationality = create_details( $post->ID, 'artist','Nationality');
                                                $Residentin = create_details( $post->ID, 'artist','Resident in');

                								?>
                                
                                
                                
                                <ul class="nav nav-tabs" id="artistTabs">
                                    <li class="active"><a href="#bio" data-toggle="tab">Biography</a></li>
                                    <?php if($haveBookings == 1){ ?> <li><a href="#info" data-toggle="tab">Info and Booking</a></li><?php  } ?>
                                </ul>
                                 
                                <div class="tab-content">
                                  <div class="tab-pane fade in active" id="videos">
                                        <div class="qw-inside-innerbox">
                                            	<?php if($detTracks!=''){	?>
                                                <h3 class="qw-artist-title">Releases</h3>
                                                <ul class="qw-artist-release-list">
                                                <?php echo $detTracks; ?>
                                                </ul>
                                                <?php } ?>
                                                <div class="spacer"></div>
                                                
                                              	<?php if($detVideo!=''){	?>
                                                 <h3 class="qw-artist-title">Videos</h3>
                                                <?php echo $detVideo; ?>
                                                <?php } ?>
                                            
                                        </div>                                    
                                  		<div class="canc"></div>
                                  </div>
                                  <div class="tab-pane fade" id="bio">
                                  		
                                        <div class="qw-inside-innerbox maincontent">
                                         <h3 class="qw-artist-title">Biography</h3>
                                   		<?php the_content(); ?>  
                                  		</div>
                                   </div>
                                   <?php
                                   /*
                                   *
                                   *    Booking details check
                                   *
                                   */
                                   if($haveBookings == 1){
                                   ?>
                                   <div class="tab-pane fade" id="info">                                   
                                   			<div class="qw-inside-innerbox">
                            					 <?php  if($det1!='' || $det2!='' || $det3!=''){  ?>
														
                                                        <h3 class="qw-artist-title">Booking</h3>
                
                                                       	 <?php  if($det1!=''){echo $det1.'<br />';} ?>
                                                         <?php  if($det2!=''){echo $det2.'<br />';} ?>
                                                         <?php  if($det3!=''){echo $det3.'<br />';} ?>
                										
                                                    <?php 	}  ?>
                                                    
                                                    
                                                     <?php
            									
                                                    if($Nationality!='' || $Residentin!='' ){
                    
                                                            ?>
                    
                                                            <h3 class="qw-artist-title">The artist</h3>
                    
                                                            <?php echo $Nationality; ?>
                    
                                                            <?php echo $Residentin; ?>
            
                                                    <?php 	}  ?>
                                                   <div class="canc"></div>
                                   			</div>
                                    </div>
                                    <?php
                                    } //end booking details check
                                    ?>
                                </div>
                        </div>
                    </div>
                        
  					<div class="span">
                <div class="qw-inside-innerbox" >
                    <?php the_tags( '<p class="qw-list-tags"><i class="icon-tags"></i>', '', '</p>'); ?>
                
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
                </div>
            </div>  
</div> 