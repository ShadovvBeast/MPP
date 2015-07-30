<?php 
 
get_header(); 
 

 if(is_post_type_archive( 'podcast' )){

	get_template_part( 'loop', 'archivepodcast' );

 }else if(is_post_type_archive( 'event' )){

	get_template_part( 'loop', 'archiveevent' );

 }else if(is_post_type_archive( 'release' )){

	get_template_part( 'loop', 'archiverelease' );

 }else if(is_post_type_archive( 'artist' )){

	get_template_part( 'loop', 'archiveartist' );

 }else{

	get_template_part( 'loop', 'archive' );

 }



get_footer();

?>