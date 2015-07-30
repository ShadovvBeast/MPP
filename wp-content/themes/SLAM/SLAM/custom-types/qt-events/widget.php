<?php



add_action( 'widgets_init', 'events_widget' );


function events_widget() {
	register_widget( 'events_Widget' );
}

class events_Widget extends WP_Widget {
	
	
	/* = Initialize
	=============================================================*/
	
	function events_Widget() {
		$widget_ops = array( 'classname' => 'eventswidget', 'description' => __('A widget that displays events ', 'eventswidget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'eventswidget-widget' );
		$this->WP_Widget( 'eventswidget-widget', __('Events Widget', 'eventswidget'), $widget_ops, $control_ops );
	}


	/* = Print widget 
	=============================================================*/
	
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; 
		$query = new WP_Query();

		$query->query( 
					  array(
			'post_type' => 'event',
			'posts_per_page' =>$instance['number'],
			'meta_key' => EVENT_PREFIX.'date',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'eventtype' =>$instance ['eventscategory']
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
                              }
						}
					?>
               		<span class="qw-widg-singleline"><?php the_title(); ?></span>
               		<br><span class="qw-widg-tags"><?php echo get_post_meta($query->post->ID,EVENT_PREFIX.'date',true); ?> <?php echo get_post_meta($query->post->ID,EVENT_PREFIX.'location',true); ?></span>
                    <div class="canc"></div>
                    </a>
            </li>
        <?php endwhile; endif; ?>
        
        <?php
		 if(isset($instance['archivelink']) && isset($instance['archivelink_text'])){
			if($instance['archivelink'] == 'show'){
				if($instance['archivelink_text']==''){$instance['archivelink_text'] = 'See all';};
		 	 	echo '<li class="bordertop QTreadmore">
		 	 	<a href="'.get_post_type_archive_link(CUSTOM_TYPE_EVENT).'"><i class="icon-chevron-right animated"></i> '.$instance['archivelink_text'].'</a>
		 	 	</li>';
		 	} 
		 }
		
		echo '</ul>';
		echo ((isset($after_widget))?$after_widget:'');
	}

	/* = Update the widget 
	=============================================================*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$attarray = array(
				'title',
				'showcover',
				'number',
				'archivelink',
				'eventscategory',
				'archivelink_text'
		);
		foreach ($attarray as $a){
			$instance[$a] = strip_tags( $new_instance[$a] );
		}
		return $instance;
	}




	/* = Form 
	=============================================================*/


	function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Events', 'eventswidget'),
							'showcover'=> 'true',
							'number'=> '5',
							'eventscategory' => '',
							'archivelink'=> 'show',
							'archivelink_text'=> 'See all'
							);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	 	<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'eventswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'eventscategory' ); ?>"><?php _e('Category:', 'eventscategory'); ?></label>
			<input id="<?php echo $this->get_field_id( 'eventscategory' ); ?>" name="<?php echo $this->get_field_name( 'eventscategory' ); ?>" value="<?php echo $instance['eventscategory']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Quantity:', 'number'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>
      	<p>
			<label for="<?php echo $this->get_field_id( 'showcover' ); ?>"><?php _e('Show cover', 'eventswidget'); ?></label><br />			
           True   <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="true" <?php if($instance['showcover'] == 'true'){ echo ' checked= "checked" '; } ?> />  
           False  <input type="radio" name="<?php echo $this->get_field_name( 'showcover' ); ?>" value="false" <?php if($instance['showcover'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>  
		 <p>
			<label for="<?php echo $this->get_field_id( 'archivelink' ); ?>"><?php _e('Show link to archive', 'eventswidget'); ?></label><br />			
           Show   <input type="radio" name="<?php echo $this->get_field_name( 'archivelink' ); ?>" value="show" <?php if($instance['archivelink'] == 'show'){ echo ' checked= "checked" '; } ?> />  
           Hide  <input type="radio" name="<?php echo $this->get_field_name( 'archivelink' ); ?>" value="hide" <?php if($instance['archivelink'] == 'hide'){ echo ' checked= "checked" '; } ?> />  
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'archivelink_text' ); ?>"><?php _e('Link text:', 'eventswidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'archivelink_text' ); ?>" name="<?php echo $this->get_field_name( 'archivelink_text' ); ?>" value="<?php echo $instance['archivelink_text']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}



?>