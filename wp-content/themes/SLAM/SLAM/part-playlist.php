<div id="qw-musicplayer-playlist">
           <div id="wrap-playlist">
           <div id="content_1" class="contentXX">
                    <ul class="qw-playlist">
                    <?php
						$nrelease = 5;
						$nrel = get_option(THEME_SHORTNAME."_qantmplayer_ep_playlist");
						if($nrel!=''){
							if(is_numeric($nrel)){
							$nrelease = $nrel;
							}
						}
						$args   = array(
							'post_type' => 'release',
							'post_status' => 'publish',
							'posts_per_page' => $nrelease
						);
						$posts_query = new WP_Query($args);
						$slidenum = 0;
						$sliders ='';
						$tracknumber = 0;
						$trackslist = array();
						while ($posts_query->have_posts()) : $posts_query->the_post();

								$id = $post->ID;
								$slidenum ++;                             
								$events= qp_get_group('track_repeatable'); 		
								if(is_array($events)){
								foreach($events as $event){ 
									$exclude =  0;
									if(isset($event['exclude'])) 
									{     
										$exclude =  $event['exclude'];
									}
										if($exclude!='1') {           
											$trackslist['t'.$tracknumber]= sanitizeMagicfieldsExternalUrl(trim($event['releasetrack_mp3_demo']));
											 ?>
											 
											 <li class="qw-carousel-track">  
												<a href="<?php echo sanitizeMagicfieldsExternalUrl($event['releasetrack_mp3_demo']); ?>" class="qw-carousel-mp3 qw-playertrack-link" data-id="<?php echo $tracknumber; ?>" id="trackid-<?php echo $tracknumber; ?>">►</a>
												<span class="qw-track-name">
												<?php 
												$title = $event['releasetrack_track_title']; 
												if(strlen($title) >= 40){
													$title = substr($title,0,40).'...';
												}
												echo $id.$title; 
												?><br />
												</span>
												<span class="qw-artists-names">
												<?php 
												$i=0;
												$max = 2;
												$array = explode(',',$event['releasetrack_artist_name']);
												echo trim($array[0]);
												if(isset($array[1])){
													echo ', '.trim($array[1]);	
												}
												if(isset($array[2])){
													echo '...';	
												}
												?>
												</span>
											</li>
											<?php 
											}
										$tracknumber++;
										
									}
								}// end if (is_array($events))
						endwhile;
						wp_reset_query();
					 ?>
                    </ul>
                </div>
      	</div>
     </div>

<?php 
	echo '<script>	
	var tracks = [';
	//$trackslist = array();
	$r=0;
	foreach($trackslist as $n => $t){
		$r++;
		echo '"'.$t.'"';
		if($r < count($trackslist)){
			echo ",\n";	
		}
		
	}
  	echo ' ];
	</script>';