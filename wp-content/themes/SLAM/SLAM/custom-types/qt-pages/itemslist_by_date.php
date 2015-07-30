<?php
function get_event_list( $eventcategory = ''){
//wp_reset_postdata();
	$result   = '';
	global $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'event',
		'meta_key' => EVENT_PREFIX.'date',
		'orderby' => 'meta_value',
        'order' => 'ASC',
		'paged' => $paged
		/*'meta_compare' => 'LIKE',
		'meta_value' => $name */
	);
	

	if($eventcategory != ''){
		$args ['eventtype'] = $eventcategory;
	}
	
	$the_query_meta = new WP_Query( $args );
	global $post;
	$resarray = array();
	while ( $the_query_meta->have_posts() ):
		$the_query_meta->the_post();
		setup_postdata( $post );
		$url = '';
		if ( $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array('100','100')  ) ) 	
		{
			$url       = $thumb['0'];
		} 
		$resarray[] = array(
			'id' =>  $post->ID,
			'date' =>  get_post_meta($post->ID,EVENT_PREFIX.'date',true),
			'permalink' =>  get_permalink($post->ID),
			'title' =>  $post->post_title,
			'thumb' => $url
		);
	endwhile;
	wp_reset_postdata();
	return $resarray;
}

?>