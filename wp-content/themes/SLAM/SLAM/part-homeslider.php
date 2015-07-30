
    <?php 
    // slider ========================================================================
    if(get_option(THEME_SHORTNAME.'_homepage_slider') == 'enabled' ){
    ?>
    <div class="qw-indexmodule">
          <?php get_template_part( 'part', 'slider' ); ?>
    </div> 
    <?php }  ?>