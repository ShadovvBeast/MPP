<?php
//https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes/wiki/Field-Arrays

// GALLERY: http://wp.tutsplus.com/tutorials/creating-your-own-image-gallery-page-template-in-wordpress/



/////////////////////// INSTRUCTIONS /////////////////////////////////////////////
//https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes/wiki/Field-Arrays

$prefix = QTS_PREFIX;

  


$fields = array(

				array(
				    'label' => 'Include latest posts with a featured image',
				    'id'    => $prefix . 'latestposts',
				    'type'  => 'checkbox',
				    'sanitizer' => 'meta_box_santitize_boolean'
				),


				
				array(
					'label' => 'Number of elements (excluding sliders below)',
					'id'    => $prefix . 'elements_number',
					'type'  => 'slider',
					'min'   => '1',
					'max'   => '20',
					'step'  => '1'
				),
				
				array(
					'label' => 'Slideshow max height',
					'id' =>  $prefix.'slideshow_maxheight',
					'type' => 'text'
				),

			
				array( // Repeatable & Sortable Text inputs
					'label'	=> 'Slider Images', // <label>
					'desc'	=> 'Add one for each slider', // description
					'id'	=> $prefix.'slider_images', // field id and name
					'type'	=> 'repeatable', // type of field
					'sanitizer' => array( // array of sanitizers with matching kets to next array
						'featured' => 'meta_box_santitize_boolean',
						'title' => 'sanitize_text_field',
						'desc' => 'wp_kses_data'
					),
					'repeatable_fields' => array ( // array of fields to be repeated
						'url' => array(
							'label' => 'Link',
							'id' =>  $prefix.'slider_link',
							'type' => 'text'
						),
						'slide_title' => array(
							'label' => 'Slide title',
							'id' =>  $prefix.'slide_title',
							'type' => 'text'
						),

						'video_url' => array(
							'label' => 'Video url',
							'id' =>  $prefix.'video_url',
							'desc'  => 'If you insert a video url, image will be ignored',
							'type' => 'text'
						),
						'slider_image' => array(
							'label' => 'Image 940x350',
							'id' => $prefix.'slider_image',
							'type' => 'image'
						)
					)
				)											
);


if(post_type_exists(CUSTOM_TYPE_QTSLIDESHOW)){
	if(function_exists('custom_meta_box_field')){
		$sample_box = new custom_add_meta_box(CUSTOM_TYPE_QTSLIDESHOW, ucfirst(CUSTOM_TYPE_QTSLIDESHOW).' details', $fields, CUSTOM_TYPE_QTSLIDESHOW, true );
	}
	function slideshow_admin_init(){
		//wp_enqueue_script(wp_enqueue_script("module_switch", get_template_directory_uri()."/modules/default/script.js", 'jquery', '1.0',true));	
	}
	add_action('admin_init', 'slideshow_admin_init');
}
