<?php



function cd_meta_cb( $post ) // <- <- <- <- <- <- <- <- <- <- <- EDIT THIS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

{

	//include 'vars.php';

	include get_template_directory().'/custom-types/'.CUSTOM_TYPE_CHART.'/vars.php';	

	

	require_once get_template_directory().'/custom-types/form_creation.php';	

	

	$post_type = get_post_type( $post );

	

	wp_nonce_field( 'save_'.$post_type.'_meta', $post_type.'_nonce' );
	
	// $n is the index to add to id fields
	$n=0;

	foreach($fields as $f){

		$f[2] = get_post_meta( $post->ID,  $f[0], true );

		//echo qantumpro_create_form_row( $f[0], $f[1], $f[2], $f[3], $n);
	
		$n++;

	}

    echo '<div style="clear:both">&nbsp;</div>';

}



?>