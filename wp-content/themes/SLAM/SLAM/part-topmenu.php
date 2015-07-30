<div class="navbar navbar-inverse navbar-fixed-top">
 <div class="navbar-inner">
    <div class="container"> 
    	<?php
		// mp3 player controls
		
		if(post_type_exists('release') && wp_is_mobile() ) {
			
			get_template_part( 'part', 'playerControls' );
		}
		?>
    	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
		<div class="nav-collapse collapse">
		<?php
		$args = array(
			'theme_location' => 'menu_location_1',
			'depth' => 0,
			'container' => false,
			'menu_class' => 'nav',
			'walker' => new Bootstrap_Walker_Nav_Menu() 
		);
		if ( has_nav_menu( 'menu_location_1' ) ) {
			wp_nav_menu( $args );
		}else{
				echo '<strong>No menu is specified. Add a menu into "Appearance > Menus" in the "Top Menu Location"</strong>';
		}
		?>
      
        <?php
		// mp3 player controls
		
		if(post_type_exists('release') && ! wp_is_mobile()) {
			
			get_template_part( 'part', 'playerControls' );
		}
		?>


        
      </div>

    </div>
  </div>
</div>