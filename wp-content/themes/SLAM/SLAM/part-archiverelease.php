<?php 
$custom_tax_array = array();
$html_list = '';
$counter = 0;
global $paged;
$temp = $wp_query;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$qyery_array = array( 'post_type' => 'release', 'order_by' => 'post_date', 'posts_per_page' =>8, 'post_status'=>'publish','paged' => $paged,  'showposts'=> 8 ) ;
$termfilter = get_term_by( 'slug', get_query_var( 'term' ), 'genre' );
if(is_object($termfilter)){
	$qyery_array['genre'] =$termfilter->slug;
}
$wpbp = new WP_Query($qyery_array ); 
$wp_query = $wpbp;
if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
		$contentspan = 8;
		$size = '250';
		 if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
			$url = $thumb['0'];
			if( $url != ''){
				$counter++;
				?>
               <div class="span3 qw-innerbox qw-borderbottom">
                        
                        <a href="<?php the_permalink(); ?>" class="qw-cover-artwork qw-archive-imagelink qw-img-fx">
                            <img src="<?php echo $url; ?>" class="qw-cover-artwork qw-image-100 qw-borderbottom" alt="<?php echo the_title(); ?>" >
                            <h4 class="equalizeblocks"><?php the_title(); ?></h4>
                        </a>
                </div>
				<?php
			}
		 
			if(($counter % 4) == 0){
				$opened = 1;
				echo '</div><div class="row-fluid">';
			}
		}
	endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','labelpro'); ?></p>
<?php endif; ?>
<?php
if(isset($opened)){
	if($opened == 1){
		?></div><?php
	}
}
?>