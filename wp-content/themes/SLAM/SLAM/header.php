<?php // Read functions.php for CSS and JS inclusion ?>
<?php
header('X-Frame-Options: GOFORIT'); 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<title>
<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( esc_attr__( 'Page %s', 'labelpro' ), max( $paged, $page ) );
?>
</title>
<?php
// facebook metadata
if (is_single()){
	echo createMetadata($post->ID); //in frontend_functions.php only for single not archive
}
?>
<?php
	$favicon = get_option( THEME_SHORTNAME . '_favicon');
	if($favicon != ''){
?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
<?php }	?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php get_template_part( 'part', 'tracking' ); ?>
<?php get_template_part( 'part', 'custom_styles' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(get_option(THEME_SHORTNAME.'_boxed_layout').' woocommerce'); ?> id="theBody" data-autoplay="<?php echo esc_attr(get_option(THEME_SHORTNAME."_do_autoplay","no")); ?>"> 

	<?php get_template_part( 'part', 'facebooksdk' ); ?>
	<?php 
	$layoutStyle = get_option(THEME_SHORTNAME.'_boxed_layout');
	if($layoutStyle == ''){$layoutStyle = 'Boxed';}
	if(get_option(THEME_SHORTNAME."_demopanel")=='show' && isset($_COOKIE['cookie'.THEME_SHORTNAME.'_boxed_layout'])){
		if($_COOKIE['cookie'.THEME_SHORTNAME.'_boxed_layout'] != 'Default'){
			$layoutStyle = $_COOKIE['cookie'.THEME_SHORTNAME.'_boxed_layout'];
		}
	}
	if($layoutStyle== 'Unboxed' || $layoutStyle == '' || $layoutStyle == false){
		/*
		*
		*	Top Menu
		*
		*/
		if(current_user_can('manage_options') || get_option(THEME_SHORTNAME.'_underconstruction_enable')!= 'enable'){	
			get_template_part( 'part', 'topmenu' ); 
			get_template_part('part','playlist-fullscreen');
			 ?><div class="qw-borderbottom"></div><?php 
		}	
		?>

		<div class="qw-logobar-container qw-innerbox qw-borderbottom">
			<div class="container">
			<?php get_template_part( 'part', 'logobar' ); ?>
			</div>
		</div>
		<?php

	}
	?>

	<div class="<?php if($layoutStyle== 'Boxed'){ echo'container';}?> contentwrapper qw-totalwrapper" id="<?php if($layoutStyle== 'Unboxed'){ echo'maincontainer';}?>">
		<?php
			if(get_option(THEME_SHORTNAME.'_underconstruction_enable') == 'enable'){
				if ( current_user_can('manage_options')) { 
					$alertbox =  '<div class="alert alert-error">
					<h1>Attention: the "Coming Soon" page is enabled! Only administrators can see the website!!! </h1>
					<p>Change it in wpadmin > Appearance > QantumThemes Admin Panel > Coming Soon Page</p>
					</div>';
					echo $alertbox;
				}else{
					get_template_part('part','underconstruction');
				}
			}
		?>
		
		<?php 
			if($layoutStyle== 'Boxed'){
				get_template_part( 'part', 'logobar' );
				?></div><?php
				get_template_part( 'part', 'topmenuboxed' ); 	
				?><div class="container"><?php 
			//	get_template_part('part','playlist-fullscreen');
				?></div><?php 
			}
		?>

		<div id="ajaxContainer">
				<?php
				if( !is_paged() && ( is_home() || is_front_page() || get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-homepage.php') ){
					if($layoutStyle== 'Boxed'){ ?><div class="container"><?php }
				    get_template_part( 'part', 'revslider-boxed' ); 
				    if($layoutStyle== 'Boxed'){ ?></div><?php }
				} 

				?>

				<div class="container contentwrapper qw-totalwrapper" id="<?php if($layoutStyle== 'Boxed'){ echo'maincontainer';}?>">




				<?php get_template_part( 'part', 'breadcrumb' ); ?>	   