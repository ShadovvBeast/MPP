</div><!-- ajaxContainer -->
<footer>
   	<?php 
   	// _footer_widgets ========================================================================
  	if(get_option(THEME_SHORTNAME.'_footer_widgets') == 'enabled' ){
  	?>
        <div class="container qw-footer-widgets">
              <div class="row-fluid">
                <div class="span4">
                    
                      
                    <?php display_sidebar("Footer row left"); ?>
                    
                </div>
                <div class="span4">
                    <?php display_sidebar("Footer row middle"); ?>
                </div>
                <div class="span4">
                    <?php display_sidebar("Footer row right"); ?>
                    <?php get_template_part( 'part', 'address' ); /* Controlled by quantum pro */ ?>
                </div>
              </div>
              <!-- row sidebar end -->
        </div>
	<?php } ?>
    <div class="qw-privacyrow">
     <div class="container">
     		<div class="row-fluid">
      			<div class="span12 qw-positionrelative">
    				<?php echo html_entity_decode(stripslashes(get_option('qp_footer_text'))); ?>
    				<a href="#top" class="qw-arrowup pull-right"><i class="icon-arrow-up"></i></a>
    			</div>
    		</div>
    	</div>
    </div>
</footer>


<!--[if lt IE 9]>
<script src="<?php echo THEMEURL;?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo THEMEURL;?>/js/PIE.js"></script>
<![endif]-->

<?php
	// important for some queries
	global $wp;
	$current_url = esc_url(add_query_arg( $wp->query_string, '', home_url( $wp->request ) )); // used in some javascript functions
	// adding stats tracking codes
	echo  html_entity_decode (stripslashes(get_option(THEME_SHORTNAME.'_tracking_footer')));
	// adding google plus script
	 if(get_option(THEME_SHORTNAME.'_gplus_on_singles')=='enabled'){
		 ?>
		 <script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		 <?php
	 }
?>
<?php

	if ( get_option( THEME_SHORTNAME . '_body_background' ) != '' && get_option( THEME_SHORTNAME . '_fullscreen_background' )== 'true' ) {
		function add_anystretch(){
			$scriptbg =' 
				<script type="text/javascript">
				  $.anystretch("'.get_option( THEME_SHORTNAME . '_body_background' ).'", {speed: 150});
				</script>';
		}
		add_action('wp_footer','add_anystretch',99999999999999);
	} 


wp_footer(); ?>
</body>
</html>