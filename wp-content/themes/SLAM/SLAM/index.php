<?php 

get_header();




if(!is_paged()){
	get_template_part( 'part', 'indexfeatured' ); // featured page

	get_template_part( 'part', 'homeslider' ); 

	get_template_part( 'part', '3boxcarousel' ); 

	get_template_part( 'part', 'homewidgets' ); 

	get_template_part( 'part', 'archivepodcasthome' );

	get_template_part( 'part', 'indexfeatured2' );// featured page

	//get_template_part( 'loop', 'indexarchiveartist' );// featured artists
}
//get_template_part( 'loop', 'archiveartist' ); //artists archive
get_template_part( 'loop', 'index' );// posts
?></div><?php
get_footer();

?>