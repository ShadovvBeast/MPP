<?php 

 get_header();

 if(is_post_type_archive( 'podcast' )){

	get_template_part( 'loop', 'archivepodcast' );

 }else{

	get_template_part( 'loop', 'archive' );

 }

 get_footer(); 
 
?>