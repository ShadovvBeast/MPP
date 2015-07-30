<?php
/*
*	Plugin Name: QantumThemes Ajax RevSlider
*
*
*
*/



/*
*
* 	Script needed
*
*/
function add_ajax_revslider(){
	 wp_enqueue_script("qw-ajax_revslider", plugins_url( 'ajax_revslider.js', __FILE__ ) , array('jquery'), '',true);

}
add_action ("wp_enqueue_scripts","add_ajax_revslider",999999999999);





/*
*
* 	To enable revslider ajax 
*
*/
if(!function_exists('qw_revslider_ajax_data')){
function qw_revslider_ajax_data(){
	?>
	<div class="hidden" id="enableRsAjax" data-nnc="<?php echo esc_attr(wp_create_nonce("RevSlider_Front")); ?>" data-admu="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"></div>
	<?php
}}
add_action( 'wp_footer', 'qw_revslider_ajax_data' );




/*
*
* 	New shortcode that get slider ID from ALIAS
*
*/
if(!function_exists('qw_revslider_ajax_shortcode')){
function qw_revslider_ajax_shortcode( $att){
	$alias = $att[0];

	if($alias != ''){

		global $post;
		global $wpdb;
		global $table_prefix;

		if (!isset($wpdb->tablename)) {
			$wpdb->revsliders_sliders = $table_prefix . 'revslider_sliders';
		}
		
		if ( $slider_id = $wpdb->get_var( "SELECT id FROM $wpdb->revsliders_sliders WHERE ( alias = \"" . sanitize_title_for_query( $alias ) . "\" ) " ) ) {
			$slider_id = ( $slider_id );
			// Now I can make the ajax call for the slider, i'llprint out a div that will be translated from the js code



			if(is_numeric($slider_id)){
				echo '<div class="qw-revslider-cont" data-qwrevslider="'.$slider_id.'" ></div>';
			}


		} 	
		wp_reset_query();
	}

	//die();
	
}}
remove_shortcode ('rev_slider');
add_shortcode( 'rev_slider_ajax', 'qw_revslider_ajax_shortcode' );




add_action( 'plugins_loaded', 'depending_operation', 999 );

function depending_operation()
{
    remove_shortcode ('rev_slider');
	add_shortcode( 'rev_slider', 'qw_revslider_ajax_shortcode' );
}

