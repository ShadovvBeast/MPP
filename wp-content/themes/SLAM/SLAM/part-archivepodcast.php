<?php
// proper js scripts added into "create_scripts.php"
$custom_tax_array = array();
$html_list = '';
$count =0;
$counter = 0;
global $paged;
$temp = $wp_query;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$termfilter = get_term_by( 'slug', get_query_var( 'term' ), 'filter' );
$filter_name = '';
if(is_object($termfilter)){
	$filter_name = $termfilter->slug;
}
$wpbp = new WP_Query(array( 'post_type' => 'podcast','filter'=>$filter_name, 'posts_per_page' =>8, 'post_status'=>'publish','paged' => $paged,  'showposts'=> 8 ) ); 
$wp_query = $wpbp;
if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
		$terms = get_the_terms( get_the_ID(), 'filter' ); 	
		$size = '250';
		
		$datatype = '';
		if(isset($terms)){
			if(is_array($terms)){
				foreach ($terms as $term) { 
					$datatype .= strtolower(preg_replace('/\s+/', '-', $term->slug)).' '; 
					if(!in_array($term->slug,$custom_tax_array)){
						array_push($custom_tax_array, $term->slug);
					}
				}
			}
		}
		$count++;
		$playhereLink = '';
		$js = '';
		$pUrl = get_post_meta($post->ID,'_podcast_resourceurl',true);
		if($pUrl!=''){
			$playhereLink = '#';
			$js = ' onclick="javascript:newfunction(\''.$pUrl.'\')" ';
		}else{
			$playhereLink = get_permalink($post->ID);
		}

		$dataBgimg='';
		if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
			$url = $thumb['0'];
			$foundimage = '<img src="'.$url.'" class="qw-cover-artwork qw-image-100 qw-keepsize qw-hiddenpic" alt="Play this podcast" >';
			$dataBgimg = ' data-bgimg="'.$url.'" ';
		}else{
			$foundimage = 'View more >';	
		}


		/* Bootstrap cols fix */
		$fix = '';
		if(($counter % 3) == 0 && $counter > 0){
			//$fix = " fixBootstrapColLeft";
		}

		$html_list .= '<div class="span3 qw-podcas-archive-titem qw-quicksand-item '.$fix.' " data-id="id-'.$count.'" data-type="'.$datatype.'">
							<div class="qw-innerbox qw-keepwidth">
								<a href="#scrolltopPlayer" '.$js .' class="qw-squaredblock qw-autobg qw-img-fx  qw-borderbottom" '.$dataBgimg.'>
									'.$foundimage.'
								</a>
								<div class="qw-podcast-textblock">
									<h4 class="equalizeblocks">'.get_the_title($post->ID).'</h4>
									<a href="#playercontainerInpage" '.$js .' class="qw-readall">Play</a><a href="'.get_permalink().'" class="qw-readall">Go to podcast page</a>
								</div>
							</div>
						</div>';
		$counter++;
		
endwhile; else: 
?>
<p>
  <?php _e('Sorry, no posts matched your criteria.','labelpro'); ?>
</p>
<?php endif; ?>





<div class="qw-innerbox qw-inpage-player"  id="inpagePlayerBox" >
    <div class="qw-inside-innerbox">
            <div class="qw-playercontainer-inpage" id="playercontainerInpage">
            </div>
            <ul class="filterOptions tagcloud">
                <li class="active"><a href="#" class="all">All</a></li>
                <?php 
                    $final_term_array = array();
                    $counter = 12;
                    $args = array(
                        'orderby' => 'count',
                        'number' => '30',
                        'order'   => 'DESC',
                    );
                    $terms = get_terms('filter',$args);
                    foreach ($terms as $t){
                        if(in_array($t->slug,$custom_tax_array) && $counter>1){
                            array_push($final_term_array,array($t->slug,$t->name));
                            $counter-=1;
                        }
                    }
                    $term_list = '';
                    foreach ($final_term_array as $ter) {
                            $term_list .= '<li><a href="#" class="'. $ter[0] .'">' . $ter[1] . '</a></li>';
                    }
                    echo $term_list;
                ?>
            </ul>
            <div class="canc"></div>
     </div>      
 </div>
<div class="canc"></div>
<div class="row-fluid filterable-grid">
	<?php echo $html_list; ?>
</div>  
