<?php 
$counter = 0;
global $paged;
$temp = $wp_query;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$termfilter = get_term_by( 'slug', get_query_var( 'term' ), 'artistgenre' );
$filter_name = '';
if(is_object($termfilter)){
	$filter_name = $termfilter->slug;
}

/*
*
*
*	Wanyt to change the order? see here: http://codex.wordpress.org/Class_Reference/WP_Query
*
*
*/
$wpbp = new WP_Query(array( 'post_type' => 'artist','artistgenre'=>$filter_name, 'posts_per_page' =>8, 'post_status'=>'publish', 'orderby'=>'menu_order','order' => 'ASC','paged' => $paged,  'showposts'=> 8 ) ); 
$wp_query = $wpbp;
if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
	$contentspan = 8;
	$size = '250';
	?>
       <div class="span3 qw-innerbox qw-borderbottom">
                <a href="<?php the_permalink(); ?>" class="qw-cover-artwork qw-archive-imagelink qw-img-fx">
					<?php
				 	if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
						$url = $thumb['0'];
						if( $url != ''){ $counter++;?>
                    	<img src="<?php echo $url; ?>" class="qw-cover-artwork qw-image-100 qw-borderbottom" alt="<?php echo the_title(); ?>" > 
                    	<?php
						}
					 }
				 	?>
                    <h4><?php the_title(); ?></h4>
                </a>
        </div>
	<?php
	if(($counter % 4) == 0){
		$opened = 1;
		echo '</div><div class="row-fluid">';
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
<? wp_reset_query(); ?>