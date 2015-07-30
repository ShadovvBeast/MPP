<?php
/*
* Plugin Name: Recent release widget
* Description: Display your recent releases in a widget
* Version: 1.0
*/

add_action( 'widgets_init', 'recentrelease_widget' );
function recentrelease_widget() {
	register_widget( 'RecentRelease_Widget' );
}

class RecentRelease_Widget extends WP_Widget {
	function RecentRelease_Widget() {
		$widget_ops = array( 'classname' => 'recentreleasewidget', 'description' => __('A widget that displays recent releases ', 'recentreleasewidget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recentreleasewidget-widget' );
		$this->WP_Widget( 'recentreleasewidget-widget', __('Recent Releases Widget', 'recentreleasewidget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; 
		$query = new WP_Query();
		//Send our widget options to the query
		$query->query( array(
			'post_type' => 'release',
			'posts_per_page' => $instance['number'],
			'posts_status' => 'publish',
			'ignore_sticky_posts' => 1
		   )
		 );
		?>
        <ul>
        <?php
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <li>
                <a class="qw-blocklink" href="<?php the_permalink(); ?>">
                	<?php
					if($instance['showcover']=='true'){
                       if(has_post_thumbnail())  { ?>
                              <?php the_post_thumbnail('thumbnail','class=qw-widget-thumbnail');?>
                              <?php
                              $contentspan = '5';
                              }
						}
					?>
               		<span class="qw-widg-singleline"><?php the_title(); ?></span>
               		<br><span class="qw-widg-tags"><?php echo get_post_meta($query ->post->ID,'general_release_details_release_date',true); ?></span>
                    <div class="canc"></div>
                    </a>
            </li>        
        <?php endwhile; endif; 
		?>
        </ul>
        <?php
		///////=======================================================================//////////// QUI VA L'OUTPUT ///////////////////////
		echo $after_widget;
	}

	//Update the widget 
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
		$defaults = array( 'title' => __('Recent Releases', 'recentreleasewidget'),
							'showcover'=> 'true',
							'number'=> '5',
							);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	 	<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'recentreleasewidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Quantity:', 'number'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>
      <p>
			<label for="<?php echo $this->get_field_id( 'showcover' ); ?>"><?php _e('Show cover', 'recentreleasewidget'); ?></label><br />			
           True   <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="true" <?php if($instance['showcover'] == 'true'){ echo ' checked= "checked" '; } ?> />  
           False  <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="false" <?php if($instance['showcover'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>  
	<?php
	}
}
?>