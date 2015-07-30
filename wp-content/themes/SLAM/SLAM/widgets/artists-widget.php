<?php
/**
 * Plugin Name: Artists widget
 * Description: Display artists in a widget
 * Version: 1.0
 * Author: Igor Nardo
*/
add_action( 'widgets_init', 'artists_widget' );
function artists_widget() {
	register_widget( 'Artists_Widget' );
}

class Artists_Widget extends WP_Widget {
	function Artists_Widget() {
		$widget_ops = array( 'classname' => 'artistswidget', 'description' => __('A widget that displays artists ', 'artistswidget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'artistswidget-widget' );
		$this->WP_Widget( 'artistswidget-widget', __('Artists Widget', 'artistswidget'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; 
		$query = new WP_Query();

		//Send our widget options to the query
		
		$queryArray =  array(
			'post_type' => 'artist',
			'posts_per_page' =>$instance['number'],
			'ignore_sticky_posts' => 1,
			'order' => 'ASC'
		   );
		
		if($instance['specificid'] != ''){
			$posts = explode(',',$instance['specificid']);
			$finalarr = array();
			foreach($posts as $p){
				if(is_numeric($p)){
					$finalarr[] = $p;
				}
			};
			$queryArray['post__in'] = $finalarr;
		}
		
		$queryArray['orderby'] = 'menu_order';
		if($instance['order'] == 'Random'){
			$queryArray['orderby'] = 'rand';
		}
		
		$query->query($queryArray);
		
		 ?>
         <ul>
         <?php
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
		global $post;
			?>
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
               		<span class="qw-widg-singleline"><?php the_title(); ?><br>

               		</span>
               		<span class="qw-widg-tags">
               		<?php
               		$terms = get_the_terms($post->ID, 'artistgenre');
               		if(is_array($terms)){
               		foreach($terms as $t){
               			echo $t->name ;
               			if (next($terms)==true) echo  " / ";
               		}
               		}
               		?>
               		</span>
                    <div class="canc"></div>
                    </a>
            </li>
        <?php endwhile; endif; 
		?>
        </ul>
        <?php
        wp_reset_postdata();
		// L'OUTPUT ///////////////////////
		echo $after_widget;
	}

	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 

		$attarray = array(
				'title',
				'showcover',
				'number',
				'specificid',
				'order'
		);
		foreach ($attarray as $a){
			$instance[$a] = strip_tags( $new_instance[$a] );
		}
		return $instance;
	}

	function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Artists', 'artistswidget'),
							'showcover'=> 'true',
							'number'=> '5',
							'specificid'=> '',
							'order'=> 'Random'
							);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	 	<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'artistswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'specificid' ); ?>"><?php _e('Add only specific artists (by post ID, comma separated):', 'artistswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'specificid' ); ?>" name="<?php echo $this->get_field_name( 'specificid' ); ?>" value="<?php echo $instance['specificid']; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Quantity:', 'number'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>
      <p>
		<label for="<?php echo $this->get_field_id( 'showcover' ); ?>"><?php _e('Show cover', 'artistswidget'); ?></label><br />			
           True   <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="true" <?php if($instance['showcover'] == 'true'){ echo ' checked= "checked" '; } ?> />
           False  <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="false" <?php if($instance['showcover'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>  
      <p>
		<label for="<?php echo $this->get_field_id( 'showcover' ); ?>"><?php _e('Order', 'artistswidget'); ?></label><br />			
           Random   <input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="Random" <?php if($instance['order'] == 'Random'){ echo ' checked= "checked" '; } ?> />  
           Page Order  <input type="radio" name="<?php echo $this->get_field_name( 'order' ); ?>" value="Page Order" <?php if($instance['order'] == 'Page Order'){ echo ' checked= "checked" '; } ?> />  
		</p>  

	<?php

	}
}
?>