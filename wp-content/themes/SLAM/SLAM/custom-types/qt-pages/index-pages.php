<?php

define ('POST_PREFIX','');


/* = main function 
=========================================*/

function add_special_fields() {



	/* = Custom fields 
	==============================================================*/


    $fields = array(


		array( // Repeatable & Sortable Text inputs
			'label'	=> 'Slideshow images/videos', // <label>
			'desc'	=> 'Add one for each slider', // description
			'id'	=> POST_PREFIX.'slider_images', // field id and name
			'type'	=> 'repeatable', // type of field
			'sanitizer' => array( // array of sanitizers with matching kets to next array
				'featured' => 'meta_box_santitize_boolean',
				'title' => 'sanitize_text_field',
				'desc' => 'wp_kses_data'
			),
			'repeatable_fields' => array ( // array of fields to be repeated
				'url' => array(
					'label' => 'Link',
					'id' =>  POST_PREFIX.'slider_link',
					'type' => 'text'
				),
				'slide_title' => array(
					'label' => 'Slide title',
					'id' =>  POST_PREFIX.'slide_title',
					'type' => 'text'
				),

				'video_url' => array(
					'label' => 'Youtube/Vimeo',
					'id' =>  POST_PREFIX.'video_url',
					'desc'  => 'If you insert a video url, image will be ignored',
					'type' => 'text'
				),
				'slider_image' => array(
					'label' => 'Image',
					'id' => POST_PREFIX.'slider_image',
					'type' => 'image'
				)
			)
		),
		array(
			'label' => 'Slideshow max height',
			'id' =>  POST_PREFIX.'slideshow_maxheight',
			'type' => 'text'
		)                    
    );



    if(post_type_exists('page')){
        if(function_exists('custom_meta_box_field')){
            $main_box = new custom_add_meta_box('slideshow', 'Slideshow', $fields, 'page', true );
        }
    }
    if(post_type_exists('post')){
        if(function_exists('custom_meta_box_field')){
            $main_box = new custom_add_meta_box('slideshow', 'Slideshow', $fields, 'post', true );
        }

    }
   

	
}

//add_action('init', 'add_special_fields');  


include 'widget-posts.php';
include 'post_taxonomy-fields.php';
