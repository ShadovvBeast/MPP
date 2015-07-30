<?php



add_action( 'widgets_init', 'posts_Widget' );


function posts_Widget() {
	register_widget( 'posts_Widget' );
}

class posts_Widget extends WP_Widget {
	
	
	/* = Initialize
	=============================================================*/
	
	function posts_Widget() {
		$widget_ops = array( 'classname' => 'qtwidget projectwidget', 'description' => __('A widget that displays posts ', 'postwidget') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'postwidget-widget' );
		$this->WP_Widget( 'postwidget-widget', __('QT Posts Widget', 'postwidget'), $widget_ops, $control_ops );
	}


	/* = Print widget 
	=============================================================*/
	
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; 
		$query = new WP_Query();

		$queryargs = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' =>$instance['number']
			/*
			'meta_key' => POST_PREFIX.'date',
			'orderby' => 'meta_value',
			'order' => 'DESC'
			*/
		   );

		
		if($instance['thecategory'] != '' && $instance['thecategory'] != 0){
			$queryargs['tax_query'] = array(
		        array(
		               'taxonomy' => 'category',
		               'field' => 'id',
		               'terms' => array($instance['thecategory'])
		        )
	   		 );
		}
		$query->query( $queryargs);
		?>
				<?php

				$layout = 'classic';
				if($instance['layout'] != ''){
					$layout = $instance['layout'];
				}

			    if($layout == 'classic'){

						?>
						<ul>
						<?php

						if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
						$postId = $query->post->ID;
						$span = "span12 marginfix borderbottom";
						?>		
							<li>	
								

									<a class="qw-blocklink" href="<?php the_permalink(); ?>">
										<?php
											if($instance['showthumbnail']=='true'){
								           		if(has_post_thumbnail())  {
								           			the_post_thumbnail('thumbnail','class=qw-widget-thumbnail');
							                    }
											}
										?>
										<span class="qw-widg-singleline	<?php echo(($instance['shorten_titles']=='yes')? 'ellipsis':'');?>">
												<?php the_title(); ?>
										</span>
										<br><span class="qw-widg-tags"><?php the_date("d F Y") ?></span>
										<div class="canc"></div>

									</a>



							</li>

						<?php endwhile; endif; 

						 if(isset($instance['archivelink']) && isset($instance['archivelink_text'])){
							if($instance['archivelink'] == 'show'){
								if($instance['archivelink_text']==''){$instance['archivelink_text'] = 'See all';};
							 	echo ' <li class="bordertop QTreadmore"><a href="'.get_post_type_archive_link('post').'"><i class="icon-chevron-right animated"></i> '.$instance['archivelink_text'].'</a></li>';
						 	} 
						 }
						
			    }elseif($layout == 'slider'){



				    	// slider
				    	$wid = str_replace("-",'',$args['widget_id']);
						?>
						<div id="<?php echo $wid;?>" class="carousel slide">

						   <div class="carousel-inner">
						   	<?php
						   		$active = 'active';
								if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
								$postId = $query->post->ID;

									if(has_post_thumbnail())  { 

									?>		<div class="item <?php echo $active; ?>">
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size = 'large', $attr = '' );?></a>
											</div>
									<?php
									$active = '';
									}
								endwhile; endif; 
							?>
							</div>
							 <a class="carousel-control animated left" href="#<?php echo $wid;?>" data-slide="prev"><i class="icon-chevron-left"></i></a>
						  	<a class="carousel-control animated right" href="#<?php echo $wid;?>" data-slide="next"><i class="icon-chevron-right"></i></a>
						</div>
						<?php


			    }

				echo $after_widget;
				?>
		
		<?php
	}

	/* = Update the widget 
	=============================================================*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$attarray = array(
				'title',
				'showthumbnail',
				'number',
				'archivelink',
				'thecategory',
				'archivelink_text',
				'shorten_titles',
				'layout'
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
		$defaults = array( 'title' => __('posts', 'postwidget'),
							'showthumbnail'=> 'true',
							'number'=> '5',
							'thecategory' => '',
							'archivelink'=> 'show',
							'shorten_titles'=> 'yes',
							'archivelink_text'=> 'See all',
							'layout' => 'classic'
							);

		/* = post type selector = */

		if(!array_key_exists('thecategory',$instance)){
			$instance['thecategory'] = '';
		}

		$filter_args = array(
			'show_option_all'    => 'Any',
			'show_option_none'   => '',
			'orderby'            => 'NAME', 
			'order'              => 'ASC',
			'show_count'         => 1,
			'hide_empty'         => 0, 
			'child_of'           => 0,
			'exclude'            => '',
			'echo'               => 1,
			'selected'           => (int)$instance['thecategory'],
			'hierarchical'       => 0, 
			'name'               =>  $this->get_field_name( 'thecategory' ),
			'id'                 => 'category',
			'class'              => 'postform',
			'depth'              => 0,
			'tab_index'          => 0,
			'taxonomy'           => 'category',
			'hide_if_empty'      => false
		);



		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	 	<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'postwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"  />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e('Layout', 'postwidget'); ?></label><br />			
           Classic list   <input type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" value="classic" <?php if($instance['layout'] == 'classic'){ echo ' checked= "checked" '; } ?> />  
           Slideshow  <input type="radio" name="<?php echo $this->get_field_name( 'layout' ); ?>" value="slider" <?php if($instance['layout'] == 'slider'){ echo ' checked= "checked" '; } ?> />  
		</p>
		<!--
        <p>
			<label for="<?php echo $this->get_field_id( 'thecategory' ); ?>"><?php _e('Category:', 'thecategory'); ?></label>
			<input id="<?php echo $this->get_field_id( 'thecategory' ); ?>" name="<?php echo $this->get_field_name( 'thecategory' ); ?>" value="<?php echo $instance['thecategory']; ?>"  class="widefat" />
		</p>
		-->
		<p>
			<label>Filter by category:<br /> </label>
			<?php wp_dropdown_categories($filter_args); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Quantity:', 'number'); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>"  class="widefat"  />
		</p>
      	<p>
			<label for="<?php echo $this->get_field_id( 'showthumbnail' ); ?>"><?php _e('Show image', 'postwidget'); ?></label><br />			
           True   <input type="radio" name="<?php echo $this->get_field_name( 'showthumbnail' ); ?>" value="true" <?php if($instance['showthumbnail'] == 'true'){ echo ' checked= "checked" '; } ?> />  
           False  <input type="radio" name="<?php echo $this->get_field_name( 'showthumbnail' ); ?>" value="false" <?php if($instance['showthumbnail'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>  
		 <p>
			<label for="<?php echo $this->get_field_id( 'archivelink' ); ?>"><?php _e('Show link to archive', 'postwidget'); ?></label><br />			
           Show   <input type="radio" name="<?php echo $this->get_field_name( 'archivelink' ); ?>" value="show" <?php if($instance['archivelink'] == 'show'){ echo ' checked= "checked" '; } ?> />  
           Hide  <input type="radio" name="<?php echo $this->get_field_name( 'archivelink' ); ?>" value="hide" <?php if($instance['archivelink'] == 'hide'){ echo ' checked= "checked" '; } ?> />  
		</p>
		<!--
        <p>
			<label for="<?php echo $this->get_field_id( 'archivelink_text' ); ?>"><?php _e('Link text:', 'postwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'archivelink_text' ); ?>" name="<?php echo $this->get_field_name( 'archivelink_text' ); ?>" value="<?php echo $instance['archivelink_text']; ?>" class="widefat" />
		</p>
		 <p>
			<label for="<?php echo $this->get_field_id( 'shorten_titles' ); ?>"><?php _e('Shorten long titles', 'postwidget'); ?></label><br />			
           Yes   <input type="radio" name="<?php echo $this->get_field_name( 'shorten_titles' ); ?>" value="yes" <?php if($instance['shorten_titles'] == 'yes'){ echo ' checked= "checked" '; } ?> />  
           No  <input type="radio" name="<?php echo $this->get_field_name( 'shorten_titles' ); ?>" value="no" <?php if($instance['shorten_titles'] == 'no'){ echo ' checked= "checked" '; } ?> />  
		</p>
	-->

	<?php
	}
}



?>