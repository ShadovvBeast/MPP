<?php 
 
get_header(); 


function get_event_list_area(){
	$result   = '';
	global $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'event',
		'meta_key' => EVENT_PREFIX.'date',
		'orderby' => 'meta_value',
        'order' => 'ASC',
		'paged' => $paged
	);
	

	if(get_query_var( 'eventarea' ) != ''){
		$args ['eventarea'] = get_query_var( 'eventarea' );
	}
	
	$the_query_meta = new WP_Query( $args );
	global $post;
	$resarray = array();
	while ( $the_query_meta->have_posts() ):
		$the_query_meta->the_post();
		setup_postdata( $post );
		$url = '';
		if ( $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array('75','75')  ) ) 	
		{
			$url       = $thumb['0'];
		} 
		$resarray[] = array(
			'id' =>  $post->ID,
			'date' =>  get_post_meta($post->ID,EVENT_PREFIX.'date',true),
			'location' =>  get_post_meta($post->ID,EVENT_PREFIX.'location',true),
			'street' =>  get_post_meta($post->ID,EVENT_PREFIX.'street',true),
			'city' =>  get_post_meta($post->ID,EVENT_PREFIX.'city',true),
			'permalink' =>  get_permalink($post->ID),
			'title' =>  $post->post_title,
			'thumb' => $url
		);
	endwhile;
	wp_reset_postdata();
	return $resarray;
}
?>
 
<div class="row-fluid" >
        <div class="span8" >
            <h1 class="qw-archive-title">
            <?php   
            $termname = '';
            if(isset($term)){
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                if(is_object($term)){
                    echo $term->name;
                } 
            }
            ?>
             Events</h1>
           

				<div class="qw-archive-release" >
				        	
				             <div class="qw-innerbox">
				            	 <div class="qw-inside-innerbox">
				            		<?php
				            		
				            		if(isset($term)){
				                        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				                        if(is_object($term)){
				                            $events =  get_event_list_area();
				                        } 
				                    }else{
				                        $events = get_event_list();   
				                    }


				                    if(count($events) > 0){ ?>
				                         <table class="table eventtable eventarchive" cellpadding:"0" cellspacing="0" >
				                            <tbody>
				                                <?php
				                                foreach($events as $e){
				                                    $d = explode('-',$e['date']);
				                                    $time = mktime(0, 0, 0, $d[1]);
				                                    setlocale(LC_TIME, get_bloginfo('language'));
				                                    $mname = strftime("%b", $d[1]);
				                                    switch ($d[1]){
				                                        case "1":$mname = __("jan","_qt");break;
				                                        case "2":$mname = __("feb","_qt");break;
				                                        case "3":$mname = __("mar","_qt");break;
				                                        case "4":$mname = __("apr","_qt");break;
				                                        case "5":$mname = __("may","_qt");break;
				                                        case "6":$mname = __("jun","_qt");break;
				                                        case "7":$mname = __("jul","_qt");break;
				                                        case "8":$mname = __("aug","_qt");break;
				                                        case "9":$mname = __("sep","_qt");break;
				                                        case "10":$mname = __("oct","_qt");break;
				                                        case "11":$mname = __("nov","_qt");break;
				                                        case "12":$mname = __("dec","_qt");break;
				                                    }
				                                    echo '<tr>
				                                    <td class="datebox"><span class="day">'.$d[2].'</span><span class="month fontface">'.$mname.'</span><span class="year fontface">'.$d[0].'</span></td>
				                                    <td class="image">'.(($e['thumb']!='')? '<a class="qw-ethumbnail" href="'.$e['permalink'].'"><img src="'.$e['thumb'].'" /></a>':'').'</td>
				                                    <td class="qt-eventlist-title"><a href="'.$e['permalink'].'" class="fontface">'.$e['title'].'</a><span class="qt-eventlist-details">'.$e['location'].' / '.$e['city'].' / '.$e['street'].'</span></td>
				                                    </tr>';
				                                }
				                                ?>
				                            </tbody>
				                        </table>
				                        <?php
				                    }else{
				                        ?>No events planned.<?php
				                    }
				                    ?>

				            	</div><!-- qw-inside-innerbox -->
				            </div><!-- qw-innerbox -->


				          <p>
				        <?php
				        global $wp_query;
				        $big = 999999999; // need an unlikely integer
				        echo paginate_links( array(
				            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				            'format' => '?paged=%#%',
				            'current' => max( 1, get_query_var('paged') ),
				            'total' => $wp_query->max_num_pages
				        ) );
				        ?>
				        </p> 



				</div>



        </div>
        <div class="span4">
            <div class="qw-innerbox">
                <div class="qw-inside-innerbox">
                    <?php display_sidebar("Archive sidebar right"); ?>
                </div>
            </div>
        </div>
</div>
</div>

<?php
get_footer();

?>