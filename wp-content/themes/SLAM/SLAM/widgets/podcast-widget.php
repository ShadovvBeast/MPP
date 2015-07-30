<?php
/**
 * Plugin Name: Podcasts widget
 * Description: Display podcasts in a widget
 * Version: 1.0
 * Author: Igor Nardo
 */

add_action( 'widgets_init', 'podcasts_widget' );
function podcasts_widget() {
	register_widget( 'Podcasts_Widget' );
}

class Podcasts_Widget extends WP_Widget {
	function Podcasts_Widget() {
		$widget_ops = array( 'classname' => 'podcastswidget', 'description' => __('A widget that displays podcasts ', 'podcastswidget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'podcastswidget-widget' );
		$this->WP_Widget( 'podcastswidget-widget', __('Podcasts Widget', 'podcastswidget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; 
		global $paged;
		  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array( 
						  'post_type' => 'podcast', 
						  'posts_per_page' => $instance['number']
						   );
				global $podcastloop;
				wp_reset_query(); 
				$podcastloop= null;
				$podcastloop = new WP_Query();
				$podcastloop->query($args);
		 ?>
         <ul>
         <?php	 
		  if ($podcastloop->have_posts()) : while ($podcastloop->have_posts()) : $podcastloop->the_post(); ?>
            <li>
                <a class="qw-blocklink" href="<?php the_permalink(); ?>">
                    <?php
						if($instance['showcover']=='true'){
                       			if(has_post_thumbnail())  { ?>
                              <?php the_post_thumbnail('thumbnail','class=qw-widget-thumbnail');?>
                              <?php
                              }
						}
					?>
                    <?php
					$tit = get_the_title(get_the_ID());
					$tit = substr($tit,0,75);
					if(strlen($tit)>=75){$tit= $tit.' [...]';}
					?>
               		<span class="qw-widg-singleline"><?php echo $tit; ?></span>
               		<br><span class="qw-widg-tags"><?php echo get_post_meta($podcastloop ->post->ID,'_podcast_artist',true); ?></span>
                    <div class="canc"></div>
                </a>
            </li>
        <?php endwhile;  endif; ?>
        </ul>
        <?php
		wp_reset_query();
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$attarray = array(
				'title',
				'showcover',
				'number'
		);
		foreach ($attarray as $a){
			$instance[$a] = strip_tags( $new_instance[$a] );
		}
		return $instance;
	}
	function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Podcasts', 'podcastswidget'),
							'showcover'=> 'true',
							'number'=> '5',
							);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	 	<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'podcastswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Quantity:', 'number'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>
      	<p>
			<label for="<?php echo $this->get_field_id( 'showcover' ); ?>"><?php _e('Show cover', 'podcastswidget'); ?></label><br />			
           True   <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="true" <?php if($instance['showcover'] == 'true'){ echo ' checked= "checked" '; } ?> />  
           False  <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="false" <?php if($instance['showcover'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>  
	<?php
	}
}
?>