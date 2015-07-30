<?php
/**
 * Plugin Name: Facebook page fanbox widget
 * Description: Display your fanbox in a sidebar
 * Version: 1.0
 * Author: Igor Nardo // QantumThemes
 */

add_action( 'widgets_init', 'facebookfanbox_widget' );
function facebookfanbox_widget() {
	register_widget( 'Facebook_Widget' );
}
class Facebook_Widget extends WP_Widget {
	function Facebook_Widget() {
		$widget_ops = array( 'classname' => 'fbfanboxwidget', 'description' => __('A widget that displays the facebook fanbox ', 'fbfanboxwidget') );
		$control_ops = array( 'width' => '100%', 'height' => 350, 'id_base' => 'fbfanboxwidget-widget' );
		$this->WP_Widget( 'fbfanboxwidget-widget', __('Facebook Fanbox Widget', 'fbfanboxwidget'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; 
		echo '
		<div class="fb_box" style="background:'.$instance['bgcolor'].';padding:'.$instance['padding'].'; "> 
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F'.$instance['pagename'].'&amp;width='.$instance['width'].'&amp;height='.$instance['height'].'&amp;show_faces='.$instance['showfaces'].'&amp;colorscheme='.$instance['colorscheme'].'&amp;stream='.$instance['streaming'].'&amp;show_border=false&amp;header='.$instance['header'].'&amp;appId=344331825656955" style="border:none; overflow:hidden; width:100%; height:'.$instance['height'].'px; border:none; overflow:hidden;"   ></iframe>
		</div>';
		echo $after_widget;
	}
	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$attarray = array(
				'bgcolor',
				'padding',
				'pagename',
				'width',
				'height',
				'colorscheme',
				'showfaces',
				'bordercolor',
				'streaming',
				'header',
				'scrolling'
		);

	

		foreach ($attarray as $a){

			$instance[$a] = strip_tags( $new_instance[$a] );

		}

		return $instance;

	}



	

	function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Facebook FanBox', 'fbfanboxwidget'),
							'bgcolor' => '020202',
							'padding' => '0px',
							'pagename' => 'QantumThemes',
							'width'		=> '270',
							'height'	=> '310',
							'colorscheme'=> 'dark',
							'showfaces'=> 'true',
							'bordercolor'=> '232323',
							'streaming'=> 'false',
							'header'=> 'false',
							'scrolling'=> 'false'
							);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	 	<h2>General options</h2>
	 	<!-- WIDGET TITLE ========================= -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<!-- PAGE NAME ========================= -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pagename' ); ?>"><?php _e('Page name:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pagename' ); ?>" name="<?php echo $this->get_field_name( 'pagename' ); ?>" value="<?php echo $instance['pagename']; ?>" style="width:100%;" />
		</p>
		<!-- PAGE NAME ========================= -->
		<p>
			<label for="<?php echo $this->get_field_id( 'bgcolor' ); ?>"><?php _e('Background color:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'bgcolor' ); ?>" name="<?php echo $this->get_field_name( 'bgcolor' ); ?>" value="<?php echo $instance['bgcolor']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'bordercolor' ); ?>"><?php _e('Border color:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'bordercolor' ); ?>" name="<?php echo $this->get_field_name( 'bordercolor' ); ?>" value="<?php echo $instance['bordercolor']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'padding' ); ?>"><?php _e('Internal padding:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'padding' ); ?>" name="<?php echo $this->get_field_name( 'padding' ); ?>" value="<?php echo $instance['padding']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Box width:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Box height:', 'fbfanboxwidget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" style="width:100%;" />
		</p>
			<p>
			<label for="<?php echo $this->get_field_id( 'colorscheme' ); ?>"><?php _e('Color scheme:', 'fbfanboxwidget'); ?></label><br />
		   Dark   <input type="radio" name="<?php echo $this->get_field_name( 'colorscheme' ); ?>" value="dark" <?php if($instance['colorscheme'] == 'dark'){ echo ' checked= "checked" '; } ?> />  
		   Light  <input type="radio" name="<?php echo $this->get_field_name( 'colorscheme' ); ?>" value="light" <?php if($instance['colorscheme'] == 'light'){ echo ' checked= "checked" '; } ?> />  
		</p> 
		<p>
			<label for="<?php echo $this->get_field_id( 'showfaces' ); ?>"><?php _e('Show faces', 'fbfanboxwidget'); ?></label><br />			
		   True   <input type="radio" name="<?php echo $this->get_field_name( 'showfaces' ); ?>" value="true" <?php if($instance['showfaces'] == 'true'){ echo ' checked= "checked" '; } ?> />  
		   False  <input type="radio" name="<?php echo $this->get_field_name( 'showfaces' ); ?>" value="false" <?php if($instance['showfaces'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>  
		<p>
			<label for="<?php echo $this->get_field_id( 'streaming' ); ?>"><?php _e('Show faces', 'fbfanboxwidget'); ?></label><br />			
		   True   <input type="radio" name="<?php echo $this->get_field_name( 'streaming' ); ?>" value="true" <?php if($instance['streaming'] == 'true'){ echo ' checked= "checked" '; } ?> />  
		   False  <input type="radio" name="<?php echo $this->get_field_name( 'streaming' ); ?>" value="false" <?php if($instance['streaming'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>   
		<p>
		<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php _e('Show streaming', 'fbfanboxwidget'); ?></label><br />			
		   True   <input type="radio" name="<?php echo $this->get_field_name( 'header' ); ?>" value="true" <?php if($instance['header'] == 'true'){ echo ' checked= "checked" '; } ?> />  
		   False  <input type="radio" name="<?php echo $this->get_field_name( 'header' ); ?>" value="false" <?php if($instance['header'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>   

		<p>
			<label for="<?php echo $this->get_field_id( 'scrolling' ); ?>"><?php _e('Show scrolling bar', 'fbfanboxwidget'); ?></label><br />			
		   True   <input type="radio" name="<?php echo $this->get_field_name( 'scrolling' ); ?>" value="true" <?php if($instance['scrolling'] == 'true'){ echo ' checked= "checked" '; } ?> />  
		   False  <input type="radio" name="<?php echo $this->get_field_name( 'scrolling' ); ?>" value="false" <?php if($instance['scrolling'] == 'false'){ echo ' checked= "checked" '; } ?> />  
		</p>       

	<?php
	}
}
?>