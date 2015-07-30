<?php 
// _homepage_multiboxes ========================================================================
if(get_option(THEME_SHORTNAME.'_homepage_multiboxes') == 'enabled' ){
?>
<div class="qw-indexmodule">
		<div class="qw-innerbox qw-homepage-multiboxes">
    	<div class="row-fluid">
          <div class="span4">
              <div class="qw-one-third">
                  <?php display_sidebar("Home row left"); ?>
              </div>
          </div>
          <div class="span4">
              <div class="qw-one-third">
                <?php display_sidebar("Home row middle"); ?>
              </div>
          </div>
          <div class="span4">
               <div class="qw-one-third">
                <?php display_sidebar("Home row right"); ?>
              </div>
          </div>
        </div>
        <div class="canc"></div>  
	</div>
</div>
<?php } ?>