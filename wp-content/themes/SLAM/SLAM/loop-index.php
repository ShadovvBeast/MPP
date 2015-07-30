	<!-- main content -->
    <?php 
 	   // _homepage_archive ========================================================================
  	if(get_option(THEME_SHORTNAME.'_homepage_archive') == 'enabled' || get_option(THEME_SHORTNAME.'_homepage_archive') == '' ){
  	?>
      
      <div class="row-fluid qw-indexmodule">           
    	<div class="span8" >
              <h1 class="qw-archive-title"><?php echo __('News','labelpro'); ?></h1>
               <div class="qw-listed-elements qw-posts">

                <?php
                global $paged;
                $temp = $wp_query;
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $qyery_array = array( 'post_type' => 'post', 'order_by' => 'post_date', 'post_status'=>'publish','paged' => $paged ) ;
                $wpbp = new WP_Query($qyery_array ); 
                $wp_query = $wpbp;
               
                get_template_part( 'part', 'archive' ); 
                wp_reset_query();
                ?>                    
                </div><!--  end listed elements -->
                  <p>
                <?php
          				global $wp_query;
          				$big = 999999999; // need an unlikely integer
          				echo paginate_links( array(
          					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          					'format' => '?paged=%#%',
          					'current' => max( 1, get_query_var('paged') ),
          					'total' => $wp_query->max_num_pages
          				) );
          				?>
                  </p>
      	</div><!--  end left col -->
        <!--  right col -->
        <div class="span4">
            <div class="qw-innerbox">
                  <div class="qw-inside-innerbox hidden-phone">
                      <?php display_sidebar("Home sidebar right"); ?>
                  </div>
            </div>
        </div>
        <!--  end right col -->
  	</div>
  	<!-- end main content -->
    <div class="canc"></div>  
    <?php 
    wp_reset_query();
    } ?>  
