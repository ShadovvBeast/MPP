<div class="row">
<div class="span12">
<?php
	if(get_option(THEME_SHORTNAME."_underconstruction_image")!=''){
		?>
        	<img src="<?php echo get_option(THEME_SHORTNAME."_underconstruction_image"); ?>" />
        <?php	
	}

?>
<?php echo html_entity_decode(stripslashes(get_option(THEME_SHORTNAME."_underconstruction_text"))); ?>
</div></div>
</div><!-- end of container opened in head -->
</body>
</html>
<?php

die();
?>