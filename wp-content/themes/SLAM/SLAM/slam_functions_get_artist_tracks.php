// get_artist_tracks: used in the artist's pages, is needed to automatically find all the tracks by this artist and create the link to the tracks in his page



function get_artist_tracks( $name )



{

	wp_reset_postdata();



	$result         = '';



	$args           = array(


/*
		 'post_type' => 'release',
		'meta_key' => 'track_repeatable',
		'meta_compare' => 'LIKE',
		'meta_value' => $name 
*/

		'post_type' => 'release',
		 'posts_per_page' => 15,
 		 'meta_query' => array(
				array(
					'key' => 'track_repeatable',
					'value' => $name,
					'compare' => 'LIKE'
				)
			)
	);



	$the_query_meta = new WP_Query( $args );



	global $post;



	while ( $the_query_meta->have_posts() ):
		

		$the_query_meta->the_post();



		setup_postdata( $post );
		
		/////////////////////////////////
		// [2014-11-09] Added by Bernie for bedengler.com
		$metas = get_post_meta( $post->ID, 'track_repeatable', true );   // unserializes the meta data and returns it as array
		unset($showRelease);
		
		foreach($metas as $meta)
		{
			// if $name is contained in the title or the artist, show the track
			if(stripos($meta['releasetrack_track_title'], $name) !== false OR stripos($meta['releasetrack_artist_name'], $name) !== false)
				$showRelease = 1;
		}
		/////////////////////////////////
		
		if ( $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(



			 '100',



			'100' 



		) ) ) {



			$url       = $thumb[ '0' ];



			$thumbcode = '<img class="qw-artist-release-img" src="' . $url . '" alt="' . $post->post_title . '" />';



		} //$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '30', '30' ) )


		if($showRelease)	// [2014-11-09] Added by Bernie for bedengler.com
			$result .= '<li><a href="' . get_permalink( $post->ID ) . '" class="qw-author-release fontface">' . $thumbcode . $post->post_title . '</a></li>';



	endwhile;



	wp_reset_postdata();



	return $result;



}
