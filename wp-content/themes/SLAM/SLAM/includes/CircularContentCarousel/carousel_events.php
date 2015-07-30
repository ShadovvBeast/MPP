<?php
/*
*
*       ==================================================================
*       Extra module
*       Manage the number of events and other variables by changing this:
*       ==================================================================
*
*/
$number_of_events_to_show = "6";
$title_of_the_box = "Events";
$text_of_the_button = "More Info";


/*
*
*
* DON'T CHANGE THIS
*
*
*
*
*/

if(!function_exists('get_event_carousel_details')){
function get_event_carousel_details($id){

 if(get_post_type( $id ) != CUSTOM_TYPE_EVENT){
        return $content;
    }
    $street = get_post_meta($id,EVENT_PREFIX . 'street',true); 
    $city = get_post_meta($id,EVENT_PREFIX . 'city',true); 
    $cap = get_post_meta($id,EVENT_PREFIX . 'cap',true); 
    $website = get_post_meta($id,EVENT_PREFIX . 'website',true); 
    $phone = get_post_meta($id,EVENT_PREFIX . 'phone',true); 
    $coord = get_post_meta($id,EVENT_PREFIX . 'coord',true); 
    $location = get_post_meta($id,EVENT_PREFIX . 'location',true); 
    $date = get_post_meta($id,EVENT_PREFIX . 'date',true); 
    $facebooklink = get_post_meta($id,EVENT_PREFIX . 'facebooklink',true); 
    $fbcomments = get_post_meta($id,EVENT_PREFIX . 'fbcomments',true); 
    $title = get_the_title($id);
    $map = '';
    
    if($city!=''){
        $map =  '
        <div class="gmap" id="map" data-center="'.$street.' '.$city.'" data-zoom="15">
            <address>
              <strong>'.get_the_title($id).'</strong><br />
              '.$street.'<br />
              '.$cap.' '.$city.'
            </address>
          </div>';
    }
    $details = '
    <h4 class="qw_event_title ">Event Details</h4>
    <table class="inCarouselEvent" cellpadding:"0" cellspacing="0" >
            <tbody>
                    '.(($date!='') ? '<tr><th>Date:</th> <td>'.$date.'</th></tr>' : '').'
                    '.(($location!='') ? '<tr><th>Location:</th> <td>'.$location.'</td></tr>' : '').'
                    '.(($street!='' || $city!='') ? '<tr><th>Address:</th> <td> '.$street.' <br> '.$cap.' '.$city.'</td></tr>' : '').'
                    '.(($phone!='') ? '<tr><th>Phone:</th> <td>'.$phone.'</td></tr>' : '').'
                    '.(($website!='') ? '<tr><th>Website:</th> <td><a href="'.$website.'" target="_blank" rel="external nofollow">'.$website.'</a>'.'</td></tr>' : '').'
                    '.(($facebooklink!='') ? '<tr><th>Facebook:</th> <td><a href="'.$facebooklink.'" target="_blank" rel="external nofollow">Visit</a>'.'</td></tr>' : '').'
            </tbody>
    </table>'; 
    return $details;
}}
?>
<style>
    .eventcarousel .contents {  font-size: 11px;  line-height: 1.4em; }
    .eventcarousel .contents .buylinks a {  margin-bottom: 5px; }
    .eventcarousel .contents .buylinks a:last-child {  margin-bottom: 0px; }
</style>

      <h1><?php echo $title_of_the_box; ?></h1>                        
        <div id="ca-container" class="ca-container hidden-phone">
            <div class="ca-wrapper ">
                <?php
                $slider_category = get_term_by('name', get_option('qp_slider_cat'), 'category','ARRAY_A');
                $posts_query = new WP_Query('post_type=event&post_status=publish&posts_per_page='.$number_of_events_to_show.'&showposts='.$number_of_events_to_show);
                $slidenum = 0;
                $sliders ='';
                while ($posts_query->have_posts()) : $posts_query->the_post();
                        $slidenum ++;
                        ?>
                <div class="ca-item ca-item-<?php  echo $slidenum; ?>">
                    <div class="ca-item-main">
                        <div class="qw-carousel-imagepreview">
                                <?php  if(has_post_thumbnail())  { ?>					
                                    <a href="#" class="ca-expand-box">
                                    <?php the_post_thumbnail('medium',array('class' => 'qw-carouselimage','title' =>'Info')); ?>
                                    </a>
                                <?php }?>
                        </div>
                        <h5 class="qw-carousel-title"><?php the_title(); ?></h5>
                    </div>
                    <div class="ca-content-wrapper">
                        <div class="ca-content eventcarousel">
                            <h6><?php the_title(); ?></h6>
                            <a href="#" class="ca-close qw-hideme" >&times;</a>
                            <div class="ca-content-text qw-content-text">
                                <div class="row-fluid ca-carouselrow">
                                 <div class="span5 contents">
                                       <?php 
                                        the_excerpt();
                                        ?>
                                  </div>  
                                  <div class="span6 details">
                                         <?php
                                        global $post;
                                        $id = $post -> ID;
                                        echo get_event_carousel_details($id);
                                        ?>
                                  </div>
                                </div>    
                            </div>
                            <div class="ca-readall">
                                <a href="<?php the_permalink(); ?>"><?php echo $text_of_the_button; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php                   
        endwhile;        
        wp_reset_query();
        echo $sliders;
        ?>	
    </div><!-- ca-wrapper -->
</div><!-- ca-container -->