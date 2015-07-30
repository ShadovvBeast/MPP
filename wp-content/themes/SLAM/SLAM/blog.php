<?php /* Template Name: Blog */ ?>
<?php 
get_header(); 
global $paged;
$temp = $wp_query;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$qyery_array = array( 'post_type' => 'post', 'order_by' => 'post_date', 'post_status'=>'publish','paged' => $paged ) ;
$wpbp = new WP_Query($qyery_array ); 
$wp_query = $wpbp;

get_template_part( 'loop', 'archive' );
?></div><?php
get_footer();
?>